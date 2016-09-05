<?php
class DbController extends Singleton {
	private static $defaultdb = false;
	// База данных по умолчанию.
	private static $customdbs = array ();
	// Массив дополнительных баз данных
	public function __construct() {
	}
	public static function getInstance() { // Возвращает свой экземпляр
		return parent::_getInstance ( __CLASS__ );
	}
	public static function AddDatabaseConnection(array $params, $owner = false) { // Добавляет соединение с базой данных.
	  // Запрещено владеть более чем одним "частным" соединением с базой данных.
		if ($owner && isset ( $this->customdbs [$owner] )) {
			return false;
		}
		/**
		 * Запрещено изменять ID соединения с БД по умолчанию.
		 */
		if (! $owner && DbController::$defaultdb) {
			return false;
		}
		
		$db_type = $GLOBALS ['DB_TYPE'];
		
		if ($db_type == "MYSQL") {
			if ($id = mysqli_connect ( @$params ['hostname'], @$params ['user'], @$params ['password'] )) {
				if (isset ( $params ['dbname'] ) && ! mysqli_select_db ( $id, $params ['dbname'] )) {
					return false;
				}
				if (! $owner) {
					DbController::$defaultdb = $id;
				} else {
					DbController::$customdbs [$owner] = $id;
				}
				return true;
			} else {
				return false;
			}
		}
		
		if ($db_type == "POSTGRESQL") {
			$conn_string = "dbname='{$params['dbname']}' user='{$params['user']}' password='{$params['password']}'";
			// $conn_string = "dbname='test_database' user='test_user' password='{$params['password']}'";
			// $conn_string = "host='{$params['hostname']}' port='5432' dbname='test_database' user='{$params['user']}' password='{$params['password']}'";
			
			/*
			 * echo $conn_string; alert();
			 */
			
			// if($id = mysql_connect(@$params['hostname'], @$params['user'], @$params['password'], true))
			if ($id = pg_connect ( $conn_string )) {
				// if(isset($params['dbname']) && !mysql_select_db($params['dbname'], $id))
				if (isset ( $params ['dbname'] ) && ! $id) {
					return false;
				}
				if (! $owner) {
					DbController::$defaultdb = $id;
				} else {
					DbController::$customdbs [$owner] = $id;
				}
				return true;
			} else {
				return false;
			}
		}
	}
	/**
	 * Возвращает копию объекта содержащую данные о текущем соединении.
	 *
	 * @param string $owner        	
	 * @return mixed
	 */
	public static function GetDatabaseInstance($owner = false) {
		if (! $owner) {
			return new DbConnection ( DbController::$defaultdb );
		} else {
			return (isset ( DbController::$customdbs [$owner] )) ? new DbConnection ( DbController::$customdbs [$owner] ) : false;
		}
	}
}
?>
