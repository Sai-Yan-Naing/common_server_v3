<?php
require_once('views/admin/admin_config.php');
$act_id=$_POST["act_id"];
$action = $_POST['action'];
$getvps = $commons->getRow("SELECT * FROM vps_account WHERE id=?",[$act_id]);
$host_ip = $getvps['host_ip'];
$host_user = $getvps['host_user'];
$host_password = $getvps['host_password'];
$vm_name = $getvps['instance'];
$today = date("Y-m-d H:i:s");
$msg = "jp message";
$msgsession ="msg";
$pserr = false;
$res = 'noerror';
if ( $action  === 'delete')
{
	$action ="delete_vm";
	$update_q = "UPDATE vps_account SET removal= ? WHERE id=? ";
	if ( ! $commons->doThis($update_q,[$today,$act_id]))
	{
		$error="cannot update delete";
		require_once('views/admin/vps.php');
		die();
	}
	$msg = "server has been deleted";
} else
{
	$status=$getvps['active'] == 1?0:1;
	$action=$getvps['active'] == 1?"shutdown":"startup";
	$msg = $getvps['active'] == 1?"server is shutting down":"server is starting";
	// $reboot=1;
	// die('hello');
	// echo $status.$action.$act_id;
	$update_q = "UPDATE vps_account SET active= ?, reboot=1 WHERE id= ? ";
	if ( ! $commons->doThis($update_q,[$status,$act_id]))
	{
		$error="cannot update vps";
		require_once('views/admin/vps.php');
		die();
	}
}
$res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name);
if(preg_replace("/\s+/", "", $res)=='error'){
	$pserr = true;;
}
if($pserr){
$msgsession = 'msg';
$msg = 'powershellerror';
}
flash($msgsession,$msg);
header("location: /admin?main=vps$pagy");
?>