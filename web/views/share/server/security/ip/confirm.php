<?php 
require_once('views/share_config.php');
$site = $webuser;
$ip = $_POST['block_ip'];
$action = $_POST['action'];
$temp = json_decode($webblacklist,true);
$msg = "jp message";
$msgsession ="msg";
if ( $action=='new')
{
	$msg = "ブラックリストに 「".$ip."」 を追加しました";
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
	$qry = "UPDATE web_account SET blacklist = ? WHERE id = ?";
	if ( ! $commons->doThis($qry,[$result,$webid]))
	{
		$error = $ip." cannot insert to Database.";
		include('views/share/server/security/ip/index.php');
	  die();
	}
} else {
	$msg = "ブラックリストから「".$ip."」 を削除しました";
	$act_id = $_POST['act_id'];
	unset($temp[$act_id]);
	$result = json_encode($temp);
	// print_r($result);
	// die();
	$qry = "UPDATE web_account SET blacklist = '$result' WHERE id = $webid";
	if ( !$commons->doThis($qry))
	{
		$error = $ip." cannot delete to Database.";
		include('views/share/server/security/ip/index.php');
	  die();
	}
}

// Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/blockip/blockip.ps1" '. $site." ".$ip.' '.$action);
echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/blockip.ps1" ip '.$web_host.' '.$web_user.' '.$web_password.' '.$site.' '.$ip.' '.$action);
// die;
flash($msgsession,$msg);
header("location:/share/server?setting=security&tab=ip&act=index");