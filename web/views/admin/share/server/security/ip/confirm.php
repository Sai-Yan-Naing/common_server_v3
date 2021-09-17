<?php 
require_once('views/admin/admin_shareconfig.php');
$site = $webuser;
$ip = $_POST['block_ip'];
$action = $_POST['action'];
$temp = json_decode($webblacklist,true);
if($action=='new')
{
	if(isExistBlackListIp($site,$ip))
	{
		$error = $ip." is already exist.";
		include('views/admin/share/server/security/ip/index.php');
		die();
	}
	$temp["BID-".time()] = ['ip'=>$ip,'mask'=>'255.255.255.255','status'=>'BLOCKED'];
	$result = json_encode($temp);
	// print_r($result);
	// die();
	$qry = "UPDATE web_account SET `blacklist` = '$result' WHERE `id` = $webid";
	if(!$commons->doThis($qry))
	{
		$error = $ip." cannot insert to Database.";
		include('views/admin/share/server/security/ip/index.php');
	  die();
	}
}else{
	$act_id = $_POST['act_id'];
	unset($temp[$act_id]);
	$result = json_encode($temp);
	// print_r($result);
	// die();
	$qry = "UPDATE web_account SET `blacklist` = '$result' WHERE `id` = $webid";
	if(!$commons->doThis($qry))
	{
		$error = $ip." cannot delete to Database.";
		include('views/admin/share/server/security/ip/index.php');
	  die();
	}
}

Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/blockip/blockip.ps1" '. $site." ".$ip.' '.$action);
header("location:/admin/share/server?setting=security&tab=ip&act=index&webid=$webid");
?>