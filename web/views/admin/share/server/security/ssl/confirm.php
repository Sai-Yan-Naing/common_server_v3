<?php
require_once('views/admin/admin_shareconfig.php');
$msg = "Let’s Encryptの登録が完了しました。<br>設定反映までしばらくお待ちください";
$msgsession ="msg";
// $user = $getWeb['user'];
// if(!isset($_POST['common_name'])){ header("location: /share/servers/security");}
// echo shell_exec('whoami');
// echo $sitename = $_POST['common_name'];
$sitename = $webuser;
// echo $getid = Shell_Exec(escapeshellcmd("powershell.exe  -NoProfile -Noninteractive -command  Get-Website -Name $sitename | Select -ExpandProperty ID"));
// shell_exec("E:\scripts\ssl.bat $getid");


Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/ssl.ps1" ssl '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser);
// die;
flash($msgsession,$msg);
header("location: /admin/share/server?setting=security&tab=ssl&act=index&webid=$webid");
die;