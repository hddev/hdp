<?php

// =======================================================
class Department // Класс для работы с экземпляром подразделения
                 // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $parent_id;
	private $name;
	private $short_name;
	private $description;
	private $ordercolumn;
	private $creation_date;
	private $change_date;
	private $change_user_id;
	private $db_type;
	function __construct($id = 0, array $in = array()) {
		/**
		 * Функция инициализации объекта.
		 * Принимает на вход идентификатор пользователя и массив дополнительных параметров.
		 * Если идентификатор равен нулю, то инициализация будет произведена по данным массива: ...
		 *
		 * @param int $id        	
		 * @param array $in        	
		 */
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
		
		if (0 == $id) {
			if (0 == count ( $in )) {
				$this->InitializeEmpty ();
			} else {
				if (isset ( $in ['PARAMETR_CASE'] )) {
				} else {
					$in ['id'] = 0; // Если не обнулить, то появится возможность создавать не существующие подразделения с реальными id.
					$this->InitializeByArray ( $in );
				}
			}
		} else {
			$this->InitializeById ( $id );
		}
	} // __construct
	  
	// --------------- PRIVATE FUNCTION'S ---------------
	private function InitializeEmpty() 	// Инициализирует объект со значениями по умолчанию.
	{
		$in = array ();
		$in ['id'] = 0;
		$in ['parent_id'] = 0;
		
		$in ['name'] = "";
		$in ['short_name'] = "";
		$in ['description'] = "";
		$in ['ordercolumn'] = 0;
		
		$in ['change_user_id'] = 0;
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->parent_id = (isset ( $in ['parent_id'] )) ? intval ( $in ['parent_id'] ) : 0;
		
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		$this->short_name = (isset ( $in ['short_name'] )) ? strval ( $in ['short_name'] ) : "";
		$this->description = (isset ( $in ['description'] )) ? intval ( $in ['description'] ) : 0;
		$this->ordercolumn = (isset ( $in ['ordercolumn'] )) ? intval ( $in ['ordercolumn'] ) : 0;
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->parent_id = (isset ( $in ['parent_id'] )) ? intval ( $in ['parent_id'] ) : 0;
		
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		$this->short_name = (isset ( $in ['short_name'] )) ? strval ( $in ['short_name'] ) : "";
		$this->description = (isset ( $in ['description'] )) ? intval ( $in ['description'] ) : 0;
		$this->ordercolumn = (isset ( $in ['ordercolumn'] )) ? intval ( $in ['ordercolumn'] ) : 0;
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeById($id) { // Инициализирует объект по идентификатору пользователя.
		$row = $this->LoadById ( $id );
		if (! $row) {
			return false;
		} else {
			return $this->InitializeByArray ( $row );
		}
	}
	private function LoadById($id) { // Загружает массив входных данных пользователя по его идентификатору.
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_departments_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_departments_table WHERE id = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_departments_table` (`parent_id`,`name`,`short_name`,`description`,`ordercolumn`,`change_user_id`,`creation_date`,`change_date`)
			VALUES ('{$this->parent_id}','{$this->name}','{$this->short_name}','{$this->description}','{$this->ordercolumn}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_departments_table" );
			$query = "INSERT INTO {$this->prefix}_departments_table (id,parent_id,name,short_name,description,ordercolumn,change_user_id,creation_date,change_date)
			VALUES ('{$this->id}','{$this->parent_id}','{$this->name}','{$this->short_name}','{$this->description}','{$this->ordercolumn}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addDepartment", 'Department:' . $this->GetName (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_departments_table` SET `parent_id` = '{$this->parent_id}',`name` = '{$this->name}',`short_name` = '{$this->short_name}',
				`description` = '{$this->description}',`ordercolumn` = '{$this->ordercolumn}',`change_user_id` = '{$this->change_user_id}',
				`creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}' WHERE `id` = {$this->id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_departments_table SET parent_id = '{$this->parent_id}',name = '{$this->name}',short_name = '{$this->short_name}',
		description = '{$this->description}',ordercolumn = '{$this->ordercolumn}',change_user_id = '{$this->change_user_id}',
		creation_date = '{$this->creation_date}',change_date = '{$this->change_date}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updDepartment", 'Department:' . $this->GetName (), '' );
	} // Update
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function GetParentId() { // Возвращает логин.
		return $this->parent_id;
	}
	public function GetName() {
		return $this->name;
	}
	public function GetShortName() {
		return $this->short_name;
	}
	public function GetDescription() {
		return $this->description;
	}
	public function GetOrder() {
		return $this->ordercolumn;
	}
	public function GetChangeUserID() {
		return $this->change_user_id;
	}
	
	/**
	 * Возвращает дату создания пользователя.
	 *
	 * @return string
	 */
	public function GetCreationDate() {
		return $this->creation_date;
	}
	/**
	 * Возвращает дату последнего изменения данных пользователя.
	 *
	 * @return string
	 */
	public function GetChangeDate() {
		return $this->change_date;
	}
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetParentID($parent_id) { // Устанавливает новый логин пользователя.
		$this->parent_id = intval ( $parent_id );
	}
	public function SetName($name) {
		$this->name = trim ( $name );
	}
	public function SetShortName($short_name) {
		$this->short_name = trim ( $short_name );
	}
	public function SetDescription($description) {
		$this->description = trim ( $description );
	}
	public function SetOrder($order) {
		$this->ordercolumn = trim ( $order );
	}
	public function SetChangeUserID($change_user_id) {
		$this->change_user_id = intval ( $change_user_id );
	}
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByXMLArray ( $in );
	}
	public function Save() 	// Сохраняет данные пользователя.
	{
		$this->change_date = date ( 'Y-m-d H:i:s' );
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
	}
	public function GetArray() 	// Возвращает массив данных.
	{
		$out = array ();
		$out ['id'] = $this->id;
		$out ['parent_id'] = $this->parent_id;
		$out ['name'] = $this->name;
		$out ['short_name'] = $this->short_name;
		$out ['description'] = $this->description;
		$out ['ordercolumn'] = $this->ordercolumn;
		$out ['change_user_id'] = $this->change_user_id;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
		
		$synchelper = new SynchronizationHelper ();
		$record = $synchelper->LoadRecordByID ( "Department", $this->id );
		if (! empty ( $record ))
			$out ['ln_doc_unid'] = $record ['unid'];
		
		return $out;
	}
	/**
	 * Возвращает массив данных для генерации XML.
	 *
	 * @param boolean $import        	
	 * @return array
	 */
	public function GetArrayForXML($import = false, array $external_data = array()) {
		$out = array ();
		$out ['name'] = "Department";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['parent_id'] = $this->parent_id;
		$out ['attributes'] ['name'] = $this->name;
		$out ['attributes'] ['short_name'] = $this->short_name;
		$out ['attributes'] ['description'] = $this->description;
		$out ['attributes'] ['ordercolumn'] = $this->ordercolumn;
		$out ['attributes'] ['change_user_id'] = $this->change_user_id;
		$out ['attributes'] ['creation_date'] = $this->creation_date;
		$out ['attributes'] ['change_date'] = $this->change_date;
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [0] ['name'] = "ExternalData";
			$out ['childs'] [0] ['childs'] = $external_data;
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
	public function GetArrayForXMLWithParent($import = false, array $external_data = array(), $parent_type) {
		$out = array ();
		$out ['name'] = "Department";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['parent_id'] = $this->parent_id;
		$out ['attributes'] ['name'] = $this->name;
		$out ['attributes'] ['short_name'] = $this->short_name;
		$out ['attributes'] ['description'] = $this->description;
		$out ['attributes'] ['ordercolumn'] = $this->ordercolumn;
		$out ['attributes'] ['change_user_id'] = $this->change_user_id;
		$out ['attributes'] ['creation_date'] = $this->creation_date;
		$out ['attributes'] ['change_date'] = $this->change_date;
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [0] ['name'] = "ParentData";
			$out ['childs'] [0] ['attributes'] ['type'] = $parent_type;
			$out ['childs'] [0] ['childs'] = $external_data;
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
	
	// =======================================================
} // Department
  // =======================================================
?>
