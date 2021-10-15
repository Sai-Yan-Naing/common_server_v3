<?php 
require_once('views/share_config.php');
$site = $webuser;
$ip = $_POST['block_ip'];
$action = $_POST['action'];
$temp = json_decode($webblacklist,true);
if ( $action === 'new')
{
	if ( isExistBlackListIp($site,$ip))
	{
		$error = $ip." is already exist.";
		include('views/share/server/security/ip/index.php');
		die();
	}
	$temp["BID-".time()] = ['ip'=>$ip,'mask'=>'255.255.255.255','status'=>'BLOCKED'];
	$result = json_encode($temp);
	// print_r($result);
	// die();
	$qry = "UPDATE web_account SET `blacklist` = ? WHERE `id` = ?";
	if ( ! $commons->doThis($qry,[$result,$webid]))
	{
		$error = $ip." cannot insert to Database.";
		include('views/share/server/security/ip/index.php');
	  die();
	}
} else
{
	$act_id = $_POST['act_id'];
	unset($temp[$act_id]);
	$result = json_encode($temp);
	// print_r($result);
	// die();
	$qry = "UPDATE web_account SET `blacklist` = ? WHERE `id` = ?";
	if ( ! $commons->doThis($qry,[$result,$webid]))
	{
		$error = $ip." cannot delete to Database.";
		include('views/share/server/security/ip/index.php');
	  die();
	}
}

Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/blockip/blockip.ps1" '. $site." ".$ip.' '.$action);
header("location:/share/server?setting=security&tab=ip&act=index");
?>