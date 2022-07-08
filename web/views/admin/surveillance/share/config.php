<?php
session_start();
ob_start();
// if(!isset($_COOKIE['admin'])){header('location: /login');}
// if(!isset($_GET['webid']) || $_GET['webid']==null){header('location: /admin');}
require_once("config/all.php");
require_once("models/common.php");
require_once("models/backup.php");
require_once("commons/common.php");
require_once('mails/mail.php');
require_once('ftp/config.php');
// require_once('views/admin/admin_sharevalidate.php');
$webmailer = new Mailer;
$commons = new Common;
// echo $_COOKIE['admin'];
$webadminID = $_COOKIE['admin'];

$admin_acc = $commons->getRow("SELECT * FROM customer WHERE user_id=? ",[$webadminID]);
$webadminID = $admin_acc['user_id'];
$webadminName = $admin_acc['name'];
$webadminweb = explode(",",$admin_acc['web']);
// $webplanid = $admin_acc['plan_id'];
$web_acc = $commons->getRow("SELECT * FROM web_account WHERE id=? AND customer_id=? and removal IS NULL",[$_GET['webid'],$_COOKIE['admin']]);
$webid = $web_acc['id'];
$webadminID = $web_acc['customer_id'];
$web_server_id = $web_acc['web_server_id'];
$webuser = $web_acc['user'];
$webdomain = $web_acc['domain'];
$webpass = $web_acc['password'];
$webstopped = $web_acc['stopped'];
$webappstopped = $web_acc['appstopped'];
$weberrorpages = $web_acc['error_pages'];
$webdns = $web_acc['dns'];
$webbasicsetting = $web_acc['basic_setting'];
$webappversion = $web_acc['app_version'];
$webblacklist = $web_acc['blacklist'];
$weborigin = $web_acc['origin'];
$weborigin_id = $web_acc['origin_id'];
$webssl = $web_acc['ssl'];
$webplanid = $web_acc['plan'];
$webmysql_cnt = $web_acc['mysql_cnt'];
$webmssql_cnt = $web_acc['mssql_cnt'];
$webmariadb_cnt = $web_acc['mariadb_cnt'];
// for root site
if($weborigin !=1)
{
$webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE origin =? AND customer_id= ? AND id =? and removal IS NULL",[1,$_COOKIE['admin'],$weborigin_id]);
$webrootid = $webroot_acc['id'];
$webadminID = $webroot_acc['customer_id'];
$webroot_server_id = $webroot_acc['web_server_id'];
$webrootuser = $webroot_acc['user'];
$webrootdomain = $webroot_acc['domain'];
$webrootpass = $webroot_acc['password'];
$webrootstopped = $webroot_acc['stopped'];
$webrootappstopped = $webroot_acc['appstopped'];
$webrooterrorpages = $webroot_acc['error_pages'];
$webrootdns = $webroot_acc['dns'];
$webrootbasicsetting = $webroot_acc['basic_setting'];
$webrootappversion = $webroot_acc['app_version'];
$webrootblacklist = $webroot_acc['blacklist'];
$webplanid = $web_acc['plan'];
}
$webplan = $commons->getRow("SELECT * FROM plan_tbl WHERE id= ?",[$webplanid]);
$webplnname = $webplan['name'];
$webplnsite = $webplan['site'];
$webplnwebcapacity = $webplan['web_capacity'];
$webplnmail = $webplan['mail_capacity'];
$webpath = ( $weborigin != 1 )? $webrootuser."/".$webuser : $webuser;
// die(); 

$pagy = (isset($_GET['page']))?'&page='.$_GET['page']:'';
$pagyc = (isset($_GET['page']))?'?page='.$_GET['page']:'';

