<?php
/**
 * @subpackage CORE
 * @author Kamishkertsev A.V.
 * @version 1.0.0
 		$out ['FullAccess'] = "Полный доступ";
		$out ['AddUsers'] = "Добавление пользователей";
		$out ['EditUsers'] = "Редактирование пользователей";
		$out ['DeleteUsers'] = "Удаление пользователей";
		$out ['UnlimetedSessionCount'] = "Неогр. число сессий";
		$out ['UnlimitedWindowCount'] = "Неогр. число открытых окон";
 */

// =======================================================
class Access {
	private $db;
	private $prefix;
	private $user_id; // вспомогательная переменная класса | спользуется длясвязывания отдельных функция
	private $type;
	function __construct() { // Функция инициализации объекта.
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->user_id = SHGetCurrentUserID ();
		$this->type = $GLOBALS ['DB_TYPE'];
	} // __construct
	  
	// --------------- PRIVATE FUNCTION'S ---------------
	private function CookiesAccessDelete($id) {
		if ($this->type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_access_table` WHERE `id` = " . $id;
		if ($this->type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_access_table WHERE id = " . $id;
		
		$this->db->Commit ( $query );
		return true;
	} // CookiesAccessDelete
	private function IsLoginByCookies() {
		if (! isset ( $_COOKIE ['mixid'] ))
			return false;
		if (strlen ( $_COOKIE ['mixid'] ) == 0)
			return false;
		
		if ($this->type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_access_table` WHERE `mix_id` = '" . $_COOKIE ['mixid'] . "'";
		if ($this->type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_access_table WHERE mix_id = '" . $_COOKIE ['mixid'] . "'";
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		
		while ( $Row = $result->GetRow () ) {
			if (isset ( $Row ['cookies_duration'] )) {
				if (time ( $Row ['cookies_duration'] ) >= time ()) {
					$this->user_id = $Row ['user_id'];
					return true;
				} else
					$this->CookiesAccessDelete ( $Row ['id'] );
			} else
				$this->CookiesAccessDelete ( $Row ['id'] );
		}
		return false;
	} // IsLoginByCookies
	public function GetAccessRows() {
		if ($this->type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_access_table` WHERE `user_id` = " . $this->user_id;
		if ($this->type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_access_table WHERE user_id = " . $this->user_id;
		
		$result = $this->db->Query ( $query );
		return $result;
	}
	public function IsUniqueSession() {
		if (SHIsGetRight ( $this->user_id, 'UnlimetedSessionCount' ))
			return true;
		$result = $this->GetAccessRows ();
		if (! $result)
			return false;
		
		if ($result->Count () > 1) {
			return false;
		} else {
			$Row = $result->GetRow ();
			if ($Row ['session_id'] != session_id ())
				return false;
		}
		return true;
	}
	public function GetAccessRowsForHTML() {
		$html = "<table border=0><tr><td><b>№ </b><td>&nbsp;</td></td><td><b>Дата подключения</b></td></tr>";
		$i = 0;
		$result = $this->GetAccessRows ();
		while ( $Row = $result->GetRow () ) {
			if (isset ( $Row ['session_id'] )) {
				$i ++;
				if ($Row ['session_id'] == session_id ())
					$html = $html . "<tr><td><b>" . $i . ". </b></td><td>&nbsp;</td><td>" . $Row ['datetime_created'] . " - текущее подключение</td></tr>";
				else
					$html = $html . "<tr><td><b>" . $i . ". </b></td><td>&nbsp;</td><td>" . $Row ['datetime_created'] . "</td></tr>";
			} else
				$this->CookiesAccessDelete ( $Row ['id'] );
		}
		$html = $html . "</table>";
		return $html;
	}
	public function CheakSession() {
		if (! isset ( $_SESSION ['user'] ['mixconnection'] ) && SHGetCurrentUserID () > 0) {
			$key = md5 ( uniqid () );
			$_SESSION ['user'] ['mixconnection'] = $key;
			setcookie ( 'mixconnection', $key, 0, '/' );
			return true;
		}
		if (isset ( $_SESSION ['user'] ['mixconnection'] )) {
			if (isset ( $_COOKIE ['mixconnection'] )) {
				if ($_SESSION ['user'] ['mixconnection'] == $_COOKIE ['mixconnection']) {
					return true;
				}
			}
		}
		return false;
	}
	public function DeleteExtraConnections() {
		$result = $this->GetAccessRows ();
		while ( $Row = $result->GetRow () ) {
			if (isset ( $Row ['session_id'] )) {
				if ($Row ['session_id'] != session_id ())
					$this->CookiesAccessDelete ( $Row ['id'] );
			} else
				$this->CookiesAccessDelete ( $Row ['id'] );
		}
	}
	private function Authorization_Success($user_id) { // событие вызывается в случае успешной авторизации: прописывает необходимую информацию в сессию и COOKIES
		if (isset ( $_SESSION ['user'] ['id'] ))
			return true;
		if (! isset ( $this->user_id ))
			$this->user_id = $user_id;
			
			// $_SESSION['user']['id'] = $user_id; // Регистрируем id в сессии
		$_SESSION ['user'] ['id'] = $user_id; // Регистрируем id текущего пользователя в сессии.
		
		$session_id = session_id ();
		$ip = SHGetCurrentIP ();
		
		if (isset ( $_REQUEST ['bRememberMe'] )) {
			$mix_id = uniqid ( md5 ( strval ( uniqid () ) ) );
		} else {
			$mix_id = "";
		}
		
		$datetime_created = date ( "Y-m-d H:i:s" );
		$cookies_duration = time ( $datetime_created ) + 604800; // 7 дней
		
		if ($this->type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_access_table` WHERE `session_id` = '" . session_id () . "' AND `user_id` =" . $user_id;
		if ($this->type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_access_table WHERE session_id = '" . session_id () . "' AND user_id =" . $user_id;
		
		$this->db->Commit ( $query );
		
		// setcookie("PHPSESSID");
		if ($this->type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_access_table` (`user_id`,`session_id`,`ip`,`mix_id`,`cookies_duration`,`datetime_created`)
		VALUES ('{$user_id}','{$session_id}','{$ip}','{$mix_id}','" . date ( "Y-m-d H:i:s", $cookies_duration ) . "','{$datetime_created}')";
		if ($this->type == "POSTGRESQL")
			$query = "INSERT INTO {$this->prefix}_access_table (id, user_id,session_id,ip,mix_id,cookies_duration,datetime_created)
		VALUES (nextval('k26_access_table_seq'::regclass),'{$user_id}','{$session_id}','{$ip}','{$mix_id}','" . date ( "Y-m-d H:i:s", $cookies_duration ) . "','{$datetime_created}')";
		
		$this->db->Commit ( $query );
		
		setcookie ( 'mixid', $mix_id, $cookies_duration );
		
		// Прописываем действие в событиях
		$Log = new Log ( 0, array (
				'ordercolumn' => 1 
		) );
		$Log->AddSimpleAction ( "login" );
	}
	
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetUserId() {
		return $this->user_id;
	}
	public function CheackConnection($rekey) {
		if (! isset ( $rekey ) || ! isset ( $_SESSION ['rekey'] ))
			return false;
		if ($_SESSION ['rekey'] == $rekey)
			return true;
		return false;
	} // CheackConnection
	public function GetReKey() {
		if (SHIsGetRight ( SHGetCurrentUserID (), 'UnlimitedWindowCount' )) {
			$rekey = "UnlimitedWindowCount";
		} else {
			$rekey = md5 ( uniqid () );
		}
		$_SESSION ['rekey'] = $rekey;
		return $rekey;
	}
	private function IsAccessExist() {
		if ($this->type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_access_table` WHERE `user_id` = " . $this->user_id . " AND `session_id` = '" . session_id () . "'";
		if ($this->type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_access_table WHERE user_id = " . $this->user_id . " AND session_id = '" . session_id () . "'";
		
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		if ($result->Count () > 0)
			return true;
	}
	public function IsLogin() { // Проверяем была ли сделана авторизация
		if (SHGetCurrentUserID () > 0)
			if ($this->IsAccessExist ())
				return true;
		return false;
	} // IsLogin
	public function GetCurrentUser() {
		$user = new User ( 0, array (
				"load_current_user" => true 
		) );
		if (isset ( $user ))
			return $user;
		return null;
	}
	public function QuickLogin() {
		if ($this->IsLoginByCookies ()) {
			if (isset ( $this->user_id )) {
				$_REQUEST ['bRememberMe'] = true;
				$this->Authorization_Success ( $this->user_id );
				return true;
			}
		}
		
		if ((! isset ( $_SESSION ['user'] ['id'] ) || $_SESSION ['user'] ['id'] <= 0) && isset ( $_REQUEST ['login_username'] ) && isset ( $_REQUEST ['login_password'] )) { // Регистрируем пользователя
			return $this->LogIn ( $_REQUEST ['login_username'], $_REQUEST ['login_password'] );
		}
	}
	public function LogIn($username = "", $password = "") { // Авторизует пользователя в системе.
		$user = new User ( 0, array (
				"load_user_by_login" => $username 
		) );
		if (null == $user)
			return false; // throw new ModuleAccessException("Токой пользователь не зарегистрирован, либо пароль неверный!",0,"access");
		if ($user->GetId () > 0 && isset ( $_SESSION ['user'] ['id'] ) && $_SESSION ['user'] ['id'] == $user->GetId () && $user->IsConnected ()) {
			return true; // Этот пользователь уже вошел в систему и он подключен
		} elseif ($user->GetId () > 0) {
			if ($user->GetPasswordHash () == $this->EncryptPassword ( trim ( $password ) ) && $user->IsConnected ()) {
				$this->Authorization_Success ( $user->GetId () );
				return true;
			} else
				return false; // Пароль не совпал либо пользователь отключен от системы
		} else
			return false; // Нет id - нет пользователя :)
	}
	public function LogOut() { // Разавторизует пользователя.
		$Log = new Log ( 0, array (
				'order' => 1 
		) );
		$Log->AddSimpleAction ( "logout" );
		
		if (SHGetCurrentUserID () > 0) {
			if ($this->type == "MYSQL")
				$query = "DELETE FROM `{$this->prefix}_access_table` WHERE `session_id` = '" . session_id () . "' AND `user_id` =" . SHGetCurrentUserID ();
			if ($this->type == "POSTGRESQL")
				$query = "DELETE FROM {$this->prefix}_access_table WHERE session_id = '" . session_id () . "' AND user_id =" . SHGetCurrentUserID ();
			
			$this->db->Commit ( $query );
		}
		
		// unset($_SESSION['current_user_id']); // оставлено для совместимости
		unset ( $_SESSION ['user'] );
		// setcookie("mixid");
		
		// session_destroy();
	}
	public function EncryptPassword($password) { // Возвращает хэш пароля пользователя.
		return md5 ( md5 ( md5 ( md5 ( md5 ( $password ) . $password ) . $password ) . $password ) );
	}
	public function IsAdministrator() { // Проверяет текущего пользователя на принадлежность к группе администраторов
		$usergroup = new UserGroup ( $this->GetCurrentUser ()->GetGroupId () );
		if (! isset ( $usergroup ))
			return false;
		if ($usergroup->GetShortName () == 'ADMINS')
			return true;
		return false;
	}
	public function IsOrganizators() { // Проверяет текущего пользователя на принадлежность к группе организаторов
		$usergroup = new UserGroup ( $this->GetCurrentUser ()->GetGroupId () );
		if (! isset ( $usergroup ))
			return false;
		if ($usergroup->GetShortName () == 'ORGANIZERS')
			return true;
		if ($usergroup->GetShortName () == 'ADMINS')
			return true;
		return false;
	}
	public function IsInstructors() { // Проверяет текущего пользователя на принадлежность к группе преподавателей
		$usergroup = new UserGroup ( $this->GetCurrentUser ()->GetGroupId () );
		if (! isset ( $usergroup ))
			return false;
		if ($usergroup->GetShortName () == 'INSTRUCTORS')
			return true;
		if ($usergroup->GetShortName () == 'ADMINS')
			return true;
		return false;
	}
	public function GetHTMLRekeyInformation($parameters = Array()) {
		// Возвращает строку с ключом проверки активного окна, которую необходимо добавить в конец HTML
		$tmp = "../";
		foreach ( $parameters as $i ) {
			$tmp = $tmp . "../";
		}
		$tmp = "'" . $tmp . "/dynamic/helpers/validation.php/?rekey=" . $this->GetReKey () . "'";
		return '<script type="text/javascript" language="javascript">setInterval("makeRequest(' . $tmp . ')",1000);</script>';
	}
	public function SetProcess($alias) {
		if (isset ( $alias ))
			$_SESSION ['user'] ['process'] = $alias;
	}
	public function UnSetAllProcess() {
		unset ( $_SESSION ['user'] ['process'] );
	}
	public function UnSetProcess($alias) {
		if ($this->GetProcess () == $alias)
			$this->SetProcess ( "" );
	}
	public function GetProcess() {
		if (! isset ( $_SESSION ['user'] ['process'] ))
			return "";
		return $_SESSION ['user'] ['process'];
	}
	public function IsProcess($alias) {
		if (! isset ( $alias ))
			return false;
		if ($this->GetProcess () == $alias)
			return true;
		return false;
	}
	public function IsRCMAvailable() {
		return SHIsGetRight ( SHGetCurrentUserID (), 'RCMEnable' );
	}
	public function IsMEPAvailable() {
		return SHIsGetRight ( SHGetCurrentUserID (), 'MEPEnable' );
	}
	public function IsMyRoomAvailable() {
		return SHIsGetRight ( SHGetCurrentUserID (), 'MyRoomEnable' );
	}
	
	// ------------- [ GET ] -------------
	
	// ------------- [ SET ] -------------
	
	// ------------- [ Function ] -------------
	// =======================================================
} // Access
  // =======================================================
function SHIsGetRight($person_id, $alias) {
	$CasePrivileges = new CasePrivileges ();
	return $CasePrivileges->IsUserGetPrivilege ( $person_id, $alias );
} // SHIsUserGetPrl
function SHIsLockMode() {
	$access = new Access ();
	if ($access->IsAdministrator ())
		return false;
		// FixMe: дописать проверку на включение сервисного режима || здесь пока ее нет!
	return false;
} // SHIsLockMode
function SHQuickLogin() {
	$access = new Access ();
	$access->QuickLogin ();
}
function SHLogIn($username = "", $password = "") {
	$access = new Access ();
	$access->LogIn ( $username, $password );
}
function SHLogOut() {
	$access = new Access ();
	$access->LogOut ();
}
function SHGetCurrentIP() {
	if (isset ( $_SERVER ['HTTP_X_REAL_IP'] ))
		return $_SERVER ['HTTP_X_REAL_IP'];
	if (isset ( $_SERVER ['REMOTE_ADDR'] ))
		return $_SERVER ['REMOTE_ADDR'];
	return "0.0.0.0";
} // getCurrentIP
function SHGetCurrentUserID() {
	if (isset ( $_SESSION ['user'] ['id'] ))
		return intval ( $_SESSION ['user'] ['id'] );
	return - 1;
}

/*
 * require_once ' Exception. inc'; class AuthException extends Exception {} class Cookie { private $created; private $userid; private $version; // собственный mcrypt-дескриптор private $td; // mcrypt-информация static $cypher = 'blowfish'; static $mode = 'cfb'; static $key = ''; // информация о формате cookie static $cookiename = 'USERAUTH'; static $myversion = '1'; // срок действия cookie static $expiration = '600'; // период повторного выпуска cookie static $warning = '300'; static $glue = ' | ' ; public function _construct($userid = false) { $this->td = mcrypt_module_open ($cypher, '', $mode, ''); if($userid) { $this->userid = $userid; return; } else { if(array_key_exists(self::$cookiename, $_COOKIE)) { $buffer = $this->_unpackage($_COOKIE[self::$cookiename]); } else { throw new AuthException("Heт cookie-файла"); } } } public function set() { $cookie = $this->_package(); setcookie(self::$cookiename, $cookie); } public function validate() { if(!$this->version || !$this->created || !$this->userid) { throw new AuthException("Неверно сформированный cookie-файл"); } if ($this->version != self::$myversion) { throw new AuthException("Несоответствие версии"); } if (time() - $this->created -> self::$expiration) { throw new AuthException("Истек срок действия cookie"); } elseif (time() - $this->created > self::$resettime) { $this->set(); } } public function logout() { setcookie(self::$cookiename, "", 0); } private function _package() { $parts = array(self::$myversion, time(), $this->userid); $cookie = implode(self::$glue, $parts); return $this-> encrypt($cookie); } private function _unpackage($cookie) { $buffer = $this->_decrypt($cookie); list($this->version, $this->created, $this->userid) = explode(self::$glue, $buffer); if($this->version != self::$myversion || !$this->created || !$this->userid) { throw new AuthException(); } } private function _encrypt($plaintext) { $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td) , MCRYPT_RAND); mcrypt_generic_init ($this->td, $this->key, $iv) ; $crypttext = mcrypt_generic ($this->td, $plaintext); mcrypt_generic_deinit ($this->td); return $iv.$crypttext; } private function _decrypt($crypttext) { $ivsize = mcrypt_get_iv_size($this->td); $iv = substr($crypttext, 0, $ivsize); $crypttext = substr($crypttext, $ivsize); mcrypt_generic_init ($this->td, $this->key, $iv); $plaintext = mdecrypt_generic ($this->td, $crypttext); mcrypt_generic_deinit ($this->td); return $plaintext; } private function _reissue() { $this->created = time(); } }
 */
?>
