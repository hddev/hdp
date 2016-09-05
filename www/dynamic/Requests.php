<?php 

$db = DbController::GetDatabaseInstance(); // DB
$pc = PageController::getInstance(); // PageController

$prefix = $GLOBALS['DB_PREFIX'];
$classloader = ClassLoader::getInstance();

$xsltemplate = new XSLTemplate();
$xmlbuilder = new XMLBuilder();

try {

// ==========================================================
	class EventHandler { 
// ==========================================================
		private $xml;
		private $html;
	
		private $xsltemplate;
		private $xsltemplatehelper;
		private $xmlbuilder;
	
		function __construct() {
			$this->html="";
			$this->xml="";

			$this->xsltemplate=new XslTemplate();
			$this->xsltemplatehelper=new XSLTemplateHelper();
			$this->xmlbuilder=new XMLBuilder();
					
			if (!isset($_REQUEST['action'])) $_REQUEST['action']="Default";
				
			switch ($_REQUEST['action']) {
                case "requests-list":
                    $this->ShowRequestsList();
                    break;

                case "request-form":
                    $this->ShowRequestForm();
                    break;
                    
                case "request-form-new":
                   	$this->ShowRequestFormNew();
                    break;

                case "request-edit":
                    $this->ShowRequestDataEdit();
                    break;

                case "registration-completedwork":
                    $this->ShowCompletedWorkForm();
                    break;
                    
                case "test-registration-completedwork":
                    $this->ShowCopyCompletedWorkForm();
                    break;                    

                case "completedwork-edit":
                    $this->ShowCompletedWorkDataEdit();
                    break;

                case "completedwork-multi-edit":
                    $this->ShowCompletedWorkDataEditMulti();
                    break;

                case "requirement-form":
                    $this->ShowRequirementForm();
                    break;

                case "requirement-edit":
                    $this->ShowRequirementDataEdit();
                    break;

                case "requirement-send":
                    $this->NewRequirement();
                    break;

                case "delete-attach":
                    $this->RemoveAttach();
                    break;

                case "print-request":
                    $this->PrintRequest();
                    break;

                case "defect-edit":
                    $this->DefectDataEdit();
                    break;

                case "print-defect":
                    $this->DefectPrint();
                    break;

                case "satisfaction-edit":
                    $this->ShowSatisfactionDataEdit();
                    break;

                case "receipt-edit":
                    $this->ShowReceiptDataEdit();
                    break;

                case "print-receipt":
                    $this->ReceiptPrint();
                    break;

                case "receipt-cancel":
                    $this->ReceiptCancel();
                    break;

                case "receipt-remove":
                    $this->ReceiptRemove();
                    break;

                case "approve-disagree-withcomment":
                    $this->ApproveDisagreeWithcomment();
                    break;

                case "defect-remove":
                    $this->DefectRemove();
                    break;

                case "add-message":
                    $this->AddRequestMessage();
                    break;

                case "request-choose-executors":
                    $this -> RequestChooseExecutors();
                    break;

                case "multi-registration-completedwork":
                    $this->ShowCompletedWorkFormMulti();
                    break;
                    
                case "request-log":
                    $this->ShowRequestLog();
                    break;
                    
				case "request-messages":
					$this->ShowRequestMessages();
					break;
                    	
				case "request-completedworks":
					$this->ShowRequestCompletedWorks();
					break;

                case "search-requests":
                    $this->ShowRequestsListBySearch();
                    break;
                    
                case "units-notify":
                	$this -> UnitsNotify();
                	break; 

                case "get-materials":
                	$this -> GetMaterials();
                	break;
                	
                case "notify":
                	$this->ShowNotificationAPI();
                	break;

                case "Default":
                    $this->ShowRequestsList();
                    break;

				default:
					$this->ShowRequestsList();
					break;
			}
		}		
		
		private function ShowRequestsList() { // Выводит cписок подразделений - добавил Степанов А.О.
			/*$parameters=array();

			if (isset($_REQUEST['page'])) {
				$parameters['page']=intval($_REQUEST['page']);
			} else {
				$parameters['page']=0;
			}
			if (isset($_REQUEST['per_page'])) {
				$parameters['per_page']=intval($_REQUEST['per_page']);
			} else {
				$parameters['per_page']=PER_PAGE;
			}	*/					
			$RequestHelper = new RequestHelper();
			
			//$access = new Access();
			//$user = $access -> GetCurrentUser();

			$this->xml=$this->xmlbuilder->buildXML($RequestHelper->GetRequestsListForXML(true, array()));//
			//if ($access->IsAdministrator()) {
			//	$this->html.=$this->xsltemplate->build($this->xml,"RequestsList", "Requests");
			//} else {
			//	$this->html.=$this->xsltemplate->build($this->xml,"RequestsList", "Requests");
			//}
			
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsList", "Requests");

			//exit(header('Location:'.$_SERVER['REQUEST_URI'].''));

            
        }
		
		private function ShowRequestForm() {
				$request=new Request($_REQUEST['id']);
				$request_helper = new RequestHelper();
				
				if ($request_helper->IsRequestVisibleForUserID($_REQUEST['id'] and $_REQUEST['id'] != 0)) {
					throw new ModuleAccessException("Доступ к данному запросу запрещен.",0,"access");
				}				
				
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
				
				$requestactivityhelper = new RequestActivityHelper();
				$requestactivityhelper -> SetUserRead($_REQUEST['id']);
				
				/*$notificationhelper = new NotificationHelper();
				$notificationhelper -> ObsoleteNotificationMarkForCurrentUserID($_REQUEST['id']);*/				
		}
		
		private function ShowRequestFormNew() {
			$request=new Request($_REQUEST['id']);
			$request_helper = new RequestHelper();
		
			if ($request_helper->IsRequestVisibleForUserID($_REQUEST['id'] and $_REQUEST['id'] != 0)) {
				throw new ModuleAccessException("Доступ к данному запросу запрещен.",0,"access");
			}
		
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
		
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"NewRequestsForm","Requests");
		
			$requestactivityhelper = new RequestActivityHelper();
			$requestactivityhelper -> SetUserRead($_REQUEST['id']);
		
			/*$notificationhelper = new NotificationHelper();
			 $notificationhelper -> ObsoleteNotificationMarkForCurrentUserID($_REQUEST['id']);*/
		}
		
		private function ShowRequestDataEdit() {			
			if (isset($_REQUEST['exit'])) {
				$this->ShowRequestsList();
				return true;
			}
			
			if ($_REQUEST['id'] == 0) {$bNeedIndex = 1;}
			else $bNeedIndex = 0;
		
			$nr = new Request($_REQUEST['id']);						
			$nr -> SetArray($_REQUEST);	
			if ($_REQUEST['status'] == 0) {
				$nr ->SetUKI($_REQUEST['uki-prefix'] ."-" .$_REQUEST['uki-index']);	
				//$nr -> SetAddress($_REQUEST['address']);		
			}
			$nr->Save();
			
			//upload attachment
			$uplfiles = new UploadsFile();
			$requestupload = new RequestUpload();
			
			/*$requestuploadhelper = new RequestsUploadsHelper();
			$requestuploadhelper -> DeleteRequestUploads($nr->GetId());*/
			
			if (isset($_FILES['filename']['name'])) {
				$requestupload -> SetName($_FILES['filename']['name']);
				$requestupload -> SetRequestID($nr->GetId());
				$requestupload -> GenUniqName();
				$requestupload -> SetFilePath();
				$filepath=$requestupload->GetPath();
				
									
				if (move_uploaded_file($_FILES['filename']['tmp_name'], $filepath))
				{
					$requestupload->Save();					
				};
			}
			//upload attachment
			
			//---- категория запроса - обаботка ----
			if ($_REQUEST['status'] == 0) {
				if (isset($_REQUEST['route'])) {
					/// обрабатываем категорию запроса
					$request_route_helper = new RequestRouteHelper();
					$request_route_helper -> UpdateRouteByRequestID($nr->GetId(), $_REQUEST['route']);
					/// обрабатываем категорию запроса
				}
			}
			//---- категория запроса - обаботка ----
			
			// создание дополнительных полей
			$addfieldhelper = new AdditionalFieldsHelper();
			$addfieldhelper -> FillAdditionalFields($nr->GetID(), $_REQUEST);
			// создание дополнительных полей
				
			$_REQUEST['id']=$nr->GetID();
			$bIncludeExternal =0;
			if ($bNeedIndex == 1) {
				$requesthelper = new RequestHelper();
				$nr -> SetRequestNumber($requesthelper -> GetRequestIndex($nr->GetID()));
				$nr->Save();
			};			
					
			// --- сохранение запроса ----
			if (isset($_REQUEST['saveandexit'])) {
				$this->ShowRequestsList();
				$logaction = "rSave";
			} elseif (isset($_REQUEST['saveandedit'])) {		
				$this->ShowRequestForm();
				$logaction = "rSave";					
			} elseif (isset($_REQUEST['send'])) {		
				//проверяем по id организации предусмотрено согласование в организации или нет 	

				//--- проверка нужно ли принимать в работу ----
				if ($GLOBALS['TAKEINWORK_DISABLE']!="1") {
					//alert1();
					$new_status = $GLOBALS['REQUEST_STATUS_TAKEINWORK'];//2
					$logaction = "rSendTakeInWork";
				}
				else
				{//--- пропускаем этап принятия в работу ----
				//alert2();
				$new_status = $GLOBALS['REQUEST_STATUS_CONSIDERATION'];
				$logaction = "rSendConsideration";
				$nr -> SetContractID($GLOBALS['DEFAULT_CONTRACT_ID']);
				//--- пропускаем этап принятия в работу ----
				};
								
				if (isset($_REQUEST['contractor_id'])) {
					$approver_helper = new RequestApproverHelper();
					$approvers_list = $approver_helper -> GetOrganizationApproversList($_REQUEST['contractor_id']);
					if (!empty($approvers_list)) {
						$new_status = $GLOBALS['REQUEST_STATUS_APPROVE'];//1
						$logaction = "rSendApprove";
					}
					else {
						//--- проверка нужно ли принимать в работу ----
						if ($GLOBALS['TAKEINWORK_DISABLE']!="1") {
							//alert1();
							$new_status = $GLOBALS['REQUEST_STATUS_TAKEINWORK'];//2
							$logaction = "rSendTakeInWork";
						}
						else
						{//--- пропускаем этап принятия в работу ----
						//alert2();
						$new_status = $GLOBALS['REQUEST_STATUS_CONSIDERATION'];
						$logaction = "rSendConsideration";
						$nr -> SetContractID($GLOBALS['DEFAULT_CONTRACT_ID']);
						//--- пропускаем этап принятия в работу ----
						};
						//--- проверка нужно ли принимать в работу ----
					}
				};				

				$nr -> SetStatus($new_status);
				
				$Log=new Log();								
				$Log->AddAction($logaction,'RequestAction_D:'.$nr ->GetId(),'');
				
			/*	$activity_helper = new RequestActivityHelper();
				$activity_helper -> MarkRequestUnread($nr ->GetId());*/
				
				$nr->Save();
				
				/*добавляем отправку письма*/
				$mailhelper = new MemoMailHelper();
				$mailhelper -> RequestChangeStatusNotify($nr -> GetArray());
				$notificationhelper = new NotificationHelper();
				$notificationhelper -> CreateNotificationMarks($nr -> GetStatus(), $nr -> GetId());
				/*добавляем отправку письма*/
				
				$requestactivityhelper = new RequestActivityHelper();
				$requestactivityhelper -> SetUserRead($_REQUEST['id']);

                // --- Добавляем в GET информациюю о начальном представлении [ В работе ] ---
                $_REQUEST['type'] = 'inwork';
                $_REQUEST['category'] = 'inwork';

                // --- Открываем представление с запросами ---
                $this->ShowRequestsList();
				
			}
			// --- сохранение запроса ----		
			
			if (isset($_REQUEST['approve-agree'])) $this->RequestApproveAgree();
			if (isset($_REQUEST['approve-disagree'])) $this->RequestApproveDisagree();
			if (isset($_REQUEST['take-in-work'])) $this->TakeRequestInWork();//приступить к исполнению
			if (isset($_REQUEST['works-done'])) $this->RequestWorksDone();
			
			// --- добавлено - обработка событий принятия в работу и распределения (было на стороне LN) ---
			if (isset($_REQUEST['request-take-in-work'])) $this->RequestTakeInWork(); //принять в работу от заказчика
			if (isset($_REQUEST['request-chooseexecutors'])) $this->RequestShowExecutorsList(); //
			if (isset($_REQUEST['request-consider'])) $this->RequestConsider();
			// --- добавлено - обработка событий принятия в работу и распределения (было на стороне LN) ---

		} // ShowRequestDataEdit
		
		private function ShowCompletedWorkForm() {			
			$cw = new CompletedWork($_REQUEST['id'], array());
			
			$external = array();
			$cwhelper = new CompletedWorkHelper();
			
			if (!($cwhelper->IsWorkVisidbleForUserID($_REQUEST['request_id']))) {				
				throw new ModuleAccessException("Доступ к данной работе запрещен.",0,"access");
			}
			
			if (isset($_REQUEST['request_id'])) {
				$cw -> SetRequestID($_REQUEST['request_id']);				
				$external = $cwhelper -> GetExternalDataForXML(false, $_REQUEST['request_id'], $cw -> GetExecutorID(), $cw -> GetId());	}
			else {
				$external = $cwhelper -> GetExternalDataForXML(false, 0, $cw -> GetExecutorID(), $cw -> GetId());
			}
			
			$this->xml=$this->xmlbuilder->buildXML($cw->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"CompletedWorkForm","Requests");
		}
		
		private function ShowCopyCompletedWorkForm() {
			$cw = new CompletedWork($_REQUEST['id'], array());
				
			$external = array();
			$cwhelper = new CompletedWorkHelper();
				
			if (!($cwhelper->IsWorkVisidbleForUserID($_REQUEST['request_id']))) {
				throw new ModuleAccessException("Доступ к данной работе запрещен.",0,"access");
			}
				
			if (isset($_REQUEST['request_id'])) {
				$cw -> SetRequestID($_REQUEST['request_id']);
				$external = $cwhelper -> GetExternalDataForXML(false, $_REQUEST['request_id'], $cw -> GetExecutorID(), $cw -> GetId());	}
				else {
					$external = $cwhelper -> GetExternalDataForXML(false, 0, $cw -> GetExecutorID(), $cw -> GetId());
				}
					
				$this->xml=$this->xmlbuilder->buildXML($cw->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"CopyCompletedWorkForm","Requests");
		}
		
		private function ShowCompletedWorkDataEdit() {
			if (isset($_REQUEST['exit'])) {
				//$this->ShowRequestsList();
				$request=new Request($_REQUEST['request_id']);
				$request_helper = new RequestHelper();
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
				
				return true;
			}
			
			$cw = new CompletedWork($_REQUEST['id']);	
			$cw -> SetArray($_REQUEST); 

			//fix for knowledge db
			if (isset($_REQUEST['markknow'])) 
			{$cw -> SetKnowMark(1);
			//echo "--- o k ----";
			}
			//fix for knowledge db
			
			$cw -> Save();
				
			//обновляем или создаем расходник
			if ($cw ->GetId() != 0) {
				$cw_material_helper = new CompletedWorkMaterialHelper();
				$cw_material_helper -> UpdateCompletedWorkMaterial($cw -> GetId());
			}
			//обновляем или создаем расходник
			
			// --- сохранение запроса ----
			if (isset($_REQUEST['saveandexit'])) {
	
				$Log=new Log();
				$Log->AddAction("rRegisterCompletedWork",'RequestAction_D:'.$_REQUEST['request_id'],'');
			
				//$this->ShowRequestsForm();
			} elseif (isset($_REQUEST['obsolete'])) {				
				$cw -> SetStatus(1);
				$cw -> Save();			
				$Log=new Log();
				$Log->AddAction("rObsoleteCompletedWork",'RequestAction_D:'.$_REQUEST['request_id'],'');
			
				//$this->ShowRequestForm();
			}
			// --- сохранение запроса ----			
			
			$request_helper = new RequestHelper();
			$request=new Request($_REQUEST['request_id']);
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
			
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
			
		}
		
		// для массовой регистрации работ
		private function ShowCompletedWorkDataEditMulti() {
			if (isset($_REQUEST['exit'])) {
				//$this->ShowRequestsList();
				$request=new Request($_REQUEST['request_id']);
				$request_helper = new RequestHelper();
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
		
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
		
				return true;
			}
				
			$cw = new CompletedWork($_REQUEST['id']);
			$cw -> SetArray($_REQUEST);			
		
			//fix for knowledge db
			if (isset($_REQUEST['markknow']))
			{$cw -> SetKnowMark(1);
			//echo "--- o k ----";
			}
			//fix for knowledge db
				
			$cw -> Save();
			
			//для первой работы - сохраняем расходник если он есть
			if (isset($_REQUEST['material']) & isset($_REQUEST['count'])) {
				$cw_material = new CompletedWorkMaterial();
				$cw_material -> SetMaterial($_REQUEST['material']);
				$cw_material -> SetWorkID($cw -> GetId());
				$cw_material -> SetCount($_REQUEST['count']);
				
				$cw_material -> Save();
			};			
			//для первой работы - сохраняем расходник если он есть
			
			//--- fix для массовой регистрации работ ---
			if (isset($_REQUEST['works-count'])) {
				$works_count = intval($_REQUEST['works-count']);
								
				if ($works_count>=1) {					
					for ($i = 1; $i <= $works_count; $i++) {						
						if (isset($_REQUEST['service_contract-'.$i])) {							
							$cw_multi = new CompletedWork($_REQUEST['id']);
							$cw_multi -> SetArray($_REQUEST);
							
							$cw_multi -> SetServiceContract($_REQUEST['service_contract-' .$i]);
							$cw_multi -> SetDateStart($_REQUEST['date_start-' .$i]);
							$cw_multi -> SetPeriod($_REQUEST['period-' .$i]);
							$cw_multi -> SetComment($_REQUEST['comment-' .$i]);
							
							$cw_multi -> Save();
							
							//--- fix для регистрации материалов ---
							if (isset($_REQUEST['material-'.$i]) & isset($_REQUEST['count-'.$i])) {
								$material = $_REQUEST['material-'.$i];
								$count = $_REQUEST['count-'.$i];
								if ($material!="" & intval($count)<>0) {
									$cw_material = new CompletedWorkMaterial();
									$cw_material -> SetMaterial($material);
									$cw_material -> SetWorkID($cw_multi -> GetId());
									$cw_material -> SetCount($count);
				
									$cw_material -> Save();
								}
							}	
							//--- fix для регистрации материалов ---
						}
					}
				}
			}			
			//--- fix для массовой регистрации работ ---
				
			// --- сохранение запроса ----
			if (isset($_REQUEST['saveandexit'])) {
		
				$Log=new Log();
				$Log->AddAction("rRegisterCompletedWork",'RequestAction_D:'.$_REQUEST['request_id'],'');
					
				//$this->ShowRequestsForm();
			} elseif (isset($_REQUEST['obsolete'])) {
				$cw -> SetStatus(1);
				$cw -> Save();
				$Log=new Log();
				$Log->AddAction("rObsoleteCompletedWork",'RequestAction_D:'.$_REQUEST['request_id'],'');
					
				//$this->ShowRequestForm();
			}
			// --- сохранение запроса ----
							
			$request_helper = new RequestHelper();
			$request=new Request($_REQUEST['request_id']);
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
				
		}
		// для массовой регистрации работ
		
		private function ShowRequirementForm () {
			$requirement = new Requirement($_REQUEST['id']);			
			$this->xml=$this->xmlbuilder->buildXML($requirement->GetArrayForXML(false, array()));
			$this->html.=$this->xsltemplate->build($this->xml, "RequirementForm", "Requests");			
		}
		
		private function ShowRequirementDataEdit() {			
			if (isset($_REQUEST['cancel'])) {
				$request=new Request($_REQUEST['request_id']);
				$request_helper = new RequestHelper();
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
				
			} elseif (isset($_REQUEST['saveandexit'])) {
				$requirement = new Requirement();
				$requirement -> SetStatus(0);
				$requirement -> SetQuantity($_REQUEST['quantity']);
				$requirement -> SetPosition($_REQUEST['position']);
				$requirement -> SetRequestID($_REQUEST['requestid']);
				$requirement -> SetPartNumber($_REQUEST['partnumber']);				
				$requirement -> Save();	
			
				$request=new Request($_REQUEST['requestid']);
				
				$Log=new Log();
				$Log->AddAction("rCreateRequirement:" .$requirement -> GetId(),'RequestAction_D:'.$request ->GetId(),'');
								
				$request_helper = new RequestHelper();				
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
			}
		}
		
		private function NewRequirement() {
			//if (isset($_REQUEST['requestid'])) {
				$requirement = new Requirement();
				$requirement -> SetQuantity($_REQUEST['quantity']);
				$requirement -> SetPosition($_REQUEST['position']);			
				$requirement -> SetPartNumber($_REQUEST['quantity']);
				$requirement -> Save();
				
				$request_helper = new RequestHelper();
				$request=new Request($_REQUEST['requestid']);							
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
		}
		
		private function RequestApproveAgree() {			
			$request = new Request($_REQUEST['id'], array());
			$status = $request -> GetStatus();
			//согласование - отправляем на принятие в работу
			if ($status == $GLOBALS['REQUEST_STATUS_APPROVE']) {
				
				//--- проверка нужно ли принимать в работу ----
				if ($GLOBALS['TAKEINWORK_DISABLE']!="1") {
					//alert1();
					$new_status = $GLOBALS['REQUEST_STATUS_TAKEINWORK'];//2
					$logaction = "rSendTakeInWork";
				}
				else
				{//--- пропускаем этап принятия в работу ----
				//alert2();
				$new_status = $GLOBALS['REQUEST_STATUS_CONSIDERATION'];
				$logaction = "rSendConsideration";
				$request -> SetContractID($GLOBALS['DEFAULT_CONTRACT_ID']);
				//--- пропускаем этап принятия в работу ----
				};
				//--- проверка нужно ли принимать в работу ----
				
				$request -> SetStatus($new_status);//2
				//$logaction = "rSendTakeInWork";
				$request->Save();	
			//	alert2();			
			};
			//согласование - отправляем на принятие в работу
			
			//подтверждение исполнения - перемещаем в исполнено //6
			if ($status == $GLOBALS['REQUEST_STATUS_CONFIRMATION'])  {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_DONE']);//7
				$logaction = "rDone";
				$request->Save();
			};
			//подтверждение исполнения - перемещаем в исполнено
			
			$Log=new Log();
			$Log->AddAction($logaction,'RequestAction_D:'.$request ->GetId(),'');
			
			//создаем запись в таблице с уведомлениями
			$notificationhelper = new NotificationHelper();
			$notificationhelper -> CreateNotificationMarks($request -> GetStatus(), $request ->GetId());
			//создаем запись в таблице с уведомлениями
			
			$activity_helper = new RequestActivityHelper();
			$activity_helper -> MarkRequestUnread($request ->GetId());
			
			//добавляем создание записи для синхронизации - перенесено в основное действие	
			$this->ShowRequestsList();
		}
		
		// --- действия (взять в работу и рассмотрено) добавлены после отказа от связи с лотусом ---
		private function RequestTakeInWork() {
			$request = new Request($_REQUEST['id'], array());
			$status = $request -> GetStatus();
			
			//проверяем что выбрали договор			
			if ($_REQUEST['contract_id']=="0" | $_REQUEST['contract_id']=="") {
				$exception = new Xception("Не выбран договор.",1,"info");
				$exception -> ShowMessage();
				$this -> ShowRequestForm();
				//$exception -> getMessage();
				return false;
			};
			
			//согласование - отправляем на принятие в работу
			if ($status == $GLOBALS['REQUEST_STATUS_TAKEINWORK']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_CONSIDERATION']);//2
				$logaction = "rConsiderationTakeInWork";
				$request->Save();
			};
			//согласование - отправляем на принятие в работу				
						
			$Log=new Log();
			$Log->AddAction($logaction,'RequestAction_D:'.$request ->GetId(),'');
			
			//создаем запись в таблице с уведомлениями
			$notificationhelper = new NotificationHelper();
			$notificationhelper -> CreateNotificationMarks($request -> GetStatus(), $request ->GetId());
			//создаем запись в таблице с уведомлениями
				
			//добавляем создание записи для синхронизации - перенесено в основное действие
			$this->ShowRequestsList();
		}
		
		private function RequestShowExecutorsList() {
            $parameters=array();
			$UserHelper=new UserHelper();			
			
			$elar=array();
			$elar['name']="Request";
			$request = array();
			$request['id']=$_REQUEST['id'];
			$elar['attributes'] = $request;
			$externaldata[]=$elar;					
													
			$this->xml=$this->xmlbuilder->buildXML($UserHelper->GetUsersListForXML($parameters, false, $externaldata, "secondname", "ASC"));
			
			$access = new Access();
			$user = $access -> GetCurrentUser();
			$id = $user -> GetId();
			
			if ($id == 238) {
				$this->html.=$this->xsltemplate->build($this->xml,"CopyExecutorsList","Requests");
			}
			else {
				$this->html.=$this->xsltemplate->build($this->xml,"CopyExecutorsList","Requests");
			}
		}
		
		private function RequestConsider() {
			$request = new Request($_REQUEST['id'], array());
			$status = $request -> GetStatus();
			
			//проверяем на наличие выбранных исполниетелей
			$requesthelpher = new RequestExecutorHelper();
			$list=$requesthelpher -> GetRequestExecutorsList($_REQUEST['id']);
			
			if (empty($list)) {
				$exception = new Xception("Не выбраны исполнители по текущему запросу.",1,"info");
				$exception -> ShowMessage();
				$this -> ShowRequestForm();
				//$exception -> getMessage();
				return false;
			};
			
			//согласование - отправляем на принятие в работу
			if ($status == $GLOBALS['REQUEST_STATUS_CONSIDERATION']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_INWORK']);//2
				$logaction = "rConsiderationConsidered";
				$request->Save();
			};
			//согласование - отправляем на принятие в работу

			$Log=new Log();
			$Log->AddAction($logaction,'RequestAction_D:'.$request ->GetId(),'');
			
			$activity_helper = new RequestActivityHelper();
			$activity_helper -> MarkRequestUnreadForUserID($request -> GetId(), $request -> GetAuthorID());
									
			//создаем запись в таблице с уведомлениями
			$notificationhelper = new NotificationHelper();
			$notificationhelper -> CreateNotificationMarks($request -> GetStatus(), $request ->GetId());
			//создаем запись в таблице с уведомлениями
		
			//добавляем создание записи для синхронизации - перенесено в основное действие
			$this->ShowRequestsList();
		}
		
		private function RequestChooseExecutors() {
			if (isset($_REQUEST['cancel'])) {
				$this -> ShowRequestForm();
				//break;
			}
			elseif (isset($_REQUEST['saveandexit'])) {				
				$bByStaticData = true;
				
				if (isset($_REQUEST['selected-executors-count'])) {
					$nExecutors = intval($_REQUEST['selected-executors-count']);
					if ($nExecutors > 0) {$bByStaticData = false;}
				}
				
				if ($bByStaticData) {
					if (!isset($_REQUEST['staticdata'])) {
						$exception = new Xception("Не выбраны исполнители по текущему запросу",1,"info");
						$exception -> ShowMessage();
						$this->RequestShowExecutorsList();
						return false;
					}
					
					$executorhelper = new RequestExecutorHelper();
					$executorhelper -> UpdateExecutors($_REQUEST['id']);
					//$this -> ShowRequestForm();
					$this->RequestConsider(); // Отправляем запрос сразу на этап "Исполнение"
					//break;
				} 
				else {
					for ($ii = 1; $ii <= intval($_REQUEST['executors-count']); $ii++) {
						if (isset($_REQUEST['executor-' .strval($ii)])) {							
							$executor = new RequestExecutor();
							$executor -> SetExecutantType(1);
							$executor -> SetTakeInWork(0);
							$executor -> SetRequestID($_REQUEST['id']);
							$executor -> SetExecutorID($_REQUEST['executor-' .$ii]);
							$executor -> Save();
						}
					}
										
					$this->RequestConsider();
				}						                
			}
		}		
				
		// --- действия (взять в работу и рассмотрено) добавлены после отказа от связи с лотусом ---
		
		private function ApproveDisagreeWithComment() {
			$this->RequestApproveDisagree();			
		}
		
		private function RequestApproveDisagree() {
			$request = new Request($_REQUEST['id'], array());
			$status = $request -> GetStatus();
			//согласование - возвращаем на этап создания с этара согласования //1
			if ($status == $GLOBALS['REQUEST_STATUS_APPROVE']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_NEW']); //0
				$request -> SetComment($_REQUEST['comment']); //0
				$logaction = "rReturnedToAuthor; Причина - " .$_REQUEST['comment'];
				$request->Save();
			};
			//согласование - возвращаем на этап создания
			
			//согласование - отклоняем, а не возвращаем на этап создания с этапа принятия в работу //
			if ($status == $GLOBALS['REQUEST_STATUS_TAKEINWORK']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_DECLINE']); //0
				$request -> SetComment($_REQUEST['comment']); //0
				$logaction = "rReturnedToAuthor; Причина - " .$_REQUEST['comment'];
				$request->Save();
			};
			//согласование - отклоняем, а не возвращаем на этап создания
			
			//распределение - отклоняем, а не возвращаем на этап создания с этапа принятия в работу //
			if ($status == $GLOBALS['REQUEST_STATUS_CONSIDERATION']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_DECLINE']); //0
				$request -> SetComment($_REQUEST['comment']); //0
				$logaction = "rReturnedToAuthor; Причина - " .$_REQUEST['comment'];
				$request->Save();
			};
				
			//подтверждение исполнения - возвращаем на исполнение работ //6
			if ($status == $GLOBALS['REQUEST_STATUS_CONFIRMATION']) {
				$request -> SetStatus($GLOBALS['REQUEST_STATUS_CONSIDERATION']); //3
				$logaction = "rReturnedInWork";
				$request->Save();
			};
			//подтверждение исполнения - возвращаем на исполнение работ
			
			$Log=new Log();
			$Log->AddAction($logaction,'RequestAction_D:'.$request ->GetId(),'');
			
			$activity_helper = new RequestActivityHelper();
			$activity_helper -> MarkUnread($request ->GetId());
			$activity_helper -> SetUserRead($request -> GetId());
			//$activity_helper -> MarkRequestUnreadForUserID($request -> GetId(), $request -> GetAuthorID());
			//$activity_helper -> MarkRequestUnread($request ->GetId());
			
			//создаем запись в таблице с уведомлениями
			$notificationhelper = new NotificationHelper();
			$notificationhelper -> CreateNotificationMarks($request -> GetStatus(), $request ->GetId());
			//создаем запись в таблице с уведомлениями
				
            // --- Добавляем в GET информациюю о начальном представлении [ В работе ] ---
            $_REQUEST['type'] = 'inwork';
            $_REQUEST['category'] = 'inwork';

            // --- Открываем представление с запросами ---
			$this->ShowRequestsList();
		}
		
		private function TakeRequestInWork() {
			$request = new Request($_REQUEST['id'], array());
			$access = new Access();
			$user = $access -> GetCurrentUser();
			
			$requestexecutorhelper = new RequestExecutorHelper();
			$executor_record = $requestexecutorhelper -> GetRequestExecutorByUserID($request->GetId(), $user->GetId());

			if (!empty($executor_record)) {								
					$requestexecutor = new RequestExecutor($executor_record['id'], array());					
					$requestexecutor -> SetTakeInWork(1);//1
					$logaction = "rTakeInWork";
					$requestexecutor -> Save();				
			};
			
			$Log=new Log();
			$Log->AddAction($logaction,'RequestAction_D:'.$request ->GetId(),'');

			//добавляем создание записи для синхронизации - перенесено в основное действие				
			$this->ShowRequestForm();
		}
		
		private function RequestWorksDone() {
			$request = new Request($_REQUEST['id'], array());
			//отправляем на этап отметки об исполнении			
			$request -> SetStatus($GLOBALS['REQUEST_STATUS_CONFIRMATION']);//($GLOBALS['REQUEST_STATUS_COMPLETE']);//5
			$request->Save();
			
			$Log=new Log();
			$Log->AddAction("rWorksDone",'RequestAction_D:'.$request ->GetId(),'');
			$Log->AddAction("rSendComplete",'RequestAction_D:'.$request ->GetId(),'');	

			$activity_helper = new RequestActivityHelper();
			$activity_helper -> MarkRequestUnreadForUserID($request ->GetId(), $request -> GetAuthorID());
			
			//создаем запись в таблице с уведомлениями
			$notificationhelper = new NotificationHelper();
			$notificationhelper -> CreateNotificationMarks($request -> GetStatus(), $request ->GetId());
			//создаем запись в таблице с уведомлениями
						
			//добавляем создание записи для синхронизации - перенесено в основное действие	
			$this->ShowRequestsList();
		}
		
		private function RemoveAttach() {
			$uploadsfilehelper = new UploadsFileHelper();
			$requestsuploadshelper = new RequestsUploadsHelper();
			
			if (isset($_REQUEST['id']) and isset($_REQUEST['fileid'])) {
				$requestsuploadshelper -> DeleteRequestUpload($_REQUEST['id'], $_REQUEST['fileid']);
			};	
			
			$this -> ShowRequestForm();		
		}
		
		private function PrintRequest() {
			if (isset($_REQUEST['id'])) {
				$pdfprinter = new PDFPrinter();
				$pdfprinter -> ExportRequestToPDF($_REQUEST['id']);
				$this -> ShowRequestForm();
			}
		}
		
		private function DefectDataEdit() {
			if (isset($_REQUEST['saveandexit'])) {
				$defect = new Defect();				
				$defect -> SetArray($_REQUEST);
				$defecthelper = new DefectHelper();
				$defect -> SetNumber($defecthelper -> GetDefectIndex());
				
				$defect -> Save();
			
			
				$request=new Request($_REQUEST['request_id']);
				$request_helper = new RequestHelper();				
							
				$name = "Акт о дефектации № " .$defect -> GetNumber() .".pdf";
			
				$uplfiles = new UploadsFile();
				$defectupload = new RequestDefectUpload();
			
				$defectupload -> SetName($name);
				
				$access = new Access();
				$defectupload -> SetUserid($access -> GetCurrentUser() -> GetId());
				
				$defectupload -> SetRequestID($_REQUEST['request_id']);
				$defectupload -> SetDefectID($defect -> GetId());
				//$defectupload -> SetFileID();
				$defectupload -> SetStatus(0);
				$defectupload -> SetFilePath();
				$defectupload -> GenUniqName();
				$defectupload -> Save();				
							
				//создаем pdf, копируем на фтп и удаляем
				$pdfprinter = new PDFPrinter();
				$path = "uploads/" .$defectupload -> GetPathName() ."/" .$defectupload -> GetUniqName();
				$pdfprinter -> ExportDefectToPDF($path, $defect -> GetId(), "F");
					
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
			}
		}
		
		private function DefectPrint() {
			$pdfprinter = new PDFPrinter();
			$pdfprinter -> ExportDefectToPDF("", $_REQUEST['defect_id'], "D");
			$this -> ShowRequestForm();
		}
		
		private function DefectRemove() {
			if (isset($_REQUEST['defect_id'])) {
				$defect = new Defect($_REQUEST['defect_id']);
				$defect -> SetObsoleteStatus(1);
				$defect -> Save();
				
				$request=new Request($_REQUEST['id']);
				$request_helper = new RequestHelper();
				$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
				$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");
				return true;
			}
		}
		
		private function ShowSatisfactionDataEdit() {
			$satisfaction = new Satisfaction();
			$satisfaction -> SetComment($_REQUEST['comment']);
			$satisfaction -> SetRequestID($_REQUEST['requestid']);			
			$access = new Access();
			$satisfaction -> SetAuthorID($access -> GetCurrentUser() -> GetId());			
			$satisfaction -> Save();
			
			$satisfactionhelper = new SatisfactionHelper();
			$satisfactionhelper -> FillSatisfactionParams($satisfaction -> GetId());			

			$request=new Request($_REQUEST['requestid']);
			$request_helper = new RequestHelper();
			
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
			
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");			
		}

		private function AddRequestMessage() {
			$message = new Message();
			$message -> setcomment($_REQUEST['comment']);
			$message -> setrequestid($_REQUEST['request_id']);
			$message -> save();			

			$request=new Request($_REQUEST['request_id']);
			$request_helper = new RequestHelper();
				
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
			
		/*	$activity_helper = new RequestActivityHelper();
			$activity_helper -> MarkRequestUnread($request ->GetId());*/
				
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");			
		}

	public function ShowReceiptDataEdit() {			
			$receipt = new TrustReceipt();
			$receipt -> SetReceipt($_REQUEST['receipt']);
			$receipt -> SetRequestID($_REQUEST['request_id']);
			$receipt -> Save();						

			$request=new Request($_REQUEST['request_id']);
			$request_helper = new RequestHelper();
				
			$external = $request_helper -> GetExternalDataForXML(false, $request -> GetArray());
				
			$this->xml=$this->xmlbuilder->buildXML($request->GetArrayForXML(false, $external));
			$this->html.=$this->xsltemplate->build($this->xml,"RequestsForm","Requests");			
		}
		
		public function ReceiptPrint() {
			$printer = new PDFPrinter();
			$trustreceipt = new TrustReceipt($_REQUEST['receipt_id']);
			$printer -> ExportTrustReceiptToPDF($_REQUEST['id'], $trustreceipt -> GetReceipt());
			
			$this -> ShowRequestForm();
		}
		
		public function ReceiptCancel() {			
			$trustreceipt = new TrustReceipt($_REQUEST['receipt_id']);
			$trustreceipt -> SetStatus(2);
			$trustreceipt -> Save();
			$this -> ShowRequestForm();
		}
		
		public function ReceiptRemove() {			
			$trustreceipt = new TrustReceipt($_REQUEST['receipt_id']);
			$trustreceipt -> SetStatus(1);
			$trustreceipt -> Save();
			
			$this -> ShowRequestForm();
		}
		
		public function ShowCompletedWorkFormMulti() {
			/*echo "ok";
			$this->xml = "<Test></Test>";
			$this->html.=$this->xsltemplate->build($this->xml,"CompletedWorkFormMulti","Requests");*/
			
			$cw = new CompletedWork($_REQUEST['id'], array());
				
			$external = array();
			$cwhelper = new CompletedWorkHelper();
				
			if (!($cwhelper->IsWorkVisidbleForUserID($_REQUEST['request_id']))) {
				throw new ModuleAccessException("Доступ к данной работе запрещен.",0,"access");
			}
				
			if (isset($_REQUEST['request_id'])) {
				$cw -> SetRequestID($_REQUEST['request_id']);
				$external = $cwhelper -> GetExternalDataForXML(false, $_REQUEST['request_id'], $cw -> GetExecutorID(), $cw -> GetId());	}
				else {
					$external = $cwhelper -> GetExternalDataForXML(false, 0, $cw -> GetExecutorID(), $cw -> GetId());
				}
					
				$this->xml=$this->xmlbuilder->buildXML($cw->GetArrayForXML(false, $external));
				$this->html.=$this->xsltemplate->build($this->xml,"CompletedWorkFormMulti","Requests");
			
		}
		
		public function ShowRequestLog() {
			if (!isset($_REQUEST['request_id'])) {return false;};
			
			$request_id = $_REQUEST['request_id'];
			$log_helper = new LogHelper();
			
			$this->xml=$this->xmlbuilder->buildXML($log_helper -> getRequestActionsListForXML($request_id));			
			$this->html=$this->xsltemplate->build($this->xml,"RequestLog","Requests");
		}
		
		public function ShowRequestMessages() {
			if (!isset($_REQUEST['request_id'])) {return false;};
				
			$request_id = $_REQUEST['request_id'];
			$msg_helper = new MessageHelper();
				
			$this->xml=$this->xmlbuilder->buildXML($msg_helper -> getRequestMessagesListForXML($request_id));
			$this->html=$this->xsltemplate->build($this->xml,"RequestMessages","Requests");
		}
		
		public function ShowRequestCompletedWorks() {
			if (!isset($_REQUEST['request_id'])) {return false;};
				
			$request_id = $_REQUEST['request_id'];
			$executorhelper = new RequestExecutorHelper();
			$completedworkhelper = new CompletedWorkHelper();
						
			$this->xml=$this->xmlbuilder->buildXML($completedworkhelper -> GetRequestCompletedWorksListForXML(array(), false, $executorhelper -> GetRequestExecutantsForXML($request_id), $request_id));
			//$this->xml=$this->xmlbuilder->buildXML($executorhelper -> GetRequestExecutantsForXML($request_id));
			$this->html=$this->xsltemplate->build($this->xml,"RequestCompletedWorks","Requests");
		}
		
		private function UnitsNotify() {
			if (isset($_REQUEST['key'])) {
				$key_to_check = md5($GLOBALS['MAIL_NOTIFICATION_KEY']);
				$request_key = $_REQUEST['key'];
					
				if ($key_to_check == $request_key) {
					$notificationhelper = new NotificationHelper();
					$notificationhelper -> Notify();
				}
			}
			
		}
		
		private function GetMaterials() {
			$cw_helper = new CompletedWorkHelper();
			$cw_helper -> GetMaterials();
		}

        private function ShowRequestsListBySearch() { // Выводит список запросов по результатам поиска
            $RequestHelper = new RequestHelper();

            $access = new Access();
            $user = $access -> GetCurrentUser();

            $this->xml=$this->xmlbuilder->buildXML($RequestHelper->GetRequestsListForXML(true, array()));
            $this->html.=$this->xsltemplate->build($this->xml,"RequestsList", "Requests");
        }
        
        private function ShowNotificationAPI() {
        	$request_helper = new RequestHelper();
        	
        	$access = new Access();
        	$user = $access -> GetCurrentUser();
        		
        	$this->xml=$this->xmlbuilder->buildXML($request_helper -> GetRequestNotificationsListForXML($user->GetId()));
        	$this->html=$this->xsltemplate->build($this->xml,"NotificationAPI","Requests");
        }
		
		public function GetXML() {
			return $this->xml;
		}
		
		public function GetHTML() {
			return $this->html;
		}
// ==========================================================		
	} //EventHandler
