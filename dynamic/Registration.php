<?php
try {
	
	// Если пришли данные - проверяем их и создаем пользователя.
	$errors = array ();
	$messages = array ();
	if (isset ( $_REQUEST ['post'] )) {
		$uh = new UserHelper ();
		// Проверяем логин
		if (isset ( $_REQUEST ['login'] ) && ! empty ( $_REQUEST ['login'] )) {
			if (! $uh->UsernameCorrect ( $_REQUEST ['login'] )) {
				$errors [] = "login-not-correct";
			}
			if ($uh->GetUserExist ( $_REQUEST ['login'] )) {
				$errors [] = "login-already-exist";
			}
		} else {
			$errors [] = "login-not-exist-error";
		}
		// Проверяем пароль
		if (isset ( $_REQUEST ['password'] ) && ! empty ( $_REQUEST ['password'] )) {
			if (! isset ( $_REQUEST ['password_copy'] ) || empty ( $_REQUEST ['password_copy'] ) || $_REQUEST ['password'] != $_REQUEST ['password_copy']) {
				$errors [] = "password-and-copy-not-same-error";
			}
			if (strlen ( $_REQUEST ['password'] ) < 5) {
				$errors [] = "password-too-short-error";
			}
		} else {
			$errors [] = "password-not-exist-error";
		}
		// проверяем Captcha
		if (! isset ( $_REQUEST ['keystring'] ) || $_REQUEST ['keystring'] != $_SESSION ['keystring'] ['user_registration']) {
			$errors [] = "captcha-not-valid";
		} else {
			unset ( $_SESSION ['keystring'] ['user_registration'] );
		}
		// Проверяем заполенны ли остальные обязательные поля.
		if (! isset ( $_REQUEST ['second_name'] )) {
			$errors [] = "second_name-not-exist-error";
		}
		if (! isset ( $_REQUEST ['first_name'] )) {
			$errors [] = "first_name-not-exist-error";
		}
		if (! isset ( $_REQUEST ['email'] )) {
			$errors [] = "email-non-exist-error";
		}
		if (preg_match ( '/[-0-9A-Za-z_.]+@[-0-9a-z_]+\.[a-z]{2,6}/i', $_REQUEST ['email'], $regs )) {
			$email = $regs [0];
		} else {
			$errors [] = "email-not-correct-error";
		}
		// Если без ошибок - создаем пользователя.
		if (count ( $errors ) == 0) {
			$nu = new User ();
			$nu->SetLogin ( $uh->FormatUsername ( $_REQUEST ['login'] ) );
			$nu->SetPassword ( $_REQUEST ['password'] );
			$nu->SetFirstname ( $_REQUEST ['first_name'] );
			$nu->SetSecondname ( $_REQUEST ['second_name'] );
			$nu->SetPatronymic ( $_REQUEST ['patronymic'] );
			$nu->SetEmail ( $email );
			$nu->SetConnected ( '1' );
			$nu->SetGroup ( 2 ); // Новый пользователь привязан к группе "пользователи".
			$nu->Save ();
			
			if ($_REQUEST ['allow_rcm']) {
				$uh->SetNewUserRequestForStudent ( $nu->GetId (), $_REQUEST ['group_name'] );
			}
			$messages [] = "user-creation-successfull-message";
		} else {
			$messages [] = "user-creation-errors-message";
		}
	} else {
		$messages [] = "new-user-message";
	}
	
	$xsltemplate = new XslTemplate ();
	$xmlbuilder = new XMLBuilder ();
	
	$root_xml [0] ['name'] = "UserData";
	if (! isset ( $_REQUEST ['post'] ) || count ( $errors ) > 0) {
		$root_xml [0] ['attributes'] ['show_form'] = 1;
	} else {
		$root_xml [0] ['attributes'] ['show_form'] = 0;
	}
	$root_xml [0] ['attributes'] ['login'] = $_REQUEST ['login'];
	$root_xml [0] ['attributes'] ['password'] = $_REQUEST ['password'];
	$root_xml [0] ['attributes'] ['password_copy'] = $_REQUEST ['password_copy'];
	
	$root_xml [0] ['attributes'] ['sess_name'] = session_name ();
	$root_xml [0] ['attributes'] ['sess_id'] = session_id ();
	$root_xml [0] ['attributes'] ['code'] = "user_registration";
	
	if (count ( $errors ) > 0) {
		$root_xml [0] ['childs'] [0] ['name'] = "Errors";
		foreach ( $errors as $error ) {
			$root_xml [0] ['childs'] [0] ['childs'] [] = array (
					'name' => 'Error',
					'attributes' => array (
							'code' => $error 
					) 
			);
		}
	}
	if (count ( $messages ) > 0) {
		$root_xml [0] ['childs'] [1] ['name'] = "Messages";
		foreach ( $messages as $message ) {
			$root_xml [0] ['childs'] [1] ['childs'] [] = array (
					'name' => 'Message',
					'attributes' => array (
							'code' => $message 
					) 
			);
		}
	}
	
	$xml = $xmlbuilder->buildXML ( $root_xml );
	$html = $xsltemplate->build ( $xml, "UserRegistration" );
	echo $html;
} catch ( Xception $e ) {
	$e->ShowMessage ();
}
?>