<?php 
require_once("views/admin/admin_shareconfig.php");
$to = $_POST['email'];
$toName = $_POST['name'];
$subject = "mail subject";
$body = $_POST['message'];
$webmailer->sendMail($to,$toName,$subject,$body);
header("location: /admin/share/contactus?act=index&webid=$webid");
die('admin');

?>