// ==========================================================	
	
	$Access = New Access;
	if(!$Access->IsLogin()) {
		
		if ($_REQUEST['action'] != "units-notify") {
			$Access->LogOut();
			throw new ModuleAccessException("Доступ к модулю Запросы разрешен только авторизованным пользователям.",0,"access");
		}		
	}
		
	if (isset($_REQUEST['id'])) $RequestID = $_REQUEST['id'];
	
	$event_handler=new EventHandler();
	echo $event_handler->GetHTML();

//	if ($Access->IsAdministrator() | isset($_REQUEST['adminmode'])) {
	if (isset($_REQUEST['adminmode'])) {
		echo '<textarea cols="100" rows="40">'.$event_handler->GetXML().'</textarea>';
		
		echo "Request:";
		var_dump($_REQUEST);
		
		echo "Get:";
		var_dump($_GET);
		
		/*echo "Files:";
		 var_dump($_FILES['filename']['tmp_name']);*/
	}
/*	
	if ($Access->IsAdministrator()) {
		echo "Request:";
		var_dump($_REQUEST);
		
		echo "Get:";
		var_dump($_GET);
		
		echo '<textarea cols="100" rows="40">'.$event_handler->GetXML().'</textarea>';
	}
*/	
/*
	echo "Request:";
	var_dump($_REQUEST);
	
	echo "Get:";
	var_dump($_GET);
	
	echo '<textarea cols="100" rows="40">'.$event_handler->GetXML().'</textarea>';
*/
	// Определяем что показывать
	$parameters = $pc->GetURIParameters();
	$level = count($parameters);	
		
}

catch (ModuleAccessException $e) { echo $e->ShowMessage(); }
catch (UrlErrorException $e) { echo $e->ShowMessage(); }
catch (InformationException $e) { echo $e->ShowMessage(); }
catch (ErrorsException $e) { echo $e->ShowMessage(); }

 ?>