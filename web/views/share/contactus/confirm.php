<?php 
require_once("views/share_config.php");
	$to = $_POST['email'];
	$toName = $_POST['name'];
	$subject = "mail subject";
	$body = $_POST['message'];
	$webmailer->sendMail($to,$toName,$subject,$body);
	header("location: /share/contactus?act=index");
	die('admin');

?>