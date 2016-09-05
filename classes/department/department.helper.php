<?php
// =============================================
class DepartmentHelper // =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	public function GetDepartmentsList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_departments_table ORDER BY `id` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_departments_table";
		}
		;
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_departments_table ORDER BY id DESC";
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
	public function GetDepartmentsListForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetDepartmentsList ( $parameters );
		
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
		$out ['name'] = "Departments";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "Department";
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
	public function GetSubordinationUsersArray($parameters, $parent_id) {
		// parent_id - id подразделения, которму подчинены пользователи
		// source_type = 1 - организация, = 2 - подразделение, = 3 - пользователь
		// возвращает таблицу всех подчиненных подразделению единиц
		if ($parent_id == "")
			$parent_id = 0;
		
		if ($this->db_type == "MYSQL")
			$query = "SELECT source_id FROM {$this->prefix}_relations_table where parent_id = {$parent_id} and parent_type = 2 and source_type = 3";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT source_id FROM {$this->prefix}_relations_table where parent_id = {$parent_id} and parent_type = 2 and source_type = 3";
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		
		$out = array ();
		
		$out ['name'] = "Users";
		
		$out_attributes = array ();
		
		foreach ( $array as $element ) {
			$array_tmp = array ();
			// $array_tmp1 = array();
			$User = new User ( $element ['source_id'], array () );
			// $array_tmp1 = $User->GetArrayForXML() ;
			$array_tmp = $User->GetArray ();
			
			// $out['childs'][] = $array_tmp;
			
			/*
			 * foreach($array_tmp as $e) { $elar = array(); $elar['name'] = "User"; //$elar['attributes'] = $e['attributes']; $out['childs'][] = $e['attributes']; echo implode('!!!',$e['attributes']); }
			 */
			
			// $out['childs'][] = array('name' => "User",'childs'=>$array_tmp1);
			$out ['childs'] [] = array (
					'name' => "User",
					'attributes' => $array_tmp 
			);
			$out_attributes [] = $array_tmp;
		}
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		
		return $out_attributes;
	}
	public function GetSubordinationDepartmentsArray($parameters, $parent_id) {
		// parent_id - id подразделения, которму подчинены пользователи
		// source_type = 1 - организация, = 2 - подразделение, = 3 - пользователь
		// возвращает таблицу всех подчиненных подразделению единиц
		// if ($parent_id =="") return array();
		if ($parent_id == "") {
			$parent_id = 0;
		}
		;
		
		if ($this->db_type == "MYSQL")
			$query = "SELECT source_id FROM {$this->prefix}_relations_table where parent_id = {$parent_id} and parent_type = 2 and source_type = 2";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT source_id FROM {$this->prefix}_relations_table where parent_id = {$parent_id} and parent_type = 2 and source_type = 2";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		
		$out = array ();
		$out_attributes = array ();
		
		$out ['name'] = "Departments";
		
		foreach ( $array as $element ) {
			$array_tmp = array ();
			$Department = new Department ( $element ['source_id'], array () );
			// $array_tmp = $Department->GetArrayForXML() ;
			$array_tmp = $Department->GetArray ();
			
			// $out['childs']= $array_tmp;
			$out ['childs'] [] = array (
					'name' => "Department",
					'attributes' => $array_tmp 
			);
			
			$out_attributes [] = $array_tmp;
			/*
			 * foreach ($array_tmp as $list) { $elar['name'] = "Department"; $elar['childs'] = $list; $Users = $this->GetSubordinationUsersArray($parameters, $list['id']); foreach ($Users as $ElementUser) { $elar['childs'][] = $ElementUser; }; $out['childs'][]=$elar; }
			 */
		}
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		
		return $out_attributes;
	}
	public function GetSubordinationUnitsArrayForXML($parameters, $parent_id) {
		// возвращает подчиненные подразделению структурные единицы
		// берем прямое подчинение
		$Departments = $this->GetSubordinationDepartmentsArray ( $parameters, $parent_id );
		$Users = $this->GetSubordinationUsersArray ( $parameters, $parent_id );
		
		$users_index = 1;
		if (! $Users) {
			$users_index = 0;
		}
		;
		
		$departments_index = 2;
		
		if (! $Departments) {
			$departments_index = 0;
		} else {
			if ($users_index == 0) {
				$departments_index = 1;
			}
		}
		
		$out = array ();
		$out ['name'] = "Subordination";
		
		if ($users_index != 0) {
			$out ['childs'] [$users_index] ['name'] = "Users";
			foreach ( $Users as $element ) {
				$out ['childs'] [$users_index] ['childs'] [] = array (
						'name' => "User",
						'attributes' => $element 
				);
			}
			
			$out ['childs'] [$departments_index] ['name'] = "Departments";
		}
		
		if ($departments_index != 0) {
			foreach ( $Departments as $element ) {
				// рекурсия - берем подчинение текущего подразделения с $parent_id
				$DepartmentChilds = $this->GetSubordinationUnitsArrayForXML ( $parameters, $element ['id'] );
				$out ['childs'] [$departments_index] ['childs'] [] = array (
						'name' => "Department",
						'attributes' => $element,
						'childs' => $DepartmentChilds 
				);
			}
		}
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		
		return $out;
	}
	
	// ==============================================
} // DepartmentHelper
  // ==============================================
?>