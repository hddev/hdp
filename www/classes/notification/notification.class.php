<?php

// =======================================================
class Notification // Класс для работы с экземпляром увдомления
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
		$in ['request_id'] = 0;
		$in ['user_id'] = 0;
		$in ['status'] = 0;
		
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->user_id = (isset ( $in ['user_id'] )) ? intval ( $in ['user_id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->request_id = (isset ( $in ['request_id'] )) ? intval ( $in ['request_id'] ) : 0;
		$this->user_id = (isset ( $in ['user_id'] )) ? intval ( $in ['user_id'] ) : 0;
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
	private function LoadById($id) { // Загружает массив входных данных пользователя по его идентификатору.
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_notifications_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_notifications_table WHERE id = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
	                            // $query="INSERT INTO `{$this->prefix}_organizations_table` (`name`,`short_name`,`description`,`order`,`creation_date`,`change_date`,`change_user_id`)
	                            // VALUES ('{$this->name}','{$this->short_name}','{$this->description}','{$this->order}','{$this->creation_date}','{$this->change_date}','{$this->change_user_id}')";
		if ($this->db_type == "MYSQL") {
			$query = "INSERT INTO `{$this->prefix}_notifications_table` (`request_id`, `user_id`, `status`) VALUES ('{$this->request_id}','{$this->user_id}','{$this->status}')";
		}
		;
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_notifications_table" );
			$query = "INSERT INTO {$this->prefix}_notifications_table (id, request_id, user_id, status) VALUES ('{$this->id}','{$this->request_id}','{$this->user_id}','{$this->status}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		// echo $this->id;
		// alert();
		// $Log=new Log();
		// $Log->AddAction("addOrganization",'Organization:'.$this->GetName(),'');
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
	                            
		// $this->name=mysql_real_escape_string($this -> name);
		if ($this->db_type == "MYSQL") {
			$query = "UPDATE `{$this->prefix}_route_table` SET `request_id` = '{$this->request_id}', `user_id` = '{$this->user_id}', `status` = '{$this->status}' WHERE `id` = {$this->id}";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$this->name = pg_escape_string ( $this->name );
			
			$query = "UPDATE {$this->prefix}_route_table SET request_id = '{$this->request_id}', user_id = '{$this->user_id}', status = '{$this->status}' WHERE id = {$this->id}";
		}
		
		$this->db->Commit ( $query );
		
		// $Log=new Log();
		// $Log->AddAction("updNotification",'Notification:'.$this->GetID(),'');
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
	public function GetStatus() {
		return $this->status;
	}
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetRequestID($request_id) {
		$this->request_id = intval ( $request_id );
	}
	public function SetUserID($user_id) {
		$this->user_id = intval ( $user_id );
	}
	public function SetStatus($status) {
		$this->status = intval ( $status );
	}
	public function Save() 	// Сохраняет данные пользователя.
	{
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
	}
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByXMLArray ( $in );
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
	public function GetArrayForXML($import = false, array $external_data = array()) {
		$out = array ();
		$out ['name'] = "Notification";
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
} // route
  // =======================================================
?>
