<?php
// =============================================
class UserHelper // =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	function GetUserExist($username) { // Возвращает булевское значение обозначающее существует ли пользователь с заданным логином или нет.
		$username = mysql_real_escape_string ( $this->FormatUsername ( $username ) );
		
		if ($this->db_type == "MYSQL")
			$sql = "SELECT COUNT(`id`) as `count` FROM `{$this->prefix}_users_table` WHERE `login` = '{$username}'";
		if ($this->db_type == "POSTGRESQL")
			$sql = "SELECT COUNT(id) as count FROM {$this->prefix}_users_table WHERE login = '{$username}'";
		
		$result = $this->db->Query ( $sql );
		$row = $result->GetRow ( MYSQL_ASSOC );
		if ($row ['count'] > 0)
			return true;
		else
			return false;
	}
	function FormatUsername($username) { // Форматирует логин в соответствии с некоторыми правилами
		return trim ( $username );
	}
	function UsernameCorrect($username) { // Проверяет имя пользователя на соответствие некому правилу.
		return preg_match ( "/^([A-Za-z0-9_]+)$/", $this->FormatUsername ( $username ) );
	}
	public function GetUsersList($parameters, $sort_column, $sort_type) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_users_table ORDER BY `" . $sort_column . "`" . $sort_type;
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_users_table ORDER BY " . $sort_column . " " . $sort_type;
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_table";
		}
		
		// Модифицируем запрос для постраничного вывода и сортировки
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			if (! empty ( $parameters )) {
				$cl = ClassLoader::getInstance ();
				$paginationclassname = $cl->LoadClass ( "PAGINATION" ); // подгружаем класс Pagination
				if ($paginationclassname) {
					$pagination = new $paginationclassname ( $query, $count_query );
					
					if (isset ( $parameters ['per_page'] ))
						$pagination->SetPerPage ( $parameters ['per_page'] );
					$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
					$query = $pagination->ConstructQuery ( $page, $pagination_data );
				}
			}
		}
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	public function GetUsersListForXML($parameters, $import = false, $external_data = array(), $sort_column = "id", $sort_type = "DESC") {
		/*
		 * $sort_column = "id"; $sort_type = "DESC";
		 */
		$list = $this->GetUsersList ( $parameters, $sort_column, $sort_type );
		
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
		$out ['name'] = "Users";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "User";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
			
			// /--- добавил pagination ---
		$ar = array ();
		$ar ['name'] = "Pagination";
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		$out ['childs'] [] = $ar;
		// /--- добавил pagination ---
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetUsersListSort($parameters, $sort_column, $sort_type) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_users_table ORDER BY `id` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_users_table ORDER BY id DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_table";
		}
		
		// Модифицируем запрос для постраничного вывода и сортировки
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			if (! empty ( $parameters )) {
				$cl = ClassLoader::getInstance ();
				$paginationclassname = $cl->LoadClass ( "PAGINATION" ); // подгружаем класс Pagination
				if ($paginationclassname) {
					$pagination = new $paginationclassname ( $query, $count_query );
					
					if (isset ( $parameters ['per_page'] ))
						$pagination->SetPerPage ( $parameters ['per_page'] );
					$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
					$query = $pagination->ConstructQuery ( $page, $pagination_data );
				}
			}
		}
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	public function SetNotify($user_id) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_users_notifications_table where `user_id` = {$user_id}";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_users_notifications_table where user_id = {$user_id}";
		
		$result = $this->db->query ( $query );
		$row = $result->GetRow ();
		
		if (empty ( $row )) {
			if ($GLOBALS ['DB_TYPE'] == "MYSQL")
				$query = "INSERT INTO `{$this->prefix}_users_notifications_table` (`user_id`)
				VALUES ('{$user_id}')";
			if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL") {
				$id = $this->db->GetPGInsertId ( "{$this->prefix}_users_notifications_table" );
				$query = "INSERT INTO {$this->prefix}_users_notifications_table (id,user_id)
				VALUES ('{$id}','{$user_id}')";
			}
			$this->db->Commit ( $query );
		}
	}
	public function UnsetNotify($user_id) {
		if ($this->db_type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_users_notifications_table` WHERE `user_id` = {$user_id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_users_notifications_table WHERE user_id = {$user_id}";
		$this->db->Commit ( $query );
	}
	
	// ==============================================
} // UserHelper
  // ==============================================
?>
