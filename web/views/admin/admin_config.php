<?php
session_start();
require_once('config/all.php');
require_once('models/common.php');
require_once('commons/common.php');
require_once('mails/mail.php');
require_once('views/admin/admin_validate.php');
// echo $_COOKIE['admin'];
$webadminID = $_COOKIE['admin'];
$commons = new Common;
$webmailer = new Mailer;
$admin_acc = $commons->getRow("SELECT * FROM customer WHERE user_id=?",[$webadminID]);
$webadminID = $admin_acc['user_id'];
$webadminName = $admin_acc['name'];

// for root site
$webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE origin =? AND customer_id= ?",[1,$webadminID]);
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

$pagy = (isset($_GET['page']))?'&page='.$_GET['page']:'';
$pagyc = (isset($_GET['page']))?'?page='.$_GET['page']:'';