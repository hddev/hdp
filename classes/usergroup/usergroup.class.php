<?php
class UserGroup {
	private $db;
	private $prefix;
	private $id;
	private $name;
	private $short_name;
	private $db_type;
	
	/**
	 * Функция инициализации объекта.
	 * Принимает на вход идентификатор пользователя и массив дополнительных параметров.
	 * Если идентификатор равен нулю, то инициализация будет произведена по данным массива:
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
				if (isset ( $in ['load_user_group_by_short_name'] )) {
					$this->InitializeByArray ( $this->LoadByShortName ( $in ['load_user_group_by_short_name'] ) );
				} elseif (isset ( $in ['load_current_user'] ) && isset ( $_SESSION ['current_group_id'] ) && $_SESSION ['current_group_id'] > 0) {
					$this->InitializeById ( $_SESSION ['current_group_id'] );
				} else {
					$in ['id'] = 0; // Если не обнулить, то появится возможность создавать не существующих пользователей с реальными id.
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
		$in ['name'] = "";
		$in ['short_name'] = "";
		$in ['group_id'] = 0;
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d h:i:s" );
		return $this->InitializeByArray ( $in );
	}
	/**
	 * Инициализирует объект с помощью массива входных значений.
	 *
	 * @param array $in        	
	 * @return boolean
	 */
	private function InitializeByArray(array $in) {
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		$this->short_name = (isset ( $in ['short_name'] )) ? strval ( $in ['short_name'] ) : "";
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d h:i:s" );
		return true;
	}
	/**
	 * Инициализирует объект по идентификатору группы.
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
	}
	/**
	 * Загружает массив входных данных группы по её идентификатору.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	private function LoadById($id) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_users_groups_table` WHERE `id` = '{$id}'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_users_groups_table WHERE id = '{$id}'";
		
		$result = $this->db->Query ( $query );
		if (! $result) {
			return false;
		}
		return $result->GetRow ();
	}
	/**
	 * Инициализирует объект по короткому названию группы.
	 *
	 * @param string $short_name        	
	 * @return mixed
	 */
	private function LoadByLogin($short_name) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_users_groups_table` WHERE `short_name` = '{$short_name}'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_users_groups_table WHERE short_name = '{$short_name}'";
		
		$result = $this->db->Query ( $query );
		if (! $result) {
			return false;
		}
		return $result->GetRow ();
	}
	/**
	 * Добавляет запись о группе в БД.
	 */
	private function Insert() {
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_users_groups_table` (`name`,`short_name`) VALUES ('{$this->name}','{$this->short_name}')";
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_users_groups_table" );
			$query = "INSERT INTO {$this->prefix}_users_groups_table (id,name,short_name) VALUES ('{$this->id}','{$this->name}','{$this->short_name}')";
		}
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		if ($this->db_type == "MYSQL")
			$Log->AddAction ( "addGroup", 'Name:' . $this->GetName (), '' );
	}
	/**
	 * Обновляет запись о группе в БД.
	 */
	private function Update() {
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_users_groups_table` SET `name` = '{$this->name}',`short_name` = '{$this->short_name}' WHERE `id` = {$this->id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_users_groups_table SET name = '{$this->name}',short_name = '{$this->short_name}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updGroup", 'Name:' . $this->GetName (), '' );
	}
	
	// PUBLIC
	/**
	 * Возвращает идентификатор группы.
	 *
	 * @return int
	 */
	public function GetId() {
		return $this->id;
	}
	public function GetName() {
		return $this->name;
	}
	public function GetShortName() {
		return $this->short_name;
	}
	public function GetCreationDate() {
		return $this->creation_date;
	}
	public function GetChangeDate() {
		return $this->change_date;
	}
	public function SetName($name) {
		$this->name = trim ( $name );
	}
	public function SetShortName($short_name) {
		$this->short_name = trim ( $short_name );
	}
	public function Save() {
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
	}
	public function GetArray() {
		$out = array ();
		$out ['id'] = $this->id;
		$out ['name'] = $this->name;
		$out ['short_name'] = $this->short_name;
		return $out;
	}
	public function GetArrayForXML($import = false) {
		$out = array ();
		$out ['name'] = "UsersGroup";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['name'] = $this->name;
		$out ['attributes'] ['short_name'] = $this->short_name;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
}
?>