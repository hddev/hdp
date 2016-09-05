<?php
$MAIL_FROM = "From:  Service Desk <noreply@MY_SERVER.ru>";
$MAIL_ENABLED = "1";
$MAIL_RECEIPT_ANALYZE_ENABLED = "0";
$MAIL_SYSTEM_LINK = "http://sd/";
$MAIL_CHANGE_STATUS_NOTIFY = "0";

$MAIL_NOTIFICATION_KEY = "";

$MAIL_NOTIFICATION_TYPE = "1";

$NOTIFICATION_TYPE_SINGLE = "0"; // каждому пользователю по письму (с каждым запросом)
$NOTIFICATION_TYPE_GROUPBY_REQUESTID = "1"; // всем имеющим отношение пользователям единое письмо (по каждому запросу)
$NOTIFICATION_TYPE_GROUPBY_USERID = "2"; // КАЖДОМУ ПОЛЬЗОВАТЕЛЮ ОДНО ПИСЬМО СО ВСЕМИ ЗАПРОСАМИ
                                         
// md5 - b99929f0e474d0d48a7b987c135ccaf9

?>
