<?php
require_once('views/admin/admin_shareconfig.php');
// $user = $getWeb['user'];
// if(!isset($_POST['common_name'])){ header("location: /share/servers/security");}
// echo shell_exec('whoami');
// echo $sitename = $_POST['common_name'];
$sitename = $webuser;
// echo $getid = Shell_Exec(escapeshellcmd("powershell.exe  -NoProfile -Noninteractive -command  Get-Website -Name $sitename | Select -ExpandProperty ID"));
// shell_exec("E:\scripts\ssl.bat $getid");
$action = $_POST['action'];
if($action =='new')
{
	$common_name = $_POST['common_name'];
	$prefecture = $_POST['prefecture'];
	$municipality = $_POST['municipality'];
	$organization = $_POST['organization'];
	$msg = "Let’s Encryptの登録が完了しました。<br>設定反映までしばらくお待ちください";
	$msgsession ="msg";
	$temp1["ssl"] = ['common_name'=>$common_name,'prefecture'=>$prefecture,'municipality'=>$municipality,'organization'=>$organization];
	$webssl = json_encode($temp1);
	// $webssl = 2;
	$query = "UPDATE web_account SET ssl='$webssl' WHERE id='$webid'";
	$commons->doThis($query);
// die;
	#Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/ssl.ps1" ssl '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser);
}elseif($action =='edit'){

	$common_name = $_POST['common_name'];
	$prefecture = $_POST['prefecture'];
	$municipality = $_POST['municipality'];
	$organization = $_POST['organization'];
	$msg = "Let’s Encryptの登録が完了しました。<br>設定反映までしばらくお待ちください";
	$msgsession ="msg";
	$temp1["ssl"] = ['common_name'=>$common_name,'prefecture'=>$prefecture,'municipality'=>$municipality,'organization'=>$organization];
	$webssl = json_encode($temp1);
	// $webssl = 2;
	$query = "UPDATE web_account SET ssl='$webssl' WHERE id='$webid'";
	$commons->doThis($query);

	}else{
	$temp1 = [];
	$webssl = json_encode($temp1);
	// $webssl = 1;
	$query = "UPDATE web_account SET ssl='$webssl' WHERE id='$webid'";
	$commons->doThis($query);
}

// die;
flash($msgsession,$msg);
header("location: /admin/share/server?setting=security&tab=ssl&act=index&webid=$webid");
die;