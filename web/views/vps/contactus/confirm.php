<?php 

require_once("views/vps_config.php");
$to = $_POST['email'];
$toName = $_POST['name'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$today = date("Y/m/d");

$timestamp = date("Y/m/d :h:m:s");

$subject ='ウィンサーバー';
$body = file_get_contents('views/mailer/vps/contactus/user.php');
$body = str_replace('$message', $message, $body);
$body = str_replace('$phone', $phone, $body);
$body = str_replace('$email', $to, $body);
$body = str_replace('$name', $toName, $body);
$body = str_replace('$today', $today, $body);

$webmailer->sendMail($to,$toName,$subject,$body,CC);

$body = file_get_contents('views/mailer/vps/contactus/mail.php');
$body = str_replace('$message', $message, $body);
$body = str_replace('$contractID', $webadminID, $body);
$body = str_replace('$webadminName', $webadminName, $body);
$body = str_replace('$phone', $phone, $body);
$body = str_replace('$email', CC, $body);
$body = str_replace('$name', $toName, $body);
$body = str_replace('$today', $timestamp, $body);

$webmailer->sendMail($to,$toName,$subject,$body,CC);
header("location:/vps/contactus?act=index");
die();