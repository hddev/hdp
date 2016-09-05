<?php
$PRE_INCLUDE = array ();

$PRE_INCLUDE [] = "/classes/singleton/singleton.class.php";
$PRE_INCLUDE [] = "/classes/classloader/classloader.class.php";

$PRE_INCLUDE [] = "/classes/dbconnection/dbconnection.class.php";
$PRE_INCLUDE [] = "/classes/dbcontroller/dbcontroller.class.php";
$PRE_INCLUDE [] = "/classes/dbresult/dbresult.class.php";

$PRE_INCLUDE [] = "/classes/xception/xception.class.php";
$PRE_INCLUDE [] = "/classes/access/access.class.php";
function __autoload($class_name) {
	// Функция автоматической загрузки классов.
	// Если класс не подключен, и при этом в коде происходит обращение к нему,
	// то данная функция пробует подключить класс используя его имя.
	try {
		$classloader = ClassLoader::getInstance ();
		if (! $classloader->LoadClass ( strtoupper ( str_ireplace ( "helper", "", $class_name ) ) )) {
			throw new ModuleAccessException ( "Необходимый модуль {$class_name} не подключен.", 0, "error" );
		}
	} catch ( ModuleAccessException $e ) {
		echo $e->ShowMessage ();
	}
} // __autoload($class_name)

define ( "PER_PAGE", 10 ); // Количество записей на страницу для списков элементов по умолчанию.
define ( "DOCUMENT_ROOT", $_SERVER ['DOCUMENT_ROOT'] ); // Корневой каталог сайта

?>