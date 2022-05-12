<?php
require_once('views/share_config.php');
$msg = "Let’s Encryptの登録が完了しました。<br>設定反映までしばらくお待ちください";
$msgsession ="msg";
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
	$msg = "Let’s Encryptの登録が完了しました。<br>設定反映までしばらくお待ちください";
	$msgsession ="msg";
	$webssl = 1;
	$query = "UPDATE web_account SET ssl='$webssl' WHERE id='$webid'";
	$commons->doThis($query);

	Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/ssl.ps1" ssl '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser);
}

flash($msgsession,$msg);
header("location: /share/server?setting=security&tab=ssl&act=index");
die;