<?php
// =============================================
class AdditionalFieldsHelper 
// =============================================
{
	private $db;
	private $prefix;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
	}
	public function GetFieldsList() {
		// --- исчерпывающий список необязательных полей ---
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_additionalfields_table ORDER BY `id` DESC";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_additionalfields_table ORDER BY id DESC";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
		// --- исчерпывающий список необязательных полей ---
	}
	public function GetRequestFieldsList($request_id) {
		// --- исчерпывающий список необязательных полей ---
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where `request_id` = {$request_id}";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where request_id = {$request_id}";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
		// --- исчерпывающий список необязательных полей ---
	}
	public function SetAdditionalFieldValue($request_id, $field_name, $field_alias, $field_value) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_requests_additionalfields_table` (`request_id`,`field_name`,`field_alias`,`field_value`)
		VALUES ('{$request_id}','{$field_name}','{$field_alias}','{$field_value}')";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "INSERT INTO {$this->prefix}_requests_additionalfields_table (id,request_id,field_name,field_alias,field_value)
		VALUES (nextval('k26_requests_additionalfields_table_seq'::regclass),'{$request_id}','{$field_name}','{$field_alias}','{$field_value}')";
		
		$this->db->Commit ( $query );
		$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addAdditionalFieldValue", 'Request_ID:' . $request_id, '' );
	}
	public function UpdateAdditionalFieldValue($request_id, $field_name, $field_alias, $field_value) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where `request_id` = {$request_id} AND `field_alias` = '{$field_alias}'";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where request_id = {$request_id} AND field_alias = '{$field_alias}'";
		
		$result = $this->db->query ( $query );
		$row = $result->GetRow ();
		
		if (empty ( $row )) {
			$this->SetAdditionalFieldValue ( $request_id, $field_name, $field_alias, $field_value );
			
			/*
			 * $Log=new Log(); $Log->AddAction("updRequest",'Request:'.$this->GetRequestNumber(),'');
			 */
		} else {
			if ($GLOBALS ['DB_TYPE'] == "MYSQL")
				$query = "UPDATE `{$this->prefix}_requests_additionalfields_table` SET `field_name` = '{$field_name}',
			`field_value` = '{$field_value}' WHERE `request_id` = {$request_id} AND `field_alias` = '{$field_alias}'";
			if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
				$query = "UPDATE {$this->prefix}_requests_additionalfields_table SET field_name = '{$field_name}',
			field_value = '{$field_value}' WHERE request_id = {$request_id} AND field_alias = '{$field_alias}'";
			$this->db->Commit ( $query );
		}
	}
	public function FillAdditionalFields($request_id, $request) {
		// --- заполняет список необязтельных полей для запроса ---
		$request_helper = new RequestHelper ();
		$additionalfields = $request_helper->GetAdditionalFieldsList ( $request_id );
		
		$fieldslist = $this->GetFieldsList ();
		
		if (! $additionalfields) {
			// заполняем необязательные поля
			foreach ( $fieldslist as $element ) {
				if (isset ( $request [$element ['alias']] )) {
					// создаем запись с кастомными полями
					$this->SetAdditionalFieldValue ( $request_id, $element ['description'], $element ['alias'], $request [$element ['alias']] );
				}
			}
		} else {
			// обновляем или заполняем необязательные поля
			foreach ( $additionalfields as $element ) {
				if (isset ( $request [$element ['field_alias']] )) {
					// обновляем запись с кастомными полями
					$this->UpdateAdditionalFieldValue ( $request_id, $element ['field_name'], $element ['field_alias'], $request [$element ['field_alias']] );
				}
			}
		}
	}
	public function GetRequestImportance($request_id) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where `request_id` = {$request_id} AND `field_alias` = 'importance'";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_requests_additionalfields_table where request_id = {$request_id} AND field_alias = 'importance'";
		
		$result = $this->db->query ( $query );
		$row = $result->GetRow ();
		
		if (! empty ( $row )) {
			switch ($row ['field_value']) {
				case "0" :
					return "Критический";
					break;
				case "2" :
					return "Средний";
					break;
				case "3" :
					return "Низкий";
					break;
			}
		}
		
		return "Средний";
	}
	
	// ==============================================
} // RequestHelper
  // ==============================================
?>