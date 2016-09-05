<?php
class XslTemplate {
	private $db;
	private $prefix;
	private $id;
	private $group_id;
	private $name;
	private $file;
	private $file_loaded = false;
	function __construct($id = 0, array $in = array()) {
		$this->db = DbController::GetDatabaseInstance (); // Получаем экземпляр соединения с БД.
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		if (0 == $id) {
			if (0 == count ( $in )) {
				$this->InitializeEmpty ();
			} else {
				if (isset ( $in ['load_xsl_template_by_name'] )) {
					$this->InitializeByArray ( $this->LoadByName ( $in ['load_xsl_template_by_name'] ) );
				} else {
					$in ['id'] = 0; // Если не обнулить, то появится возможность создавать не существующие шаблоны с реальными id.
					$this->InitializeByArray ( $in );
				}
			}
		} else {
			$this->InitializeById ( $id );
			if (isset ( $in ['load_xsl_data'] ) && $in ['load_xsl_data'] == true) {
				$this->LoadFile ();
			}
		}
	}
	
	/**
	 * Инициализирует объект по умолчанию.
	 *
	 * @return boolean
	 */
	private function InitializeEmpty() {
		$in = array ();
		$in ['id'] = 0;
		$in ['group_id'] = 0;
		$in ['name'] = "";
		return $this->InitializeByArray ( $in );
	}
	private function InitializeByArray(array $in) {
		$this->id = (isset ( $in ['id'] )) ? intval ( $in ['id'] ) : 0;
		$this->group_id = (isset ( $in ['group_id'] )) ? intval ( $in ['group_id'] ) : 0;
		$this->name = (isset ( $in ['name'] )) ? strval ( $in ['name'] ) : "";
		if (isset ( $in ['xsl_data'] )) {
			$this->file = $in ['xsl_data'];
			$this->file_loaded = true;
		}
		return true;
	}
	private function InitializeById($id) {
		$row = $this->LoadById ( $id );
		if (! $row) {
			return false;
		} else {
			return $this->InitializeByArray ( $row );
		}
	}
	private function LoadById($id) {
		$query = "SELECT * FROM `{$this->prefix}_xsl_templates_table` WHERE `id` = '{$id}'";
		$result = $this->db->Query ( $query );
		if (! $result) {
			return false;
		}
		return $result->GetRow ();
	}
	private function LoadByName($name) {
		$query = "SELECT * FROM `{$this->prefix}_xsl_templates_table` WHERE `name` = '{$name}' LIMIT 1";
		$result = $this->db->Query ( $query );
		if (! $result) {
			return false;
		}
		return $result->GetRow ();
	}
	private function Insert() {
		$query = "INSERT INTO `{$this->prefix}_xsl_templates_table` (`group_id`,`name`) VALUES ('{$this->group_id}','{$this->name}')";
		$this->db->Commit ( $query );
		$this->id = $this->db->GetInsertId ();
	}
	private function Update() {
		$query = "UPDATE `{$this->prefix}_xsl_templates_table` SET `group_id` = '{$this->group_id}',`name` = '{$this->name}' WHERE `id` = {$this->id}";
		$this->db->Commit ( $query );
	}
	
	// PUBLIC
	public function GetId() {
		return $this->id;
	}
	public function GetGroupId() {
		return $this->group_id;
	}
	public function GetName() {
		return $this->name;
	}
	public function SetGroupId($group_id) {
		$this->group_id = intval ( $group_id );
	}
	public function SetName($name) {
		$this->name = trim ( $name );
	}
	public function Save() {
		if (0 == $this->id) {
			$this->Insert ();
		} else {
			$this->Update ();
		}
		if ($this->file_loaded) {
			$this->SaveFile ();
		}
	}
	public function SetArray($in) {
		$in ['id'] = $this->GetId ();
		$this->InitializeByArray ( $in );
	}
	public function GetArray() {
		$out = array ();
		$out ['id'] = $this->id;
		$out ['group_id'] = $this->group_id;
		$out ['name'] = $this->name;
		if ($this->file_loaded) {
			$out ['xsl_data'] = $this->file;
		}
		return $out;
	}
	public function GetArrayForXML($import = false, array $external_data = array()) {
		$out = array ();
		$out ['name'] = "XSLTemplate";
		$out ['attributes'] ['id'] = $this->id;
		$out ['attributes'] ['group_id'] = $this->group_id;
		$out ['attributes'] ['name'] = $this->name;
		$out ['attributes'] ['xsl_data_loaded'] = intval ( $this->file_loaded );
		$out ['childs'] [0] ['name'] = "XSLData";
		$out ['childs'] [0] ['childs'] = $this->file;
		if (count ( $external_data ) > 0) {
			$out ['childs'] [4] ['name'] = "ExternalData";
			$out ['childs'] [4] ['childs'] = $external_data;
		}
		
		if (! $import) {
			$nout = array ();
			$nout [0] = $out;
			$out = $nout;
		}
		return $out;
	}
	/**
	 * Загружает данные из файла xsl шаблона.
	 */
	public function LoadFile() {
		if ($this->id > 0) {
			$fname = DOCUMENT_ROOT . "/xsl/{$this->name}.xsl";
			if (file_exists ( $fname )) {
				$this->file = file_get_contents ( $fname );
				$this->file_loaded = true;
			} else {
				// Файла нет - создадим.
				file_put_contents ( $fname, "" );
				$this->file = "";
				$this->file_loaded = true;
			}
		} else {
			$this->file = "";
			$this->file_loaded = true;
		}
	}
	/**
	 * Сохраняет данные xsl шаблона в файл
	 */
	public function SaveFile() {
		if ($this->file_loaded) {
			file_put_contents ( DOCUMENT_ROOT . "/xsl/{$this->id}.xsl", $this->file );
		}
	}
	/**
	 * Устанавливает значение содержимого файла.
	 *
	 * @param string $data        	
	 */
	public function SetFileContent($data) {
		$this->file = $data;
		$this->file_loaded = true;
	}
	public function build($xml_data, $xsl_name, $xsl_dir = '') {
		if ($xsl_dir != '')
			$xsl_dir .= '/';
		$path = $GLOBALS ['ROOT_DIR'] . '/xsl/' . $xsl_dir . $xsl_name . '.xsl';
		
		$xsldoc = new DOMDocument ( '1.0', 'utf-8' );
		if (! $result = $xsldoc->load ( $path )) {
			return false;
		}
		
		$xmldoc = new DOMDocument ( '1.0', 'utf-8' );
		$xmldoc->loadXML ( $xml_data );
		
		$htmlbuilder = new XSLTProcessor ();
		$htmlbuilder->importStylesheet ( $xsldoc );
		
		return $htmlbuilder->transformToXml ( $xmldoc );
	}
}
?>