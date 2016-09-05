<?php

// =======================================================
class Request // Класс для работы с экземпляром подразделения
              // =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $status;
	private $request_number;
	private $requesttext; // $description;
	private $author_id;
	private $contractor_id;
	private $address;
	private $uki;
	private $fio;
	private $cabinet;
	private $phone;
	private $ln_doc_unid;
	private $contract_id;
	private $comment;
	private $service_contract;
	private $email;
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
		
		$access = new Access ();
		$user = $access->GetCurrentUser ();
		
		$orghelper = new OrganizationHelper ();
		
		$in ['request_number'] = "";
		$in ['requesttext'] = "";
		$in ['author_id'] = $user->GetId ();
		$in ['contractor_id'] = $orghelper->GetCurrentUserOrganization ();
		$in ['address'] = "";
		$in ['uki'] = "";
		$in ['fio'] = "";
		$in ['cabinet'] = "";
		$in ['phone'] = "";
		$in ['ln_doc_unid'] = "";
		$in ['contract_id'] = 0;
		$in ['comment'] = "";
		$in ['service_contract'] = "";
		
		$in ['email'] = "";
		
		$in ['change_user_id'] = 0;
		$in ['creation_date'] = date ( "Y-m-d H:i:s" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_number = (isset ( $in ['request_number'] )) ? strval ( $in ['request_number'] ) : "";
		$this->requesttext = (isset ( $in ['requesttext'] )) ? strval ( $in ['requesttext'] ) : "";
		$this->author_id = (isset ( $in ['author_id'] )) ? intval ( $in ['author_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		$this->address = (isset ( $in ['address'] )) ? strval ( $in ['address'] ) : "";
		$this->uki = (isset ( $in ['uki'] )) ? strval ( $in ['uki'] ) : "";
		$this->fio = (isset ( $in ['fio'] )) ? strval ( $in ['fio'] ) : "";
		$this->cabinet = (isset ( $in ['cabinet'] )) ? strval ( $in ['cabinet'] ) : "";
		$this->phone = (isset ( $in ['phone'] )) ? strval ( $in ['phone'] ) : "";
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		$this->contract_id = (isset ( $in ['contract_id'] )) ? intval ( $in ['contract_id'] ) : "";
		$this->comment = (isset ( $in ['comment'] )) ? strval ( $in ['comment'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? strval ( $in ['service_contract'] ) : "";
		
		$this->email = (isset ( $in ['email'] )) ? strval ( $in ['email'] ) : "";
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d H:i:s" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_number = (isset ( $in ['request_number'] )) ? strval ( $in ['request_number'] ) : "";
		$this->requesttext = (isset ( $in ['requesttext'] )) ? strval ( $in ['requesttext'] ) : "";
		$this->author_id = (isset ( $in ['author_id'] )) ? intval ( $in ['author_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		$this->address = (isset ( $in ['address'] )) ? strval ( $in ['address'] ) : "";
		$this->uki = (isset ( $in ['uki'] )) ? strval ( $in ['uki'] ) : "";
		$this->fio = (isset ( $in ['fio'] )) ? strval ( $in ['fio'] ) : "";
		$this->cabinet = (isset ( $in ['cabinet'] )) ? strval ( $in ['cabinet'] ) : "";
		$this->phone = (isset ( $in ['phone'] )) ? strval ( $in ['phone'] ) : "";
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		$this->contract_id = (isset ( $in ['contract_id'] )) ? intval ( $in ['contract_id'] ) : "";
		$this->comment = (isset ( $in ['comment'] )) ? strval ( $in ['comment'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? strval ( $in ['service_contract'] ) : "";
		
		$this->email = (isset ( $in ['email'] )) ? strval ( $in ['email'] ) : "";
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d H:i:s" );
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
			$query = "SELECT * FROM `{$this->prefix}_requests_table` WHERE `id` = " . intval ( $id );
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_table WHERE id = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
	                            
		// $text = nl2br($this->requesttext);
	                            // $text = str_replace("\n", "&#010;",$this->requesttext);
		$text = str_replace ( "&#010;", "<br/>", $this->requesttext );
		$text = str_replace ( "\n", "<br/>", $text );
		
		if ($this->db_type == "MYSQL") {
			$this->requesttext = mysql_real_escape_string ( $this->requesttext );
			$this->fio = mysql_real_escape_string ( $this->fio );
			$this->cabinet = mysql_real_escape_string ( $this->cabinet );
			$this->phone = mysql_real_escape_string ( $this->phone );
			$this->comment = mysql_real_escape_string ( $this->comment );
			
			$query = "INSERT INTO `{$this->prefix}_requests_table` (`status`,`request_number`,`requesttext`,`author_id`,`contractor_id`,`address`,`uki`,`fio`,`cabinet`,`phone`,`ln_doc_unid`,`contract_id`,`comment`,`service_contract`,`change_user_id`,`creation_date`,`change_date`,`email`)
			VALUES ('{$this->status}','{$this->request_number}','{$text}','{$this->author_id}','{$this->contractor_id}','{$this->address}','{$this->uki}','{$this->fio}','{$this->cabinet}','{$this->phone}','{$this->ln_doc_unid}','{$this->contract_id}','{$this->comment}','{$this->service_contract}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}','{$this->email}')";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$this->requesttext = pg_escape_string ( $this->requesttext );
			$this->fio = pg_escape_string ( $this->fio );
			$this->cabinet = pg_escape_string ( $this->cabinet );
			$this->phone = pg_escape_string ( $this->phone );
			$this->comment = pg_escape_string ( $this->comment );
			
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_requests_table" );
			
			$query = "INSERT INTO {$this->prefix}_requests_table (id,status,request_number,requesttext,author_id,contractor_id,address,uki,fio,cabinet,phone,ln_doc_unid,contract_id,comment,service_contract,change_user_id,creation_date,change_date,email)
			VALUES ('{$this->id}','{$this->status}','{$this->request_number}','{$text}','{$this->author_id}','{$this->contractor_id}','{$this->address}','{$this->uki}','{$this->fio}','{$this->cabinet}','{$this->phone}','{$this->ln_doc_unid}','{$this->contract_id}','{$this->comment}','{$this->service_contract}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}','{$this->email}')";
		}
		
		// echo $query;
		
		$this->db->Commit ( $query );
		
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addRequest", 'Request:' . $this->GetRequestNumber (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
	                            
		// $text = str_replace("\n", "&#010;",$this->requesttext);
		$text = str_replace ( "&#010;", "<br/>", $this->requesttext );
		$text = str_replace ( "\n", "<br/>", $text );
		
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_requests_table` SET `status` = '{$this->status}',`request_number` = '{$this->request_number}',`requesttext` = '{$text}',
				`author_id` = '{$this->author_id}',`contractor_id` = '{$this->contractor_id}',
				`address` = '{$this->address}',`uki` = '{$this->uki}',`fio` = '{$this->fio}',
				`cabinet` = '{$this->cabinet}',`phone` = '{$this->phone}',`ln_doc_unid` = '{$this->ln_doc_unid}',
				`contract_id` = '{$this->contract_id}',`comment` = '{$this->comment}',`service_contract` = '{$this->service_contract}',
				`change_user_id` = '{$this->change_user_id}',`creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}', `email` = '{$this->email}'  WHERE `id` = {$this->id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_requests_table SET status = '{$this->status}',request_number = '{$this->request_number}',requesttext = '{$text}',
				author_id = '{$this->author_id}',contractor_id = '{$this->contractor_id}',
				address = '{$this->address}',uki = '{$this->uki}',fio = '{$this->fio}',
				cabinet = '{$this->cabinet}',phone = '{$this->phone}',ln_doc_unid = '{$this->ln_doc_unid}',
				contract_id = '{$this->contract_id}',comment = '{$this->comment}',service_contract = '{$this->service_contract}',
				change_user_id = '{$this->change_user_id}',creation_date = '{$this->creation_date}',change_date = '{$this->change_date}', email = '{$this->email}'  WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updRequest", 'Request:' . $this->GetRequestNumber (), '' );
	} // Update
	  
	// --------------- PUBLIC FUNCTION'S ---------------
	public function GetId() { // Возвращает идентификатор пользователя.
		return $this->id;
	}
	public function GetStatus() { // Возвращает логин.
		return $this->status;
	}
	public function GetRequestNumber() {
		return $this->request_number;
	}
	public function GetRequestText() {
		return $this->requesttext;
	}
	
	//
	public function GetAuthorID() {
		return $this->author_id;
	}
	public function GetContractorID() {
		return $this->contractor_id;
	}
	public function GetAddress() {
		return $this->address;
	}
	public function GetUKI() {
		return $this->uki;
	}
	public function GetFIO() {
		return $this->fio;
	}
	public function GetCabinet() {
		return $this->cabinet;
	}
	public function GetPhone() {
		return $this->phone;
	}
	public function GetLNDocUnid() {
		return $this->ln_doc_unid;
	}
	public function GetContractID() {
		return $this->contract_id;
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
	public function GetEmail() {
		return $this->email;
	}
	
	// --- SET ---
	public function SetID($id) {
		$this->id = intval ( trim ( $id ) );
	}
	public function SetStatus($status) { // Устанавливает новый логин пользователя.
		$this->status = intval ( $status );
	}
	public function SetRequestNumber($request_number) {
		$this->request_number = trim ( $request_number );
	}
	public function SetRequestText($requesttext) {
		$this->requesttext = trim ( $requesttext );
	}
	public function SetAuthorID($author_id) {
		$this->author_id = intval ( $author_id );
	}
	public function SetContractorID($contractor_id) {
		$this->contractor_id = intval ( $contractor_id );
	}
	public function SetAddress($address) {
		$this->address = trim ( $address );
	}
	public function SetUKI($uki) {
		$this->uki = trim ( $uki );
	}
	public function SetFIO($fio) {
		$this->fio = trim ( $fio );
	}
	public function SetCabinet($cabinet) {
		$this->cabinet = trim ( $cabinet );
	}
	public function SetPhone($phone) {
		$this->phone = trim ( $phone );
	}
	public function SetLnDocUnid($ln_doc_unid) {
		$this->ln_doc_unid = trim ( $ln_doc_unid );
	}
	public function SetContractID($contract_id) {
		$this->contract_id = intval ( $contract_id );
	}
	public function SetComment($comment) {
		$this->comment = trim ( $comment );
	}
	public function SetServiceContract($service_contract) {
		$this->service_contract = trim ( $service_contract );
	}
	public function SetChangeUserID($change_user_id) {
		$this->change_user_id = intval ( $change_user_id );
	}
	public function SetEmail($email) {
		$this->email = strval ( $email );
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
		$out ['request_number'] = $this->request_number;
		$out ['requesttext'] = str_replace ( "\n", "&#010;", $this->requesttext );
		
		$out ['author_id'] = $this->author_id;
		$out ['contractor_id'] = $this->contractor_id;
		$out ['address'] = $this->address;
		$out ['uki'] = $this->uki;
		$out ['fio'] = $this->fio;
		$out ['cabinet'] = $this->cabinet;
		$out ['phone'] = $this->phone;
		$out ['ln_doc_unid'] = $this->ln_doc_unid;
		$out ['contract_id'] = $this->contract_id;
		$out ['comment'] = $this->comment;
		$out ['service_contract'] = $this->service_contract;
		
		$out ['email'] = $this->email;
		
		$out ['change_user_id'] = $this->change_user_id;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
		
		$synchelper = new SynchronizationHelper ();
		$record = $synchelper->LoadRecordByID ( "Request", $this->id );
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
	public function GetArrayForXML($import = false, array $external_data = array(), $replace = true) {
		$out = array ();
		$out ['name'] = "Request";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['status'] = $this->status;
		$out ['attributes'] ['request_number'] = $this->request_number;
		
		if ($replace) {
			$out ['attributes'] ['requesttext'] = str_replace ( "<br/>", "&#010;", str_replace ( "\n", "&#010;", $this->requesttext ) );
		} else {
			$out ['attributes'] ['requesttext'] = str_replace ( "<br/>", "", $this->requesttext );
		}
		;
		
		$out ['attributes'] ['author_id'] = $this->author_id;
		$out ['attributes'] ['contaractor_id'] = $this->contractor_id;
		$out ['attributes'] ['address'] = $this->address;
		$out ['attributes'] ['uki'] = $this->uki;
		$out ['attributes'] ['fio'] = $this->fio;
		$out ['attributes'] ['cabinet'] = $this->cabinet;
		$out ['attributes'] ['phone'] = $this->phone;
		$out ['attributes'] ['ln_doc_unid'] = $this->ln_doc_unid;
		$out ['attributes'] ['contract_id'] = $this->contract_id;
		$out ['attributes'] ['comment'] = $this->comment;
		$out ['attributes'] ['service_contract'] = $this->service_contract;
		
		$out ['attributes'] ['email'] = $this->email;
		
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
	
	// =======================================================
} // Request
  // =======================================================
?>
