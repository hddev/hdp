<?php
$db = DbController::GetDatabaseInstance (); // DB
$pc = PageController::getInstance (); // PageController

$prefix = $GLOBALS ['DB_PREFIX'];
$classloader = ClassLoader::getInstance ();

$xsltemplate = new XSLTemplate ();
$xmlbuilder = new XMLBuilder ();

try {
	
	// ==========================================================
	class EventHandler {
		// ==========================================================
		private $xml;
		private $html;
		private $xsltemplate;
		private $xsltemplatehelper;
		private $xmlbuilder;
		function __construct() {
			$this->html = "";
			$this->xml = "";
			
			$this->xsltemplate = new XslTemplate ();
			$this->xsltemplatehelper = new XSLTemplateHelper ();
			$this->xmlbuilder = new XMLBuilder ();
			
			if (! isset ( $_REQUEST ['action'] ))
				$_REQUEST ['action'] = "Default";
			
			switch ($_REQUEST ['action']) {
				case "statistics-form" :
					$this->ShowStatisticsForm ();
					break;
				
				case "statistics-retrieve" :
					$this->ShowStatisticsResult ();
					break;
				
				default :
					$this->ShowStatisticsForm ();
					break;
			}
		}
		private function ShowStatisticsForm() { // Выводит форму статистики
			$statistics = new Statistics ();
			$report_type = 0;
			$type = 0;
			
			if (isset ( $_REQUEST ['report_type'] ))
				$report_type = $_REQUEST ['report_type'];
			$statistics->SetCategory ( $report_type );
			
			if (isset ( $_REQUEST ['type'] ))
				$type = $_REQUEST ['type'];
			$statistics->SetType ( $type );
			
			$this->xml = $this->xmlbuilder->buildXML ( $statistics->GetArrayForXML ( false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "StatisticsForm", "Statistics" );
		}
		private function ShowStatisticsResult() {
			if (! isset ( $_REQUEST ['category'] ))
				return false;
			if (! isset ( $_REQUEST ['type'] ))
				return false;
			if (! isset ( $_REQUEST ['date_start'] ))
				return false;
			if (! isset ( $_REQUEST ['date_finish'] ))
				return false;
			
			$statistics = new Statistics ();
			$statistics->SetCategory ( $_REQUEST ['category'] );
			$statistics->SetType ( $_REQUEST ['type'] );
			$statistics->SetDateStart ( $_REQUEST ['date_start'] );
			$statistics->SetDateFinish ( $_REQUEST ['date_finish'] );
			
			$statisticshelper = new statisticshelper ();
			
			$external = $statisticshelper->GetDataListForXML ( $statistics->GetArray (), array () );
			
			$template = "StatisticsResult_Report" . $_REQUEST ['type'];
			
			$this->xml = $this->xmlbuilder->buildXML ( $statistics->GetArrayForXML ( false, $external ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, $template, "Statistics" );
		}
		public function GetXML() {
			return $this->xml;
		}
		public function GetHTML() {
			return $this->html;
		}
		// ==========================================================
	} // EventHandler
	  // ==========================================================
	
	$Access = new Access ();
	if (! $Access->IsLogin ()) {
		$Access->LogOut ();
		throw new ModuleAccessException ( "Доступ к модулю Запросы разрешен только авторизованным пользователям.", 0, "access" );
	}
	
	if (isset ( $_REQUEST ['id'] ))
		$RequestID = $_REQUEST ['id'];
	
	$event_handler = new EventHandler ();
	echo $event_handler->GetHTML ();
	
	// if ($Access->IsAdministrator() | isset($_REQUEST['adminmode'])) {
	if (isset ( $_REQUEST ['adminmode'] )) {
		echo '<textarea cols="100" rows="40">' . $event_handler->GetXML () . '</textarea>';
		
		echo "Request:";
		var_dump ( $_REQUEST );
		
		echo "Get:";
		var_dump ( $_GET );
	}
	
	/*
	 * echo "Request:"; var_dump($_REQUEST); echo "Get:"; var_dump($_GET);
	 */
	
	// echo '<textarea cols="100" rows="40">'.$event_handler->GetXML().'</textarea>';
	
	// Определяем что показывать
	$parameters = $pc->GetURIParameters ();
	$level = count ( $parameters );
} 

catch ( ModuleAccessException $e ) {
	echo $e->ShowMessage ();
} catch ( UrlErrorException $e ) {
	echo $e->ShowMessage ();
} catch ( InformationException $e ) {
	echo $e->ShowMessage ();
} catch ( ErrorsException $e ) {
	echo $e->ShowMessage ();
}

?>