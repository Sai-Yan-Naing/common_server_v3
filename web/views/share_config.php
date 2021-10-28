<?php
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
$weboriginid = $web_acc['origin_id'];
// for root site
$webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE id= ?",[$weboriginid]);
$webrootid = $webroot_acc['id'];
$webadminID = $webroot_acc['customer_id'];
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

$webpath = ( $weborigin != 1 )? $webrootuser."/".$webuser : $webrootuser; 