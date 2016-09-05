<?php

// =======================================================
class User // Класс для работы с экземпляром пользователя
           // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $login;
	private $password;
	private $group_id;
	private $firstname;
	private $secondname;
	private $patronymic;
	private $email;
	private $creation_date;
	private $change_date;
	private $connected;
	private $db_type;
	function __construct($id = 0, array $in = array()) {
		/**
		 * Функция инициализации объекта.
		 * Принимает на вход идентификатор пользователя и массив дополнительных параметров.
		 * Если идентификатор равен нулю, то инициализация будет произведена по данным массива:
		 * $in['load_user_by_login'] = %username%; - инициализация по имени пользователя.
		 * $in['load_current_user'] = %anykey%; - инициализация текущего зарегистрированного в сеансе пользователя.
		 *
		 * @param int $id        	
		 * @param array $in        	
		 */
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД.
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
		if (0 == $id) {
			if (0 == count ( $in )) {
				$this->InitializeEmpty ();
			} else {
				if (isset ( $in ['load_user_by_login'] )) {
					try {
						if (! is_array ( $this->LoadByLogin ( $in ['load_user_by_login'] ) ))
							return null;
						$this->InitializeByArray ( $this->LoadByLogin ( $in ['load_user_by_login'] ) );
					} catch ( ErrorsException $e ) {
						echo $e->ShowMessage ();
					}
				} elseif (isset ( $in ['load_current_user'] ) && isset ( $_SESSION ['user'] ['id'] ) && $_SESSION ['user'] ['id'] > 0) {
					$this->InitializeById ( $_SESSION ['user'] ['id'] );
				} else {
					$in ['id'] = 0; // Если не обнулить, то появится возможность создавать не существующих пользователей с реальными id.
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
		$in ['connected'] = 0;
		$in ['login'] = "";
		$in ['password'] = "";
		$in ['group_id'] = 0;
		$in ['firstname'] = "";
		$in ['secondname'] = "";
		$in ['patronymic'] = "";
		$in ['email'] = "";
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->connected = (isset ( $in ['connected'] )) ? intval ( $in ['connected'] ) : 0;
		$this->login = (isset ( $in ['login'] )) ? strval ( $in ['login'] ) : "";
		$this->password = (isset ( $in ['password'] )) ? strval ( $in ['password'] ) : "";
		$this->group_id = (isset ( $in ['group_id'] )) ? intval ( $in ['group_id'] ) : 0;
		$this->firstname = (isset ( $in ['firstname'] )) ? strval ( $in ['firstname'] ) : "";
		$this->secondname = (isset ( $in ['secondname'] )) ? strval ( $in ['secondname'] ) : "";
		$this->patronymic = (isset ( $in ['patronymic'] )) ? strval ( $in ['patronymic'] ) : "";
		$this->email = (isset ( $in ['email'] )) ? strval ( $in ['email'] ) : "";
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->connected = (isset ( $in ['connected'] )) ? intval ( $in ['connected'] ) : 0;
		$this->login = (isset ( $in ['login'] )) ? strval ( $in ['login'] ) : "";
		$this->password = (isset ( $in ['password'] )) ? strval ( $in ['password'] ) : "";
		$this->group_id = (isset ( $in ['group_id'] )) ? intval ( $in ['group_id'] ) : 0;
		$this->firstname = (isset ( $in ['firstname'] )) ? strval ( $in ['firstname'] ) : "";
		$this->secondname = (isset ( $in ['secondname'] )) ? strval ( $in ['secondname'] ) : "";
		$this->patronymic = (isset ( $in ['patronymic'] )) ? strval ( $in ['patronymic'] ) : "";
		$this->email = (isset ( $in ['email'] )) ? strval ( $in ['email'] ) : "";
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
			$query = "SELECT * FROM `{$this->prefix}_users_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_users_table WHERE id = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function LoadByLogin($login) { // Инициализирует объект по логину пользователя.
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_users_table` WHERE `login` = '" . mysqli_real_escape_string ( $this->db->GetCID (), $login ) . "'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_users_table WHERE login = '" . pg_escape_string ( $login ) . "'";
		$result = $this->db->Query ( $query );
		if (! $result)
			return $result;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_users_table` (`connected`,`login`,`password`,`group_id`,`firstname`,`secondname`,`patronymic`,`email`,`creation_date`,`change_date`)
			VALUES ('{$this->connected}','{$this->login}','{$this->password}','{$this->group_id}','{$this->firstname}','{$this->secondname}','{$this->patronymic}','{$this->email}','{$this->creation_date}','{$this->change_date}')";
		
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_users_table" );
			$query = "INSERT INTO {$this->prefix}_users_table (id,connected,login,password,group_id,firstname,secondname,patronymic,email,creation_date,change_date)
			VALUES ('{$this->id}','{$this->connected}','{$this->login}','{$this->password}','{$this->group_id}','{$this->firstname}','{$this->secondname}','{$this->patronymic}','{$this->email}','{$this->creation_date}','{$this->change_date}')";
		}
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addUser", 'Login:' . $this->GetLogin (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_users_table` SET `connected` = '{$this->connected}',`login` = '{$this->login}',`password` = '{$this->password}',`group_id` = '{$this->group_id}',
				`firstname` = '{$this->firstname}',`secondname` = '{$this->secondname}',`patronymic` = '{$this->patronymic}',`email` = '{$this->email}',
				`creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}' WHERE `id` = {$this->id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_users_table SET connected = '{$this->connected}',login = '{$this->login}',password = '{$this->password}',group_id = '{$this->group_id}',
			firstname = '{$this->firstname}',secondname = '{$this->secondname}',patronymic = '{$this->patronymic}',email = '{$this->email}',
			creation_date = '{$this->creation_date}',change_date = '{$this->change_date}' WHERE id = {$this->id}";
			
			/*
		 * if ($this->db_type == "MYSQL") $query="UPDATE `{$this->prefix}_users_table` SET `firstname` = '{$this->firstname}',`secondname` = '{$this->secondname}',`patronymic` = '{$this->patronymic}',`email` = '{$this->email}', `creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}' WHERE `id` = {$this->id}"; if ($this->db_type == "POSTGRESQL") $query="UPDATE {$this->prefix}_users_table SET firstname = '{$this->firstname}',secondname = '{$this->secondname}',patronymic = '{$this->patronymic}',email = '{$this->email}', creation_date = '{$this->creation_date}',change_date = '{$this->change_date}' WHERE id = {$this->id}";
		 */
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updUser", 'Login:' . $this->GetLogin (), '' );
	} // Update
	private function EncryptPassword($password) { // Возвращает хэш пароля пользователя.
		$access = new Access ();
		return $access->EncryptPassword ( $password );
	}
	
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function IsConnected() { // Возвращает логин.
		if ($this->connected == 1)
			return true;
		else
			return false;
	}
	public function GetLogin() { // Возвращает логин.
		return $this->login;
	}
	public function GetPasswordHash() {
		return $this->password;
	}
	/**
	 * Возвращает идентификатор группы пользователя.
	 *
	 * @return int
	 */
	public function GetGroupId() {
		return $this->group_id;
	}
	public function GetFirstname() {
		return $this->firstname;
	}
	public function GetSecondname() {
		return $this->secondname;
	}
	public function GetPatronymic() {
		return $this->patronymic;
	}
	public function GetEmail() {
		return $this->email;
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
	public function SetConnected($connected) {
		$this->connected = intval ( $connected ); // 0|1
	}
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetLogin($login) { // Устанавливает новый логин пользователя.
		$this->login = trim ( $login );
	}
	/**
	 * Устанавливает новый пароль пользователя.
	 *
	 * @param string $password        	
	 */
	public function SetPassword($password) {
		$this->password = $this->EncryptPassword ( trim ( $password ) );
	}
	/**
	 * Устанавливает идентификатор группы пользователя.
	 *
	 * @param int $group_id        	
	 */
	public function SetGroup($group_id) {
		$this->group_id = intval ( $group_id );
	}
	public function SetFirstname($firstname) {
		$this->firstname = trim ( $firstname );
	}
	public function SetSecondname($secondname) {
		$this->secondname = trim ( $secondname );
	}
	public function SetPatronymic($patronymic) {
		$this->patronymic = trim ( $patronymic );
	}
	public function SetEmail($email) {
		if (preg_match ( '/[-0-9A-Za-z_.]+@[-0-9a-z_]+\.[a-z]{2,6}/i', $email, $regs )) {
			$this->email = $regs [0];
		} elseif ($email == "") {
			$this->email = $email;
		}
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
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByXMLArray ( $in );
	}
	public function GetArray() 	// Возвращает массив данных.
	{
		$out = array ();
		$out ['id'] = $this->id;
		$out ['connected'] = $this->connected;
		$out ['login'] = $this->login;
		$out ['password_hash'] = $this->password;
		$out ['group_id'] = $this->group_id;
		$out ['firstname'] = $this->firstname;
		$out ['secondname'] = $this->secondname;
		$out ['patronymic'] = $this->patronymic;
		$out ['email'] = $this->email;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
		
		$synchelper = new SynchronizationHelper ();
		$record = $synchelper->LoadRecordByID ( "User", $this->id );
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
		$out ['name'] = "User";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['connected'] = $this->connected;
		$out ['attributes'] ['login'] = $this->login;
		$out ['attributes'] ['group_id'] = $this->group_id;
		$out ['attributes'] ['firstname'] = $this->firstname;
		$out ['attributes'] ['secondname'] = $this->secondname;
		$out ['attributes'] ['patronymic'] = $this->patronymic;
		$out ['attributes'] ['email'] = $this->email;
		$out ['attributes'] ['password_hash'] = $this->password;
		$out ['attributes'] ['creation_date'] = $this->creation_date;
		$out ['attributes'] ['change_date'] = $this->change_date;
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [4] ['name'] = "ExternalData";
			$out ['childs'] [4] ['childs'] = $external_data;
		}
		
		/*
		 * if (count($parentunit_data)>0) { $out['childs'][5]['name']="ParentData"; $out['childs'][5]['attributes']['type']="2"; $out['childs'][5]['childs']=$parentunit_data; }
		 */
		
	/*	$out['childs'][5]['name']="OrganizationList";
		$out['childs'][5]['childs']=$organization_list;*/
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
	public function GetArrayForXMLWithParent($import = false, array $external_data = array(), array $parentunit_data = array(), $parent_type) {
		$out = array ();
		$out ['name'] = "User";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['connected'] = $this->connected;
		$out ['attributes'] ['login'] = $this->login;
		$out ['attributes'] ['group_id'] = $this->group_id;
		$out ['attributes'] ['firstname'] = $this->firstname;
		$out ['attributes'] ['secondname'] = $this->secondname;
		$out ['attributes'] ['patronymic'] = $this->patronymic;
		$out ['attributes'] ['email'] = $this->email;
		$out ['attributes'] ['password_hash'] = $this->password;
		$out ['attributes'] ['creation_date'] = $this->creation_date;
		$out ['attributes'] ['change_date'] = $this->change_date;
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [4] ['name'] = "ExternalData";
			$out ['childs'] [4] ['childs'] = $external_data;
		}
		
		if (count ( $parentunit_data ) > 0) {
			$out ['childs'] [5] ['name'] = "ParentData";
			$out ['childs'] [5] ['attributes'] ['type'] = $parent_type;
			$out ['childs'] [5] ['childs'] = $parentunit_data;
		}
		
		/*
		 * $out['childs'][5]['name']="OrganizationList"; $out['childs'][5]['childs']=$organization_list;
		 */
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
	public function GetStudentId() {
		$query = "SELECT id FROM `{$this->prefix}_rcm_students_table` WHERE `user_id`={$this->id}";
		$result = $this->db->Query ( $query );
		if ($row = $result->GetRow ()) {
			return $row ['id'];
		} else {
			return 0;
		}
	}
	public function GetShotFIO() 	// Возвращает ФИО в сокращенной форме (Фамилия И.О.)
	{
		if ($this->secondname != "")
			$fio = $this->secondname;
		if ($this->firstname != "") {
			$fio .= " " . mb_substr ( $this->firstname, 0, 1, 'UTF-8' ) . ".";
		}
		if (($this->patronymic) != "") {
			$fio .= mb_substr ( $this->patronymic, 0, 1, 'UTF-8' ) . ".";
		}
		return $fio;
	}
	public function GetFIO() 	// Возвращает ФИО
	{
		$fio = "";
		if ($this->secondname != "")
			$fio .= $this->secondname;
		if ($this->firstname != "")
			$fio .= " " . $this->firstname;
		if (($this->patronymic) != "")
			$fio .= " " . $this->patronymic;
		return $fio;
	}
	public function GetOrganizationName() {
		$OrganizationHelper = new OrganizationHelper ();
		return $OrganizationHelper->GetUserOrganizationNameByUserID ( $this->id );
	}
	
	/*
	 * public function LogIn($username = "", $password = "") // Авторизует пользователя в системе. { $tuser = new User(0, array("load_user_by_login"=>$username)); if( $tuser->GetId()>0 && isset($_SESSION['user']['id']) && $_SESSION['user']['id] == $tuser->GetId() && $tuser->IsConnected()) { return true; // Этот пользователь уже вошел в систему и он подключен }elseif( $tuser->GetId()>0 ){ if($tuser->GetPasswordHash() == $this->EncryptPassword(trim($password)) && $tuser->IsConnected()) { $this->InitializeByArray($this->LoadByLogin($username)); // Загружаем данные о текущем пользователе //$_SESSION['current_user_id'] = $this->GetId(); // Регистрируем id в сессии $_SESSION['user']['id'] = $this->GetId(); // Регистрируем id текущего пользователя в сессии. setcookie('mixid',uniqid('k26',True),time()+3600); // Прописываем действие в событиях $Log = new Log(0, array('order'=>1)); $Log->AddSimpleAction("login"); return true; }else{ return false; // Пароль не совпал либо пользователь отключен от системы } }else{ return false; // Нет id - нет пользователя :) } } public function LogOut() // Разавторизует пользователя. { $Log = new Log(0, array('order'=>1)); $Log->AddSimpleAction("logout"); //unset($_SESSION['current_user_id']); // оставлено для совместимости unset($_SESSION['user']); }
	 */
	// =======================================================
} // User
  // =======================================================
?>
