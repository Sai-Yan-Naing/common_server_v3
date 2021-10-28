<?php
 require_once('views/vps_config.php');

$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
if ( isset($_GET['action']) and $_GET['action']=='iisinstall')
{
    $cmd = "iisinstall";
    $vm_action = "iisinstall";
    
    shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
} else
{
    $cmd = "install_sqlserver";
    $vm_action = $_POST['sqlv'];
    
    shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
}

header("location: /vps/various?setting=easy_install&tab=easy_install&act=index");

?>