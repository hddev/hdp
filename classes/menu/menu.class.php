<?php
class Menu {
	private $db;
	private $prefix;
	private $id;
	private $name;
	private $db_type;
	function __construct($id = 0, $in = array()) {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
		
		if (0 == $id) {
			$in ['id'] = 0;
			$this->InitializeByArray ( $in );
		} else {
			$this->LoadMenuById ( $id );
		}
	}
	/**
	 * Инициализирует объект с помощью массива входных значений.
	 *
	 * @param array $in        	
	 * @return bool
	 */
	private function InitializeByArray($in) {
		$this->id = isset ( $in ['id'] ) ? intval ( $in ['id'] ) : 0;
		$this->name = isset ( $in ['name'] ) ? strval ( $in ['name'] ) : "";
		return true;
	}
	/**
	 * Инициализирует объект по идентификатору меню.
	 *
	 * @param int $id        	
	 * @return bool
	 */
	private function LoadMenuById($id) {
		$id = intval ( $id );
		if ($this->db_type == "MYSQL")
			$sql = "SELECT * FROM `{$this->prefix}_menu_table` WHERE `id`='{$id}'";
		if ($this->db_type == "POSTGRESQL")
			$sql = "SELECT * FROM {$this->prefix}_menu_table WHERE id='{$id}'";
		
		$result = $this->db->Query ( $sql );
		if ($result->Count () > 0) {
			$row = $result->GetRow ( MYSQL_ASSOC );
			return $this->InitializeByArray ( $row );
		} else {
			return false;
		}
	}
	/**
	 * Добавляет запись о меню в БД
	 *
	 * @return bool
	 */
	private function Insert() {
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_menu_table` (`name`) VALUES ('{$this->name}')";
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_menu_table" );
			$query = "INSERT INTO {$this->prefix}_menu_table (name) VALUES ('{$this->name}')";
		}
		;
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		return true;
	}
	
	/**
	 * Обновляет запись о меню в БД.
	 */
	private function Update() {
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_menu_table` SET `name` = '{$this->name}' WHERE `id` = {$this->id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_menu_table SET name = '{$this->name}' WHERE id = {$this->id}";
		$this->db->Commit ( $query );
	}
	
	// PUBLIC
	/**
	 * Возвращает идентификатор меню.
	 *
	 * @return int
	 */
	public function GetId() {
		return $this->id;
	}
	/**
	 * Возвращает название меню
	 *
	 * @return string
	 */
	public function GetName() {
		return $this->name;
	}
	/**
	 * Устанавливает название меню
	 *
	 * @param string $name        	
	 */
	public function SetName($name) {
		$this->name = strval ( $name );
	}
	/**
	 * Сохраняет запись о меню.
	 */
	public function Save() {
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
	}
	/**
	 * Возвращает массив со значениями полей класса.
	 *
	 * @return array
	 */
	public function GetArray() {
		$out = array ();
		$out ['id'] = $this->id;
		$out ['name'] = $this->name;
		return $out;
	}
	/**
	 * Возвращает массив со значениями полей объекта для генерации XML.
	 *
	 * @param bool $import        	
	 * @return array
	 */
	public function GetArrayForXML($import = false) {
		$out = array ();
		$out ['name'] = "Menu";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['name'] = $this->name;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
}
?>