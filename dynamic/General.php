<?php

// Главная странца
$db = DbController::GetDatabaseInstance (); // DB
$pc = PageController::getInstance (); // PageController

$prefix = $GLOBALS ['DB_PREFIX'];
$classloader = ClassLoader::getInstance ();

$xsltemplate = new XSLTemplate ();
$xmlbuilder = new XMLBuilder ();

try {
	$Access = new Access ();
	if ($Access->IsLogin ()) {
		$out = Array ();
		// Описание блоков
		$out ['name'] = "MEPBlocks";
		// Приступить к обучению
		$out ['childs'] [0] ['name'] = "MEPLink";
		$out ['childs'] [0] ['attributes'] ['id'] = 'requests';
		$out ['childs'] [0] ['attributes'] ['url'] = '/requests/?action=request-form&id=0';
		$out ['childs'] [0] ['attributes'] ['title'] = 'Создать запрос';
		$out ['childs'] [0] ['attributes'] ['active'] = true;
		$out ['childs'] [0] ['attributes'] ['img'] = '/images/logo/logo_courses.jpg';
		$out ['childs'] [0] ['attributes'] ['description'] = "Создать новый запрос на оказание услуг";
		// Личный кабинет пользователя
		$out ['childs'] [1] ['name'] = "MEPLink";
		$out ['childs'] [1] ['attributes'] ['id'] = 'personal_room';
		$out ['childs'] [1] ['attributes'] ['url'] = '/requests/?action=requests-list&type=inwork&category=inwork'; // '/personal_room/?action=user-editinfo';
		$out ['childs'] [1] ['attributes'] ['title'] = 'Просмотреть все запросы';
		$out ['childs'] [1] ['attributes'] ['active'] = true;
		$out ['childs'] [1] ['attributes'] ['img'] = '/images/logo/logo_room.jpg';
		$out ['childs'] [1] ['attributes'] ['description'] = "Просмотр инфомрцмации по созданным запросам";
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		
		$xml = $xmlbuilder->buildXML ( $out );
		$html = $xsltemplate->build ( $xml, 'General' );
	} else {
		$out = Array ();
		$out ['name'] = "Authorization";
		if (isset ( $_REQUEST ['login'] )) {
			$out ['childs'] [0] ['name'] = "Attempt";
			$out ['childs'] [0] ['attributes'] ['exist'] = 'true';
		}
		// ... можно здесь передать параметры.
		
		$nout = array ();
		$nout [0] = $out;
		$out = $nout;
		
		$xml = $xmlbuilder->buildXML ( $out );
		$html = $xsltemplate->build ( $xml, "Authorization" );
	}
	echo $html;
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
/*
?>
		<textarea cols="150" rows="40">
		<?=$xml;?>
		</textarea>
<?	
		echo "Request:";
		var_dump($_REQUEST);
		
		echo "Get:";
		var_dump($_GET);
?>

<?/*
 * ?> <textarea cols="150" rows="40"> <?=$xml;?> </textarea> <? echo "Request:"; var_dump($_REQUEST); echo "Get:"; var_dump($_GET); ?> <?
 */
?>