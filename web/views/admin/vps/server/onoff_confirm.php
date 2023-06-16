<?php
require_once('views/admin/admin_vpsconfig.php');
$act = $_POST['action'];
$webactive = $_POST['state'];
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$pserr = false;
$res = 'noerror';
$msgsession = 'msg';
if ( $act == "onoff"){
    $status=$webactive==1?0:1;
    $action=$webactive==1?"shutdown":"startup";
    $msg=$webactive==1?"server is shutting down":"server is starting";
    // die('hello');
    // echo $status.$action.$act_id;
    $update_q = "UPDATE vps_account SET active='$status', reboot=1 WHERE id='$webid'";
    if ( ! $commons->doThis($update_q,[$status,$webid]))
    {
    echo $error="cannot update vps";
    require_once('views/admin/vps.php');
    die();
    }
}

$res = Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name);
$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
 flash($msgsession,$msg);
header("location: /admin/vps/server?tab=$tab&act=index&webid=$webid");