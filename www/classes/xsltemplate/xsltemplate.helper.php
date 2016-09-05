<?php
class XSLTemplateHelper {
	private $db;
	private $prefix;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
	}
	/**
	 * Возвращает массив XSL шаблонов в соответствии с переданными параметрами.
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
	public function GetXSLTemplatesList($parameters) {
		if ($GLOBALS ['DB_TYPE'] == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_xsl_templates_table ORDER BY `id`";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_xsl_templates_table";
		}
		
		if ($GLOBALS ['DB_TYPE'] == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_xsl_templates_table ORDER BY id";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_xsl_templates_table";
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
		foreach ( $array as $k => $v ) {
			if (file_exists ( $GLOBALS ['ROOT_DIR'] . "/xsl/{$v['name']}.xsl" )) {
				$array [$k] ['file_exists'] = 1;
			} else {
				$array [$k] ['file_exists'] = 0;
			}
		}
		
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
	public function GetXSLTemplatesListForXML($parameters, $import = false) {
		$list = $this->GetXSLTemplatesList ( $parameters );
		
		if (isset ( $list ['pagination_data'] )) {
			$pagination_data = $list ['pagination_data'];
			unset ( $list ['pagination_data'] );
		}
		
		$out = array ();
		$out ['name'] = "XSLTemplates";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "XSLTemplate";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar;
		}
		
		$ar = array ();
		$ar ['name'] = "Pagination";
		foreach ( $pagination_data as $key => $element ) {
			$ar ['attributes'] [$key] = $element;
		}
		$out ['childs'] [] = $ar;
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	public function GetDirList($dir) 	// Выводит содержимое папки
	{
		if ($dir == '')
			$path = $_SERVER ['DOCUMENT_ROOT'] . '/xsl';
		else
			$path = $_SERVER ['DOCUMENT_ROOT'] . '/xsl' . $dir;
		$dh = opendir ( $path );
		$out = array ();
		$out ['name'] = "XSLTemplates";
		$out ['attributes'] ['itemdir'] = $dir;
		while ( $file = readdir ( $dh ) ) {
			if ($file != '.svn' && $file != '.' && $file != '..') {
				$elar = array ();
				if (is_dir ( $path . '/' . $file )) {
					
					$elar ['name'] = "XSLDir";
					// $htmlstring.="<a href='/admin/?action=xsltemplates-list&amp;dir=".$dir.'/'.$file."'>".$file."</a><br>";
				} else {
					$elar ['name'] = "XSLTemplate";
					// $htmlstring.=$file.'<a href="/admin/?action=xsltemplate-form&amp;path='.$dir.'/'.$file.'"><img src="/images/iicons/layout_edit.png" alt="Редактировать XSL шаблон." title="Редактировать XSL шаблон."/></a><br>';
				}
				$elar ['attributes'] ['name'] = $file;
				$elar ['attributes'] ['dir'] = $dir . '/' . $file;
				$out ['childs'] [] = $elar;
			}
		}
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		closedir ( $dh );
		return $out;
	}
	public function XSLTemplateForm($dir) 	// Выводит форму редактрования XSL шаблона
	{
		$path = $GLOBALS ['ROOT_DIR'] . '/xsl' . $dir;
		$file = file_get_contents ( $path );
		$file_loaded = true;
		
		$out = array ();
		$out ['name'] = "XSLTemplate";
		$out ['attributes'] ['name'] = basename ( $path );
		$out ['attributes'] ['xsl_data_loaded'] = intval ( $file_loaded );
		$out ['childs'] [0] ['name'] = "XSLData";
		$out ['childs'] [0] ['childs'] = $file;
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		return $out;
	}
}
?>
