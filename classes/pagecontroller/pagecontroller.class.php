<?php
class PageController extends Singleton {
	private $db;
	private $uri;
	private $uri_info;
	private $uri_params;
	public static function getInstance() {
		return parent::_getInstance ( __CLASS__ );
	}
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->uri = $this->DispatchURI ( $_SERVER ['REQUEST_URI'] );
		$this->LoadURIInfo ();
	}
	/**
	 * Загружает подробные данные по элементам URI (Universal Resource Identifier).
	 */
	private function LoadURIInfo() {
		if (0 == count ( $this->uri ))
			$this->uri [] = "/";
		
		$parent = 0;
		foreach ( $this->uri as $uri_element ) {
			
			if ($GLOBALS ['DB_TYPE'] == "MYSQL")
				$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_pages_table` WHERE `url` = '{$uri_element}' AND `parent` = {$parent}";
			if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
				$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_pages_table WHERE url = '{$uri_element}' AND parent = {$parent}";
			
			if ($result = $this->db->Query ( $query )) {
				if ($row = $result->GetRow ()) {
					$this->uri_info [] = $row;
					if ($uri_element != "/")
						$parent = $row ['id'];
				} else {
					$this->uri_params [] = $uri_element; // Если такого элемента не существует, значит это параметр.
				}
			} else {
				break;
			}
		}
	}
	/**
	 * Выделяет из URI массив элементов.
	 *
	 * @param string $uri        	
	 * @return array
	 */
	public function DispatchURI($uri) {
		$pre_array = explode ( "?", $uri );
		
		$uri_array = explode ( "/", $pre_array [0] );
		
		$uri_new_array = array ();
		$uri_new_array [] = "/";
		foreach ( $uri_array as $k => $uri_element ) {
			$uri_element = trim ( strval ( $uri_element ) );
			if (strlen ( $uri_element ) > 0) {
				$uri_new_array [] = $uri_element;
			}
		}
		return $uri_new_array;
	}
	/**
	 * Возвращает идентификатор текущей страницы.
	 *
	 * @return int
	 */
	public function GetCurrentPageId() {
		return $this->uri_info [count ( $this->uri_info ) - 1] ['id'];
	}
	/**
	 * Возвращает массив иерархии страниц до текущей.
	 *
	 * @return array
	 */
	public function GetCurrentPageIerarchy() {
		return $this->uri_info;
	}
	/**
	 * Возвращает массив параметров uri
	 *
	 * @return array
	 */
	public function GetURIParameters() {
		return $this->uri_params;
	}
	/**
	 * Возвращает подробную информацию по структуре страницы.
	 *
	 * @param int $pid        	
	 * @return array
	 */
	public function GetPageStructure($pid) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_pages_elements_table` WHERE `page_id` = '{$pid}' ORDER BY `ordercolumn`";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_pages_elements_table WHERE page_id = '{$pid}' ORDER BY ordercolumn";
		
		$pagestructure = array ();
		if ($result = $this->db->Query ( $query )) {
			while ( $row = $result->GetRow () ) {
				$pagestructure [] = $row;
			}
			return $pagestructure;
		} else {
			return false;
		}
	}
	/**
	 * Возвращает краткую информацию о странице.
	 *
	 * @param int $pid        	
	 * @return array
	 */
	public function GetPageInfo($pid) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_pages_table` WHERE `id` = '{$pid}' LIMIT 1";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_pages_table WHERE id = '{$pid}' LIMIT 1";
		
		$result = $this->db->Query ( $query );
		if ($result && $result->Count () > 0) {
			$row = $result->GetRow ();
			return $row;
		} else {
			return false;
		}
	}
	public function GetCurrentURI() {
		return $_SERVER ['REQUEST_URI'];
	}
}
?>