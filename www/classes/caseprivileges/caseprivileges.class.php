<?php
// =======================================================
class CasePrivileges {
	private $db;
	private $prefix;
	private $db_type;
	function __construct() { // Функция инициализации объекта.
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	} // __construct
	  
	// --------------- PRIVATE FUNCTION'S ---------------
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetPrivilegesByUserID($id) 	// FIX :: Дописать на случай принадлежности пользователя к группе
	{ // Возвращает массив привилегий для конкретного пользователя
		if ($this->db_type == "MYSQL")
			$query = "SELECT `alias` FROM `{$this->prefix}_privileges_table` WHERE `access_id` = " . intval ( $id ) . " AND `access_id_type` = 1";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT alias FROM {$this->prefix}_privileges_table WHERE access_id = " . intval ( $id ) . " AND access_id_type = 1";
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return array ();
		
		$out = Array ();
		$aPrivileges = $result->GetAllRows ( MYSQL_ASSOC );
		foreach ( $aPrivileges as $element ) {
			$out [] = $element ['alias'];
		}
		
		return $out;
	} // GetPrivilegesByUserID
	public function GetPrivilegesByGroupID($id) { // Возвращает массив привилегий для конкретной группы пользователей
		if ($this->db_type == "MYSQL")
			$query = "SELECT `alias` FROM `{$this->prefix}_privileges_table` WHERE `access_id` = " . intval ( $id ) . " AND `access_id_type` = 0";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT alias FROM {$this->prefix}_privileges_table WHERE access_id = " . intval ( $id ) . " AND access_id_type = 0";
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return array ();
		return $result->GetAllRows ();
	} // GetPrivilegesByGroupID
	public function GetPrivilegesToCurrentUser() {
		if (isset ( $_SESSION ['user'] ['id'] )) {
			return $this->GetPrivilegesByUserID ( $_SESSION ['user'] ['id'] );
		} else {
			return array ();
		}
	}
	public function GetPrivilegesList($parameters) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_privileges_table ORDER BY `id`";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_privileges_table ORDER BY id";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
	} // GetRCMCoursesList
	public function GetPrivilegesListForXML($parameters, $import = false, $external_data = array()) {
		/**
		 * Возвращает массив пригодный для генерации XML.
		 *
		 * @param array $parameters        	
		 * @param boolean $import        	
		 * @return array
		 */
		$list = $this->GetPrivilegesList ( $parameters );
		
		$out = array ();
		$out ['name'] = "Privileges";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "Privilege";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	} // GetPrivilegesListForXML
	public function GetAllPrivilegesWithDescriptions() {
		$out = Array ();
		$out ['FullAccess'] = "Полный доступ";
		$out ['MyRoomEnable'] = "Предоставление доступа к MR";
		$out ['AddUsers'] = "Добавление пользователей";
		$out ['EditUsers'] = "Редактирование пользователей";
		$out ['DeleteUsers'] = "Удаление пользователей";
		$out ['UnlimetedSessionCount'] = "Неограниченное к-во сессий";
		$out ['UnlimitedWindowCount'] = "Неограниченное к-во окон";
		return $out;
	}
	public function GetAllPrivilegesWithDescriptionsForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetAllPrivilegesWithDescriptions ( $parameters );
		
		$index = 0;
		$out = array ();
		$out ['name'] = "PrivilegesList";
		foreach ( $list as $key => $element ) {
			$elar = array ();
			$elar ['name'] = "PrivilegeItem";
			$elar ['attributes'] = array (
					'index' => $index ++,
					'alias' => $key,
					'description' => $element 
			);
			$out ['childs'] [] = $elar;
		}
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	} // GetAllPrivilegesWithDescriptionsForXML
	public function IsUserGetPrivilege($person_id = NULL, $alias) { // Проверяет имеет ли пользователь указанную привилегию (если не указан $person_id - подставляется текующий)
		if ($this->IsUserGetPrivilegeEx ( $person_id, 'FullAccess' ))
			return true;
		return $this->IsUserGetPrivilegeEx ( $person_id, $alias );
	} // IsUserGetPrivilege
	private function IsUserGetPrivilegeEx($person_id = NULL, $alias) {
		if (! $person_id)
			$person_id = SHGetCurrentUserID ();
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_privileges_table WHERE (`alias`= '" . $alias . "' AND `access_id_type` = 1 AND `access_id` = " . $person_id . ")";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_privileges_table WHERE (alias= '" . $alias . "' AND access_id_type = 1 AND access_id = " . $person_id . ")";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		$Row = $result->GetRow ();
		if (isset ( $Row ['id'] ))
			return true;
		return false;
	}
	
	// ------------- [ GET ] -------------
	
	// ------------- [ SET ] -------------
	
	// ------------- [ Function ] -------------
	
	// =======================================================
} // CasePrivileges
  // =======================================================
?>