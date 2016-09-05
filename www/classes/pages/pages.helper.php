<?php
class PagesHelper {
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	/**
	 * Возвращает список статических элементов.
	 *
	 * @param array $parameters        	
	 * @return array
	 */
	function GetStaticDataList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_static_elements_table ORDER BY `id`";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_static_elements_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_static_elements_table ORDER BY id";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_static_elements_table";
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
				$query = $pagination->ConstructQuery ( $page, &$pagination_data );
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
		
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	
	/**
	 * Возвращает массив пригодный для генерации XML.
	 *
	 * @param array $parameters        	
	 * @param boolean $import        	
	 * @return array
	 */
	public function GetStaticDataListForXML($parameters, $import = false) {
		$list = $this->GetStaticDataList ( $parameters );
		
		if (isset ( $list ['pagination_data'] )) {
			$pagination_data = $list ['pagination_data'];
			unset ( $list ['pagination_data'] );
		}
		
		$out = array ();
		$out ['name'] = "StaticDataList";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "StaticData";
			$elar ['childs'] = $element ['content'];
			unset ( $element ['content'] );
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		$ar = array ();
		$ar ['name'] = "Pagination";
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		$out ['childs'] [] = $ar;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
}

?>