<?php
// =============================================
class PageControllerHelper 
// =============================================
{
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	public function GetPagesTableList($parameters) {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_pages_table ORDER BY `id` DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_pages_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_pages_table ORDER BY id DESC";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_pages_table";
		}
		
		// Модифицируем запрос для постраничного вывода и сортировки
		/*
		 * $pagination_data=array(); if (is_array($parameters)) { $pagination=new Pagination($query,$count_query); if (isset($parameters['per_page'])) $pagination->SetPerPage($parameters['per_page']); $page=(isset($parameters['page'])&&intval($parameters['page'])>0)?intval($parameters['page']):0; $query=$pagination->ConstructQuery($page,&$pagination_data); }
		 */
		$result = $this->db->query ( $query );
		if (! $result)
			return false;
		
		$array = $result->GetAllRows ( MYSQL_ASSOC );
		// $array['pagination_data']=$pagination_data;
		return $array;
	}
	public function GetPagesTableListForXML($parameters, $import = false, $external_data = array()) {
		$list = $this->GetPagesTableList ( $parameters );
		
		/*
		 * if (isset($list['pagination_data'])) { $pagination_data=$list['pagination_data']; unset($list['pagination_data']); $ar=array(); $ar['name']="Pagination"; foreach ($pagination_data as $key=>$element) { $ar['attributes'][$key]=$element; } $out['childs'][]=$ar; }
		 */
		
		$out = array ();
		$out ['name'] = "PagesTable";
		foreach ( $list as $element ) {
			$elar = array ();
			$elar ['name'] = "PageTable";
			$elar ['attributes'] = $element;
			$out ['childs'] [] = $elar; // '$elar;
		}
		
		// if (count($external_data)>0) $out['childs'][]=array('name'=>"ExternalData",'childs'=>$external_data);
		
		/*
		 * $ar = array(); $ar['name'] = "Pagination"; foreach($pagination_data as $key=>$element) { $ar['attributes'][$key] = $element; } $out['childs'][] = $ar;
		 */
		
		if (count ( $external_data ) > 0)
			$out ['childs'] [] = array (
					'name' => "ExternalData",
					'childs' => $external_data 
			);
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		
		return $out;
	}
	
	// ==============================================
} // PagesTableHelper
  // ==============================================
?>