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
require_once('views/share_validate.php');
$webmailer = new Mailer;
$commons = new Common;

$web_acc = $commons->getRow("SELECT * FROM web_account WHERE domain= ?", [$_COOKIE['share_user']]);
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
$webssl = $web_acc['ssl'];
// for root site
$webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE origin =? AND customer_id= ? and removal IS NULL",[1,$webadminID]);
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

$setting = $_GET['setting'];

$web_server_id = ( $weborigin != 1 )? $web_server_id : $webroot_server_id; 

$web_server = "SELECT * FROM web_server_config WHERE id='$web_server_id'";
$gethost = $commons->getRow($web_server);
$web_host = $gethost['ip'];
$web_user = $gethost['username'];
$web_password = $gethost['password'];
$web_mydbuser = $gethost['mydbuser'];
$web_mydbpass = $gethost['mydbpass'];
$web_madbuser = $gethost['madbuser'];
$web_madbpass = $gethost['madbpass'];
$web_msdbuser = $gethost['msdbuser'];
$web_msdbpass = $gethost['msdbpass'];
$web_ftp = $gethost['ftp_user'];
$web_ftppass = $gethost['ftp_pass'];

$admin_acc = $commons->getRow("SELECT * FROM customer WHERE user_id=?",[$webadminID]);
$webadminID = $admin_acc['user_id'];
$webadminName = $admin_acc['name'];
$webadminweb = explode(",",$admin_acc['web']);
$webadminplanid = $admin_acc['plan_id'];

$webroot_plan = $commons->getRow("SELECT * FROM plan_tbl WHERE id= ?",[$webadminplanid]);
$webplnname = $webroot_plan['name'];
$webplnsite = $webroot_plan['site'];
$webplnwebcapacity = $webroot_plan['web_capacity'];
$webplnmailuser = $webroot_plan['mail_user'];
$webplnmysqldb = $webroot_plan['mysql_db'];
$webplnmysqldbnum = $webroot_plan['mysql_db_num'];
$webplnmariadb = $webroot_plan['maria_db'];
$webplnmariadbnum = $webroot_plan['maria_db_num'];
$webplnmssqldb = $webroot_plan['mssql_db'];
$webplnmssqldbnum = $webroot_plan['mssql_db_num'];
$webplnmssqlcap = $webroot_plan['mssql_db_capacity'];

$webplnftp = $webroot_plan['ftp'];
$webplnftpnum = $webroot_plan['ftp_num'];

$webplnbackup = $webroot_plan['back_up'];

define("MYROOT", $web_mydbuser);
define("MYROOT_PASS", $web_mydbpass);
define("MYDSN", 'mysql:host='.$web_host.':3310');

define("MAROOT", $web_madbuser);
define("MAROOT_PASS", $web_madbpass);
define("MADSN", 'mysql:host='.$web_host.':3307');

// const SQLSERVER_2016_DSN = "sqlsrv:Server=localhost;Database=master";
// const SQLSERVER_2016_USER = "tester";
// const SQLSERVER_2016_PASS = "welcome123!";

define("SQLSERVER_2016_USER", $web_msdbuser);
define("SQLSERVER_2016_PASS", $web_msdbpass);
define("SQLSERVER_2016_DSN", 'sqlsrv:Server='.$web_host.';Database=master');

$webpath = ( $weborigin != 1 )? $webrootuser."/".$webuser : $webrootuser; 

$pagy = (isset($_GET['page']))?'&page='.$_GET['page']:'';
$pagyc = (isset($_GET['page']))?'?page='.$_GET['page']:'';

