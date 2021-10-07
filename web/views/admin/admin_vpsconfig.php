<?php
// if(!isset($_COOKIE['admin'])){header('location: /login');}
// if(!isset($_GET['server']) && !isset($_GET['setting']) and !isset($_GET['tab'])){header('location: /admin');}
$webserver = $_GET['server'];
$websetting = $_GET['setting'];
$tab = $_GET['tab'];
// if(!isset($_GET['webid']) || $_GET['webid']==null){header("location: /admin/$webserver");}
require_once("config/all.php");
require_once("models/common.php");
require_once("commons/common.php");
require_once('views/admin/admin_vpsvalidate.php');
// require_once("usage/usage.php");
require_once('mails/mail.php');
$webmailer = new Mailer;
$commons = new Common;
$web_acc = $commons->getRow("SELECT * FROM vps_account WHERE id='$_GET[webid]' AND customer_id='D000123'");
$webid = $web_acc['id'];
$webip = $web_acc['ip'];
$webadminID = $web_acc['customer_id'];
$webvmhost_ip = $web_acc['host_ip'];
$webvmhost_user = $web_acc['host_user'];
$webvmhost_password = $web_acc['host_password'];
$webvm_name = $web_acc['instance'];
$webpass = $web_acc['password'];
$webactive = $web_acc['active'];
$webrdp = $web_acc['rdp'];
$webhttp_rdp = $web_acc['http_rdp'];
$web_memory = $web_acc['memory'];
$web_storage  = $web_acc['storage'];
$web_cpu = $web_acc["cpu"];
?>