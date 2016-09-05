<?php

// =======================================================
class RequestActivity // Класс для работы с экземпляром подразделения
                      // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $request_id;
	private $user_id;
	private $status;
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
		$in ['user_id'] = 0;
		$in ['request_id'] = 0;
		$in ['status'] = 0;
		
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->user_id = (isset ( $in ['user_id'] )) ? intval ( $in ['user_id'] ) : 0;
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->user_id = (isset ( $in ['user_id'] )) ? intval ( $in ['user_id'] ) : 0;
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
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
			$query = "SELECT * FROM `{$this->prefix}_requests_activity_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_activity_table WHERE id = " . intval ( $id );
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_requests_activity_table` (`id`,`request_id`,`user_id`,`status`)
			VALUES ('{$this->id}','{$this->request_id}','{$this->user_id}','{$this->status}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_requests_activity_table" );
			$query = "INSERT INTO {$this->prefix}_requests_activity_table (id,request_id,user_id,status)
			VALUES ('{$this->id}','{$this->request_id}','{$this->user_id}','{$this->status}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addRequestActivity", 'RequestActivity:' . $this->GetID (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_requests_activity_table` SET `request_id` = '{$this->request_id}',
				`user_id` = '{$this->user_id}',`status` = '{$this->status}' WHERE `id` = {$this->id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_requests_activity_table SET request_id = '{$this->request_id}',
				user_id = '{$this->user_id}',status = '{$this->status}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updRequestActivity", 'RequestActivity:' . $this->GetID (), '' );
	} // Update
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function GetRequestID() {
		return $this->request_id;
	}
	public function GetUserID() {
		return $this->user_id;
	}
	public function GetStatus() { // Возвращает логин.
		return $this->status;
	}
	
	// --- SET ---
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetRequestID($request_id) {
		$this->request_id = intval ( trim ( $request_id ) );
	}
	public function SetUserID($user_id) {
		$this->user_id = intval ( trim ( $user_id ) );
	}
	public function SetStatus($status) { // Возвращает логин.
		$this->status = intval ( trim ( $status ) );
	}
	
	// --- SET ---
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByXMLArray ( $in );
	}
	public function Save() 	// Сохраняет данные пользователя.
	{
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
		$out ['request_id'] = $this->request_id;
		$out ['user_id'] = $this->user_id;
		$out ['status'] = $this->status;
		
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
		$out ['name'] = "RequestActivity";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['request_id'] = $this->request_id;
		$out ['attributes'] ['user_id'] = $this->user_id;
		$out ['attributes'] ['status'] = $this->status;
		
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
} // RequestActivity
  // =======================================================
?>
