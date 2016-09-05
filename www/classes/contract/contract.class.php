<?php

// =======================================================
class Contract // Класс для работы с экземпляром подразделения
               // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $responsible_id;
	private $change_user_id;
	private $contractor_id;
	private $name;
	private $number;
	private $date_start;
	private $status;
	private $ln_doc_unid;
	private $creation_date;
	private $change_date;
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
		$in ['responsible_id'] = 0;
		$in ['change_user_id'] = 0;
		$in ['contractor_id'] = 0;
		
		$in ['name'] = "";
		$in ['number'] = "";
		$in ['status'] = 0;
		$in ['ln_doc_unid'] = "";
		
		$in ['date_start'] = date ( "Y-m-d" );
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
	                                                // alert();
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->responsible_id = (isset ( $in ['responsible_id'] )) ? intval ( $in ['responsible_id'] ) : 0;
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		$this->number = (isset ( $in ['number'] )) ? strval ( $in ['number'] ) : "";
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		
		$this->date_start = (isset ( $in ['date_start'] )) ? strval ( $in ['date_start'] ) : date ( "Y-m-d" );
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
	                                             // alert();
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->responsible_id = (isset ( $in ['responsible_id'] )) ? intval ( $in ['responsible_id'] ) : 0;
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		$this->number = (isset ( $in ['number'] )) ? strval ( $in ['number'] ) : "";
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		
		$this->date_start = (isset ( $in ['date_start'] )) ? strval ( $in ['date_start'] ) : date ( "Y-m-d" );
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
			$query = "SELECT * FROM `{$this->prefix}_contracts_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_contracts_table WHERE id = " . intval ( $id );
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_contracts_table` (`id`,`responsible_id`,`change_user_id`,`contractor_id`,`name`,`number`,`status`,`ln_doc_unid`,`date_start`,`creation_date`,`change_date`)
			VALUES ('{$this->id}','{$this->responsible_id}','{$this->change_user_id}','{$this->contractor_id}','{$this->name}','{$this->number}','{$this->status}','{$this->ln_doc_unid}','{$this->date_start}','{$this->creation_date}','{$this->change_date}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_contracts_table" );
			$query = "INSERT INTO {$this->prefix}_contracts_table (id,responsible_id,change_user_id,contractor_id,name,number,status,ln_doc_unid,date_start,creation_date,change_date)
					VALUES ('{$this->id}','{$this->responsible_id}','{$this->change_user_id}','{$this->contractor_id}','{$this->name}','{$this->number}','{$this->status}','{$this->ln_doc_unid}','{$this->date_start}','{$this->creation_date}','{$this->change_date}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addContract", 'Contract:' . $this->GetName (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_contracts_table` SET `responsible_id` = '{$this->responsible_id}',`change_user_id` = '{$this->change_user_id}',`contractor_id` = '{$this->contractor_id}',`name` = '{$this->name}',`number` = '{$this->number}',
				`status` = '{$this->status}',`ln_doc_unid` = '{$this->ln_doc_unid}',`date_start` = '{$this->date_start}',`creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}' WHERE `id` = {$this->id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_contracts_table SET responsible_id = '{$this->responsible_id}',change_user_id = '{$this->change_user_id}',contractor_id = '{$this->contractor_id}',name = '{$this->name}',number = '{$this->number}',
		status = '{$this->status}',ln_doc_unid = '{$this->ln_doc_unid}',date_start = '{$this->date_start}',creation_date = '{$this->creation_date}',change_date = '{$this->change_date}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updContract", 'Contract:' . $this->GetName (), '' );
	} // Update
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function GetResponsibleId() {
		return $this->responsible_id;
	}
	public function GetChangeUserID() {
		return $this->change_user_id;
	}
	public function GetContractorId() { // Возвращает логин.
		return $this->contractor_id;
	}
	public function GetName() {
		return $this->name;
	}
	public function GetNumber() {
		return $this->number;
	}
	public function GetLNDocUNID() {
		return $this->ln_doc_unid;
	}
	public function GetStatus() {
		return $this->status;
	}
	
	/**
	 * Возвращает дату создания пользователя.
	 *
	 * @return string
	 */
	public function GetCreationDate() {
		return $this->creation_date;
	}
	public function GetDateStart() {
		return $this->date_start;
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
	public function SetResponsibleID($responsible_id) { // Устанавливает новый логин пользователя.
		$this->responsible_id = intval ( $responsible_id );
	}
	public function SetContractorID($contractor_id) {
		$this->contractor_id = intval ( $contractor_id );
	}
	public function SetChangeUserID($change_user_id) {
		$this->change_user_id = intval ( $change_user_id );
	}
	public function SetName($name) {
		$this->name = trim ( $name );
	}
	public function SetNumber($number) {
		$this->number = trim ( $number );
	}
	public function SetLNDocUNID($ln_doc_unid) {
		$this->ln_doc_unid = trim ( $ln_doc_unid );
	}
	public function SetStatus($status) {
		$this->status = intval ( $status );
	}
	public function SetDateStart($date_start) {
		$this->date_start = trim ( $date_start );
	}
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		// alert();
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
		$out ['responsible_id'] = $this->responsible_id;
		$out ['contractor_id'] = $this->contractor_id;
		$out ['change_user_id'] = $this->change_user_id;
		
		$out ['name'] = $this->name;
		$out ['number'] = $this->number;
		$out ['status'] = $this->status;
		$out ['ln_doc_unid'] = $this->ln_doc_unid;
		
		$out ['date_start'] = $this->date_start;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
		
		$synchelper = new SynchronizationHelper ();
		$record = $synchelper->LoadRecordByID ( "Contract", $this->id );
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
		$out ['name'] = "Contract";
		
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['responsible_id'] = $this->responsible_id;
		$out ['attributes'] ['contractor_id'] = $this->contractor_id;
		$out ['attributes'] ['change_user_id'] = $this->change_user_id;
		
		$out ['attributes'] ['name'] = $this->name;
		$out ['attributes'] ['number'] = $this->number;
		$out ['attributes'] ['status'] = $this->status;
		$out ['attributes'] ['ln_doc_unid'] = $this->ln_doc_unid;
		
		$out ['attributes'] ['date_start'] = $this->date_start;
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
	
	// =======================================================
} // Contract
  // =======================================================
?>
