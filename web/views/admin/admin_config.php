<?php
session_start();
require_once('config/all.php');
require_once('models/common.php');
require_once('models/common_validate.php');
require_once('commons/common.php');
require_once('mails/mail.php');
// echo $_COOKIE['admin'];
$webadminID = $_COOKIE['admin'];
$commons = new Common;
$webmailer = new Mailer;
$admin_acc = $commons->getRow("SELECT * FROM customer WHERE user_id=?",[$webadminID]);
$webadminID = $admin_acc['user_id'];
$webadminName = $admin_acc['name'];
$webadminweb = explode(",",$admin_acc['web']);
// $webadminplanid = $admin_acc['plan_id'];

// for root site
$webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE origin =? AND customer_id= ?",[1,$webadminID]);
$webrootid = $webroot_acc['id'];
$webadminID = $webroot_acc['customer_id'];
$web_server_id = $webroot_acc['web_server_id'];
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
$webplanid = $webroot_acc['plan'];
if(isset($_GET['webser']))
{
	$web_server_id = $_GET['webser'];
}
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

$webroot_plan = $commons->getRow("SELECT * FROM plan_tbl WHERE id= ?",[$webplanid]);
$webplnname = $webroot_plan['name'];
$webplnsite = $webroot_plan['site'];
$webplnwebcapacity = $webroot_plan['web_capacity'];
$webplnmail = $webroot_plan['mail_capacity'];
$webplnmailuser = $webroot_plan['mail_user'];

define("MYROOT", $web_mydbuser);
define("MYROOT_PASS", $web_mydbpass);
define("MYDSN", 'mysql:host='.$web_host.':3310');

define("MAROOT", $web_madbuser);
define("MAROOT_PASS", $web_madbpass);
define("MADSN", 'mysql:host='.$web_host.':3307');

define("SQLSERVER_2016_USER", $web_msdbuser);
define("SQLSERVER_2016_PASS", $web_msdbpass);
define("SQLSERVER_2016_DSN", 'sqlsrv:Server='.$web_host.';Database=master');
$winusers = ['administrator','guest'];
$pagy = (isset($_GET['page']))?'&page='.$_GET['page']:'';
$pagyc = (isset($_GET['page']))?'?page='.$_GET['page']:'';