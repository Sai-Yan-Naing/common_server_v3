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
$web_memory = $web_acc['memory'];
$web_storage  = $web_acc['storage'];
$web_cpu = $web_acc["cpu"];
$web_iis = $web_acc["iis"];
$web_ssms = $web_acc["ssms"];
$web_mssql_2016 = $web_acc["mssql_16"];
$web_mssql_2017 = $web_acc["mssql_17"];
$web_mssql_2019 = $web_acc["mssql_19"];
$web_os = $web_acc["os"];
$web_osversion = $web_acc["osversion"];
$web_osname = $web_acc["osname"];

$pagy = (isset($_GET['page']))?'&page='.$_GET['page']:'';
$pagyc = (isset($_GET['page']))?'?page='.$_GET['page']:'';