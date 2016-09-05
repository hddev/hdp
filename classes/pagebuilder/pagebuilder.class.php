<?php
class PageBuilder {
	private $page_ierarchy;
	private $pagecontroller;
	private $cur_page;
	private $db;
	function __construct() {
		$this->pagecontroller = PageController::getInstance ();
		$this->page_ierarchy = $this->pagecontroller->GetCurrentPageIerarchy ();
		$this->cur_page = $this->page_ierarchy [count ( $this->page_ierarchy ) - 1];
		
		$this->db = DbController::GetDatabaseInstance ();
	}
	/**
	 * Выполняет построение страницы.
	 */
	public function BuildPage() {
		$template_path = "{$GLOBALS['ROOT_DIR']}/templates/{$this->cur_page['template']}.html";
		include ($template_path);
		
		$log = new Log ( 0, array () );
		$log->AddAction ( "url", $_SERVER ['REQUEST_URI'], 0 );
	}
	/**
	 * Возвращает заголовок страницы.
	 *
	 * @return string
	 */
	private function ShowTitle() {
		return "Service Desk - Infotech-IT";
	}
	/**
	 * Возвращает результат выполнения статического или динамического элемента.
	 *
	 * @return string
	 */
	private function ShowContent() {
		$content = $this->pagecontroller->GetPageStructure ( $this->cur_page ['id'] );
		
		ob_start ();
		foreach ( $content as $node ) {
			switch ($node ['type']) {
				case 1 :
					echo $this->GetStaticData ( $node ['content_id'] );
					break;
				case 2 :
					echo $this->GetDynamicData ( $node ['content_id'] );
					break;
				default :
					
					break;
			}
		}
		$content_data = ob_get_clean ();
		return $content_data;
	}
	/**
	 * Выполняет статический элемент и возвращает его текст.
	 *
	 * @param int $did        	
	 * @return string
	 */
	private function GetStaticData($did) {
		/**
		 * Временная заглушка
		 * В дальнейшем - заменить на получение текста с помощью спец.
		 * класса StaticDataElement
		 */
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_static_elements_table` WHERE `id` = '{$did}'";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_static_elements_table WHERE id = '{$did}'";
		
		if ($result = $this->db->Query ( $query )) {
			$row = $result->getRow ();
			return $row ['content'];
		} else {
			/**
			 * Нужно выкидывать исключение.
			 */
			return "";
		}
	}
	/**
	 * Выполняет динамический элемент и возвращает результаты выполнения.
	 *
	 * @param int $did        	
	 * @return string
	 */
	private function GetDynamicData($did) {
		/**
		 * Временная заглушка
		 * В дальнейшем - заменить на получение текста с помощью спец.
		 * класса DynamicDataElement
		 */
		if ($GLOBALS ['DB_TYPE'] == "MYSQL")
			$query = "SELECT * FROM `{$GLOBALS['DB_PREFIX']}_dynamic_elements_table` WHERE `id` = {$did}";
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL")
			$query = "SELECT * FROM {$GLOBALS['DB_PREFIX']}_dynamic_elements_table WHERE id = {$did}";
		
		if ($result = $this->db->Query ( $query )) {
			$row = $result->getRow ();
			ob_start ();
			include ($GLOBALS ['ROOT_DIR'] . "/dynamic/" . $row ['alias'] . ".php");
			$result = ob_get_clean ();
			return $result;
		} else {
			/**
			 * Нужно выкидывать исключение.
			 */
			return "";
		}
	}
	/**
	 * Возвращает стиль страницы.
	 *
	 * @return string
	 */
	private function ShowStyle() {
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"/templates/{$this->cur_page['template']}.css\"/>";
	}
}

?>