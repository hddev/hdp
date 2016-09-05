<?php
class Pages {
	private $db;
	private $prefix;
	private $id;
	private $page_parent;
	private $page_name;
	private $page_url;
	private $page_template;
	private $page_menu_id;
	private $page_show;
	private $db_type;
	
	/**
	 * Функция инициализации объекта
	 *
	 * @param int $id        	
	 * @param array $in        	
	 */
	function __construct($id = 0, array $in = array()) {
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД.
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
		if (0 == $id) {
			if (0 == count ( $in )) {
				$this->InitializeEmpty ();
			} else {
				$in ['id'] = 0;
				$this->InitializeByArray ( $in );
			}
		} else {
			$this->InitializeById ( $id );
		}
	}
	
	// PRIVATE
	/**
	 * Инициализирует объект со значениями по умолчанию.
	 *
	 * @return boolean
	 */
	private function InitializeEmpty() {
		$in = array ();
		$in ['id'] = 0;
		$in ['page_parent'] = 0;
		$in ['page_name'] = "";
		$in ['page_url'] = "";
		$in ['page_template'] = 0;
		$in ['page_menu_id'] = 0;
		$in ['page_show'] = 0;
		return $this->InitializeByArray ( $in );
	}
	/**
	 * Инициализирует объект с помощью массива входных значений.
	 *
	 * @param array $in        	
	 * @return boolean
	 */
	private function InitializeByArray(array $in) {
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->page_parent = (isset ( $in ['page_parent'] )) ? intval ( $in ['page_parent'] ) : 0;
		$this->page_name = (isset ( $in ['page_name'] )) ? strval ( $in ['page_name'] ) : "";
		$this->page_url = (isset ( $in ['page_url'] )) ? strval ( $in ['page_url'] ) : "";
		$this->page_template = (isset ( $in ['page_template'] )) ? intval ( $in ['page_template'] ) : 0;
		$this->page_menu_id = (isset ( $in ['page_menu_id'] )) ? intval ( $in ['page_menu_id'] ) : 0;
		$this->page_show = (isset ( $in ['page_show'] )) ? intval ( $in ['page_show'] ) : 0;
		return true;
	}
	/**
	 * Инициализирует объект по идентификатору статического элемента.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	private function InitializeById($id) {
		$row = $this->LoadById ( $id );
		if (! $row) {
			return false;
		} else {
			return $this->InitializeByArray ( $row );
		}
	}
	/**
	 * Загружает массив входных данных статического элемента по его идентификатору.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	private function LoadById($id) {
		if ($this->db_type == "MYSQL")
			$query = "SELECT * FROM `{$this->prefix}_pages_table` WHERE `id` = '{$id}'";
		if ($this->db_type == "POSTGRESQL")
			$query = "SELECT * FROM {$this->prefix}_pages_table WHERE id = '{$id}'";
		
		$result = $this->db->Query ( $query );
		if (! $result) {
			return false;
		}
		return $result->GetRow ();
	}
	
	/**
	 * Добавляет запись о статическом элементе в БД.
	 */
	private function Insert() {
		if ($this->db_type == "MYSQL")
			$query = "INSERT INTO `{$this->prefix}_pages_table` (`parent`,`name`,`url`,`template`,`menu_id`,`show_in_menu`) VALUES ('{$this->page_parent}','{$this->page_name}','{$this->page_url}','{$this->page_template}','{$this->page_menu_id}','{$this->page_show}')";
		if ($this->db_type == "POSTGRESQL") {
			$this->id = $this->db->GetPGInsertId ( "{$this->prefix}_pages_table" );
			$query = "INSERT INTO {$this->prefix}_pages_table (id,parent,name,url,template,menu_id,show_in_menu) VALUES ('{$this->id}','{$this->page_parent}','{$this->page_name}','{$this->page_url}','{$this->page_template}','{$this->page_menu_id}','{$this->page_show}')";
		}
		;
		
		$this->db->Commit ( $query );
		if ($this->db_type == "MYSQL")
			$this->id = $this->db->GetInsertId ();
		
		$Log = new Log ();
		$Log->AddAction ( "addPage", 'Name:' . $this->GetName (), '' );
	}
	/**
	 * Обновляет запись о статическом элементе в БД.
	 */
	private function Update() {
		if ($this->db_type == "MYSQL")
			$query = "UPDATE `{$this->prefix}_pages_table` SET `parent` = '{$this->page_parent}',`name` = '{$this->page_name}',`url` = '{$this->page_url}',`template` = '{$this->page_template}',`menu_id` = '{$this->page_menu_id}',`show_in_menu` = '{$this->page_show}' WHERE `id` = {$this->id}";
		if ($this->db_type == "POSTGRESQL")
			$query = "UPDATE {$this->prefix}_pages_table SET parent = '{$this->page_parent}',name = '{$this->page_name}',`url` = '{$this->page_url}',template = '{$this->page_template}',menu_id = '{$this->page_menu_id}',show_in_menu = '{$this->page_show}' WHERE id = {$this->id}";
		
		$this->db->Commit ( $query );
		
		$Log = new Log ();
		$Log->AddAction ( "updPage", 'Name:' . $this->GetName (), '' );
	}
	/**
	 * Сохраняет или обновляет запись.
	 */
	public function Save() {
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
	}
	/**
	 * Возвращает идентификатор записи.
	 *
	 * @return id
	 */
	public function GetId() {
		return $this->id;
	}
	/**
	 * Возвращает идентификатор группы элементов.
	 *
	 * @return int
	 */
	public function GetParent() {
		return $this->page_parent;
	}
	/**
	 * Возвращает название элемента.
	 *
	 * @return string
	 */
	public function GetName() {
		return $this->page_name;
	}
	/**
	 * Возвращает содержимое элемента.
	 *
	 * @return string
	 */
	public function GetURL() {
		return $this->page_url;
	}
	/**
	 * Возвращает дату создания элемента.
	 *
	 * @return string
	 */
	public function GetTemplate() {
		return $this->page_template;
	}
	public function GetMenuID() {
		return $this->page_menu_id;
	}
	public function GetShowInMenu() {
		return $this->page_show;
	}
	/**
	 * Устанавливает идентификатор группы.
	 *
	 * @param int $group_id        	
	 */
	public function SetParent($parent) {
		$this->page_parent = intval ( $parent );
	}
	/**
	 * Устанавливает название элемента.
	 *
	 * @param string $name        	
	 */
	public function SetName($name) {
		$this->page_name = strval ( $name );
	}
	/**
	 * Устанавливает содержимое элемента.
	 *
	 * @param string $content        	
	 */
	public function SetURL($url) {
		$this->page_url = strval ( $url );
	}
	public function SetTemplate($template) {
		$this->page_template = strval ( $template );
	}
	public function SetMenuID($menu_id) {
		$this->page_menu_id = strval ( $menu_id );
	}
	public function SetShowInMenu($show_in_menu) {
		$this->page_show = strval ( $show_in_menu );
	}
	/**
	 * Массовая установка параметров по массиву.
	 *
	 * @param array $in        	
	 */
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByArray ( $in );
	}
	/**
	 * Возвращает массив данных.
	 *
	 * @return array
	 */
	public function GetArray() {
		$out = array ();
		$out ['id'] = $this->id;
		$out ['parent'] = $this->page_parent;
		$out ['name'] = $this->page_name;
		$out ['url'] = $this->page_url;
		$out ['template'] = $this->page_template;
		$out ['menu_id'] = $this->page_menu_id;
		$out ['show_in_menu'] = $this->page_show;
		return $out;
	}
	/**
	 * Возвращает массив данных для генерации XML.
	 *
	 * @param boolean $import        	
	 * @return array
	 */
	public function GetArrayForXML($import = false) {
		$out = array ();
		$out ['name'] = "Page";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['parent'] = $this->page_parent;
		$out ['attributes'] ['name'] = $this->page_name;
		$out ['attributes'] ['url'] = $this->page_url;
		$out ['attributes'] ['template'] = $this->page_template;
		$out ['attributes'] ['menu_id'] = $this->page_menu_id;
		$out ['attributes'] ['show_in_menu'] = $this->page_show;
		/*
		 * $out['childs'][0]['name']="Content"; $out['childs'][0]['childs']=$this->content;
		 */
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
}
?>