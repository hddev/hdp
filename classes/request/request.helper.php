<?php
// =============================================
class RequestHelper// =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $this->db_type = $GLOBALS ['DB_TYPE'];
	}
	public function GetRequestsList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_requests_table ORDER BY `id` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_requests_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_requests_table ORDER BY id DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_requests_table";
		}
		
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
	
	// формирует формулу отбора с запросом поиска
	public function GetSearchQuery($category) {
		if (! isset ( $_REQUEST ['q'] )) {
			return " ";
		} else {
			if ($_REQUEST ['q'] == "") {
				return " ";
			}
			;
		}
		
		$query = $_REQUEST ['q'];
		$query = trim ( $query );
		
		if ($this->db_type == "MYSQL")
			$query = mysql_real_escape_string ( $query );
		if ($this->db_type == "POSTGRESQL")
			$query = pg_escape_string ( $query );
		
		$query = htmlspecialchars ( $query );
		$query = strtolower ( $query );
		
		if ($category == "extreme") {
			$result = " WHERE LOWER(requests.requesttext) LIKE '%$query%'
			OR LOWER(requests.fio) LIKE '%$query%' OR LOWER(requests.request_number) LIKE '%$query%' ";
		} else {
			$result = " AND (LOWER(requests.requesttext) LIKE '%$query%'
			OR LOWER(requests.fio) LIKE '%$query%' OR LOWER(requests.request_number) LIKE '%$query%') ";
		}
		
		return $result;
	}
	// формирует формулу отбора с запросом поиска
	public function GetCaseOrderByQueryIssue() {
		$result = "";
		if ($this->db_type == "MYSQL") {
			$result = "CASE
				WHEN status = 6
 				THEN 2
				WHEN status = 2
				THEN 3
				WHEN status = 3
				THEN 4
				WHEN status = 7
				THEN 5
				WHEN status = 10
				THEN 6
				WHEN status = 4
				THEN 7
				ELSE status
 				END";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			
			$result = "CASE
				WHEN (status = 0) THEN 0
				WHEN (status = 1) THEN 1
				WHEN (status = 6) THEN 2
				WHEN (status = 2) THEN 3
				WHEN (status = 3) THEN 4
				WHEN (status = 7) THEN 5
				WHEN (status = 10) THEN 6
				WHEN (status = 4) THEN 7				
 				END";
			
			/*
			 * $result = "CASE status WHEN 6 THEN 2 WHEN 2 THEN 3 WHEN 3 THEN 4 WHEN 7 THEN 5 WHEN 10 THEN 6 WHEN 4 THEN 7 END";
			 */
			$result = "status";
		}
		
		return $result;
	}
	public function GetCurrentUserRequestsList($parameters) {
		
		// все запросы не переведены на разные СУБД, так как для PgSQL и MySQL синтакисис ЗДЕСЬ одинаков!!!пока)))
		$status = "";
		$query = "";
		$type = "";
		
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		$user_id = $user->GetId ();
		
		$category = "";
		$sort_type = "DESC";
		$order_column = "id"; // status"; - сортировочный столбец по умолчанию
		
		if (isset ( $_REQUEST ['ordertype'] ))
			$sort_type = $_REQUEST ['ordertype'];
		if (isset ( $_REQUEST ['orderby'] ))
			$order_column = $_REQUEST ['orderby'];
		
		if (isset ( $_REQUEST ['category'] ))
			$category = $_REQUEST ['category'];
		
		if ($order_column == "status")
			$order_column = $this->GetCaseOrderByQueryIssue ();
		$search = $this->GetSearchQuery ( $category );
		
		switch ($category) {
			/*
			 * case "inwork": $query = "SELECT DISTINCT requests.* FROM {$this->prefix}_requests_table AS requests LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id WHERE (requests.status = 1 OR requests.status = 6 OR requests.status = 2 OR requests.status = 3 OR requests.status = 7) AND ( requests.author_id = {$user_id} OR approve.approver_id = {$user_id} OR executants.executor_id = {$user_id} OR routeapprove.approver_id = {$user_id})" .$search ."ORDER BY {$order_column} $sort_type"; $count_query = "SELECT COUNT(DISTINCT requests.id) FROM {$this->prefix}_requests_table AS requests LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id WHERE (requests.status = 1 OR requests.status = 6 OR requests.status = 2 OR requests.status = 3 OR requests.status = 7) AND ( requests.author_id = {$user_id} OR approve.approver_id = {$user_id} OR executants.executor_id = {$user_id} OR routeapprove.approver_id = {$user_id})" .$search; break;
			 */
			
			case "inwork" :
				$query = "SELECT DISTINCT
					requests.*
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
					WHERE (requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']} AND routeapprove.approver_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']} AND executants.executor_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']} AND requests.author_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']} AND approve.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
				
				$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
					WHERE (requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']} AND routeapprove.approver_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']} AND executants.executor_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']} AND requests.author_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']} AND approve.approver_id = {$user_id})" . $search;
				break;
			
			case "oncontrol" :
				$query = "SELECT DISTINCT 
					requests.*
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (approve.approver_id = {$user_id} OR routeapprove.approver_id = {$user_id} OR requests.author_id = {$user_id})
					AND requests.status != {$GLOBALS['REQUEST_STATUS_DONE']}
					AND requests.status != {$GLOBALS['REQUEST_STATUS_DECLINE']}
					AND requests.status != {$GLOBALS['REQUEST_STATUS_NEW']}
					AND NOT requests.id IN 
					(SELECT DISTINCT
					requests.id
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
					WHERE (requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']} AND routeapprove.approver_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']} AND executants.executor_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']} AND requests.author_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']} AND approve.approver_id = {$user_id}))" . $search . "ORDER BY {$order_column} $sort_type";
				
				$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (approve.approver_id = {$user_id} OR routeapprove.approver_id = {$user_id} OR requests.author_id = {$user_id})
					AND requests.status != {$GLOBALS['REQUEST_STATUS_DONE']}
					AND requests.status != {$GLOBALS['REQUEST_STATUS_DECLINE']}
					AND requests.status != {$GLOBALS['REQUEST_STATUS_NEW']}
					AND NOT requests.id IN 
					(SELECT DISTINCT
					requests.id
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
					WHERE (requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']} AND routeapprove.approver_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']} AND executants.executor_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']} AND requests.author_id = {$user_id})
					OR (requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']} AND approve.approver_id = {$user_id}))" . $search;
				break;
			
			case "done" :
				$query = "SELECT DISTINCT
				requests.*
				FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
				WHERE (requests.status = 4)
				AND (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
				
				$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
				WHERE (requests.status = 4)
				AND (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search;
				break;
			
			case "signing" :
				$query = "SELECT DISTINCT
				requests.*
				FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
				WHERE (requests.status = 10)
				AND (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
				
				$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
				WHERE (requests.status = 10)
				AND (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search;
				break;
			
			case "extreme" :
				$query = "SELECT * FROM {$this->prefix}_requests_table AS requests " . $search . "ORDER BY {$order_column} {$sort_type}";
				$count_query = "SELECT COUNT(*) FROM {$this->prefix}_requests_table AS requests " . $search;
				break;
			
			case "approving" :
				if (isset ( $_REQUEST ['rl_status'] ) and $type != "1") {
					// alert();
					$array_statuses = array (
							"1" => "На согласовании",
							"6" => "На принятии в работу",
							"2" => "На распределении работ",
							"3" => "Исполнение работ",
							"7" => "Отметка об исполнении",
							"10" => "Отметка со стороны заказчика",
							"4" => "Архив(исполнено)" 
					);
					if (array_key_exists ( $_REQUEST ['rl_status'], $array_statuses )) {
						$status = $_REQUEST ['rl_status'];
					}
				}
				
				if ($status == "") {
					
					$query = "SELECT DISTINCT
					requests.*
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (requests.status = 1) and (
					requests.author_id = {$user_id} OR
					approve.approver_id = {$user_id} OR
					executants.executor_id = {$user_id} OR
					routeapprove.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
					
					$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (requests.status = 1) and (
					(requests.author_id = {$user_id} OR
					approve.approver_id = {$user_id} OR
					executants.executor_id = {$user_id} OR
					routeapprove.approver_id = {$user_id})" . $search;
				} 

				else {
					$query = "SELECT DISTINCT
					requests.*
					FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (requests.status = $status) AND (
					requests.author_id = {$user_id} OR
					approve.approver_id = {$user_id} OR
					executants.executor_id = {$user_id} OR
					routeapprove.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
					
					$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
					{$this->prefix}_requests_table AS requests
					LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
					LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
					
					LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
					LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
					
					WHERE (requests.status = $status) AND (
					requests.author_id = {$user_id} OR
					approve.approver_id = {$user_id} OR
					executants.executor_id = {$user_id} OR
					routeapprove.approver_id = {$user_id})" . $search;
				}
				;
				break;
			
			default :
				$query = "SELECT DISTINCT
				requests.*
				FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				LEFT JOIN {$this->prefix}_requests_activity_table AS activity ON requests.id = activity.request_id
				
				WHERE (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search . "ORDER BY {$order_column} $sort_type";
				
				// alert();
				
				$count_query = "SELECT COUNT(DISTINCT requests.id) FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				
				WHERE (
				requests.author_id = {$user_id} OR
				approve.approver_id = {$user_id} OR
				executants.executor_id = {$user_id} OR
				routeapprove.approver_id = {$user_id})" . $search;
				break;
		}
		
		// Модифицируем запрос для постраничного вывода и сортировки
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			
			$pagination = new Pagination ( $query, $count_query );
			
			if (isset ( $parameters ['per_page'] ))
				$pagination->SetPerPage ( $parameters ['per_page'] );
			$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
			$query = $pagination->ConstructQuery ( $page, $pagination_data );
			
			if (isset ( $parameters ['rl_status'] )) {
				$pagination_data ['rl_status'] = $parameters ['rl_status'];
			} else {
				$pagination_data ['rl_status'] = "";
			}
			if (isset ( $parameters ['rl_type'] )) {
				$pagination_data ['rl_type'] = $parameters ['rl_type'];
			} else {
				$pagination_data ['rl_type'] = "";
			}
		}
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	public function IsRequestVisibleForUserID($request_id) {
		// проверка имеет пользователь доступ к запросу или нет
		return false;
	}
	public function GetRequestsListForXML($parameters, $import = false) {
		// ,$external_data=array()
		$parameters = array ();
		
		if (isset ( $_REQUEST ['page'] )) {
			$parameters ['page'] = intval ( $_REQUEST ['page'] );
		} else {
			$parameters ['page'] = 0;
		}
		if (isset ( $_REQUEST ['per_page'] )) {
			$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
		} else {
			$parameters ['per_page'] = PER_PAGE;
		}
		;
		if (isset ( $_REQUEST ['type'] )) {
			$parameters ['rl_type'] = $_REQUEST ['type'];
		}
		if (isset ( $_REQUEST ['rl_status'] )) {
			$parameters ['rl_status'] = $_REQUEST ['rl_status'];
		}
		
		if (isset ( $_REQUEST ['category'] )) {
			$parameters ['category'] = $_REQUEST ['category'];
		} else {
			$parameters ['category'] = 'all';
		}
		
		if (isset ( $_REQUEST ['q'] )) {
			$parameters ['query_search'] = $_REQUEST ['q'];
		} else {
			$parameters ['query_search'] = '';
		}
		
		$list = $this->GetCurrentUserRequestsList ( $parameters );
		
		// $list=$this->GetRequestsList($parameters);
		$pagination_data = array ();
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
		
		$query_unread_marks = "";
		$out = array ();
		$out ['name'] = "Requests";
		$elar = array ();
		
		if (empty ( $list )) {
			$out ['childs'] [] = $elar;
		} else {
			foreach ( $list as $element ) {
				$elar = array ();
				$elar ['name'] = "Request";
				$elar ['attributes'] = $element;
				
				if ($query_unread_marks == "") {
					$query_unread_marks = "request_id = " . $element ['id'];
				} else {
					$query_unread_marks = $query_unread_marks . " OR " . "request_id = " . $element ['id'];
				}
				
				$elar ['childs'] [0] ['name'] = "ExternalData";
				$elar ['childs'] [0] ['childs'] = $this->GetExternalDataForListXML ( false, $element );
				/*
				 * $request = new Request($element['id']); $elar1 = $request -> GetArrayForXML(false, $this -> GetExternalDataForXML(false, $element));
				 */
				// alert();
				$out ['childs'] [] = $elar; // '$elar;
			}
		}
		
		// if (count($external_data)>0) $out['childs'][]=array('name'=>"ExternalData",'childs'=>$external_data);
		
		// Информация о группе текущего пользователя
		$ar = array ();
		$ar ['name'] = "CurrentUserGroup";
		
		$Access = new Access ();
		$CGroup = new UserGroup ( $Access->GetCurrentUser ()->GetGroupId () );
		
		$ar ['attributes'] ['sname'] = $CGroup->GetShortName ();
		$out ['childs'] [] = $ar;
		// ------------------------------------------
		
		// Информация о статусе автоматической загрузки контента
		if (isset ( $_REQUEST ['auto-reload-mode'] )) {
			$ar = array ();
			$ar ['name'] = "AutoReloadRequestsList";
			$ar ['attributes'] ['status'] = true;
			
			if (isset ( $_REQUEST ['fromcategory'] ))
				$ar ['attributes'] ['category'] = $_REQUEST ['fromcategory'];
			
			$out ['childs'] [] = $ar;
		}
		
		// ------------------------------------------
		
		$ar = array ();
		$ar ['name'] = "Pagination";
		
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		
		$out ['childs'] [] = $ar;
		
		// / отметки по запросам
		$ar = array ();
		$ar ['name'] = "ReadMarks";
		$requestactivityhelper = new RequestActivityHelper ();
		$marks = array ();
		$marks = $requestactivityhelper->GetReadMarks ( $query_unread_marks, $Access->GetCurrentUser ()->GetId () );
		
		if (! empty ( $marks )) {
			foreach ( $marks as $element ) {
				$elar = array ();
				$elar ['name'] = "ReadMark";
				$elar ['attributes'] = $element;
				$ar ['childs'] [] = $elar;
			}
		}
		
		$out ['childs'] [] = $ar;
		// / отметки по запросам*/
		
		$ar = array ();
		$ar ['name'] = "UIView";
		$ar ['attributes'] ['category'] = $parameters ['category'];
		$out ['childs'] [] = $ar;
		
		$ar = array ();
		$ar ['name'] = "Search";
		$ar ['attributes'] ['query'] = $parameters ['query_search'];
		$out ['childs'] [] = $ar;
		
		// if( count($external_data) > 0 ) $out['childs'][] = array('name' => "ExternalData",'childs'=>$external_data);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetAdditionalFieldsList($request_id) {
		// список необязательных(кастомных) полей для запроса
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where `request_id` = {$request_id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where request_id = '{$request_id}'";
		
		$result = $this->db->query ( $query );
		// alert0();
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		
		return $array;
		// список необязательных(кастомных) полей для запроса
	}
	public function GetExternalDataForXML($import = false, $request = array()) {
		$out = array ();
		$out ['name'] = "External";
		
		if (isset ( $_REQUEST ['category'] )) {
		}
		
		if ($request ['id'] == 0) {
			$fields = $this->GetCurrentUserOrganizationAdditionalFields ();
			if (! empty ( $fields )) {
				foreach ( $fields as $element ) {
					$elar = array ();
					$elar ['name'] = "AdditionalField";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;
				}
			}
		} else {
			$list = $this->GetAdditionalFieldsList ( $request ['id'] );
			
			if (! empty ( $list )) {
				foreach ( $list as $element ) {
					$elar = array ();
					$elar ['name'] = "AdditionalField";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;
				}
			}
		}
		;
		
		// выполненные работы - вынесено в ajax
		/*
		 * if ($request['id'] != 0) { $cwhelper = new CompletedWorkHelper(); $list = $cwhelper -> GetRequestCompletedWorksList($request['id']); if (!empty($list)) { foreach ($list as $element) { $elar=array(); $elar['name']="CompletedWork"; $elar['attributes']=$element; $out['childs'][]=$elar;// '$elar; } } }
		 */
		// выполненные работы
		
		// акты о дефектации
		// выполненные работы
		/*
		 * if ($request['id'] != 0) { $uploadshelper = new UploadsFileHelper(); $requestuploadhelper = new RequestsUploadsHelper(); $list = $requestuploadhelper -> GetRequestDefects($request['id']); if (!empty($list)) { foreach ($list as $element) { $elar=array(); $elar['name']="Defect"; $elar['attributes']=$element; $out['childs'][]=$elar;// '$elar; } } }
		 */
		// акты о дефектации
		
		// сохранные расписки
		/*
		 * if ($request['id'] != 0) { $trustreceipyhelper = new TrustReceiptHelper(); $list = $trustreceipyhelper -> GetTrustReceiptsList($request['id']); if (!empty($list)) { foreach ($list as $element) { $elar=array(); $elar['name']="TrustReceipt"; $elar['attributes']=$element; $out['childs'][]=$elar;// '$elar; } } }
		 */
		// сохранные расписки
		
		// вложения
		if ($request ['id'] != 0) {
			$uploadhelper = new UploadsFileHelper ();
			$requestuploadhelper = new RequestsUploadsHelper ();
			$list = $requestuploadhelper->GetRequestUploads ( $request ['id'] );
			
			if (! empty ( $list )) {
				foreach ( $list as $element ) {
					$elar = array ();
					$elar ['name'] = "Upload";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;*/
				}
			}
		}
		// вложения
		
		// --- список маршрутов ---
		if ($request ['status'] == "0") {
			
			$routehelper = new RouteHelper ();
			$route_list = $routehelper->GetRoutesList ( array () );
			
			if (! empty ( $route_list )) {
				foreach ( $route_list as $element ) {
					$elar = array ();
					$elar ['name'] = "Route";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar;
				}
			}
		}
		// --- список маршрутов ---
		
		// маршрут для текущего запроса - при наличии
		// if ($request['status'] <> "0") {
		
		$requestroutehelper = new RequestRouteHelper ();
		$route = $requestroutehelper->GetRouteByRequestID ( $request ['id'] );
		
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
		
		// }
		// маршрут для текущего запроса - при наличии
		
		// -- на этапе распределения подгружаем распределяторов для маршрута ---
		if ($request ['status'] == "2") {
			if ($route_id == "") {
				$requestroutehelper = new RequestRouteHelper ();
				$route = $requestroutehelper->GetRouteByRequestID ( $request ['id'] );
				
				if (! empty ( $route )) {
					foreach ( $route as $element ) {
						$elar = array ();
						$route = new Route ( $element ['route_id'] );
						$route_id = $element ['route_id'];
					}
				}
			}
			
			$routehelper = new RouteHelper ();
			$route_approvers = $routehelper->GetRouteApprovers ( $route_id );
			
			if (! empty ( $route_approvers )) {
				foreach ( $route_approvers as $element ) {
					$elar = array ();
					$elar ['name'] = "RouteApprover";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;*/
				}
			}
		}
		// -- на этапе распределения подгружаем распределяторов для маршрута ---
		
		// анкета удовлетворенности
		if ($request ['status'] == "10" | $request ['status'] == "4") {
			$satisfactionhelper = new SatisfactionHelper ();
			$list = $satisfactionhelper->GetRequestSatisfactionID ( $request ['id'] );
			
			if (! empty ( $list )) {
				$elar = array ();
				
				$elar ['name'] = "Satisfaction";
				$satisfaction = new Satisfaction ( $list ['id'] );
				
				$external = $satisfactionhelper->GetSatisfacionExternalDataForXML ( $satisfaction->GetId () );
				
				$elar ['attributes'] = $satisfaction->GetArray ();
				$elar ['childs'] [0] ['name'] = "ExternalData";
				$elar ['childs'] [0] ['childs'] = $external;
				
				$out ['childs'] [] = $elar;
			}
		}
		// анкета удовлетворенности
		
		// подгружаем текущего пользователя и сведения об организации
		$elar = array ();
		$elar ['name'] = "Author";
		$user = new User ( $request ['author_id'] );
		$elar ['attributes'] = $user->GetArray ();
		$out ['childs'] [] = $elar;
		
		$elar = array ();
		$elar ['name'] = "User";
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		$elar ['attributes'] = $user->GetArray ();
		$out ['childs'] [] = $elar;
		
		$elar = array ();
		$elar ['name'] = "Organization";
		$organizationhelper = new OrganizationHelper ();
		$organization_id = $organizationhelper->GetUserOrganizationID ( $request ['author_id'] );
		
		// fix - не совпадает организация автора и организация,указанная в запросе
		if ($request ['contractor_id'] != $organization_id)
			$organization_id = $request ['contractor_id'];
			// fix - не совпадает организация автора и организация,указанная в запросе
			
		// alert();
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
		
		// подгружаем текущего пользователя и сведения об организации
		
		// подгружаем Договор
		if ($request ['status'] == "6") {
			// подгружаем все договора
			$contract_helper = new ContractHelper ();
			$contracts_list = $contract_helper->GetContarctsList ( null );
			if (! empty ( $contracts_list )) {
				foreach ( $contracts_list as $element ) {
					$elar = array ();
					$elar ['name'] = "Contract";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;
				}
			}
		} else {
			if (! empty ( $request ['contract_id'] )) {
				$elar = array ();
				$elar ['name'] = "Contract";
				$contract = new Contract ( $request ['contract_id'], array () );
				$elar ['attributes'] = $contract->GetArray ();
				$out ['childs'] [] = $elar;
			}
			;
		}
		
		if (! empty ( $request ['service_contract'] )) {
			$elar = array ();
			$elar ['name'] = "ServiceContract";
			$service = new ContractService ( $request ['service_contract'], array () );
			$elar ['attributes'] = $service->GetArray ();
			$out ['childs'] [] = $elar;
		}
		;
		// подгружаем Договор
		
		// для запросов на согласовании - подгружаем согласующих
		if ($request ['status'] == 1) {
			$approverhelper = new RequestApproverHelper ();
			$request_approvers = $approverhelper->GetOrganizationApproversList ( $organization_id );
			
			if (! empty ( $request_approvers )) {
				foreach ( $request_approvers as $element ) {
					$elar = array ();
					$elar ['name'] = "Approver";
					$elar ['attributes'] = $element;
					$out ['childs'] [] = $elar; // '$elar;
				}
			} else {
				// перекидываем на этап "принятие в работу"
			}
		}
		// для запросов на согласовании - подгружаем согласующих
		
		// подгружаем исполнителей
		$executorshelper = new RequestExecutorHelper ();
		$external_executors = $executorshelper->GetRequestExecutorsList ( $request ['id'] );
		
		if (! empty ( $external_executors )) {
			foreach ( $external_executors as $element ) {
				$elar = array ();
				$elar ['name'] = "RequestExecutor";
				$elar ['attributes'] = $element;
				$elar ['childs'] [0] ['name'] = "Executor";
				$executant = new User ( $element ['executor_id'], array () );
				$elar ['childs'] [0] ['name'] = "Executant";
				$elar ['childs'] [0] ['attributes'] = $executant->GetArray ();
				$out ['childs'] [] = $elar; // '$elar;
			}
		}
		// подгружаем исполнителей
		
		// подгружаем список потребностей
		$requirementhelper = new RequirementHelper ();
		$require_list = $requirementhelper->GetRequestRequirementsList ( $request ['id'] );
		if (! empty ( $require_list )) {
			foreach ( $require_list as $element ) {
				$elar = array ();
				$elar ['name'] = "Requirement";
				$elar ['attributes'] = $element;
				$out ['childs'] [] = $elar;
			}
		}
		// подгружаем список потребностей
		
		// погружаем сообщения - сделано на jquery
		/*
		 * $messagehelper = new MessageHelper(); $messages_list = $messagehelper -> GetRequestMessagesList($request['id']); if (!empty($messages_list)) { foreach ($messages_list as $element) { $elar=array(); $elar['name']="Message"; $elar['attributes'] = $element; $msguser = new User($element['user_id']); $elar['attributes']['secondname'] = $msguser -> GetSecondname(); $elar['attributes']['firstname'] = $msguser -> GetFirstname(); $elar['attributes']['patronymic'] = $msguser -> GetPatronymic(); $out['childs'][]=$elar; } }
		 */
		// погружаем сообщения
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetExternalSynchronizationDataForXML($import = false, $request = array()) {
		$out = array ();
		$out ['name'] = "External";
		
		// дополнительные поля, файлы, исполнители
		
		// подгружаем доп поля
		$elar = array ();
		$addfieldshelper = new AdditionalFieldsHelper ();
		$addfields_list = $addfieldshelper->GetRequestFieldsList ( $request ['id'] );
		if (! empty ( $addfields_list )) {
			foreach ( $addfields_list as $element ) {
				$elar = array ();
				$elar ['name'] = "AdditionalField";
				$elar ['attributes'] = $element;
				$out ['childs'] [] = $elar;
			}
		}
		// подгружаем доп поля
		
		// подгружаем файлы
		$elar = array ();
		$uploadsfilehelper = new UploadsFileHelper ();
		$requestuploadshelper = new RequestsUploadsHelper ();
		$uploads_list = $requestuploadshelper->GetRequestUploads ( $request ['id'] );
		if (! empty ( $uploads_list )) {
			foreach ( $uploads_list as $element ) {
				$elar = array ();
				$elar ['name'] = "File";
				$elar ['attributes'] = $element;
				$out ['childs'] [] = $elar;
			}
		}
		// подгружаем файлы
		
		// подгружаем исполнителей
		$executorshelper = new RequestExecutorHelper ();
		$external_executors = $executorshelper->GetRequestExecutorsList ( $request ['id'] );
		
		if (! empty ( $external_executors )) {
			foreach ( $external_executors as $element ) {
				$elar = array ();
				$elar ['name'] = "Executor";
				$elar ['attributes'] = $element;
				$out ['childs'] [] = $elar; // '$elar;
			}
		}
		// подгружаем исполнителей
		
		// дополнительные поля, файлы, исполнители
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetExternalDataForListXML($import = false, $request = array()) {
		$out = array ();
		$out ['name'] = "External";
		
		// подгружаем автора и сведения об организации
		
		$elar = array ();
		$elar ['name'] = "Author";
		$user = new User ( $request ['author_id'] );
		$elar ['attributes'] = $user->GetArray ();
		$out ['childs'] [] = $elar;
		
		$elar = array ();
		$elar ['name'] = "Organization";
		$organizationhelper = new OrganizationHelper ();
		$organization_id = $organizationhelper->GetUserOrganizationID ( $request ['author_id'] );
		// alert();
		$organization = new Organization ( $organization_id, array () );
		$elar ['attributes'] = $organization->GetArray ();
		$out ['childs'] [] = $elar;
		
		// подгружаем текущего пользователя и сведения об организации
		
		// подгружаем Договор
		if (! empty ( $request ['contract_id'] )) {
			$elar = array ();
			$elar ['name'] = "Contract";
			$contract = new Contract ( $request ['contract_id'], array () );
			$elar ['attributes'] = $contract->GetArray ();
			$out ['childs'] [] = $elar;
		}
		;
		
		if (! empty ( $request ['service_contract'] )) {
			$elar = array ();
			$elar ['name'] = "ServiceContract";
			$service = new ContractService ( $request ['service_contract'], array () );
			$elar ['attributes'] = $service->GetArray ();
			$out ['childs'] [] = $elar;
		}
		;
		// подгружаем Договор
		
		$elar = array ();
		$elar ['name'] = "Importance";
		$additionalfieldshelper = new AdditionalFieldsHelper ();
		$result = $additionalfieldshelper->GetRequestImportance ( $request ['id'] );
		$elar ['attributes'] ['value'] = $result;
		$out ['childs'] [] = $elar;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetCurrentUserOrganizationAdditionalFields() {
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		
		$unit_id = $user->GetId ();
		
		if ($this->db_type == "MYSQL" or $this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_relations_table where source_id = {$unit_id} and source_type = 3";
		
		$result = $this->db->query ( $query );
		if (! $result) {
			$organization_id = 0;
			return false;
		}
		;
		
		$array = $result->GetRow ( MYSQL_ASSOC ); // ->GetAllRows(MYSQL_ASSOC);
		$parent_type = $array ['parent_type']; // -- ищем единицу с типом 1 - организацию --
		
		while ( $parent_type != 1 ) {
			if ($array ['parent_id'] == '') {
				return false;
			}
			;
			
			if ($this->db_type == "MYSQL" or $this->db_type == "POSTGRESQL")
				$query = "SELECT * FROM {$this->prefix}_relations_table where source_id = {$array['parent_id']} and source_type = {$array['parent_type']}";
			$result = $this->db->query ( $query );
			
			if (! $result) {
				$organization_id = 0;
				return false;
			}
			;
			
			$array = $result->GetRow ( MYSQL_ASSOC ); // ->GetAllRows(MYSQL_ASSOC);
			$parent_type = $array ['parent_type'];
		}
		;
		
		$organization_id = $array ['parent_id'];
		
		if ($this->db_type == "MYSQL" or $this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_organizations_additionalfields_table where organization_id = '{$organization_id}'";
		$result = $this->db->query ( $query );
		if (! $result) {
			return false;
		}
		;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC ); // ->GetAllRows(MYSQL_ASSOC);
		
		/*
		 * $fieldsaliases_array_tmp = explode("|", $array['additional_fields_aliases']); $fields_array = array();
		 */
		
		$fields_array = array ();
		
		foreach ( $array as $element ) {
			$elar = array ();
			$elar ['field_name'] = $element ['field_name'];
			$elar ['field_alias'] = $element ['field_alias'];
			$elar ['field_value'] = "";
			$fields_array [] = $elar;
		}
		;
		
		return $fields_array;
	}
	private function GetRequestNotificationsList($user_id) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT DISTINCT
				requests.id, requests.fio, requests.request_number, requests.requesttext
				FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				FULL JOIN {$this->prefix}_requests_activity_table AS activity ON (requests.id = activity.request_id and activity.user_id={$user_id})
				FULL JOIN {$this->prefix}_api_notifications_table AS api ON (requests.id = api.request_id and api.user_id={$user_id})
				WHERE (
				(requests.author_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']}) OR
				(approve.approver_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']}) OR
				(executants.executor_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']}) OR
				(routeapprove.approver_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']})) and (activity.status is NULL) and (api.id is NULL)
				ORDER BY requests.id DESC LIMIT 5";
		}
		;
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT DISTINCT
				requests.id, requests.fio, requests.request_number, requests.requesttext
				FROM
				{$this->prefix}_requests_table AS requests
				LEFT JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
				LEFT JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
				LEFT JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
				LEFT JOIN {$this->prefix}_route_approve_table AS routeapprove ON routes.route_id = routeapprove.route_id
				FULL JOIN {$this->prefix}_requests_activity_table AS activity ON (requests.id = activity.request_id and activity.user_id={$user_id})
				FULL JOIN {$this->prefix}_api_notifications_table AS api ON (requests.id = api.request_id and api.user_id={$user_id})
				WHERE (
				(requests.author_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_CONFIRMATION']}) OR
				(approve.approver_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_APPROVE']}) OR
				(executants.executor_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_INWORK']}) OR
				(routeapprove.approver_id = {$user_id} AND requests.status = {$GLOBALS['REQUEST_STATUS_CONSIDERATION']})) 
				and (activity.status is NULL) and (api.id is NULL)
				ORDER BY requests.id DESC LIMIT 5";
		}
		;
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
	}
	public function GetRequestNotificationsListForXML($user_id, $import = false) {
		$list = $this->GetRequestNotificationsList ( $user_id );
		
		$out = array ();
		$out ['name'] = "Notifications";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "Notification";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar; // '$elar;
			$this->CreateAPINotificationMark ( $element ['id'], $user_id );
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	private function CreateAPINotificationMark($request_id, $user_id) {
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_api_notifications_table` (`request_id`,`user_id`)
													VALUES ('{$request_id}','{$user_id}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$id = $this->db->GetPGInsertId ( "{$this->prefix}_api_notifications_table" );
			$query = "INSERT INTO {$this->prefix}_api_notifications_table (id,request_id,user_id)
					VALUES ('{$id}','{$request_id}','{$user_id}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addApiNotification", 'APINotificationID:' . $id, '' );
	}
	public function GetRequestIndex($request_id) {
		$prefix = $GLOBALS ['REQUESTS_PREFIX'] . date ( "y" ) . "-" . date ( "m" ) . "-" . date ( "d" ) . "-";
		if (strlen ( strval ( $request_id ) ) == 1)
			$postfix = "0000" . strval ( $request_id );
		if (strlen ( strval ( $request_id ) ) == 2)
			$postfix = "000" . strval ( $request_id );
		if (strlen ( strval ( $request_id ) ) == 3)
			$postfix = "00" . strval ( $request_id );
		if (strlen ( strval ( $request_id ) ) == 4)
			$postfix = "0" . strval ( $request_id );
		if (strlen ( strval ( $request_id ) ) == 5)
			$postfix = strval ( $request_id );
		$prefix = $prefix . $postfix;
		return $prefix;
	}
	
	// ==============================================
} // RequestHelper
  // ==============================================
?>
