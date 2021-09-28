<?php
require_once('views/admin/admin_config.php');
$act_id=$_POST["act_id"];
$action = $_POST['action'];
$getvps = $commons->getRow("SELECT * FROM vps_account WHERE id='$act_id'");
$host_ip = $getvps['host_ip'];
$host_user = $getvps['host_user'];
$host_password = $getvps['host_password'];
$vm_name = $getvps['instance'];
$today = date("Y-m-d H:i:s");
if($action=='delete')
{
	$update_q = "UPDATE vps_account SET removal='$today' WHERE id='$act_id'";
	if(!$commons->doThis($update_q))
	{
	$error="cannot update delete";
	require_once('views/admin/vps.php');
	die();
	}
}else{
	$status=$getvps['active']==1?0:1;
	$action=$getvps['active']==1?"shutdown":"startup";
	// die('hello');
	// echo $status.$action.$act_id;
	$update_q = "UPDATE vps_account SET active='$status' WHERE id='$act_id'";
	if(!$commons->doThis($update_q))
	{
	$error="cannot update vps";
	require_once('views/admin/vps.php');
	die();
	}
}
// echo $action;
// die();
// $action = 'shutdown';
// $host_ip = '210.146.10.219';
// $host_user = 'administrator';
// $host_password = 'np3FUyEDiPRf';
// $vm_name = '20210720sai';
echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v_init.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name);
header("location: /admin?main=vps");
?>