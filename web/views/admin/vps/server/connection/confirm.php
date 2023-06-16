<?php
require_once('views/admin/admin_vpsconfig.php');
$cmd = "change_pass";
$pserr = false;
$res = 'noerror';
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$os = $web_os;
$webip = $webip;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_action = "change_pass";
$vm_change_action  = WINSERVERROOT;
$vm_fw = $_POST['password'];
$update_q = "UPDATE vps_account SET password='$vm_fw' WHERE id='$webid'";
$commons->doThis($update_q,[$status,$webid]);
if($os=='windows'){
   $res = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$vm_change_action.' '.$vm_fw. ' '.$os);  
}else{
     $res = shell_exec  ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$webip.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$vm_change_action.' '.$vm_fw. ' '.$os);
}
$msg = "Password successfull changed";
if(preg_replace("/\s+/", "", $res)=='error'){
   $pserr = true;;
}
if($pserr){
$msgsession = 'msg';
$msg = 'powershellerror';
}
flash($msgsession,$msg);
header("location: /admin/vps/server?tab=connection&act=index&webid=$webid");

?>