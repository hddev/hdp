<?php
try {
	/**
	 * Класс обработки событий
	 */
	class EventHandler {
		private $xml;
		private $html;
		private $xsltemplate;
		private $xsltemplatehelper;
		private $xmlbuilder;
		private $classloader;
		
		/**
		 * Конструктор
		 */
		function __construct() {
			$this->html = "";
			$this->xml = "";
			$this->classloader = ClassLoader::getInstance ();
			// Проверяем наличие класса XSL шаблонизатора/
			$xsltemplateclassname = $this->classloader->LoadClass ( 'XSLTEMPLATE' );
			if (! $xsltemplateclassname) {
				/**
				 * 1-й параметр - сообщение, которое выведется пользователю, 2-й - код ошибки (пока он всегда = 1), 3-й - текстовый код ошибки (от него зависит показываемый значок)
				 * Виды значков: error - ошибка, access - ошибка доступа, fatal - фатальная ошибка, info - информация, не критичные ошибки, но важно чтобы пользователь знал.
				 */
				throw new ModuleLoadException ( "Невозможно подгрузить XSLTEMPLATE.", 1, "fatal" );
			}
			/**
			 * Helper - это вспомогательный класс автоматически подгружаемый вместе с основным, но проверить на всякий случай надо.
			 */
			$xsltemplatehelperclassname = $this->classloader->GetHelper ( 'XSLTEMPLATE' );
			if (! $xsltemplatehelperclassname) {
				throw new ModuleLoadException ( "Невозможно подгрузить XSLTEMPLATE Helper.", 1, "fatal" );
			}
			$xmlbuilderclassname = $this->classloader->LoadClass ( 'XMLBUILDER' );
			if (! $xmlbuilderclassname) {
				throw new ModuleLoadException ( "Невозможно подгрузить XMLBUILDER.", 1, "fatal" );
			}
			
			$this->xsltemplate = new $xsltemplateclassname ();
			$this->xsltemplatehelper = new $xsltemplatehelperclassname ();
			$this->xmlbuilder = new $xmlbuilderclassname ();
			
			switch ($_REQUEST ['action']) {
				case "get-user-exist" :
					if (isset ( $_REQUEST ['login'] )) {
						$uh = new UserHelper ();
						$this->html = intval ( $uh->GetUserExist ( $_REQUEST ['login'] ) );
					} else {
						$this->html = "error";
					}
					break;
				/**
				 * Под этим комментарием можно прописать свои вызовы шаблонов и обработку входных данных.
				 */
				default :
					$this->html = "no content";
			}
		}
		public function GetXML() {
			return $this->xml;
		}
		public function GetHTML() {
			return $this->html;
		}
	}
	
	// var_dump($_REQUEST);
	
	$event_handler = new EventHandler ();
	
	echo $event_handler->GetHTML ();

/**
 * Если раскомментировать код ниже, то можно просмотреть XML, который генерирует код (естественно этот XML должен быть записан в переменную $xml)
 */
	/*
	?>
		<textarea cols="80" rows="40">
		<?=$event_handler->GetXML();?>
		</textarea>
	<?/*
	 * ?> <textarea cols="80" rows="40"> <?=$event_handler->GetXML();?> </textarea> <?
	 */
} catch ( Xception $e ) {
	$e->ShowMessage ();
}
?>