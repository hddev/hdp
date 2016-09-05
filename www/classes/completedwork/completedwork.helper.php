<?php
// =============================================
class CompletedWorkHelper // =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	public function GetCompletedWorksList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_completedworks_table ORDER BY `id` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_departments_table";
		}
		;
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_completedworks_table ORDER BY id DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_departments_table";
		}
		;
		
		// Модифицируем запрос для постраничного вывода и сортировки
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			$pagination = new Pagination ( $query, $count_query );
			
			if (isset ( $parameters ['per_page'] ))
				$pagination->SetPerPage ( $parameters ['per_page'] );
			$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
			$query = $pagination->ConstructQuery ( $page, $pagination_data );
		}
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	public function GetMaterials() {
		// $term = trim(strip_tags($_GET['term']));
		$term = "CX";
		$query = "SELECT material as term FROM {$this->prefix}_completedworks_materials_table WHERE material LIKE '%" . $term . "%'";
		
		$result = $this->db->query ( $query );
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		
		foreach ( $array as $element ) {
			$element ['term'] = htmlentities ( stripslashes ( $element ['term'] ) );
			$row_set [] = $element;
		}
		
		echo json_encode ( $row_set );
	}
	public function GetRequestCompletedWorksList($request_id) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_completedworks_table where `request_id` = {$request_id} and `status` = 0";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_completedworks_table where request_id = {$request_id} and status = 0";
		
		$result = $this->db->query ( $query );
		// alert0();
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		
		return $array;
	}
	public function GetRequestsListForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetCompletedWorksList ( $parameters );
		// alert0();
		if (isset ( $list ['pagination_data'] )) {
			$pagination_data = $list ['pagination_data'];
			unset ( $list ['pagination_data'] );
			$ar = array ();
			$ar ['name'] = "Pagination";
			foreach ( $pagination_data as $key => $element ) {
				$ar ['attributes'] [$key] = $element;
			}
			$out ['childs'] [] = $ar;
		}
		
		$out = array ();
		$out ['name'] = "CompletedWorks";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "CompletedWork";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar; // '$elar;
		}
		
		// if (count($external_data)>0) $out['childs'][]=array('name'=>"ExternalData",'childs'=>$external_data);
		
		$ar = array ();
		$ar ['name'] = "Pagination";
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		$out ['childs'] [] = $ar;
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetExternalDataForXML($import = false, $request_id, $executor_id, $cw_id) {
		$out = array ();
		$out ['name'] = "External";
		
		// добавляем сведения о запросе
		$request = new Request ( $request_id, array () );
		$elar ['name'] = "Request";
		$elar ['attributes'] = $request->GetArray ();
		$out ['childs'] [] = $elar;
		// добавляем сведения о запросе
		
		// подгружаем маршрут
		$requestroutehelper = new RequestRouteHelper ();
		$route = $requestroutehelper->GetRouteByRequestID ( $request_id );
		
		if (! empty ( $route )) {
			foreach ( $route as $element ) {
				$elar = array ();
				$route = new Route ( $element ['route_id'] );
				$route_id = $element ['route_id'];
			}
		} else {
			$route = new Route ( 7 );
		}
		
		$elar ['name'] = "RequestRoute";
		
		$elar ['attributes'] = $route->GetArray ();
		$out ['childs'] [] = $elar;
		// подгружаем маршрут
		
		// подгружаем расходник
		
		if ($route->GetAllowMaterial () == "1") {
			$material_helper = new CompletedWorkMaterialHelper ();
			$material = $material_helper->GetCompletedWorkMaterialList ( $cw_id ); // ); //$requestroutehelper -> GetRouteByRequestID($request_id);
			
			if (! empty ( $material )) {
				foreach ( $material as $element ) {
					$elar = array ();
					$material = new CompletedWorkMaterial ( $element ['id'] );
				}
				;
				
				$elar ['name'] = "RequestMaterial";
				
				$elar ['attributes'] = $material->GetArray ();
				$out ['childs'] [] = $elar;
			}
			;
		}
		;
		// подгружаем расходник
		
		// подгружаем текущего пользователя и сведения об организации
		$elar = array ();
		$elar ['name'] = "User";
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		$elar ['attributes'] = $user->GetArray ();
		$out ['childs'] [] = $elar;
		
		$elar = array ();
		$elar ['name'] = "Executor";
		$user = new User ( $executor_id );
		$elar ['attributes'] = $user->GetArray ();
		$out ['childs'] [] = $elar;
		
		$elar = array ();
		$elar ['name'] = "Organization";
		$organizationhelper = new OrganizationHelper ();
		$organization_id = $organizationhelper->GetCurrentUserOrganization ();
		$organization = new Organization ( $organization_id, array () );
		$elar ['attributes'] = $organization->GetArray ();
		$out ['childs'] [] = $elar;
		
		$external_addresses = $organizationhelper->GetOrganizationAddresses ( $organization_id );
		
		if (! empty ( $external_addresses )) {
			foreach ( $external_addresses as $element ) {
				$elar = array ();
				$elar ['name'] = "Address";
				$elar ['attributes'] = $element;
				$out ['childs'] [] = $elar; // '$elar;
			}
		}
		
		$elar = array ();
		$elar ['name'] = "Contract";
		$contractservicegrouphelper = new ContractServicesGroupHelper ();
		
		$contract_id = $request->GetContractID ();
		$contractservicesgroups = $contractservicegrouphelper->GetGroupServicesList ( $request->GetContractID () );
		
		$contract = new Contract ( $request->GetContractID (), array () );
		$elar ['attributes'] = $contract->GetArray ();
		$out ['childs'] [] = $elar;
		
		if (! empty ( $contractservicesgroups )) {
			foreach ( $contractservicesgroups as $element ) {
				$elar = array ();
				$elar ['name'] = "ContractServiceGroup";
				$elar ['attributes'] = $element;
				
				$contractservices = new ContractServiceHelper ();
				$contractservicesarray = $contractservices->GetGroupServicesList ( $element ['id'] );
				// alert();
				$elar ['childs'] [1] ['name'] = "ContractServices";
				foreach ( $contractservicesarray as $service_element ) {
					$elar ['childs'] [1] ['childs'] [] = array (
							'name' => "ContractService",
							'attributes' => $service_element 
					);
				}
				
				$out ['childs'] [] = $elar; // '$elar;
			}
			;
		}
		;
		
		// подгружаем текущего пользователя и сведения об организации
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetRequestCompletedWorksListForXML($parameters = array(), $import = false, $external_data = array(), $request_id) {
		$list = $this->GetRequestCompletedWorksList ( $request_id );
		
		if (isset ( $list ['pagination_data'] )) {
			$pagination_data = $list ['pagination_data'];
			unset ( $list ['pagination_data'] );
			$ar = array ();
			$ar ['name'] = "Pagination";
			foreach ( $pagination_data as $key => $element ) {
				$ar ['attributes'] [$key] = $element;
			}
			$out ['childs'] [] = $ar;
		}
		
		$out = array ();
		$out ['name'] = "CompletedWorks";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "CompletedWork";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar; // '$elar;
		}
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function IsWorkVisidbleForUserID($request_id) {
		return true;
	}
	
	// ==============================================
} // CompletedWorksHelper
  // ==============================================
?>
