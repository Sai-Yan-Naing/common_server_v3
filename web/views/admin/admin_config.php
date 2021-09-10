<?php
require_once('config/all.php');
require_once('models/common.php');
require_once('commons/common.php');
echo $_COOKIE['admin'];
$commons = new Common;
$admin_acc = $commons->getRow("SELECT * FROM customer WHERE user_id='D000123'");
$webadminID = $admin_acc['user_id'];
?>