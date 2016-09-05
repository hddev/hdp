<?php
class LogHelper {
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	/**
	 * Возвращает массив событий в соответствии с переданными параметрами.
	 *
	 * Содержимое массива $parameters:
	 * 'per_page' - кол-во записей на странице
	 * 'page' - текущий номер страницы
	 * 'orderby' - имя поля для сортировки
	 * 'sort_direction' - направление сортировки
	 *
	 * @param array $parameters        	
	 * @return array
	 */
	public function GetLogList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_log_table ORDER BY `action_date` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_log_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_log_table ORDER BY action_date DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_log_table";
		}
		
		/**
		 * Модифицируем запрос для постраничного вывода и сортировки
		 */
		$pagination_data = array ();
		if (is_array ( $parameters )) {
			$cl = ClassLoader::getInstance ();
			$paginationclassname = $cl->LoadClass ( "PAGINATION" ); // подгружаем класс Pagination
			if ($paginationclassname) {
				$pagination = new $paginationclassname ( $query, $count_query );
				
				if (isset ( $parameters ['per_page'] ))
					$pagination->SetPerPage ( $parameters ['per_page'] );
				$page = (isset ( $parameters ['page'] ) && intval ( $parameters ['page'] ) > 0) ? intval ( $parameters ['page'] ) : 0;
				// Изменяем запрос для постраничного вывода
				$query = $pagination->ConstructQuery ( $page, $pagination_data );
			}
		}
		/**
		 * ----------------------------------------------------------
		 */
		$result = $this->db->query ( $query );
		if (! $result) {
			return false;
		}
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		$array ['pagination_data'] = $pagination_data;
		return $array;
	}
	/**
	 * Возвращает массив пригодный для генерации XML.
	 *
	 * @param array $parameters        	
	 * @param boolean $import        	
	 * @return array
	 */
	public function GetLogListForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetLogList ( $parameters );
		
		if (isset ( $list ['pagination_data'] )) {
			$pagination_data = $list ['pagination_data'];
			unset ( $list ['pagination_data'] );
		}
		
		$out = array ();
		$out ['name'] = "Log";
		foreach ( $list as $element ) {
			if (isset ( $element ['user_id'] )) {
				$user = new User ( $element ['user_id'], array () );
				$element ['user_id'] = $user->GetLogin ();
			}
			if (isset ( $element ['action_type'] ))
				$element ['action_type'] = $this->GetTypeNameByAlias ( $element ['action_type'] );
			
			$elar = array ();
			$elar ['name'] = "Action";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		$ar = array ();
		$ar ['name'] = "Pagination";
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		$out ['childs'] [] = $ar;
		
		if (count ( $external_data ) > 0) {
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	
	/*
	 * Типы событий
	 */
	public function GetTypeNameByAlias($action_type) {
		if ($action_type == "login")
			return "Вход пользователя";
		if ($action_type == "logout")
			return "Выход пользователя";
		
		if ($action_type == "addUser")
			return "Добавление нового пользователя";
		if ($action_type == "updUser")
			return "Обновление данных о пользователе";
		
		if ($action_type == "addStaticData")
			return "Добавление статической страницы";
		if ($action_type == "updStaticData")
			return "Обновление статической страницы";
		
		if ($action_type == "addGroup")
			return "Добавление новой группы";
		if ($action_type == "updGroup")
			return "Обновление информации о группе";
		
		if ($action_type == "addCourse")
			return "Добавлен новый курс";
		if ($action_type == "updCourse")
			return "Обновлена информация о курсе";
		
		if ($action_type == "addLection")
			return "Добавлена новая лекция";
		if ($action_type == "updLection")
			return "Изменена информация о лекции";
		
		if ($action_type == "showMyCourses")
			return "Просмотр списка доступных курсов";
		if ($action_type == "showMyLections")
			return "Просмотр списка достпных лекций";
		if ($action_type == "showMyMaterials")
			return "Просмотре списка доступных материалов";
		if ($action_type == "showMyTests")
			return "Просмотр списка достпных тестов";
		
		if ($action_type == "url")
			return "Переход пользователя";
		
		return $action_type; // Дописать по мере необходимости
	} // GetTypeByAlias
	public function getRequestActionsList($request_id) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM {$this->prefix}_log_table where `key` = 'RequestAction_D:{$request_id}'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_log_table where key = 'RequestAction_D:{$request_id}'";
			
			// if ($this -> db_type == "POSTGRESQL") $query="SELECT * FROM log_table_view where key = 'RequestAction_D:{$request_id}'";
			
		// alert();
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		return $array;
	}
	public function GetRequestActionByAlias($actiontype) {
		$type = explode ( ";", $actiontype );
		$action_type = $type [0];
		
		if ($action_type == "rSendApprove")
			return "Отправлен на согласование";
		if ($action_type == "rSendTakeInWork")
			return "Отправлен на этап принятия в работу";
		if ($action_type == "rSave")
			return "Сохранен";
		if ($action_type == "rDone")
			return "Исполнен(архивы)";
		if ($action_type == "rReturnedToAuthor") {
			if (count ( $type ) > 1) {
				return "Возвращен автору. " . $type [1];
			} else {
				return "Возвращен автору";
			}
			;
		}
		
		if ($action_type == "rReturnedInWork") {
			if (count ( $type ) > 1) {
				return "Возвращен на этап исполнения работ. " . $type [1];
			} else {
				return "Возвращен на этап исполнения работ";
			}
			;
		}
		
		if ($action_type == "rTakeInWork")
			return "Взят в работу";
		if ($action_type == "rWorksDone")
			return "Работы исполнены";
		if ($action_type == "rSendComplete")
			return "Отправлен на подтверждение исполнения";
		if ($action_type == "rSendConsideration")
			return "Отправлен на этап распределения работ";
		if ($action_type == "rSendInWork")
			return "Отправлен на этап исполнения работ";
		if ($action_type == "rDecline")
			return "Отклонен";
		if ($action_type == "rSendConfirnation")
			return "Отправлен на подтверждение заказчику";
		if ($action_type == "rReturnConsideration")
			return "Возвращен на этап распределения работ";
		
		if ($action_type == "rRegisterCompletedWork")
			return "Зарегистрирована выполненная работа";
		if ($action_type == "rObsoleteCompletedWork")
			return "Аннулирована выполненная работа";
			
			// --- действия (взять в работу и рассмотрено) добавлены после отказа от связи с лотусом ---
		if ($action_type == "rConsiderationTakeInWork")
			return "Запрос принят в работу";
		if ($action_type == "rConsiderationConsidered")
			return "Запрос распределен(назначены исполнители)";
			// --- действия (взять в работу и рассмотрено) добавлены после отказа от связи с лотусом ---
			
		// не хватает потребностей
		$pos = strpos ( $action_type, ":" );
		if ($pos === false)
			return $action_type;
		else {
			// расшифровываем по маске rCreateRequirement : id потребности
			$array = explode ( ":", $action_type );
			if ($array [0] == "rCreateRequirement")
				return "Сформирована потребность " . $this->GetRequirementIndex ( $array [1] );
			if ($array [0] == "rUpdRequirement") {
				$requirement = new Requirement ( $array [1] );
				$comment = $requirement->GetComment ();
				if ($comment != "")
					$comment = " (" . $comment . ")";
				return "Обработана потребность " . $this->GetRequirementIndex ( $array [1] ) . $comment;
			}
			;
		}
		;
		// не хватает потребностей
	}
	public function GetRequirementIndex($requirement_id) {
		$prefix = $GLOBALS ['REQUIREMENTS_PREFIX'] . "-" . date ( "y" ) . "-" . date ( "m" ) . "-" . date ( "d" ) . "-";
		if (strlen ( strval ( $requirement_id ) ) == 1)
			$postfix = "0000" . strval ( $requirement_id );
		if (strlen ( strval ( $requirement_id ) ) == 2)
			$postfix = "000" . strval ( $requirement_id );
		if (strlen ( strval ( $requirement_id ) ) == 3)
			$postfix = "00" . strval ( $requirement_id );
		if (strlen ( strval ( $requirement_id ) ) == 4)
			$postfix = "0" . strval ( $requirement_id );
		if (strlen ( strval ( $requirement_id ) ) == 5)
			$postfix = strval ( $requirement_id );
		$prefix = $prefix . $postfix;
		return $prefix;
	}
	public function GetDisplayRequestAction($log) {
		// по записи в логе возвращает пригодную для отображения запись
		$user = new User ( $log->GetUserId () );
		if ($user->GetId () == 0)
			$fio = "Диспетчер";
		else
			$fio = $user->GetSecondname () . " " . $user->GetFirstname () . " " . $user->GetPatronymic ();
		$date = $log->getactiondate ();
		$action = $this->GetRequestActionByAlias ( $log->getactiontype () );
		
		// для запроса возвращенного на исполнение или автору добавляется причина | $log -> getactiontype() == "rReturnedInWork"
		/*
		 * if ($log -> getactiontype() == "rReturnedToAuthor") { $array = $log -> getarray(); $request_id = substr($array['key'], -3); $request = new Request($request_id); $comment_array = explode(";", $request -> GetComment()); if (count($comment_array)>1) { if ($comment_array[count($comment_array)-1] <> "") $action = $action .$comment_array[count($comment_array)-1]; } }
		 */
		// для запроса возвращенного на исполнение или автору добавляется причина
		
		$array = array ();
		$array ['fio'] = $fio;
		$array ['date'] = $date;
		$array ['action'] = $action;
		
		return $array;
	}
	public function getRequestActionsListForXML($request_id, $external_data = array(), $import = false) {
		$log_actions_list = $this->getRequestActionsList ( $request_id );
		
		$out = array ();
		$out ['name'] = "LogActions";
		
		if (! empty ( $log_actions_list )) {
			foreach ( $log_actions_list as $element ) {
				
				$log = new Log ( $element ['id'] );
				$elar = array ();
				$elar ['name'] = "LogAction";
				$elar ['attributes'] = $this->GetDisplayRequestAction ( $log );
				$out ['childs'] [] = $elar;
			}
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
}
?>
