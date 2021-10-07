<?php
 require_once('views/admin/admin_vpsconfig.php');
 $cmd = "install_sqlserver";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_action = $_POST['sqlv'];

shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
header("location: /admin/vps/various?setting=easy_install&tab=easy_install&act=index&webid=$webid");

?>