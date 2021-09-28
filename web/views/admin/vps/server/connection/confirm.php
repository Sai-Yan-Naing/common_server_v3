<?php
require_once('views/admin/admin_vpsconfig.php');
$cmd = "change_pass";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_action = "change_pass";
$vm_change_action  = WINSERVERROOT;
$vm_fw = $_POST['password'];

 echo Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$vm_change_action.' '.$vm_fw);
//  die('ok');
header("location: /admin/vps/server?tab=connection&act=index&webid=$webid");

?>