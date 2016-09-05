<?php
class UserGroupHelper {
	private $db;
	private $prefix;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
	}
	public function GetGroupsList($parameters) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_users_groups_table ORDER BY `id`";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_groups_table";
		}
		
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_users_groups_table ORDER BY id";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_users_groups_table";
		}
		
		/**
		 * Модифицируем запрос для постраничного вывода и сортировки
		 */
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			$cl = ClassLoader::getInstance ();
			$paginationclassname = $cl->LoadClass ( "PAGINATION" ); // подгружаем класс Pagination
			if ($paginationclassname) {
				$pagination = new $paginationclassname ( $query, $count_query );
				
				if (isset ( $parameters ['per_page'] ))
					$pagination->SetPerPage ( $parameters ['per_page'] );
				$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
				// Изменяем запрос для постраничного вывода
				$query = $pagination->ConstructQuery ( $page, $pagination_data );
			}
		}
		/**
		 * ----------------------------------------------------------
		 */
		$result = $this->db->query ( $query );
		if (! $result) {
			return false;
		}
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		foreach ( $array as $k => $v ) {
			if (file_exists ( $GLOBALS ['ROOT_DIR'] . "/xsl/{$v['id']}.xsl" )) {
				$array [$k] ['file_exists'] = 1;
			} else {
				$array [$k] ['file_exists'] = 0;
			}
		}
		
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	public function GetGroupsListForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetGroupsList ( $parameters );
		
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
		$out ['name'] = "UsersGroups";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "UsersGroup";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
}
