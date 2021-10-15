<?php
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