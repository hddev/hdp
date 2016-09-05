<?php
// =============================================
class RequestActivityHelper// =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	private function GetRequestUsersAccessList($request_id) {
		if ($request_id == 0)
			return false;
		$request = new Request ( $request_id );
		
		$query = "SELECT requests.author_id as user_id FROM
				{$this->prefix}_requests_table AS requests 
				WHERE (requests.status <> 0) AND (requests.id = {$request_id})
				UNION SELECT distinct approve.approver_id FROM {$this->prefix}_approve_table AS approve		
				WHERE (approve.organization_id = {$request -> GetContractorID()})
				UNION SELECT distinct executant.executor_id FROM {$this->prefix}_requests_executants_table AS executant 
				WHERE (executant.request_id = {$request_id})";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
	}
	
	/*
	 * public function MarkRequestUnread($request_id) { $list = $this -> GetRequestUsersAccessList($request_id); if (!empty($list)) { foreach ($list as $element) { $request_activity = new RequestActivity(); $request_activity -> SetUserID($element['user_id']); $request_activity -> SetRequestID($request_id); $request_activity -> SetStatus(1); $request_activity -> Save(); } } }
	 */
	
	/*public function SetUserRead($request_id) {		
		if ($request_id == 0) return false;		
		$access = new Access();				
		if ($request_id == 0) return false;
		
		if ($this -> db_type == "MYSQL") $query="UPDATE `{$this->prefix}_requests_activity_table` SET `status` = '0' 
				WHERE `request_id` = {$request_id} AND `user_id` = {$access -> GetUserId()}";
		if ($this -> db_type == "POSTGRESQL") $query="UPDATE {$this->prefix}_requests_activity_table SET status = '0' 
				WHERE request_id = {$request_id} AND user_id = {$access -> GetUserId()}";
		
		$this->db->Commit($query);
	}*/

	public function SetUserRead($request_id) {
		if ($request_id == 0)
			return false;
		$access = new Access ();
		
		$request_activity = new RequestActivity ();
		$request_activity->SetUserID ( $access->GetCurrentUser ()->GetId () );
		$request_activity->SetRequestID ( $request_id );
		$request_activity->SetStatus ( 1 );
		$request_activity->Save ();
	}
	public function MarkRequestUnread($request_id) {
		if ($request_id == 0)
			return false;
		$access = new Access ();
		
		if ($this->db_type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_requests_activity_table` 
		WHERE `request_id` = {$request_id} AND `user_id` = {$access -> GetUserId()} AND `status` = 1";
		if ($this->db_type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_requests_activity_table
		WHERE request_id = {$request_id} AND user_id = {$access -> GetUserId()} AND status = 1";
		
		$this->db->Commit ( $query );
	}
	public function MarkRequestUnreadForUserID($request_id, $user_id) {
		if ($request_id == 0)
			return false;
		$access = new Access ();
		
		if ($this->db_type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_requests_activity_table`
		WHERE `request_id` = {$request_id} AND `user_id` = {$user_id} AND `status` = 1";
		if ($this->db_type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_requests_activity_table
		WHERE request_id = {$request_id} AND user_id = {$user_id} AND status = 1";
		
		$this->db->Commit ( $query );
	}
	public function MarkUnread($request_id) {
		if ($request_id == 0)
			return false;
		
		if ($this->db_type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_requests_activity_table`
		WHERE `request_id` = {$request_id} AND `status` = 1";
		if ($this->db_type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_requests_activity_table
		WHERE request_id = {$request_id} AND status = 1";
		
		$this->db->Commit ( $query );
	}
	
	/*
	 * public function GetUnreadMarks($query_issue, $user_id) { if ($query_issue == "") return false; $query = "SELECT DISTINCT request_id, status FROM {$this->prefix}_requests_activity_table WHERE ({$query_issue}) and user_id = '{$user_id}' and status='1'"; $result=$this->db->query($query); if (!$result) return false; $array=$result->GetAllRows(MYSQL_ASSOC); return $array; }
	 */
	public function GetReadMarks($query_issue, $user_id) {
		if ($query_issue == "")
			return false;
		
		$query = "SELECT DISTINCT request_id, status FROM {$this->prefix}_requests_activity_table WHERE ({$query_issue}) and user_id = '{$user_id}' and status='1'";
		
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
	}
	
	// ==============================================
} // RequestHelper
  // ==============================================
?>