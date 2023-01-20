<?php 
require_once('views/admin/admin_shareconfig.php');
$site = $webuser;
$ip = $_POST['block_ip'];
$action = $_POST['action'];
$temp = json_decode($webblacklist,true);
$msg = "jp message";
$msgsession ="msg";
if ( $action=='new')
{
	$msg = "ブラックリストに 「".$ip."」 を追加しました";
	
	$temp1 = json_decode($webblacklist, true);
	// print_r($temp1);die;
	foreach($temp1 as $t){
		if(in_array($ip, $t)){
			$data = ['status'=>true, "field"=>"block_ip", "error"=>"$ip を取得することができません。別の名前を指定してください。"];
			echo json_encode($data);
			die;
		}
	}
	if ( isExistBlackListIp($site,$ip))
	{
		$error = $ip." is already exist.";
		include('views/admin/share/server/security/ip/index.php');
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
		include('views/admin/share/server/security/ip/index.php');
	  die();
	}
	Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/blockip.ps1" ip '.$web_host.' '.$web_user.' '.$web_password.' '.$site.' '.$ip.' '.$action);
$data = ['status'=>false, "message"=>"ok"];
echo json_encode($data);
flash($msgsession,$msg);
die;
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
		include('views/admin/share/server/security/ip/index.php');
	  die();
	}
}

// Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/blockip/blockip.ps1" '. $site." ".$ip.' '.$action);
echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/blockip.ps1" ip '.$web_host.' '.$web_user.' '.$web_password.' '.$site.' '.$ip.' '.$action);
// die;
flash($msgsession,$msg);
header("location:/admin/share/server?setting=security&tab=ip&act=index&webid=$webid");