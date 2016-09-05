<?php
class ClassLoader extends Singleton {
	private $classes = array ();
	private $db;
	public function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->LoadClassesInfo ();
	}
	/**
	 * Возвращает свой экземпляр
	 *
	 * @return object
	 */
	public static function getInstance() {
		return parent::_getInstance ( __CLASS__ );
	}
	/**
	 * Подгружает класс соответствующий запрошенному коду класса и возвращает его реальное имя.
	 *
	 * @param string $classcode        	
	 * @return string
	 */
	public function LoadClass($classcode) {
		if (isset ( $this->classes [$classcode] ) && 1 == $this->classes [$classcode] ['enabled']) {
			if (! isset ( $this->classes [$classcode] ['loaded'] ) || 0 == $this->classes [$classcode] ['loaded']) {
				$classname = strtolower ( $this->classes [$classcode] ['name'] );
				$classpath = $GLOBALS ['ROOT_DIR'] . "/classes/" . $classname . "/" . $classname . ".class.php";
				$helperpath = $GLOBALS ['ROOT_DIR'] . "/classes/" . $classname . "/" . $classname . ".helper.php";
				if (file_exists ( $classpath )) {
					if (include ($classpath)) {
						if (file_exists ( $helperpath )) {
							if (include ($helperpath)) {
								$this->classes [$classcode] ['helper_loaded'] = 1;
								$this->classes [$classcode] ['helper_name'] = $classname . "Helper";
							}
						}
						$this->classes [$classcode] ['loaded'] = 1;
						return $this->classes [$classcode] ['name'];
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return $this->classes [$classcode] ['name'];
			}
		} else {
			return false;
		}
	}
	/**
	 * Загружает Helper для класса с указанным кодом.
	 *
	 * @param unknown_type $classcode        	
	 * @return unknown
	 */
	public function GetHelper($classcode) {
		if (isset ( $this->classes [$classcode] ) && 1 == $this->classes [$classcode] ['enabled'] && isset ( $this->classes [$classcode] ['helper_loaded'] ) && 1 == $this->classes [$classcode] ['helper_loaded']) {
			return $this->classes [$classcode] ['helper_name'];
		} else {
			return false;
		}
	}
	/**
	 * Возвращает список классов.
	 */
	private function LoadClassesInfo() {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_classes_table`";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_classes_table";
		
		if ($dbresult = $this->db->Query ( $query )) {
			while ( $row = $dbresult->GetRow () ) {
				$this->classes [$row ['code']] = $row;
			}
		} else {
		/**
		 * НЕРАБОТОСПОСОБНОСТЬ ПРОГРАММЫ
		 */
		}
	}
}
?>