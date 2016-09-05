<?php
/**
 * @package ServiceDesk
 * @version 2.5.1
 */
ini_set ( 'display_errors', 1 ); // disable on production servers!
ini_set ( 'html_errors', 0 );
ini_set ( 'allow_call_time_pass_reference', 1 );
ini_set ( 'allow_url_fopen', 1 );
ini_set ( 'error_reporting', E_ALL );
ini_set ( 'upload_max_filesize', '8M' );
ini_set ( 'post_max_size', '8M' );
ini_set ( 'date.timezone', 'Etc/GMT-3' );

$REQURI = explode ( '?', $_SERVER ['REQUEST_URI'] );
if (substr ( $REQURI [0], - 1 ) != '/') {
	$REQURI [0] .= '/';
	$URI = implode ( '?', $REQURI );
	header ( "Location: {$URI}" ); // Если пришел URI вида: /folder1/folder2 то перенаправим на /folder1/folder2/
}

session_start ();

$GLOBALS ['ROOT_DIR'] = $_SERVER ['DOCUMENT_ROOT'];

include ($GLOBALS ['ROOT_DIR'] . "/config_db.php");
include ($GLOBALS ['ROOT_DIR'] . "/config.php");
include ($GLOBALS ['ROOT_DIR'] . "/config_exceptions.php");
include ($GLOBALS ['ROOT_DIR'] . "/config_requests.php");
include ($GLOBALS ['ROOT_DIR'] . "/config_mail.php");

$GLOBALS ['DB_PREFIX'] = $DB_PREFIX;
/**
 * Загружаем обязательные для работы системы классы.
 */
foreach ( $PRE_INCLUDE as $file ) {
	include ($GLOBALS ['ROOT_DIR'] . $file);
}
/**
 * Загружаем типы исключений.
 */
foreach ( $EXCEPTIONS as $file ) {
	include ($GLOBALS ['ROOT_DIR'] . $file);
}
/**
 * Установка соединения с базой данных (по умолчанию).
 */
DbController::AddDatabaseConnection ( array (
		"hostname" => $DB_HOST,
		"user" => $DB_USER,
		"password" => $DB_PASSWORD,
		"dbname" => $DB_NAME 
) );
$dbconnection = DbController::GetDatabaseInstance ();
$dbconnection->Commit ( "SET NAMES 'UTF8'" );

// SHQuickLogin();

// $Access=New Access();
// if (!$Access->IsLogin()) SHLogOut();
// if (!$Access->CheakSession()) SHLogOut();
// if (isset($_REQUEST['logout'])) SHLogOut();

// if (!SHAccessByTrustedIPs()) {
SHQuickLogin ();

$Access = new Access ();

if (! $Access->IsLogin ())
	SHLogOut ();
if (! $Access->CheakSession ())
	SHLogOut ();
if (isset ( $_REQUEST ['logout'] ))
	SHLogOut ();
;

// };

$xsltemplate = new XSLTemplate ();
$pagebuilder = new PageBuilder ();
$pagebuilder->BuildPage ();
?>
