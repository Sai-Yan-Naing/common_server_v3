<?php
ob_start();
if(!isset($_COOKIE['vps_user'])){header('location: /login');}
// if(!isset($_GET['server']) && !isset($_GET['setting']) and !isset($_GET['tab'])){header('location: /admin');}
$webserver = $_GET['server'];
$websetting = $_GET['setting'];
$tab = $_GET['tab'];
// if(!isset($_GET['webid']) || $_GET['webid']==null){header("location: /admin/$webserver");}
require_once("config/all.php");
require_once("models/common.php");
require_once("commons/common.php");
// require_once("usage/usage.php");
require_once('mails/mail.php');
require_once('views/vps_validate.php');
$webmailer = new Mailer;
$commons = new Common;
$web_acc = $commons->getRow("SELECT * FROM vps_account WHERE ip=?", [$_COOKIE['vps_user']]);
$webid = $web_acc['id'];
$webip = $web_acc['ip'];
$webgateway = $web_acc['gateway'];
$webadminID = $web_acc['customer_id'];
$webvmhost_ip = $web_acc['host_ip'];
$webvmhost_user = $web_acc['host_user'];
$webvmhost_password = $web_acc['host_password'];
$webvm_name = $web_acc['instance'];
$webpass = $web_acc['password'];
$webactive = $web_acc['active'];
$webrdp = $web_acc['rdp'];
$webhttp_rdp = $web_acc['http_rdp'];