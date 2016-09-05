<?php
try {
	class EventHandler {
		private $xml;
		private $html;
		
		private $db;
		private $pc;
		private $prefix;
		
		private $xsltemplate;
		private $xsltemplatehelper;
		private $xmlbuilder;
		
		function __construct() {
			$this->html="";
			$this->xml="";
			
			$this->db=DbController::GetDatabaseInstance(); // DB
			$this->pc=PageController::getInstance(); // PageController
			$this->prefix=$GLOBALS['DB_PREFIX'];
			
			$this->xsltemplate=new XslTemplate();
			$this->xsltemplatehelper=new XSLTemplateHelper();
			$this->xmlbuilder=new XMLBuilder();
			
			if (!isset($_REQUEST['action'])) {
				$_REQUEST['action']="Default";
			}
			switch ($_REQUEST['action']) {
				case "reports-showlist":
					$this->ShowReportsList();
					break;
				case "reports-uploadnew":
					$this->SaveReportForLabwork();
					break;
				case "depts-showlist":
					$this->ShowDeptsListForUser();
					break;
				case "depts-uploadnewreferat":
					$this->SaveReferatForDept();
					break;
				case "user-editinfo":
					$this->EditUserInfo();
					break;
				default:
					$this->html.='<h2>Мои Файлы</h2>';
			}
		}
		
		private function ShowReportsList() {
			$upload=new UploadsFile();
			$itemrcmhelper=new rcmstudentsreporthelper();
			$labworkhelper=new RCMLabworkHelper();
			$current_user=new User(0,array('load_current_user'=>true));
			
			$this->xml.=$this->xmlbuilder->buildXML($itemrcmhelper->GetReportsListByUserForXML($current_user->GetStudentId(),$labworkhelper->GetRCMLabworkListForXML()));
			$this->html.=$this->xsltemplate->build($this->xml,"RCMStudentsReportsList","RCM/StudentsReports");
		}
		
		public function SaveReportForLabwork() {
			$uplfiles=new UploadsFile();
			$reporthelper=new rcmstudentsreporthelper();
			$current_user=new User(0,array('load_current_user'=>true));
			
			if (isset($_REQUEST['delreport'])) {
				$reporthelper->DeleteReport($_REQUEST['report_id']);
			}
			if (isset($_REQUEST['save'])) {
				if ($_REQUEST['labwork_id']!="") {
					$studentsreport=new RCMStudentsReport();
					$studentsreport->SetName($_FILES['uploadfile']['name']);
					$studentsreport->SetUserId($current_user->GetId());
					$studentsreport->SetStudentid($current_user->GetStudentId());
					$studentsreport->SetLabworkId($_REQUEST['labwork_id']);
					$studentsreport->GenUniqName();
					$filepath=$studentsreport->GetPath();
					if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $filepath))
					{
						$studentsreport->Save();
					}
					else {$html.= "Error";}	
				} else {
					throw InformationException("Не выбран курс. Файл не сохранен.",1,"info");
				}
			}
			$this->ShowReportsList();
		}
		
		private function ShowDeptsListForUser() {
			$uplfiles=new UploadsFile();
			$reporthelper=new rcmstudentsreporthelper();
			$current_user=new User(0,array('load_current_user'=>true));
			$depthelper=new RCMStudentDeptsHelper();
			
			$this->xml.=$this->xmlbuilder->buildXML($depthelper->GetRCMStudentsDeptsByUserForXML($current_user->GetId()));
			$this->html.=$this->xsltemplate->build($this->xml,"RCMStudentsDeptsList","RCM/StudentsDepts");
		}
		
		public function SaveReferatForDept() {
			$uplfiles=new UploadsFile();
			$referathelper=new RCMStudentsReferatHelper();
			$current_user=new User(0,array('load_current_user'=>true));
			
			if (isset($_REQUEST['delreferat'])) {
				$referathelper->DeleteReferat($_REQUEST['referat_id']);
			}
			if (isset($_REQUEST['upload'])) {
				if ($_REQUEST['dept_id']!="") {
					$studentsreferat=new RCMStudentsReferat();
					$studentsreferat->SetName($_FILES['uploadfile']['name']);
					$studentsreferat->SetUserId($current_user->GetId());
					$studentsreferat->SetDeptId($_REQUEST['dept_id']);
					$studentsreferat->GenUniqName();
					$filepath=$studentsreferat->GetPath();
					if (copy($_FILES['uploadfile']['tmp_name'],$filepath)) {
						$studentsreferat->Save();
					} else {
						$html.="Error";
					}
				} else {
					throw InformationException("Не выбран тест. Файл не сохранен.",1,"info");
				}
			}
			$this->ShowDeptsListForUser();
		}
		
		public function EditUserInfo() {
			$current_user=new User(0,array('load_current_user'=>true));
			$errors=array();
			$messages=array();
			
			if (isset($_REQUEST['save-notification'])) {
				if (isset($_REQUEST['notify'])) {
					if (!isset($_REQUEST['email'])) {
						$errors[]="email-non-exist-error";
					}
					if (preg_match('/[-0-9A-Za-z_.]+@[-0-9a-z_]+\.[a-z]{2,6}/i',$_REQUEST['email'],$regs)) {
						$email=$regs[0];
					} else {
						$errors[]="email-not-correct-error";
					}
				} else {
					$email = '';
				}
				
				if (count($errors)==0) {
					
					$current_user->SetEmail($email);
					$current_user->Save();
					
					//добавляем в таблицу сведения о необходимости отправлять уведомления
					$userhelper = new UserHelper();
					if (isset($_REQUEST['notify']) & $_REQUEST['email'] <> "") {
						$userhelper -> SetNotify($current_user -> GetId());
					}
					else {
						$userhelper -> UnsetNotify($current_user -> GetId());
					}
					//добавляем в таблицу сведения о необходимости отправлять уведомления
				}
				
			}
			
			if (isset($_REQUEST['save-password'])) {
				// Проверяем пароль
				if (isset($_REQUEST['new_password'])&&!empty($_REQUEST['new_password'])) {
					if (!isset($_REQUEST['new_password_copy'])||empty($_REQUEST['new_password_copy'])||$_REQUEST['new_password']!=$_REQUEST['new_password_copy']) {
						$errors[]="password-and-copy-not-same-error";
					}
					if ((strlen($_REQUEST['new_password'])<3)&&($_REQUEST['new_password']!='')) {
						$errors[]="password-too-short-error";
					}
					
					if (count($errors)==0) {
						if (!empty($_REQUEST['new_password'])) {
							$current_user->SetPassword($_REQUEST['new_password']);
							$current_user->Save();}
						}
					}
			}
					
			if (isset($_REQUEST['saveinfo'])) {
				//alert();
				// Проверяем пароль
				/*if (isset($_REQUEST['new_password'])&&!empty($_REQUEST['new_password'])) {
					if (!isset($_REQUEST['new_password_copy'])||empty($_REQUEST['new_password_copy'])||$_REQUEST['new_password']!=$_REQUEST['new_password_copy']) {
						$errors[]="password-and-copy-not-same-error";
					}
					if ((strlen($_REQUEST['new_password'])<3)&&($_REQUEST['new_password']!='')) {
						$errors[]="password-too-short-error";
					}
				}
				*/
				/* отключаем проверку kaptcha 23/09/15
				// проверяем Captcha
				if (!isset($_REQUEST['keystring'])||$_REQUEST['keystring']!=$_SESSION['keystring']['default']||empty($_REQUEST['keystring'])) {
					$errors[]="captcha-not-valid";
				} else {
					unset($_SESSION['keystring']['user_registration']);
				}
				отключаем проверку kaptcha */
				
				//Проверяем заполенны ли остальные обязательные поля.
				if (!isset($_REQUEST['second_name'])) {
					$errors[]="second_name-not-exist-error";
				}
				if (!isset($_REQUEST['first_name'])) {
					$errors[]="first_name-not-exist-error";
				}
				
				if (isset($_REQUEST['notify'])) {
					if (!isset($_REQUEST['email'])) {
						$errors[]="email-non-exist-error";
					}
					if (preg_match('/[-0-9A-Za-z_.]+@[-0-9a-z_]+\.[a-z]{2,6}/i',$_REQUEST['email'],$regs)) {
						$email=$regs[0];
					} else {
						$errors[]="email-not-correct-error";
					}
				} else {
					$email = '';
				}
								
				if (count($errors)==0) {
					/*if (!empty($_REQUEST['new_password'])) {
						$current_user->SetPassword($_REQUEST['new_password']);
					}*/
					$current_user->SetFirstname($_REQUEST['first_name']);
					$current_user->SetSecondname($_REQUEST['second_name']);
					$current_user->SetPatronymic($_REQUEST['patronymic']);
				//	$current_user->SetEmail($email);
					$current_user->Save();
					
					/*
					//добавляем в таблицу сведения о необходимости отправлять уведомления
					$userhelper = new UserHelper();
					if (isset($_REQUEST['notify']) & $_REQUEST['email'] <> "") {
						$userhelper -> SetNotify($current_user -> GetId());
					}
					else {
						$userhelper -> UnsetNotify($current_user -> GetId());
					}
					//добавляем в таблицу сведения о необходимости отправлять уведомления
					 */
					
					//добавляем создание записи для синхронизации
					
				/*	$synchronization_record = new Synchronization();
					
					$synchronization_record -> SetType("Users");
					$synchronization_record -> SetSourceID($current_user->GetId());
					
					$synchronization_record -> Save();
					
					$synchelper = new SynchronizationHelper();
					$synchelper -> FWSynchronizationForElement($current_user -> GetArray(), "Users", $synchronization_record -> GetArray());
						
					*/
					$messages[]="user-edit-successfull-message";
				} else {
					$messages[]="user-edit-errors-message";
				}
			}
			
			$root_xml=$current_user->GetArrayForXML();
			
			$root_xml[0]['attributes']['sess_name']=session_name();
			$root_xml[0]['attributes']['sess_id']=session_id();
			
			if (count($errors)>0) {
				$root_xml[0]['childs'][0]['name']="Errors";
				foreach ($errors as $error) {
					$root_xml[0]['childs'][0]['childs'][]=array('name'=>'Error','attributes'=>array('code'=>$error));
				}
			}
			
			if (count($messages)>0) {
				$root_xml[0]['childs'][1]['name']="Messages";
				foreach ($messages as $message) {
					$root_xml[0]['childs'][1]['childs'][]=array('name'=>'Message','attributes'=>array('code'=>$message));
				}
			}
			$this->xml.=$this->xmlbuilder->buildXML($root_xml);
			$this->html.=$this->xsltemplate->build($this->xml,"UserInfoForm","PersonalRoom");
		}
		
		public function ShowStudentsResult() { //временная функция для вывода итоговых оценок пользователя
			$current_user=new User(0,array('load_current_user'=>true));
			$sec=new RCMQuestionSequence();
			
			$query="SELECT id, title FROM {$this->prefix}_rcm_courses_table WHERE `id`<>15 ORDER BY `id`";
			$result=$this->db->Query($query);
			$array=$result->GetAllRows(MYSQL_ASSOC);
			
			$out=array();
			$out['name']="RCMCourses";
			$sum=0;
			$count=0;
			foreach ($array as $element) {
				$elar=array();
				$mark=$sec->GetMarkForCourse($current_user->GetId(),$element['id']);
				$elar['name']="RCMCourse";
				$elar['attributes']=$element;
				$elar['attributes']['mark']=$mark;
				$out['childs'][]=$elar;
				if (is_double($mark)&&$mark!=0) {
					$sum=$sum+$mark;
					$count++;
				}
			
			}
			$aver=array();
			$aver['name']="Average";
			$aver['attributes']['mark']=round($sum/$count,2);
			$out['childs'][]=$aver;
			
			$nout=array();
			$nout[0]=$out;
			$out=$nout;
			
			$this->xml.=$this->xmlbuilder->buildXML($out);
			$this->html.=$this->xsltemplate->build($this->xml,"RCMStudentResult","RCM/StudentResults");
		}
		
		private function ShowStudentTimetable() {
			// Отображает форму с раписанием для текущего студента
			$out=Array();
			$out['name']="MEPMyTimetable";
			
			$out['childs'][0]['name']="RCMUIStudent";
			$StudentUI=New RCMStudent(15,array('load_student_by_user_id'=>SHGetCurrentUserID())); // FIX: 0|22
			$out['childs'][0]['childs'][]=$StudentUI->GetArrayForXML(true,array());
			
			$aSemesters=array();
			for($i=1;$i<20;$i++) {
				$a=array();
				$a['name']="MEPSemester";
				$a['attributes']['id']=$i;
				$a['attributes']['title']=$i;
				$aSemesters[]=$a;
			}
			$out['childs'][1]['name']="MEPSemesters";
			$out['childs'][1]['childs']=$aSemesters;
			
			$aWeekNumber=array();
			for($i=1;$i<20;$i++) {
				$a=array();
				$a['name']="MEPWeek";
				$a['attributes']['id']=$i;
				$a['attributes']['title']=$i;
				$aWeekNumber[]=$a;
			}
			$out['childs'][2]['name']="MEPWeeks";
			$out['childs'][2]['childs']=$aWeekNumber;
			
			$aParamentrs=Array();
			
			$a=array();
			$a['name']="Parametr";
			$a['attributes']['id']="semester_number";
			$a['attributes']['value']=@$_REQUEST['semester_number'];
			$aParamentrs[]=$a;
			
			$a=array();
			$a['name']="Parametr";
			$a['attributes']['id']="week_number";
			$a['attributes']['value']=@$_REQUEST['week_number'];
			$aParamentrs[]=$a;
			
			$out['childs'][3]['name']="Parametrs";
			$out['childs'][3]['childs']=$aParamentrs;
			
			if (@$_REQUEST['subaction']=='my-timetable-show') $this->MytimetableLoadData($StudentUI,$out);
			
			$nout=array();
			$nout[0]=$out;
			$out=$nout;
			
			$this->xml=$this->xmlbuilder->buildXML($out);
			$this->html.=$this->xsltemplate->build($this->xml,"MEPMyTimetable","PersonalRoom");
		}
		
		private function MytimetableLoadData($StudentUI,&$out) {
			if (!isset($_REQUEST['semester_number'])) throw new Xception("Не правильно указан адрес запроса ...",1,"access");
			if (!isset($_REQUEST['week_number'])) throw new Xception("Не правильно указан адрес запроса ...",1,"access");
			
			// Название дней недели:
			$aWeekDays=array();
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='1';
			$a['attributes']['name']='Понедельник';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='2';
			$a['attributes']['name']='Вторник';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='3';
			$a['attributes']['name']='Среда';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='4';
			$a['attributes']['name']='Четверг';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='5';
			$a['attributes']['name']='Пятница';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='6';
			$a['attributes']['name']='Суббота';
			$aWeekDays[]=$a;
			
			$a=array();
			$a['name']='WeekDay';
			$a['attributes']['id']='0';
			$a['attributes']['name']='Воскресенье';
			$aWeekDays[]=$a;
			
			$out['childs'][4]['name']="WeekDays";
			$out['childs'][4]['childs']=$aWeekDays;
			
			$vTimetables=array();
			$MT=New MEPTimetable(0,array());
			$vTimetables=$MT->LoadMyTimetable($StudentUI,trim($_REQUEST['semester_number']),trim($_REQUEST['week_number']));
			
			$MC=New MEPCurriculumItem(0,array());
			
			$aTimetables=array();
			foreach ($vTimetables as $row) {
				$a=array();
				$a['name']='MEPTimetableItem';
				$a['attributes']['id']=$row['mti_id'];
				$a['attributes']['msi_id']=$row['msi_id'];
				$a['attributes']['mci_id']=$row['mci_id'];
				$a['attributes']['mci_event_id']=$row['mci_event_id'];
				$a['attributes']['mci_event_name']=$MC->GetEventNameByEventID($row['mci_event_id']);
				$a['attributes']['mci_discipline_name']=$row['mci_discipline_name'];
				$a['attributes']['weekday']=(date_create($row['startdate'])->format('w'));
				$a['attributes']['startdate']=$row['startdate'];
				$a['attributes']['enddate']=$row['enddate'];
				$aTimetables[]=$a;
			}
			
			$out['childs'][5]['name']="MEPTimetables";
			$out['childs'][5]['childs']=$aTimetables;
		}
		
		public function GetXML() {
			return $this->xml;
		}
		public function GetHTML() {
			return $this->html;
		}
	}
	
	// ==================================================================
	

	$Access=New Access();
	if (!$Access->IsLogin()) throw new Xception("Вы не авторизованы.",1,"access");
	//if (!$Access->IsMyRoomAvailable()) throw new Xception("Вам закрыт доступ к этому модулю системы ...",0,"access");
	
	$event_handler=new EventHandler();
	echo $event_handler->GetHTML();
	
	/*
	echo "Request:";
	var_dump($_REQUEST);
	
	echo "Get:";
	var_dump($_GET);
	?>
<textarea cols="80" rows="40">
			<?=$event_handler->GetXML();?>
		</textarea>
<?

	*/	
} 

catch (ModuleAccessException $e) {
	echo $e->ShowMessage();
} catch (UrlErrorException $e) {
	echo $e->ShowMessage();
} catch (InformationException $e) {
	echo $e->ShowMessage();
} catch (ErrorsException $e) {
	echo $e->ShowMessage();
} catch (Xception $e) {
	$e->ShowMessage();
}

//echo '<textarea cols="150" rows="40">'.$event_handler->GetXML().'</textarea>';


?>