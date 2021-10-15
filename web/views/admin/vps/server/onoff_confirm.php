<?php
require_once('views/admin/admin_vpsconfig.php');
$act = $_POST['action'];
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
if ( $act == "onoff"){
    $status=$webactive==1?0:1;
    $action=$webactive==1?"shutdown":"startup";
    // die('hello');
    // echo $status.$action.$act_id;
    $update_q = "UPDATE vps_account SET active='$status' WHERE id='$webid'";
    if ( ! $commons->doThis($update_q,[$status,$webid]))
    {
    echo $error="cannot update vps";
    require_once('views/admin/vps.php');
    die();
    }
}

echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v_init.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name);
//  die('ok');
header("location: /admin/vps/server?tab=$tab&act=index&webid=$webid");