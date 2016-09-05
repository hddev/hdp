<?php
/**
 * Модуль административной панели
 */
try {
	/**
	 * Класс обработки событий
	 */
	class EventHandler {
		private $xml;
		private $html;
		private $xsltemplate;
		private $xsltemplatehelper;
		private $xmlbuilder;
		private $classloader;
		
		/**
		 * Конструктор
		 */
		function __construct() {
			$this->html = "";
			$this->xml = "";
			
			$this->classloader = ClassLoader::getInstance ();
			// Проверяем наличие класса XSL шаблонизатора/
			$xsltemplateclassname = $this->classloader->LoadClass ( 'XSLTEMPLATE' );
			if (! $xsltemplateclassname) {
				/**
				 * 1-й параметр - сообщение, которое выведется пользователю, 2-й - код ошибки (пока он всегда = 1), 3-й - текстовый код ошибки (от него зависит показываемый значок)
				 * Виды значков: error - ошибка, access - ошибка доступа, fatal - фатальная ошибка, info - информация, не критичные ошибки, но важно чтобы пользователь знал.
				 */
				throw new ModuleLoadException ( "Невозможно подгрузить XSLTEMPLATE.", 1, "fatal" );
			}
			/**
			 * Helper - это вспомогательный класс автоматически подгружаемый вместе с основным, но проверить на всякий случай надо.
			 */
			$xsltemplatehelperclassname = $this->classloader->GetHelper ( 'XSLTEMPLATE' );
			if (! $xsltemplatehelperclassname) {
				throw new ModuleLoadException ( "Невозможно подгрузить XSLTEMPLATE Helper.", 1, "fatal" );
			}
			$xmlbuilderclassname = $this->classloader->LoadClass ( 'XMLBUILDER' );
			if (! $xmlbuilderclassname) {
				throw new ModuleLoadException ( "Невозможно подгрузить XMLBUILDER.", 1, "fatal" );
			}
			
			$this->xsltemplate = new $xsltemplateclassname ();
			$this->xsltemplatehelper = new $xsltemplatehelperclassname ();
			$this->xmlbuilder = new $xmlbuilderclassname ();
			
			if (! isset ( $_REQUEST ['action'] )) {
				$_REQUEST ['action'] = "Default";
			}
			switch ($_REQUEST ['action']) {
				case "xsltemplates-list" :
					$this->ShowXSLTemplatesList ();
					break;
				case "xsltemplate-form" :
					$this->ShowXSLTemplateForm ();
					break;
				case "xsltemplate-edit" :
					$this->ShowXSLTemplateEdit ();
					break;
				case "static-data-list" :
					$this->ShowStaticDataList ();
					break;
				case "static-data-form" :
					$this->ShowStaticDataForm ();
					break;
				case "static-data-edit" :
					$this->ShowStaticDataEdit ();
					break;
				
				case "dynamic-data-list" :
					$this->ShowDynamicDataList ();
					break;
				case "dynamic-data-form" :
					$this->ShowDynamicDataForm ();
					break;
				case "dynamic-data-edit" :
					$this->ShowDynamicDataEdit ();
					break;
				
				case "contracts-list" :
					$this->ShowContractsList ();
					break;
				case "contract-form" :
					$this->ShowContractForm ();
					break;
				case "contract-edit" :
					$this->ShowContractEdit ();
					break;
				
				case "page-form" :
					$this->ShowPageForm ();
					break;
				
				case "page-form-edit" :
					$this->ShowPageFormEdit ();
					break;
				
				case "log-list" :
					$this->ShowLogList ();
					break;
				case "show-editor" :
					$this->ShowEditor ();
					break;
				case "privilegesbyusers-list" :
					$this->ShowPrivilegesByUsers ();
					break;
				case "privilege-add" :
					$this->PrivilegeAdd ();
					break;
				case "privilege-delete" :
					$this->PrivilegeDelete ();
					break;
				case "users-list" :
					$this->ShowUserList ();
					break;
				case "user-form" :
					$this->ShowUserForm ();
					break;
				case "user-edit" :
					$this->ShowUserDataEdit ();
					break;
				case "departments-list" :
					$this->ShowDepartmentList ();
					break;
				case "department-form" :
					$this->ShowDepartmentForm ();
					break;
				
				case "department-edit" :
					$this->ShowDepartmentDataEdit ();
					break;
				
				case "organizations-list" :
					$this->ShowOrganizatonList ();
					break;
				
				case "organization-form" :
					$this->ShowOrganizationForm ();
					break;
				
				case "organization-edit" :
					$this->ShowOrganizationDataEdit ();
					break;
				case "hierarchy" :
					$this->ShowHierarchy ();
					break;
				case "users-groups-list" :
					$this->ShowUsersGroupsList ();
					break;
				case "users-group-form" :
					$this->ShowUsersGroupForm ();
					break;
				case "users-group-edit" :
					$this->ShowUsersGroupDataEdit ();
					break;
				
				// ******///
				case "subdepartment-add" :
					$this->ShowDepartmentForm ();
					break;
				
				case "subuser-add" :
					$this->ShowUserForm ();
					break;
				
				case "unit-transfer" :
					$this->ShowUnitTransferForm ();
					break;
				
				case "unit-transfer-edit" :
					$this->ShowUnitTransferEdit ();
					break;
				
				case "route-resposible-form" :
					$this->ShowRouteResposibleForm ();
					break;
				
				case "route-resposible-edit" :
					$this->ShowRouteResposibleDataEdit ();
					break;
				
				case "new-route-resposible-form" :
					$this->ShowRouteResposibleFormNew ();
					break;
				
				case "new-route-resposible-edit" :
					$this->ShowRouteResposibleDataEditNew ();
					break;
				
				case "servicegroup-form" :
					$this->ShowServiceGroupForm ();
					break;
				
				case "newservicegroup-form" :
					$this->ShowServiceGroupNewForm ();
					break;
				
				case "servicegroup-edit" :
					$this->ShowServiceGroupDataEdit ();
					break;
				
				case "service-form" :
					$this->ShowServiceForm ();
					break;
				
				case "newservice-form" :
					$this->ShowServiceNewForm ();
					break;
				
				case "service-edit" :
					$this->ShowServiceDataEdit ();
					break;
				
				// *****//
				case "requests-list" :
					$this->ShowRequestsList ();
					break;
				
				case "request-form" :
					$this->ShowRequestForm ();
					break;
				
				// --- для работы с расходниками ---
				case "materials-list" :
					$this->ShowMaterialsList ();
					break;
				case "material-form" :
					$this->ShowMaterialForm ();
					break;
				case "material-edit" :
					$this->ShowMaterialDataEdit ();
					break;
				// --- для работы с расходниками ---
				
				// --- проверяем форму письма ---
				case "test-mailform" :
					$this->ShowMailForm ();
					break;
				// --- проверяем форму письма ---
				
				// --- выбор исполнителей с автоподбором ---
				case "test-executorslist" :
					$this->ShowExecutorsList ();
					break;
				// --- выбор исполнителей с автоподбором ---
				
				// --- выбор исполнителей с автоподбором ---
				case "test-notification" :
					$this->ShowNotificationAPI ();
					break;
				// --- выбор исполнителей с автоподбором ---
				
				default :
					$this->html .= '<h2>Панель администрирования</h2>';
			}
		}
		
		/**
		 * Выводит список шаблонов
		 */
		private function VerifyAccess() {
			$Access = new Access ();
			$CUser = $Access->GetCurrentUser ();
			
			if (! $Access->IsAdministrator ()) {
				throw new AccessException ( "Вам запрещен доступ к данному элементу.", 1, "access" );
			}
		}
		private function ShowXSLTemplatesList() { /*
		                                           * $parameters = array(); $parameters['per_page'] = 5; if(isset($_REQUEST['page'])) { $parameters['page'] = intval($_REQUEST['page']); }else{ $parameters['page'] = 0; } if(isset($_REQUEST['per_page'])) { $parameters['per_page'] = intval($_REQUEST['per_page']); }else{ $parameters['per_page'] = PER_PAGE; } if(isset($_POST['xsltemplates_move'])) { echo "перемещаем шаблоны ".implode(',',$_POST['xsltemplates']); // Ничего не делаем, только даем понять что команда дошла :) } $this->xml = $this->xmlbuilder->buildXML($this->xsltemplatehelper->GetXSLTemplatesListForXML($parameters,false)); $this->html .= '<h2>Шаблоны</h2>'; $this->html .= $this->xsltemplate->build($this->xml, "XSLTemplatesList");
		                                           */
			$this->VerifyAccess ();
			$this->xml = $this->xmlbuilder->buildXML ( $this->xsltemplatehelper->GetDirList ( $_REQUEST ['dir'] ) );
			$this->html .= '<h2>Шаблоны</h2>';
			$this->html .= $this->xsltemplate->build ( $this->xml, "XSLTemplatesList", "AdminPanel/XSLTemplates" );
		}
		/**
		 * Выводит форму редактирования шаблона
		 */
		private function ShowXSLTemplateForm() {
			/*
			 * $xsltemplateclassname = $this->classloader->LoadClass('XSLTEMPLATE'); if(!$xsltemplateclassname) { throw new ModuleLoadException("Невозможно подгрузить XSLTEMPLATE.",1,"error"); } $xsltemplateitem = new $xsltemplateclassname(intval($_REQUEST['id']), array('load_xsl_data'=>true));
			 */
			$this->VerifyAccess ();
			$path = $_REQUEST ['path'];
			$this->xml = $this->xmlbuilder->buildXML ( $this->xsltemplatehelper->XSLTemplateForm ( $path ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "XSLTemplateForm", "AdminPanel/XSLTemplates" );
		}
		/**
		 * Сохраняет данные
		 */
		private function ShowXSLTemplateEdit() {
			$this->VerifyAccess ();
			$xsltemplateclassname = $this->classloader->LoadClass ( 'XSLTEMPLATE' );
			if (! $xsltemplateclassname) {
				throw new ModuleLoadException ( "Невозможно подгрузить XSLTEMPLATE.", 1, "error" );
			}
			if (! empty ( $_REQUEST ['id'] )) {
				$xsltemplateitem = new $xsltemplateclassname ( intval ( $_REQUEST ['id'] ) );
				$xsltemplateitem->SetArray ( $_REQUEST );
			} else {
				$xsltemplateitem = new $xsltemplateclassname ( 0, $_REQUEST );
			}
			$xsltemplateitem->Save ();
			$_REQUEST ['id'] = $xsltemplateitem->GetId ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowXSLTemplatesList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowXSLTemplateForm ();
			}
		}
		/**
		 * Выводит список статических элементов
		 */
		private function ShowStaticDataList() {
			$this->VerifyAccess ();
			$parameters = array ();
			$parameters ['per_page'] = 5;
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$static_data_helper = new StaticDataHelper ();
			
			$this->xml = $this->xmlbuilder->buildXML ( $static_data_helper->GetStaticDataListForXML ( $parameters, false ) );
			$this->html .= '<h2>Статические элементы</h2>';
			$this->html .= $this->xsltemplate->build ( $this->xml, "StaticDataList" );
		}
		/**
		 * Выводит форму редактирования статического элемента
		 */
		private function ShowStaticDataForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['id'] )) {
				$staticdata = new StaticData ( intval ( $_REQUEST ['id'] ) );
				
				$this->xml = $this->xmlbuilder->buildXML ( $staticdata->GetArrayForXML ( false ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "StaticDataForm" );
			}
		}
		/**
		 * Сохраняет данные о статическом элементе
		 */
		private function ShowStaticDataEdit() {
			$this->VerifyAccess ();
			
			if (! empty ( $_REQUEST ['id'] )) {
				$staticdata = new StaticData ( intval ( $_REQUEST ['id'] ) );
				$staticdata->SetArray ( $_REQUEST );
			} else {
				$staticdata = new StaticData ( 0, $_REQUEST );
			}
			$staticdata->Save ();
			$_REQUEST ['id'] = $staticdata->GetId ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowStaticDataList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowStaticDataForm ();
			}
		}
		
		/**
		 * Выводит список и форму редактирования динамического элемента
		 */
		private function ShowDynamicDataList() {
			$this->VerifyAccess ();
			
			$parameters = array ();
			$parameters ['per_page'] = 5;
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$dynamic_data_helper = new DynamicDataHelper ();
			
			$this->xml = $this->xmlbuilder->buildXML ( $dynamic_data_helper->GetDynamicElementsListForXML ( $parameters, false ) );
			$this->html .= '<h2>Динамические элементы</h2>';
			$this->html .= $this->xsltemplate->build ( $this->xml, "DynamicDataList", "AdminPanel\DynamicData" );
		}
		private function ShowDynamicDataForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['id'] )) {
				$dynamicdata = new DynamicData ( intval ( $_REQUEST ['id'] ) );
				
				$this->xml = $this->xmlbuilder->buildXML ( $dynamicdata->GetArrayForXML ( false ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "DynamicDataForm", "AdminPanel/DynamicData" );
			}
		}
		/**
		 * Сохраняет данные о динамичеком элементе
		 */
		private function ShowDynamicDataEdit() {
			$this->VerifyAccess ();
			
			if (! empty ( $_REQUEST ['id'] )) {
				$dynamicdata = new DynamicData ( intval ( $_REQUEST ['id'] ) );
				$dynamicdata->SetArray ( $_REQUEST );
			} else {
				$dynamicdata = new DynamicData ( 0, $_REQUEST );
			}
			
			$dynamicdata->Save ();
			$_REQUEST ['id'] = $dynamicdata->GetId ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowDynamicDataList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowDynamicDataForm ();
			}
		}
		
		/* привязка элементов к страницам */
		private function ShowPageForm() {
			$this->VerifyAccess ();
			
			$contenttype = 1;
			if (isset ( $_REQUEST ['content-type'] )) {
				$contenttype = $_REQUEST ['content-type'];
			}
			
			$pagetype = 0;
			if (isset ( $_REQUEST ['page-type'] )) {
				$pagetype = $_REQUEST ['page-type'];
			}
			
			$external = array ();
			if ($contenttype == 0) {
				$statichelper = new StaticDataHelper ();
				$external = $statichelper->GetStaticDataListForXML ( null );
			} else {
				$dynamichelper = new DynamicDataHelper ();
				$external = $dynamichelper->GetDynamicElementsListForXML ( null );
			}
			;
			
			$external_pageconroller = array ();
			$page_controller = new PageControllerHelper ();
			$external_pageconroller = $page_controller->GetPagesTableListForXML ( null );
			
			$out = array ();
			$out [0] ['name'] = "PageElement";
			$out [0] ['attributes'] ['content-type'] = $contenttype;
			$out [0] ['attributes'] ['page-type'] = $pagetype;
			$out [0] ['childs'] = $external;
			
			$this->xml = "<PageForm>\n";
			
			$this->xml .= $this->xmlbuilder->buildXML ( $out );
			
			$this->xml .= $this->xmlbuilder->buildXML ( $external_pageconroller );
			
			$this->xml .= "</PageForm>\n";
			
			$this->html .= $this->xsltemplate->build ( $this->xml, "PagesForm", "AdminPanel\PagesForm" );
		}
		private function ShowPageFormEdit() {
			$this->VerifyAccess ();
			
			$contenttype = 1;
			if (isset ( $_REQUEST ['content-type'] )) {
				$contenttype = $_REQUEST ['content-type'];
			}
			
			// $contenttype=0 - статический элемент; $contenttype=0 - динамический элемент
			
			// $pagetype=0;
			if (isset ( $_REQUEST ['page-type'] )) {
				$pagetype = $_REQUEST ['page-type'];
			}
			
			// pagetype = 0 - новая страница
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				if ($pagetype == 0) {
					$page = new Pages ( 0, $_REQUEST );
					
					$page->Save ();
					$page_id = $page->GetId ();
				} else {
					/* существующая страница */
					;
					$page_id = $_REQUEST ( 'page_id' );
				}
				
				$pageselements = new PagesElements ( 0, $_REQUEST );
				
				$pageselements->SetPageId ( $page_id );
				/*
				 * $pageselements -> SetType($contenttype); $pageselements -> SetContentID($_REQUEST('content_id'));
				 */
				
				$pageselements->Save ();
			} else {
				$this->ShowPageForm ();
			}
		}
		/* --- конец привязок --- */
		
		/*---- ДОГОВОРЫ ----*/
		private function ShowContractsList() {
			$this->VerifyAccess ();
			
			$parameters = array ();
			$parameters ['per_page'] = 5;
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$contract_data_helper = new ContractHelper ();
			
			$this->xml = $this->xmlbuilder->buildXML ( $contract_data_helper->GetContractsListForXML ( $parameters, false ) );
			$this->html .= '<h2>Договоры</h2>';
			$this->html .= $this->xsltemplate->build ( $this->xml, "ContractList", "AdminPanel/Contract" );
		}
		private function ShowContractForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['id'] )) {
				$contract = new Contract ( intval ( $_REQUEST ['id'] ) );
				
				$organizationhelper = new OrganizationHelper ();
				$external = $organizationhelper->GetOrganizationsListForXML ( null );
				
				$this->xml = $this->xmlbuilder->buildXML ( $contract->GetArrayForXML ( false, $external ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "ContractForm", "AdminPanel/Contract" );
			}
		}
		private function ShowContractEdit() {
			$this->VerifyAccess ();
			
			if (! empty ( $_REQUEST ['id'] )) {
				$contract = new Contract ( intval ( $_REQUEST ['id'] ) );
				$contract->SetArray ( $_REQUEST );
			} else {
				$contract = new Contract ( 0, $_REQUEST );
			}
			
			$contract->SetName ( $_REQUEST ['name'] );
			$contract->SetNumber ( $_REQUEST ['number'] );
			$contract->SetStatus ( $_REQUEST ['status'] );
			
			$contract->SetContractorID ( $_REQUEST ['contractor_id'] );
			$contract->SetDateStart ( $_REQUEST ['date_start'] );
			// $contract->SetResponsibleID($_REQUEST['responsible_id']);
			
			$contract->Save ();
			$_REQUEST ['id'] = $contract->GetId ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				
				$this->ShowContractsList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowContractForm ();
			}
			
			if (isset ( $_REQUEST ['test'] )) {
				$contract = new Department ( 0, array () );
				$contract->Save ();
			}
		}
		/* ---- ДОГОВОРЫ ---- */
		private function ShowPrivilegesByUsers() { // Отображает список привилегий в разрезе пользователей
			$this->VerifyAccess ();
			
			$parameters = array ();
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$usersgrouphelper = new UserGroupHelper ();
			$GroupsEx = $usersgrouphelper->GetGroupsListForXML ( null );
			
			$CasePrivileges = new CasePrivileges ();
			$PrivilegesEx = $CasePrivileges->GetPrivilegesListForXML ( array (), false, array () );
			
			$PrivilegesListEx = $CasePrivileges->GetAllPrivilegesWithDescriptionsForXML ( array (), false, array () );
			
			$UserHelper = new UserHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $UserHelper->GetUsersListForXML ( $parameters, false, array_merge ( $GroupsEx, $PrivilegesEx, $PrivilegesListEx ) ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "AdminPanel/Privileges/PrivilegesByUsers" );
		} // ShowPrivilegesByUsers
		private function PrivilegeAdd() { // Добавляет привилегию
			$this->VerifyAccess ();
			
			$PrivilegeClassName = $this->classloader->LoadClass ( 'PRIVILEGE' );
			$privilege = new $PrivilegeClassName ( 0, array () );
			$privilege->SetAlias ( $_REQUEST ['access_alias'] );
			$privilege->SetAccessIDType ( 1 );
			$privilege->SetAccessID ( intval ( $_REQUEST ['access_user_id'] ) );
			$privilege->Save ();
			$this->ShowPrivilegesByUsers ();
		}
		private function PrivilegeDelete() { // Добавляет привилегию
			$this->VerifyAccess ();
			
			$PrivilegeClassName = $this->classloader->LoadClass ( 'PRIVILEGE' );
			$privilege = new $PrivilegeClassName ( 0, array (
					'LoadByAliasAndUserAccesID' => true,
					'access_id' => $_REQUEST ['access_user_id'],
					'alias' => $_REQUEST ['access_alias'] 
			) );
			if (isset ( $privilege ))
				$privilege->PrivilegeDelete ();
			$this->ShowPrivilegesByUsers ();
		}
		private function ShowUserList() { // Выводит cписок пользователей
			$this->VerifyAccess ();
			
			$parameters = array ();
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$usersgrouphelper = new UserGroupHelper ();
			$external = $usersgrouphelper->GetGroupsListForXML ( null );
			
			$UserHelper = new UserHelper ();
			
			$this->xml = $this->xmlbuilder->buildXML ( $UserHelper->GetUsersListForXML ( $parameters, false, $external ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "UsersList" );
		}
		private function ShowDepartmentList() { // Выводит cписок подразделений - добавил Степанов А.О.
			$this->VerifyAccess ();
			
			$parameters = array ();
			
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$DepartmentHelper = new DepartmentHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $DepartmentHelper->GetDepartmentsListForXML ( $parameters, false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "DepartmentsList", "AdminPanel/Departments" );
		}
		private function ShowOrganizatonList() { // Выводит cписок организаций - добавил Степанов А.О.
			$this->VerifyAccess ();
			$parameters = array ();
			
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$OrganizationHelper = new OrganizationHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $OrganizationHelper->GetOrganizationsListForXML ( $parameters, false, array () ) );
			
			$this->html .= $this->xsltemplate->build ( $this->xml, "OrganizationsList", "AdminPanel/Organizations" );
		}
		private function ShowUserForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['parent_type'] )) {
				// Получаем параметры карточки пользователя
				$user = new User ();
				$usersgrouphelper = new UserGroupHelper ();
				$external = $usersgrouphelper->GetGroupsListForXML ( null );
				
				switch ($_REQUEST ['parent_type']) {
					case 1 :
						$OrganizationUnit = new Organization ( $_REQUEST ['id'] );
						break;
					case 2 :
						$OrganizationUnit = new Department ( $_REQUEST ['id'] );
						break;
					default :
						break;
				}
				
				/*
				 * $organization_helper = new OrganizationHelper(); $organization_list = $organization_helper -> GetOrganizationsListForXML(null);
				 */
				
				$this->xml = $this->xmlbuilder->buildXML ( $user->GetArrayForXMLWithParent ( false, $external, $OrganizationUnit->GetArrayForXML ( false, array () ), $_REQUEST ['parent_type'] ) );
				// $organization_list = $organization_helper -> GetOrganizationsListForXML(null);
				$this->html .= $this->xsltemplate->build ( $this->xml, "UserForm" );
			} else {
				if (isset ( $_REQUEST ['id'] )) {
					// Получаем параметры карточки пользователя
					$user = new User ( intval ( $_REQUEST ['id'] ) );
					$usersgrouphelper = new UserGroupHelper ();
					$external = $usersgrouphelper->GetGroupsListForXML ( null );
					
					/*
					 * $organization_helper = new OrganizationHelper(); $organization_list = $organization_helper -> GetOrganizationsListForXML(null);
					 */
					
					$this->xml = $this->xmlbuilder->buildXML ( $user->GetArrayForXML ( false, $external ) );
					$this->html .= $this->xsltemplate->build ( $this->xml, "UserForm" );
				}
			}
		}
		private function ShowDepartmentForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['parent_type'] )) {
				switch ($_REQUEST ['parent_type']) {
					case 1 :
						$OrganizationUnit = new Organization ( $_REQUEST ['id'] );
						break;
					case 2 :
						$OrganizationUnit = new Department ( $_REQUEST ['id'] );
						break;
					default :
						break;
				}
				
				$Department = new Department ();
				$this->xml = $this->xmlbuilder->buildXML ( $Department->GetArrayForXMLWithParent ( false, $OrganizationUnit->GetArrayForXML ( false, array () ), $_REQUEST ['parent_type'] ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "DepartmentForm", "AdminPanel/Departments/" );
			} elseif (isset ( $_REQUEST ['id'] )) {
				$Department = new Department ( intval ( $_REQUEST ['id'] ) );
				$this->xml = $this->xmlbuilder->buildXML ( $Department->GetArrayForXML ( false, array () ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "DepartmentForm", "AdminPanel/Departments/" );
			}
		}
		private function ShowDepartmentDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowDepartmentList ();
				return true;
			}
			
			$nd = new Department ( $_REQUEST ['id'] );
			
			$nd->SetDescription ( $_REQUEST ['description'] );
			$nd->SetName ( $_REQUEST ['name'] );
			$nd->SetShortName ( $_REQUEST ['short_name'] );
			
			$nd->Save ();
			
			// добавить создание relation
			
			$_REQUEST ['id'] = $nd->GetID ();
			
			if (isset ( $_REQUEST ['parent_id'] )) {
				$relation = new Relation ();
				$relation->SetSourceID ( $nd->GetID () );
				$relation->SetSourceType ( '2' );
				$relation->SetSourceID ( $_REQUEST ['id'] );
				$relation->SetParentID ( $_REQUEST ['parent_id'] );
				$relation->SetParentType ( $_REQUEST ['parent_type'] );
				$relation->Save ();
				if (isset ( $_REQUEST ['saveandexit'] )) {
					$this->ShowHierarchy ();
					return false;
				}
			}
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowDepartmentList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				// добавить создание relation
				/*
				 * if (!($_POST['id']) and !($_POST['parent_type'])) { $relation = new Relation(); $relation -> SetSourceID($nd->GetID()); $relation -> SetSourceType('2'); $relation -> SetParentID($_REQUEST['id']); $relation -> SetParentType($_POST['parent_type']); $relation -> Save(); };
				 */
				
				$this->ShowDepartmentForm ();
			}
		} // ShowDepartmentDataEdit
		  
		// / ShowOrganizationForm
		private function ShowOrganizationForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['id'] )) {
				// Получаем параметры карточки пользователя
				$Organization = new Organization ( intval ( $_REQUEST ['id'] ) );
				
				$this->xml = $this->xmlbuilder->buildXML ( $Organization->GetArrayForXML ( false, array () ) );
				$this->html .= $this->xsltemplate->build ( $this->xml, "OrganizationForm", "AdminPanel/Organizations" );
			}
		} // /ShowOrganizationForm
		private function ShowOrganizationDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowOrganizatonList ();
				return true;
			}
			
			$no = new Organization ( $_REQUEST ['id'] );
			
			$no->SetDescription ( $_REQUEST ['description'] );
			$no->SetName ( $_REQUEST ['name'] );
			$no->SetShortName ( $_REQUEST ['short_name'] );
			
			$no->Save ();
			
			$orghelper = new OrganizationHelper ();
			$orghelper->UpdateOrganizationAddresses ( $no->GetId () );
			
			$_REQUEST ['id'] = $no->GetID ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowOrganizatonList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowOrganizationForm ();
			}
		} // ShowDepartmentDataEdit
		private function ShowHierarchy() {
			$this->VerifyAccess ();
			$RelationHelper = new RelationHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $RelationHelper->BuildXMLTree () );
			$this->html .= $this->xsltemplate->build ( $this->xml, "HierarchyList", "AdminPanel/Hierarchy" );
		}
		private function ShowUnitTransferForm() {
			$this->VerifyAccess ();
			$parameters = array ();
			
			$OrganizationHelper = new OrganizationHelper ();
			$DepartmentHelper = new DepartmentHelper ();
			
			$relation = new Relation ( $_REQUEST ['id'], $parameters );
			
			$relation->SetSourceID ( $_REQUEST ['id'] );
			$relation->SetSourceType ( $_REQUEST ['source_type'] );
			
			$this->xml = $this->xmlbuilder->buildXML ( $relation->GetArrayForXML ( false, $OrganizationHelper->GetOrganizationsListForXML ( null, false, $DepartmentHelper->GetDepartmentsListForXML ( null ) ) ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "UnitTransfer", "AdminPanel\Relation" );
		}
		private function ShowUnitTransferEdit() {
			$this->VerifyAccess ();
			
			$parameters = array ();
			
			$source_id = 0;
			$source_type = 0;
			
			$source_id = $_REQUEST ['source_id'];
			$source_type = $_REQUEST ['source_type'];
			
			$parent_id = 0;
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				
				if (isset ( $_REQUEST ['parent_organization_id'] )) {
					$parent_organization_id = $_REQUEST ['parent_organization_id'];
					// $parent_type = 1;
					// return true;
				}
				
				if (isset ( $_REQUEST ['parent_department_id'] )) {
					$parent_department_id = $_REQUEST ['parent_department_id'];
					// $parent_type = 2;
					// return true;
				}
				
				// проверяем что не 0 $parent_department_id и $parent_organization_id
				if ($parent_department_id == 0 & $parent_organization_id == 0) {
					return false;
				}
				
				// создание или обновление записи для данного $source_id
				if ($parent_department_id == 0) {
					$relation = new Relation ( $source_id, array () );
					$parent_type = 1;
					$parent_id = $parent_organization_id;
				} else {
					$relation = new Relation ( $source_id, array () );
					$parent_type = 2;
					$parent_id = $parent_department_id;
				}
				
				$relation->SetParentID ( $parent_id );
				$relation->SetParentType ( $parent_type );
				$relation->SetSourceID ( $source_id );
				$relation->SetSourceType ( $source_type );
				
				$relation->Save ();
				
				$this->ShowHierarchy ();
				return false;
			}
		}
		private function ShowUserDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowUserList ();
				return true;
			}
			
			$nu = new User ( $_REQUEST ['id'] );
			$uh = new UserHelper ();
			if (isset ( $_REQUEST ['connected'] )) {
				if ($_REQUEST ['connected'])
					$nu->SetConnected ( 1 );
				else
					$nu->SetConnected ( 0 );
			} else {
				$nu->SetConnected ( 0 );
			}
			$nu->SetLogin ( $uh->FormatUsername ( $_REQUEST ['login'] ) );
			if (! empty ( $_REQUEST ['password'] )) {
				$nu->SetPassword ( $_REQUEST ['password'] );
			}
			$nu->SetFirstname ( $_REQUEST ['firstname'] );
			$nu->SetSecondname ( $_REQUEST ['secondname'] );
			$nu->SetPatronymic ( $_REQUEST ['patronymic'] );
			$nu->SetGroup ( $_REQUEST ['group_id'] );
			$nu->SetEmail ( $_REQUEST ['email'] );
			$nu->Save ();
			$_REQUEST ['id'] = $nu->GetID ();
			
			if (isset ( $_REQUEST ['parent_id'] )) {
				$relation = new Relation ();
				$relation->SetSourceID ( $nu->GetID () );
				$relation->SetSourceType ( '3' );
				$relation->SetSourceID ( $_REQUEST ['id'] );
				$relation->SetParentID ( $_REQUEST ['parent_id'] );
				$relation->SetParentType ( $_REQUEST ['parent_type'] );
				$relation->Save ();
				if (isset ( $_REQUEST ['saveandexit'] )) {
					$this->ShowHierarchy ();
					return false;
				}
			}
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowUserList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				// добавить создание relation
				/*
				 * if (!($_REQUEST['id']) and !($_REQUEST['parent_type'])) { $relation = new Relation(); $relation -> SetSourceID($nu->GetID()); $relation -> SetSourceType('3'); $relation -> SetParentID($_REQUEST['id']); $relation -> SetParentType($_REQUEST['parent_type']); $relation -> Save(); };
				 */
				
				$this->ShowUserForm ();
			}
			
			// добавить создание relation
		} // ShowUserDataEdit
		/*
		 * Выводит cписок пользовательских групп
		 */
		private function ShowUsersGroupsList() {
			$this->VerifyAccess ();
			
			$parameters = array ();
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$usersgroups = new UserGroupHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $usersgroups->GetGroupsListForXML ( $parameters ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "UsersGroupsList" );
		}
		private function ShowUsersGroupForm() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['id'] )) {
				// Получаем параметры карточки пользователя
				$usersgroup = new UserGroup ( intval ( $_REQUEST ['id'] ) );
				$this->xml = $this->xmlbuilder->buildXML ( $usersgroup->GetArrayForXML () );
				$this->html .= $this->xsltemplate->build ( $this->xml, "UsersGroupForm" );
			}
		}
		private function ShowUsersGroupDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowUsersGroupsList ();
				return true;
			}
			
			if (! empty ( $_REQUEST ['id'] )) {
				$nug = new UserGroup ( $_REQUEST ['id'] );
				$nug->SetName ( $_REQUEST ['name'] );
				$nug->SetShortName ( $_REQUEST ['short_name'] );
				$nug->Save ();
			} else {
				$nug = new UserGroup ();
				$nug->SetName ( $_REQUEST ['name'] );
				$nug->SetShortName ( $_REQUEST ['short_name'] );
				$nug->Save ();
				$_REQUEST ['id'] = $nug->GetId ();
			}
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowUsersGroupsList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowUsersGroupForm ();
			}
		} // ShowUsersGroupDataEdit
		private function ShowLogList() { // Отображает список событий (Лог)
			$this->VerifyAccess ();
			
			$parameters = array ();
			$parameters ['per_page'] = 5;
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$loghelper = new LogHelper ();
			if (! $loghelper)
				throw new ModuleLoadException ( 'Невозможно загрузить модуль LogHelper', 1, 'error' );
			$this->xml = $this->xmlbuilder->buildXML ( $loghelper->GetLogListForXML ( $parameters ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "LogList" );
		} // ShowLogList
		private function ShowEditor() { // Отображает редактор
			$this->VerifyAccess ();
			
			$ClassName = $_REQUEST ['ClassName'];
			$Field = $_REQUEST ['Field'];
			$ID = $_REQUEST ['ID'];
			
			$ClassNameValid = $this->classloader->LoadClass ( strval ( $ClassName ) );
			if (! $ClassNameValid)
				throw new ModuleLoadException ( 'Невозможно загрузить модуль ' . $ClassName, 1, 'error' );
			
			$in = array ();
			$ClassItem = new $ClassNameValid ( $ID, $in );
			
			$arr = array ();
			$arr = $ClassItem->GetArrayForXML ( true );
			
			$trip = array ();
			$trip = split ( "/", $Field );
			
			if (count ( $trip ) == 1) {
				$Content = $arr [$trip [0]];
			}
			if (count ( $trip ) == 2) {
				$Content = $arr [$trip [0]] [$trip [1]];
			}
			if (count ( $trip ) == 3) {
				$Content = $arr [$trip [0]] [$trip [1]] [$trip [2]];
			}
			if (count ( $trip ) == 4) {
				$Content = $arr [$trip [0]] [$trip [1]] [$trip [2]] [$trip [3]];
			}
			
			$arrXML = array ();
			$arrXML ['name'] = "Content";
			$arrXML ['attributes'] ['data'] = $Content;
			
			$this->xml = $this->xmlbuilder->buildXML ( $arrXML );
			$this->html .= $this->xsltemplate->build ( $this->xml, "ContentEditor" );
		} // ShowEditor
		
		/*
		 * private function ShowAccessList() { $this -> VerifyAccess(); $itemrcmhelper=new rcmcoursehelper(); $parameters=array(); $parameters['per_page']=5; if (isset($_REQUEST['page'])) $parameters['page']=intval($_REQUEST['page']); else $parameters['page']=0; if (isset($_REQUEST['per_page'])) $parameters['per_page']=intval($_REQUEST['per_page']); else $parameters['per_page']=PER_PAGE; $this->xml=$this->xmlbuilder->buildXML($itemrcmhelper->GetAccessListForXML($parameters)); $this->html.=$this->xsltemplate->build($this->xml,"RCMAccessList","AdminPanel/Access"); }
		 */
		
		/*private function ShowAccessForm() {
			
			$this -> VerifyAccess();
			
			$StudentsGroupHelperItem=new RCMStudentGroupHelper();
			$grouparray=$StudentsGroupHelperItem->GetRCMStudentsGroupsListForXML();
			
			$itemrcmhelper=new RCMCourseHelper();
			
			$userhelper=new UserHelper();
			$userarray=$userhelper->GetUsersListForXML();
			
			$studenthelper=new RCMStudentHelper();
			$studentarray=$studenthelper->GetRCMStudentsListForXML();
			
			$this->xml=$this->xmlbuilder->buildXML($itemrcmhelper->GetAccessInfoForXML($_REQUEST['access_id'],$_REQUEST['access_id_type'],false,array_merge($itemrcmhelper->GetRCMCoursesListForXML(),$grouparray,$studentarray,$userarray)));
			$this->html.=$this->xsltemplate->build($this->xml,"RCMAccessForm","AdminPanel/Access");
		}*/
		
		private function ShowRouteResposibleForm() {
			$this->VerifyAccess ();
			
			$routehelper = new RouteHelper ();
			$UserHelper = new UserHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $routehelper->GetRoutesListForXML ( false, $UserHelper->GetUsersListForXML ( array (), false, array (), "secondname", "ASC" ) ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "RouteResponsibleForm", "AdminPanel/Route" );
		}
		private function ShowRouteResposibleDataEdit() {
			if ($_REQUEST ['route_id'] == 7) {
				$this->ShowRouteResposibleForm ();
				return false;
			}
			
			$routehelper = new RouteHelper ();
			$routehelper->UpdateRouteApprovers ();
			
			$this->ShowRouteResposibleForm ();
		}
		private function ShowRouteResposibleFormNew() {
			$this->VerifyAccess ();
			
			$routehelper = new RouteHelper ();
			$UserHelper = new UserHelper ();
			$this->xml = $this->xmlbuilder->buildXML ( $routehelper->GetRoutesListForXML ( false, $UserHelper->GetUsersListForXML ( array (), false, array (), "secondname", "ASC" ) ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "RouteResponsibleFormNew", "AdminPanel/Route" );
		}
		private function ShowRouteResposibleDataEditNew() {
			if ($_REQUEST ['route_id'] == 7) {
				$this->ShowRouteResposibleFormNew ();
				return false;
			}
			
			$routehelper = new RouteHelper ();
			$routehelper->UpdateRouteApprovers ();
			
			$this->ShowRouteResposibleFormNew ();
		}
		private function ShowServiceGroupForm() {
			$this->VerifyAccess ();
			$servicegroup = new ContractServicesGroup ( intval ( $_REQUEST ['id'] ) );
			$this->xml = $this->xmlbuilder->buildXML ( $servicegroup->GetArrayForXML ( false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "ServiceGroupForm", "AdminPanel/Contract" );
		}
		private function ShowServiceGroupNewForm() {
			$this->VerifyAccess ();
			$servicegroup = new ContractServicesGroup ( 0 );
			$servicegroup->SetContractID ( $_REQUEST ['parent_id'] );
			$this->xml = $this->xmlbuilder->buildXML ( $servicegroup->GetArrayForXML ( false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "ServiceGroupForm", "AdminPanel/Contract" );
		}
		private function ShowServiceGroupDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowContractsList ();
				return true;
			}
			
			$servicegroup = new ContractServicesGroup ( $_REQUEST ['id'] );
			$servicegroup->SetName ( $_REQUEST ['name'] );
			$servicegroup->SetStatus ( $_REQUEST ['status'] );
			$servicegroup->SetContractID ( $_REQUEST ['contract_id'] );
			$servicegroup->Save ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowContractsList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowServiceGroupForm ();
			}
		}
		private function ShowServiceForm() {
			$this->VerifyAccess ();
			$service = new ContractService ( intval ( $_REQUEST ['id'] ) );
			$this->xml = $this->xmlbuilder->buildXML ( $service->GetArrayForXML ( false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "ServiceForm", "AdminPanel/Contract" );
		}
		private function ShowServiceNewForm() {
			$this->VerifyAccess ();
			$service = new ContractService ( 0 );
			$service->SetServiceGroupID ( $_REQUEST ['parent_id'] );
			$service->SetStatus ( 0 );
			$this->xml = $this->xmlbuilder->buildXML ( $service->GetArrayForXML ( false, array () ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "ServiceForm", "AdminPanel/Contract" );
		}
		private function ShowServiceDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowContractsList ();
				return true;
			}
			
			$service = new ContractService ( $_REQUEST ['id'] );
			$service->SetName ( strval ( $_REQUEST ['name'] ) );
			$service->SetDescription ( $_REQUEST ['description'] );
			$service->SetStatus ( $_REQUEST ['status'] );
			$service->SetServiceGroupID ( $_REQUEST ['servicegroup_id'] );
			$service->Save ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowContractsList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowServiceForm ();
			}
		}
		private function ShowMaterialsList() { // Выводит cписок пользователей
			$this->VerifyAccess ();
			
			$parameters = array ();
			if (isset ( $_REQUEST ['page'] )) {
				$parameters ['page'] = intval ( $_REQUEST ['page'] );
			} else {
				$parameters ['page'] = 0;
			}
			if (isset ( $_REQUEST ['per_page'] )) {
				$parameters ['per_page'] = intval ( $_REQUEST ['per_page'] );
			} else {
				$parameters ['per_page'] = PER_PAGE;
			}
			
			$external = array ();
			$MaterialHelper = new MaterialHelper ();
			
			$this->xml = $this->xmlbuilder->buildXML ( $MaterialHelper->GetMaterialsListForXML ( $parameters, false, $external ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "MaterialsList", "AdminPanel/Material" );
		}
		private function ShowMaterialForm() {
			$this->VerifyAccess ();
			
			$material = new Material ( $_REQUEST ['id'] );
			$material_helper = new MaterialHelper ();
			$external = $material_helper->GetCategoriesListForXML ( null );
			
			$this->xml = $this->xmlbuilder->buildXML ( $material->GetArrayForXML ( false, $external ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "MaterialForm", "AdminPanel/Material" );
		}
		private function ShowMaterialDataEdit() {
			$this->VerifyAccess ();
			
			if (isset ( $_REQUEST ['exit'] )) {
				$this->ShowMaterialsList ();
				return true;
			}
			
			$nm = new Material ( $_REQUEST ['id'] );
			$nm->SetCategory ( $_REQUEST ['category'] );
			$nm->SetName ( $_REQUEST ['name'] );
			$nm->Save ();
			
			if (isset ( $_REQUEST ['saveandexit'] )) {
				$this->ShowMaterialsList ();
			} elseif (isset ( $_REQUEST ['saveandedit'] )) {
				$this->ShowMaterialForm ();
			}
		} // ShowMaterialDataEdit
		private function ShowMailForm() {
			$this->VerifyAccess ();
			
			$request = new Request ( 1489 );
			$author = new User ( $request->GetAuthorID () );
			$this->xml = $this->xmlbuilder->buildXML ( $request->GetArrayForXML ( false, $author->GetArrayForXML ( false, array () ) ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "MailTemplate_Single", "Mail" );
			
			$request = new Request ( 1489 );
			$user_id = 238;
			$mail = new MemoMail ();
			$mailhelper = new MemoMailHelper ();
			
			$mail->SetFrom ( $mailhelper->GetMailFrom () );
			$mail->SetTo ( 'a.stepanov@infotech-it.ru' ); // , e.krylova@infotech-it.ru, a.kamishkertsev@infotech-it.ru');
			$mail->SetTheme ( $mailhelper->ComposeTheme ( $request->GetStatus () ) );
			// $mail -> SetText($mailhelper->ComposeText($request -> GetStatus(), $request -> GetId(), $request -> GetRequestNumber(), $request -> GetAuthorID()));
			$mail->SetText ( $mailhelper->ComposeTextNew ( $user_id, $request->GetId () ) );
			
			$mail->Send ();
		}
		private function ShowExecutorsList() {
			$parameters = array ();
			$UserHelper = new UserHelper ();
			
			$elar = array ();
			$elar ['name'] = "Request";
			$request = array ();
			// $request['id']=$_REQUEST['id'];
			$elar ['attributes'] = $request;
			$externaldata [] = $elar;
			
			$this->xml = $this->xmlbuilder->buildXML ( $UserHelper->GetUsersListForXML ( $parameters, false, $externaldata, "secondname", "ASC" ) );
			$this->html .= $this->xsltemplate->build ( $this->xml, "CopyExecutorsList", "Requests" );
		}
		private function ShowNotificationAPI() {
			$this->VerifyAccess ();
			
			$request = new Request ( 1544 );
			$author = new User ( $request->GetAuthorID () );
			
			$this->xml = $this->xmlbuilder->buildXML ( $request->GetArrayForXML ( false, $author->GetArrayForXML ( false, array () ), false ) );
			
			/*
			 * $request_helper = new RequestHelper(); $access = new Access(); $user = $access -> GetCurrentUser(); $this->xml=$this->xmlbuilder->buildXML($request_helper -> GetRequestNotificationsListForXML($user->GetId()));
			 */
			$this->html .= $this->xsltemplate->build ( $this->xml, "TestNotificationAPI", "AdminPanel/Tests" );
		}
		public function GetXML() {
			return $this->xml;
		}
		public function GetHTML() {
			return $this->html;
		}
	}
	// --------------------------------------------------------------------------------------------------
	
	if (! isset ( $_REQUEST ['action'] )) {
		$_REQUEST ['action'] = "";
	}
	
	switch ($_REQUEST ['action']) {
		
		default :
			$Access = new Access ();
			$CUser = $Access->GetCurrentUser ();
		
		/*
		 * if (!$Access->IsAdministrator()) { throw new AccessException("Вам запрещен доступ к данному элементу.",1,"access"); }
		 */
		
		// if (!SHIsGetRight(NULL,"FullAccess")) {throw new AccessException("Вам запрещен доступ к данному элементу1.",1,"access");}
	}
	
	// if (!SHIsGetRight(NULL,"FullAccess")) {throw new AccessException("Вам запрещен доступ к данному элементу.",1,"access");}
	
	// if (0==$current_user->GetGroupId()) {throw new Xception("Не определена группа текущего пользователя",1,"error");}
	// Загружаем информацию о текущей группе, в которой состоит пользователь
	// $current_group=new UserGroup($current_user->GetGroupId());
	// Если не получилось - не пускаем.
	// if (0==$current_group->GetId()) {throw new Xception("Не получилось загрузить информацию о группе текущего пользователя.",1,"error");}
	// if ('ADMINS'!=$current_group->GetShortName()) {throw new AccessException("Вашей группе пользователей запрещен доступ к данному элементу.",1,"access");}
	
	// if (!SHIsGetRight(NULL,"FullAccess")) {throw new AccessException("Вам запрещен доступ к данному элементу.",1,"access");}
	
	// } ;
	
	$event_handler = new EventHandler ();
	echo $event_handler->GetHTML ();

	
	/*
	 * echo "Request:"; var_dump($_REQUEST); echo "Get:"; var_dump($_GET);
	 */
	
	// echo '<textarea cols="100" rows="40">'.$event_handler->GetXML().'</textarea>';
} catch ( Xception $e ) {
	$e->ShowMessage ();
}
?>