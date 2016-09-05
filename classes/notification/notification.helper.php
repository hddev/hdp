<?php
class NotificationHelper // =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	public function CreateNotificationMarks($request_status, $request_id) {
		$this->ObsoleteNotificationMarks ( $request_id );
		$this->ProcessNotificationQuery ( $request_status, $request_id );
	}
	private function ProcessNotificationQuery($request_status, $request_id) {
		$access = new Access ();
		$user_id = $access->GetCurrentUser ()->GetId ();
		
		$query = "";
		
		if ($request_status == $GLOBALS ['REQUEST_STATUS_APPROVE'])
			//определяем адреса согласовантов для организации автора
								
			{) 

			$query = "SELECT
			users.id AS user_id, requests.id as request_id
			FROM
			{$this->prefix}_requests_table AS requests
			INNER JOIN {$this->prefix}_approve_table AS approve ON requests.contractor_id = approve.organization_id
			INNER JOIN {$this->prefix}_users_table AS users ON approve.approver_id = users.id
			INNER JOIN {$this->prefix}_users_notifications_table AS notifications ON notifications.user_id = users.id
			WHERE
			requests.id = {$request_id} and users.id <> {$user_id}";
		}
		
		if ($request_status == $GLOBALS ['REQUEST_STATUS_CONSIDERATION'])
			//определяем адреса распределяторов в зависимости от маршрута
					//пока без автора
			{) 

			$query = "SELECT
			users.id AS user_id, requests.id as request_id
			FROM
			{$this->prefix}_requests_table AS requests
			INNER JOIN {$this->prefix}_requests_routes_table AS routes ON requests.id = routes.request_id
			INNER JOIN {$this->prefix}_route_approve_table AS route_approve ON routes.route_id = route_approve.route_id
			INNER JOIN {$this->prefix}_users_table AS users ON route_approve.approver_id = users.id
			INNER JOIN {$this->prefix}_users_notifications_table AS notifications ON notifications.user_id = users.id
			WHERE
			requests.id = {$request_id} and users.id <> {$user_id}";
		}
		
		if ($request_status == $GLOBALS ['REQUEST_STATUS_INWORK'])
			//определяем адреса исполнителей по запросу
			//пока без автора
			{) 

			$query = "SELECT
			users.id AS user_id, requests.id as request_id
			FROM
			{$this->prefix}_requests_table AS requests
			INNER JOIN {$this->prefix}_requests_executants_table AS executants ON requests.id = executants.request_id
			INNER JOIN {$this->prefix}_users_table AS users ON executants.executor_id = users.id
			INNER JOIN {$this->prefix}_users_notifications_table AS notifications ON notifications.user_id = users.id
			WHERE
			executants.request_id = {$request_id} and users.id <> {$user_id}";
		}
		
		/*
		 * if ($request_status == $GLOBALS['REQUEST_STATUS_COMPLETE']) //подтверждение исполнения работ - никому $users_list = "";
		 */
		
		if ($request_status == $GLOBALS ['REQUEST_STATUS_CONFIRMATION'])
			//уведомление автору о необходимости подтверждения
			{) 

			$query = "SELECT
			requests.author_id AS user_id, requests.id as request_id			
			FROM
			{$this->prefix}_requests_table AS requests	
			INNER JOIN {$this->prefix}_users_notifications_table AS notifications ON notifications.user_id = requests.author_id		
			WHERE
			requests.id = {$request_id}";
		}
		
		/*
		 * if ($request_status == $GLOBALS['REQUEST_STATUS_DONE']) //запрос исполнен - никому $users_list = "";
		 */
		
		if ($request_status == $GLOBALS ['REQUEST_STATUS_DECLINE'])
			//уведомление автору
			{) 

			$query = "SELECT
			requests.author_id AS user_id, requests.id as request_id
			FROM {$this->prefix}_requests_table AS requests	
			INNER JOIN {$this->prefix}_users_notifications_table AS notifications ON notifications.user_id = requests.author_id
			WHERE
			requests.id = {$request_id} and requests.author_id <> {$user_id}";
		}
		
		if ($query != "") {
			$result = $this->db->query ( $query );
			
			if (! $result)
				return false;
			$list = $result->GetAllRows ( MYSQL_ASSOC );
			
			if (! empty ( $list )) {
				foreach ( $list as $element ) {
					// для всех $element['user_id'] создаем записи в таблице для напоминаний
					$notification = new Notification ();
					$notification->SetRequestID ( $element ['request_id'] );
					$notification->SetStatus ( 1 );
					$notification->SetUserID ( $element ['user_id'] );
					$notification->Save ();
				}
			}
		}
		
		return false;
	}
	private function ObsoleteNotificationMarks($request_id) {
		// alert();
		/*
		 * if ($this -> db_type == "MYSQL") $query="UPDATE `{$this->prefix}_notifications_table` SET `status` = '0' WHERE `request_id` = {$request_id}"; if ($this -> db_type == "POSTGRESQL") $query="UPDATE {$this->prefix}_notifications_table SET status = '0' WHERE request_id = {$request_id}";
		 */
		if ($this->db_type == "MYSQL")
			$query = "DELETE FROM `{$this->prefix}_notifications_table`
		WHERE `request_id` = {$request_id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "DELETE FROM {$this->prefix}_notifications_table
		WHERE request_id = {$request_id}";
		
		$this->db->Commit ( $query );
	}
	private function ObsoleteNotificationMarkByID($id) {
		// alert();
		/*
		 * if ($this -> db_type == "MYSQL") $query="UPDATE `{$this->prefix}_notifications_table` SET `status` = '0' WHERE `request_id` = {$request_id}"; if ($this -> db_type == "POSTGRESQL") $query="UPDATE {$this->prefix}_notifications_table SET status = '0' WHERE request_id = {$request_id}";
		 */
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_notifications_table` SET `status` = '0'
		WHERE `id` = {$id}";
		
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_notifications_table SET status = 0
		WHERE id = {$id}";
		
		$this->db->Commit ( $query );
	}
	private function Notify_Single() {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email, users.id as user_id
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email, users.id as user_id
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		$result = $this->db->query ( $query );
		
		if (! $result)
			return false;
		$list = $result->GetAllRows ( MYSQL_ASSOC );
		
		if (! empty ( $list )) {
			$prev_request_id = "";
			$users_list = "";
			foreach ( $list as $element ) {
				$request = new Request ( $element ['request_id'] );
				$mail = new MemoMail ();
				$mailhelper = new MemoMailHelper ();
				
				$mail->SetFrom ( $mailhelper->GetMailFrom () );
				$mail->SetTo ( $element ['email'] );
				$mail->SetTheme ( $mailhelper->ComposeTheme ( $request->GetStatus () ) );
				// $mail -> SetText($mailhelper->ComposeText($request -> GetStatus(), $request -> GetId(), $request -> GetRequestNumber(), $request -> GetAuthorID()));
				$mail->SetText ( $mailhelper->ComposeTextNew ( $element ['user_id'], $request->GetId () ) );
				
				$mail->Send ();
				
				$this->ObsoleteNotificationMarkByID ( $element ['id'] );
			}
		}
	}
	private function Notify_GroupByRequestID() {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		$result = $this->db->query ( $query );
		
		if (! $result)
			return false;
		$list = $result->GetAllRows ( MYSQL_ASSOC );
		
		if (! empty ( $list )) {
			$prev_request_id = "";
			$users_list = "";
			
			foreach ( $list as $element ) {
				// начинаем формировать список для рассылки уведомлений
				$request_id = $element ['request_id'];
				
				if ($request_id == $prev_request_id) {
					$users_list = $users_list . ", " . $element ['email'];
				} else {
					if ($prev_request_id != "" and $users_list != "") {
						// ---- отправляем сообщение по переменной $users_list ----
						$mail = new MemoMail ();
						$mailhelper = new MemoMailHelper ();
						$request = new Request ( $prev_request_id );
						
						$mail->SetFrom ( $mailhelper->GetMailFrom () );
						$mail->SetTo ( $users_list );
						
						$mail->SetTheme ( $mailhelper->ComposeTheme ( $request->GetStatus () ) );
						$mail->SetText ( $mailhelper->ComposeText ( $request->GetStatus (), $request->GetId (), $request->GetRequestNumber (), $request->GetAuthorID () ) );
						$mail->Send ();
						
						$this->ObsoleteNotificationMarks ( $prev_request_id );
						// ---- отправляем сообщение по переменной $users_list ----
					}
					$users_list = $element ['email'];
				}
				;
				
				$prev_request_id = $request_id;
			}
		}
	}
	private function Notify_GroupByUserID() {
	}
	public function Notify() {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email, users.id as user_id
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id			
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT DISTINCT
			notifications.id, notifications.request_id, users.email, users.id as user_id
			FROM {$this->prefix}_notifications_table AS notifications
			INNER JOIN {$this->prefix}_users_table AS users
			ON users.id = notifications.user_id
			LEFT JOIN {$this->prefix}_requests_activity_table AS activity
			ON activity.request_id = notifications.request_id AND activity.user_id = notifications.user_id
			WHERE users.email <> '' AND notifications.status = '1' AND activity.status IS NULL
			ORDER BY notifications.request_id";
		}
		
		$result = $this->db->query ( $query );
		
		if (! $result)
			return false;
		$list = $result->GetAllRows ( MYSQL_ASSOC );
		
		if (! empty ( $list )) {
			$prev_request_id = "";
			$users_list = "";
			
			$file = fopen ( 'log/log_mail.log', 'a' );
			
			foreach ( $list as $element ) {
				
				$request = new Request ( $element ['request_id'] );
				
				$mail = new MemoMail ();
				$mailhelper = new MemoMailHelper ();
				
				$mail->SetFrom ( $mailhelper->GetMailFrom () );
				$mail->SetTo ( $element ['email'] );
				$mail->SetTheme ( $mailhelper->ComposeTheme ( $request->GetStatus () ) );
				// $mail -> SetText($mailhelper->ComposeText($request -> GetStatus(), $request -> GetId(),
				// $request -> GetRequestNumber(), $request -> GetAuthorID()));
				$mail->SetText ( $mailhelper->ComposeTextNew ( $element ['user_id'], $request->GetId () ) );
				
				if ($mail->Send ()) {
					fwrite ( $file, date ( "Y-m-d H:i:s" ) . " :: [RequestID]" . $request->GetId () . " ; [To]" . $element ['email'] . " ; [RequestStatus]" . $request->GetStatus () . "; [Status]OK" . PHP_EOL );
				} else {
					fwrite ( $file, date ( "Y-m-d H:i:s" ) . " :: [RequestID]" . $request->GetId () . " ; [To]" . $element ['email'] . " ; [RequestStatus]" . $request->GetStatus () . "; [Status]Error" . PHP_EOL );
				}
				
				$this->ObsoleteNotificationMarkByID ( $element ['id'] );
				
				/*
				 * //начинаем формировать список для рассылки уведомлений $request_id = $element['request_id']; if ($request_id == $prev_request_id) { $users_list = $users_list .", " .$element['email']; } else { if ($prev_request_id <> "" AND $users_list <> "") { //---- отправляем сообщение по переменной $users_list ---- $mail = new MemoMail(); $mailhelper = new MemoMailHelper(); $request = new Request($prev_request_id); //echo $users_list ." :: Request_ID " .$request -> GetId() ."<br/>"; $mail -> SetFrom($mailhelper -> GetMailFrom()); $mail -> SetTo($users_list); echo " Request " .$request -> GetId() ." :: " .$users_list . "***"; $mail -> SetTheme($mailhelper -> ComposeTheme($request -> GetStatus())); $mail -> SetText($mailhelper->ComposeText($request -> GetStatus(), $request -> GetId(), $request -> GetRequestNumber(), $request -> GetAuthorID())); //$mail -> Send(); $this -> ObsoleteNotificationMarks($prev_request_id); //---- отправляем сообщение по переменной $users_list ---- } $users_list = $element['email']; }; $prev_request_id = $request_id;
				 */
			}
			fclose ( $file );
		}
	}
	
	// ==============================================
} // RouteHelper
  // ==============================================
?>
