<?php
class MenuHelper {
	private $db;
	private $prefix;
	private $db_type;
	function __construct() {
		$this->db = DbController::GetDatabaseInstance ();
		$this->prefix = $GLOBALS ['DB_PREFIX'];
		$this->db_type = $GLOBALS ['DB_TYPE'];
	}
	/**
	 * Возвращает массив с данными о меню + сортировка, постраничная разбивка
	 *
	 * @return unknown
	 */
	public function GetMenuList() {
		if ($this->db_type == "MYSQL") {
			$query = "SELECT * FROM {$this->prefix}_menu_table ORDER BY `id`";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_menu_table";
		}
		
		if ($this->db_type == "POSTGRESQL") {
			$query = "SELECT * FROM {$this->prefix}_menu_table ORDER BY id";
			$count_query = "SELECT COUNT(*) FROM {$this->prefix}_menu_table";
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
				$query = $pagination->ConstructQuery ( $page, &$pagination_data );
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
	 * Возвращает "плоскую" структуру меню
	 *
	 * @param int $id        	
	 * @return array
	 */
	public function GetMenuPagesStructure($id) {
		$pc = PageController::getInstance ();
		$cur_id = $pc->GetCurrentPageId ();
		
		if ($this->db_type == "POSTGRESQL")
			$sql = "SELECT id,parent,name,url,show_in_menu FROM {$this->prefix}_pages_table WHERE menu_id = '{$id}' ORDER BY menu_order,id";
		if ($this->db_type == "MYSQL")
			$sql = "SELECT `id`,`parent`,`name`,`url`, `show_in_menu` FROM `{$this->prefix}_pages_table` WHERE `menu_id` = '{$id}' ORDER BY `menu_order`,`id`";
		
		$result = $this->db->Query ( $sql );
		
		$out = array ();
		if ($result && $result->Count () > 0) {
			while ( $row = $result->GetRow ( MYSQL_ASSOC ) ) {
				if ($row ['id'] == $cur_id) {
					$row ['active'] = 1;
				} else {
					$row ['active'] = 0;
				}
				$out [$row ['id']] = $row;
			}
		}
		return $out;
	}
	/**
	 * Возвращает иерархическую структуру меню.
	 * Работает медленно!!!
	 *
	 * @param int $id        	
	 * @return array
	 */
	public function GetIerarchicalMenuPageStructure($id) {
		$pc = PageController::getInstance ();
		$cur_id = $pc->GetCurrentPageId ();
		
		$temp = $this->GetMenuPagesStructure ( $id );
		$exit = false;
		$cycles = 0;
		while ( ! $exit ) {
			$exit = true;
			// проверяем циклом есть ли данные обо всех родительских страницах
			// Если нет, то подгружаем и не устанавливаем флаг окончания цикла
			foreach ( $temp as $k => $v ) {
				if (! isset ( $temp [$v ['parent']] ) && $v ['parent'] > 0) {
					$temp [$v ['parent']] = $pc->GetPageInfo ( $v ['parent'] );
					if ($temp [$v ['parent']] ['id'] == $cur_id) {
						$temp [$v ['parent']] ['active'] = 1;
					} else {
						$temp [$v ['parent']] ['active'] = 0;
					}
					$exit = false;
				}
			}
			$cycles += 1;
			if ($cycles > 10)
				$exit = true; // На всякий случай ограничиваем кол-во циклов (и максимальный уровень вложенности) до 10.
		}
		return $temp;
	}
	public function GetIerarchicalMenuPageStructureForXML($id) {
		$out = array ();
		$out [0] ['name'] = "MenuItems";
		$data = $this->GetIerarchicalMenuPageStructure ( $id );
		foreach ( $data as $key => $element ) {
			$out [0] ['childs'] [] = array (
					'name' => 'MenuItem',
					'attributes' => $element 
			);
		}
		return $out;
	}
}

?>