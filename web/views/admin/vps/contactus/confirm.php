<?php 
require_once("views/admin/admin_vpsconfig.php");
$to = $_POST['email'];
$toName = $_POST['name'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$today = date("Y/m/d");

$msgsession =  "msg";
$msg = "お問合せが完了しました。<br>弊社より回答させていただきますので今しばらくお待ちください";

$timestamp = date("Y/m/d :h:m:s");

$subject ='ウィンサーバー';
$body = file_get_contents('views/mailer/admin/vps/contactus/user.php');
$body = str_replace('$message', $message, $body);
$body = str_replace('$phone', $phone, $body);
$body = str_replace('$email', $to, $body);
$body = str_replace('$name', $toName, $body);
$body = str_replace('$today', $today, $body);

$webmailer->sendMail($to,$toName,$subject,$body,CC);

$body = file_get_contents('views/mailer/admin/vps/contactus/mail.php');
$body = str_replace('$message', $message, $body);
$body = str_replace('$contractID', $webadminID, $body);
$body = str_replace('$webadminName', $toName, $body);
$body = str_replace('$phone', $phone, $body);
$body = str_replace('$email', $to, $body);
$body = str_replace('$name', $toName, $body);
$body = str_replace('$today', $timestamp, $body);

$webmailer->sendMail($to,$toName,$subject,$body,CC);
flash($msgsession,$msg);
header("location: /admin/vps/contactus?act=index&webid=$webid");
die('admin');

?>