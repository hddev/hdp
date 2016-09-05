<?php
// =======================================================
class AdditionalFields 
// =======================================================
{
	private $db;
	private $prefix;
	private $id;
	private $status;
	private $request_number;
	private $description;
	private $author_id;
	private $contractor_id;
	private $address;
	private $UKI;
	private $FIO;
	private $cabinet;
	private $phone;
	private $ln_doc_unid;
	private $contract;
	private $approve_list_id;
	private $service_contract;
	private $creation_date;
	private $change_date;
	private $change_user_id;
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
		
		$in ['request_number'] = "";
		$in ['description'] = "";
		$in ['author_id'] = 0;
		$in ['contractor_id'] = 0;
		$in ['address'] = "";
		$in ['UKI'] = "";
		$in ['FIO'] = "";
		$in ['cabinet'] = "";
		$in ['phone'] = "";
		$in ['ln_doc_unid'] = "";
		$in ['contract'] = "";
		$in ['approve_list_id'] = "";
		$in ['service_contract'] = "";
		
		$in ['change_user_id'] = 0;
		$in ['creation_date'] = date ( "Y-m-d" );
		$in ['change_date'] = date ( "Y-m-d H:i:s" );
		return $this->InitializeByArray ( $in );
	} // InitializeEmpty
	private function InitializeByArray(array $in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_number = (isset ( $in ['request_number'] )) ? strval ( $in ['request_number'] ) : "";
		$this->description = (isset ( $in ['description'] )) ? strval ( $in ['description'] ) : "";
		$this->author_id = (isset ( $in ['author_id'] )) ? intval ( $in ['author_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		$this->address = (isset ( $in ['address'] )) ? strval ( $in ['address'] ) : "";
		$this->UKI = (isset ( $in ['UKI'] )) ? strval ( $in ['UKI'] ) : "";
		$this->FIO = (isset ( $in ['FIO'] )) ? strval ( $in ['FIO'] ) : "";
		$this->cabinet = (isset ( $in ['cabinet'] )) ? strval ( $in ['cabinet'] ) : "";
		$this->phone = (isset ( $in ['phone'] )) ? strval ( $in ['phone'] ) : "";
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		$this->contract = (isset ( $in ['contract'] )) ? strval ( $in ['contract'] ) : "";
		$this->approve_list_id = (isset ( $in ['approve_list_id'] )) ? strval ( $in ['approve_list_id'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? strval ( $in ['service_contract'] ) : "";
		
		$this->change_user_id = (isset ( $in ['change_user_id'] )) ? intval ( $in ['change_user_id'] ) : 0;
		$this->creation_date = (isset ( $in ['creation_date'] )) ? strval ( $in ['creation_date'] ) : date ( "Y-m-d" );
		$this->change_date = (isset ( $in ['change_date'] )) ? strval ( $in ['change_date'] ) : date ( "Y-m-d H:i:s" );
		return true;
	}
	private function InitializeByXMLArray($in) { // Инициализирует объект с помощью массива входных значений.
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->status = (isset ( $in ['status'] )) ? intval ( $in ['status'] ) : 0;
		
		$this->request_number = (isset ( $in ['request_number'] )) ? strval ( $in ['request_number'] ) : "";
		$this->description = (isset ( $in ['description'] )) ? strval ( $in ['description'] ) : "";
		$this->author_id = (isset ( $in ['author_id'] )) ? intval ( $in ['author_id'] ) : 0;
		$this->contractor_id = (isset ( $in ['contractor_id'] )) ? intval ( $in ['contractor_id'] ) : 0;
		$this->address = (isset ( $in ['address'] )) ? strval ( $in ['address'] ) : "";
		$this->UKI = (isset ( $in ['UKI'] )) ? strval ( $in ['UKI'] ) : "";
		$this->FIO = (isset ( $in ['FIO'] )) ? strval ( $in ['FIO'] ) : "";
		$this->cabinet = (isset ( $in ['cabinet'] )) ? strval ( $in ['cabinet'] ) : "";
		$this->phone = (isset ( $in ['phone'] )) ? strval ( $in ['phone'] ) : "";
		$this->ln_doc_unid = (isset ( $in ['ln_doc_unid'] )) ? strval ( $in ['ln_doc_unid'] ) : "";
		$this->contract = (isset ( $in ['contract'] )) ? strval ( $in ['contract'] ) : "";
		$this->approve_list_id = (isset ( $in ['approve_list_id'] )) ? strval ( $in ['approve_list_id'] ) : "";
		$this->service_contract = (isset ( $in ['service_contract'] )) ? strval ( $in ['service_contract'] ) : "";
		
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
		$query = "SELECT * FROM `{$this->prefix}_requests_table` WHERE `id` = " . intval ( $id );
		$result = $this->db->Query ( $query );
		if (! $result)
			return false;
		return $result->GetRow ();
	}
	private function Insert() { // Добавляет запись о пользователе в БД.
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_requests_table` (`status`,`request_number`,`description`,`author_id`,`contractor_id`,`address`,`UKI`,`FIO`,`cabinet`,`phone`,`ln_doc_unid`,`contract`,`approve_list_id`,`service_contract`,`change_user_id`,`creation_date`,`change_date`)
			VALUES ('{$this->status}','{$this->request_number}','{$this->description}','{$this->author_id}','{$this->contractor_id}','{$this->address}','{$this->UKI}','{$this->FIO}','{$this->cabinet}','{$this->phone}','{$this->ln_doc_unid}','{$this->contract}','{$this->approve_list_id}','{$this->service_contract}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}')";
		
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_additionalfields_table" );
			$query = "INSERT INTO {$this->prefix}_requests_table (id,status,request_number,description,author_id,contractor_id,address,UKI,FIO,cabinet,phone,ln_doc_unid,contract,approve_list_id,service_contract,change_user_id,creation_date,change_date)
			VALUES ('{$this->id}','{$this->status}','{$this->request_number}','{$this->description}','{$this->author_id}','{$this->contractor_id}','{$this->address}','{$this->UKI}','{$this->FIO}','{$this->cabinet}','{$this->phone}','{$this->ln_doc_unid}','{$this->contract}','{$this->approve_list_id}','{$this->service_contract}','{$this->change_user_id}','{$this->creation_date}','{$this->change_date}')";
		}
		;
		
		$this->db->Commit ( $query );
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addRequest", 'Request:' . $this->GetRequestNumber (), '' );
	} // Insert
	private function Update() { // Обновляет запись о пользователе в БД.
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "UPDATE `{$this->prefix}_requests_table` SET `status` = '{$this->status}',`request_number` = '{$this->request_number}',`description` = '{$this->description}',
				`author_id` = '{$this->description}',`contractor_id` = '{$this->contractor_id}',
				`address` = '{$this->address}',`UKI` = '{$this->UKI}',`FIO` = '{$this->FIO}',
				`cabinet` = '{$this->cabnet}',`phone` = '{$this->phone}',`ln_doc_unid` = '{$this->ln_doc_unid}',
				`contract` = '{$this->contract}',`approve_list_id` = '{$this->approve_list_id}',`service_contract` = '{$this->service_contract}',
				`change_user_id` = '{$this->change_user_id}',`creation_date` = '{$this->creation_date}',`change_date` = '{$this->change_date}' WHERE `id` = {$this->id}";
		
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_requests_table SET status = '{$this->status}',request_number = '{$this->request_number}',description = '{$this->description}',
				author_id = '{$this->description}',contractor_id = '{$this->contractor_id}',
				address = '{$this->address}',UKI = '{$this->UKI}',FIO = '{$this->FIO}',
				cabinet = '{$this->cabnet}',phone = '{$this->phone}',`ln_doc_unid` = '{$this->ln_doc_unid}',
				contract = '{$this->contract}',approve_list_id = '{$this->approve_list_id}',service_contract = '{$this->service_contract}',
				change_user_id = '{$this->change_user_id}',creation_date = '{$this->creation_date}',change_date = '{$this->change_date}' WHERE id = {$this->id}";
		
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
		return $this->requset_number;
	}
	public function GetDescription() {
		return $this->description;
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
		return $this->UKI;
	}
	public function GetFIO() {
		return $this->FIO;
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
	public function GetContract() {
		return $this->contract;
	}
	public function GetApproveListID() {
		return $this->approve_list_id;
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
	public function SetDescription($description) {
		$this->description = trim ( $description );
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
	public function SetUKI($UKI) {
		$this->UKI = trim ( $UKI );
	}
	public function SetFIO($FIO) {
		$this->FIO = trim ( $FIO );
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
	public function SetContract($contract) {
		$this->contract = trim ( $contract );
	}
	public function SetApproveListID($approve_list_id) {
		$this->approve_list_id = trim ( $approve_list_id );
	}
	public function SetServiceContract($service_contract) {
		$this->service_contract = trim ( $service_contract );
	}
	public function SetChangeUserID($change_user_id) {
		$this->change_user_id = intval ( $change_user_id );
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
		$out ['description'] = $this->description;
		
		$out ['author_id'] = $this->author_id;
		$out ['contractor_id'] = $this->contractor_id;
		$out ['address'] = $this->address;
		$out ['UKI'] = $this->UKI;
		$out ['FIO'] = $this->FIO;
		$out ['cabinet'] = $this->cabinet;
		$out ['phone'] = $this->phone;
		$out ['ln_doc_unid'] = $this->ln_doc_unid;
		$out ['contract'] = $this->contract;
		$out ['approve_list_id'] = $this->approve_list_id;
		$out ['service_contract'] = $this->service_contract;
		
		$out ['change_user_id'] = $this->change_user_id;
		$out ['creation_date'] = $this->creation_date;
		$out ['change_date'] = $this->change_date;
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
		$out ['name'] = "Request";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['status'] = $this->status;
		$out ['attributes'] ['request_number'] = $this->request_number;
		$out ['attributes'] ['description'] = $this->description;
		
		$out ['attributes'] ['author_id'] = $this->author_id;
		$out ['attributes'] ['contaractor_id'] = $this->contractor_id;
		$out ['attributes'] ['address'] = $this->address;
		$out ['attributes'] ['UKI'] = $this->UKI;
		$out ['attributes'] ['FIO'] = $this->FIO;
		$out ['attributes'] ['cabinet'] = $this->cabinet;
		$out ['attributes'] ['phone'] = $this->phone;
		$out ['attributes'] ['ln_doc_unid'] = $this->ln_doc_unid;
		$out ['attributes'] ['contract'] = $this->contract;
		$out ['attributes'] ['approve_list_id'] = $this->approve_list_id;
		$out ['attributes'] ['service_contract'] = $this->service_contract;
		
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
