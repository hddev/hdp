<?php
class Log {
	private $db;
	private $prefix;
	private $id;
	private $user_id;
	private $action_type;
	private $action_date;
	private $ip;
	private $session_id;
	private $key;
	private $ordercolumn;
	private $db_type;
	
	/**
	 * Функция инициализации объекта.
	 * Принимает на вход идентификатор события и массив дополнительных параметров.
	 * Если идентификатор равен нулю, то инициализация будет произведена по данным массива:
	 * ... дописать при необходимости
	 *
	 * @param int $id        	
	 * @param array $in        	
	 */
	function __construct($id = 0, array $in = array()) {
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД.
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
		if (0 == $id) {
			if (0 == count ( $in )) {
				$this->InitializeEmpty ();
			} else {
				if (isset ( $in ['...'] )) {
					// Дописать при необходимости
				} else {
					$in ['id'] = 0; // Если не обнулить, то появится возможность создавать не существующие записи с реальными id.
					$this->InitializeByArray ( $in );
				}
			}
		} else {
			$this->InitializeById ( $id );
		}
	}
	
	// PRIVATE
	/**
	 * Инициализирует объект со значениями по умолчанию.
	 *
	 * @return boolean
	 */
	private function InitializeEmpty() {
		$in = array ();
		$in ['id'] = 0;
		$in ['user_id'] = SHGetCurrentUserID ();
		$in ['action_type'] = "";
		$in ['action_date'] = date ( "Y-m-d H:i:s" );
		$in ['ip'] = $this->GetCurrentIP ();
		;
		$in ['session_id'] = $this->getCurrentSessionName ();
		$in ['key'] = "";
		$in ['ordercolumn'] = 0;
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	
	/**
	 * Инициализирует объект с помощью массива входных значений.
	 *
	 * @param array $in        	
	 * @return boolean
	 */
	private function InitializeByArray(array $in) {
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->user_id = (isset ( $in ['user_id'] )) ? intval ( $in ['user_id'] ) : $this->getCurrentUserID ();
		$this->action_type = (isset ( $in ['action_type'] )) ? strval ( $in ['action_type'] ) : "";
		$this->action_date = (isset ( $in ['action_date'] )) ? strval ( $in ['action_date'] ) : date ( "Y-m-d H:i:s" );
		$this->ip = (isset ( $in ['ip'] )) ? strval ( $in ['ip'] ) : $this->GetCurrentIP ();
		$this->session_id = (isset ( $in ['session_id'] )) ? strval ( $in ['session_id'] ) : $this->getCurrentSessionName ();
		$this->key = (isset ( $in ['key'] )) ? strval ( $in ['key'] ) : "";
		$this->ordercolumn = (isset ( $in ['ordercolumn'] )) ? intval ( $in ['ordercolumn'] ) : 0;
		return true;
	} // InitializeByArray
	
	/**
	 * Инициализирует объект по идентификатору действия.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	private function InitializeById($id) {
		$row = $this->LoadById ( $id );
		if (! $row) {
			return false;
		} else {
			return $this->InitializeByArray ( $row );
		}
	} // InitializeById
	
	/**
	 * Загружает массив входных данных действия по его идентификатору.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	private function LoadById($id) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_log_table` WHERE `id` = '{$id}'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_log_table WHERE id = '{$id}'";
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	} // LoadById
	
	/**
	 * Добавляет запись о действии в БД.
	 */
	private function Insert() {
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_log_table` (`user_id`,`action_type`,`action_date`,`ip`,`session_id`, `key`, `ordercolumn`) VALUES ('{$this->user_id}','{$this->action_type}','{$this->action_date}','{$this->ip}','{$this->session_id}','{$this->key}','{$this->ordercolumn}')";
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_log_table" );
			$query = "INSERT INTO {$this->prefix}_log_table (id,user_id,action_type,action_date,ip,session_id, key, ordercolumn) VALUES ('{$this->id}','{$this->user_id}','{$this->action_type}','{$this->action_date}','{$this->ip}','{$this->session_id}','{$this->key}','{$this->ordercolumn}')";
		}
		
		$result = $this->db->Commit ( $query );
		if (! $result)
			return false;
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		return true;
	} // Insert
	
	/**
	 * Обновляет запись о событии в БД.
	 */
	private function Update() {
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_log_table` SET `user_id` = '{$this->user_id}',`action_type` = '{$this->action_type}',`action_date` = '{$this->action_date}',`ip` = '{$this->ip}',`session_id` = '{$this->session_id}', `key` =  '{$this->key}', `ordercolumn` = '{$this->ordercolumn}' WHERE `id` = {$this->id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_log_table SET user_id = '{$this->user_id}',action_type = '{$this->action_type}',action_date = '{$this->action_date}',ip = '{$this->ip}',session_id = '{$this->session_id}', key =  '{$this->key}', ordercolumn = '{$this->ordercolumn}' WHERE id = {$this->id}";
		
		$result = $this->db->Commit ( $query );
		if (! $result)
			return false;
		return true;
	} // Update
	  
	// PUBLIC
	/*
	 * Возвращает ID текущего пользователя
	 */
	public function getCurrentUserID() {
		$current_user = new User ( 0, array (
				'load_current_user' => true 
		) );
		return $current_user->getID ();
	}
	/*
	 * Возврщает текущее имя сессии
	 */
	public function getCurrentSessionName() {
		return session_id ();
	} // getCurrntSessionName
	
	/*
	 * Возвращает текущий IP адрес хоста @return string
	 */
	public function getCurrentIP() {
		return SHGetCurrentIP ();
	} // getCurrentIP
	
	/**
	 * Возвращает идентификатор действия.
	 *
	 * @return int
	 */
	public function GetId() {
		return $this->id;
	} // GetId
	
	/**
	 * Возвращает дополнительный ключ сортировки событий.
	 *
	 * @return int
	 */
	public function GetKey() {
		return $this->Key;
	} // GetKey
	
	/**
	 * Возвращает идентификатор пользователя.
	 *
	 * @return int
	 */
	public function GetUserId() {
		return $this->user_id;
	} // GetUserId
	
	/**
	 * Возвращает тип действия.
	 *
	 * @return int
	 */
	public function GetActionType() {
		return $this->action_type;
	} // GetActionType
	
	/**
	 * Возвращает дату действия.
	 *
	 * @return int
	 */
	public function GetActionDate() {
		return $this->action_date;
	} // GetActionDate
	
	/**
	 * Возвращает ip адрес пользователя.
	 *
	 * @return string
	 */
	public function GetIP() {
		return $this->ip;
	} // GetIP
	
	/**
	 * Возвращает session_id пользователя.
	 *
	 * @return string
	 */
	public function GetSessionName() {
		return $this->session_id;
	} // GetSessionName
	
	/**
	 * Возвращает сортировку событий.
	 *
	 * @return string
	 */
	public function GetOrder() {
		return $this->ordercolumn;
	} // GetOrder
	
	/**
	 * Устанавливает идентификатор пользователя.
	 *
	 * @param int $user_id        	
	 */
	public function SetUserID($user_id) {
		$this->user_id = intval ( $user_id );
	} // SetUserID
	
	/**
	 * Устанавливает дополнительный ключ сортировки.
	 *
	 * @param int $key        	
	 */
	public function SetKey($key) {
		$this->key = strval ( $key );
	} // SetKey
	
	/**
	 * Устанавливает тип дейтсвия
	 *
	 * @param int $action_type        	
	 */
	public function SetActionType($action_type) {
		$this->action_type = strval ( $action_type );
	} // SetActionType
	
	/**
	 * Устанавливает сортировку событий
	 *
	 * @param int $order        	
	 */
	public function SetOrder($order) {
		$this->ordercolumn = intval ( $order );
	} // SetOrder
	
	/**
	 * Сохраняет данные события.
	 */
	public function Save() {
		if (0 == $this->id) {
			return $this->Insert ();
		} else {
			return $this->Update ();
		}
	}
	
	/**
	 * Возвращает массив данных.
	 *
	 * @return array
	 */
	public function GetArray() {
		$out = array ();
		$out ['id'] = $this->id;
		$out ['user_id'] = $this->user_id;
		$out ['action_type'] = $this->action_type;
		$out ['action_date'] = $this->action_date;
		$out ['ip'] = $this->ip;
		$out ['session_id'] = $this->session_id;
		$out ['key'] = $this->key;
		$out ['ordercolumn'] = $this->ordercolumn;
		return $out;
	} // GetArray
	
	/**
	 * Возвращает массив данных для генерации XML.
	 *
	 * @param boolean $import        	
	 * @return array
	 */
	public function GetArrayForXML($import = false) {
		$out = array ();
		$out ['name'] = "Action";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['user_id'] = $this->user_id;
		$out ['attributes'] ['action_type'] = $this->action_type;
		$out ['attributes'] ['action_date'] = $this->action_date;
		$out ['attributes'] ['ip'] = $this->ip;
		$out ['attributes'] ['session_id'] = $this->session_id;
		$out ['attributes'] ['key'] = $this->key;
		$out ['attributes'] ['ordercolumn'] = $this->ordercolumn;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	} // GetArrayForXML
	
	/**
	 * Интерфейс для добавления простого события
	 */
	public function AddSimpleAction($action_type) {
		$this->action_type = strval ( $action_type );
		return $this->Save ();
	} // AddSimpleAction
	
	/**
	 * Интерфейс для добавления события
	 */
	public function AddAction($action_type, $key, $order) {
		$this->action_type = strval ( $action_type );
		if (isset ( $key ))
			$this->key = strval ( $key );
		if (isset ( $order ))
			$this->ordercolumn = intval ( $order );
		return $this->Save ();
	} // AddAction
}
?>