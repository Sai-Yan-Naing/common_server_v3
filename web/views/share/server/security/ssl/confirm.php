<?php
require_once('views/share_config.php');
// $user = $getWeb['user'];
// if(!isset($_POST['common_name'])){ header("location: /share/servers/security");}
echo shell_exec('whoami');
// echo $sitename = $_POST['common_name'];
echo $sitename = $webuser;
echo $getid = Shell_Exec(escapeshellcmd("powershell.exe  -NoProfile -Noninteractive -command  Get-Website -Name $sitename | Select -ExpandProperty ID"));
shell_exec("E:\scripts\ssl.bat $getid");
header("location: /share/server?setting=security&tab=ssl&act=index");
die;