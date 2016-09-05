<?php

// =======================================================
class CompletedWork // Класс для работы с экземпляром подразделения
                    // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $status;
	private $request_id;
	private $date_start;
	private $time_start;
	private $period;
	private $executor_id;
	private $comment;
	private $service_contract;
	private $knowmark;
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
		$in ['status'] = 0;
		
		$in ['request_id'] = 0;
		$in ['date_start'] = date ( "Y-m-d" );
		$in ['time_start'] = date ( "H:i" );
		$in ['period'] = 0;
		
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		$in ['executor_id'] = $user->GetId ();
		
		$in ['comment'] = "";
		$in ['service_contract'] = 0;
		
		$in ['knowmark'] = 0;
		
		$in ['change_user_id'] = $user->GetId ();
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->date_start = (isset ( $in ['date_start'] )) ? strval ( $in ['date_start'] ) : date ( "Y-m-d" );
		$this->time_start = (isset ( $in ['time_start'] )) ? strval ( $in ['time_start'] ) : date ( "H:i" );
		$this->period = (isset ( $in ['period'] )) ? intval ( $in ['period'] ) : 0;
		$this->executor_id = (isset ( $in ['executor_id'] )) ? intval ( $in ['executor_id'] ) : 0;
		$this->comment = (isset ( $in ['comment'] )) ? strval ( $in ['comment'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? intval ( $in ['service_contract'] ) : 0;
		
		$this->knowmark = (isset ( $in ['knowmark'] )) ? intval ( $in ['knowmark'] ) : 0;
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		// alert();
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->date_start = (isset ( $in ['date_start'] )) ? strval ( $in ['date_start'] ) : date ( "Y-m-d" );
		$this->time_start = (isset ( $in ['time_start'] )) ? strval ( $in ['time_start'] ) : date ( "H:i" );
		$this->period = (isset ( $in ['period'] )) ? intval ( $in ['period'] ) : 0;
		$this->executor_id = (isset ( $in ['executor_id'] )) ? intval ( $in ['executor_id'] ) : 0;
		$this->comment = (isset ( $in ['comment'] )) ? strval ( $in ['comment'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? intval ( $in ['service_contract'] ) : 0;
		
		$this->knowmark = (isset ( $in ['knowmark'] )) ? intval ( $in ['knowmark'] ) : 0;
		
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
	private function LoadById($id) { // Загружает массив входных данных запроса по его идентификатору.
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_completedworks_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_completedworks_table WHERE id = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_completedworks_table` (`status`,
		`request_id`,`date_start`,`time_start`, `period`,`executor_id`,`comment`,`service_contract`,
		`change_user_id`,`creation_date`,`change_date`, `knowmark`)
			VALUES ('{$this->status}','{$this->request_id}','{$this->date_start}','{$this->time_start}','{$this->period}',
			'{$this->executor_id}','{$this->comment}','{$this->service_contract}',
			'{$this->change_user_id}','{$this->creation_date}','{$this->change_date}','{$this->knowmark}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_completedworks_table" );
			$query = "INSERT INTO {$this->prefix}_completedworks_table (id,status,
				request_id,date_start,time_start, period,executor_id,comment,service_contract,
				change_user_id,creation_date,change_date, knowmark)
				VALUES ('{$this->id}','{$this->status}','{$this->request_id}','{$this->date_start}','{$this->time_start}','{$this->period}',
				'{$this->executor_id}','{$this->comment}','{$this->service_contract}',
				'{$this->change_user_id}','{$this->creation_date}','{$this->change_date}','{$this->knowmark}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addCompletedWork", 'CompletedWork:' . $this->GetID (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_completedworks_table` SET `status` = '{$this->status}',			
				`request_id` = '{$this->request_id}',`date_start` = '{$this->date_start}',
				`time_start` = '{$this->time_start}',`period` = '{$this->period}',
				`executor_id` = '{$this->executor_id}',`comment` = '{$this->comment}',`service_contract` = '{$this->service_contract}',
				`change_user_id` = '{$this->change_user_id}',`creation_date` = '{$this->creation_date}',
				`change_date` = '{$this->change_date}', `knowmark` = '{$this->knowmark}' WHERE `id` = {$this->id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_completedworks_table SET status = '{$this->status}',
				request_id = '{$this->request_id}',date_start = '{$this->date_start}',
				time_start = '{$this->time_start}',period = '{$this->period}',
				executor_id = '{$this->executor_id}',comment = '{$this->comment}',service_contract = '{$this->service_contract}',
				change_user_id = '{$this->change_user_id}',creation_date = '{$this->creation_date}',
				change_date = '{$this->change_date}', knowmark = '{$this->knowmark}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updCompletedWork", 'CompletedWork:' . $this->GetID (), '' );
	} // Update
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function GetStatus() { // Возвращает логин.
		return $this->status;
	}
	public function GetRequestID() {
		return $this->request_id;
	}
	public function GetDateStart() {
		return $this->date_start;
	}
	public function GetTimeStart() {
		return $this->time_start;
	}
	public function GetPeriod() {
		return $this->period;
	}
	public function GetExecutorID() {
		return $this->executor_id;
	}
	public function GetComment() {
		return $this->comment;
	}
	public function GetServiceContract() {
		return $this->service_contract;
	}
	
	//
	public function GetChangeUserID() {
		return $this->change_user_id;
	}
	public function GetCreationDate() {
		return $this->creation_date;
	}
	public function GetChangeDate() {
		return $this->change_date;
	}
	public function GetKnowMark() {
		return $this->KnowMark;
	}
	
	// --- SET ---
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetStatus($status) {
		$this->status = intval ( $status );
	}
	public function SetRequestID($request_id) {
		$this->request_id = intval ( $request_id );
	}
	public function SetDateStart($date_start) {
		$this->date_start = trim ( $date_start );
	}
	public function SetTimeStart($time_start) {
		$this->time_start = trim ( $time_start );
	}
	public function SetPeriod($period) {
		$this->period = intval ( $period );
	}
	public function SetExecutorID($executor_id) {
		$this->executor_id = trim ( $executor_id );
	}
	public function SetComment($comment) {
		$this->comment = trim ( $comment );
	}
	public function SetServiceContract($service_contract) {
		$this->service_contract = intval ( $service_contract );
	}
	public function SetChangeUserID($change_user_id) {
		$this->change_user_id = intval ( $change_user_id );
	}
	public function SetKnowMark($knowmark) {
		$this->knowmark = intval ( $knowmark );
	}
	
	// --- SET ---
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
		$out ['status'] = $this->status;
		
		$out ['request_id'] = $this->request_id;
		$out ['date_start'] = $this->date_start;
		$out ['time_start'] = $this->time_start;
		$out ['period'] = $this->period;
		$out ['executor_id'] = $this->executor_id;
		$out ['comment'] = $this->comment;
		$out ['service_contract'] = $this->service_contract;
		
		$out ['change_user_id'] = $this->change_user_id;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
		
		$out ['knowmark'] = $this->knowmark;
		
		$synchelper = new SynchronizationHelper ();
		$record = $synchelper->LoadRecordByID ( "CompletedWork", $this->id );
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
		$out ['name'] = "CompletedWork";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['status'] = $this->status;
		
		$out ['attributes'] ['request_id'] = $this->request_id;
		$out ['attributes'] ['date_start'] = $this->date_start;
		$out ['attributes'] ['time_start'] = $this->time_start;
		$out ['attributes'] ['period'] = $this->period;
		$out ['attributes'] ['executor_id'] = $this->executor_id;
		$out ['attributes'] ['comment'] = $this->comment;
		$out ['attributes'] ['service_contract'] = $this->service_contract;
		
		$out ['attributes'] ['change_user_id'] = $this->change_user_id;
		$out ['attributes'] ['creation_date'] = $this->creation_date;
		$out ['attributes'] ['change_date'] = $this->change_date;
		
		$out ['attributes'] ['knowmark'] = $this->knowmark;
		
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
} // Completedworks
  // =======================================================
?>
