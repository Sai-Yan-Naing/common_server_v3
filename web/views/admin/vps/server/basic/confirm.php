<?php
require_once('views/admin/admin_vpsconfig.php');
$act = $_POST['action'];
if($act == "onoff"){
    $status=$webactive==1?0:1;
    $action=$webactive==1?"shutdown":"startup";
    // die('hello');
    // echo $status.$action.$act_id;
    $update_q = "UPDATE vps_account SET active='$status' WHERE id='$webid'";
    if(!$commons->doThis($update_q))
    {
    echo $error="cannot update vps";
    require_once('views/admin/vps.php');
    die();
    }
}
//  echo Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$vm_change_action.' '.$vm_fw);
//  die('ok');
header("location: /admin/vps/server?tab=basic&act=index&webid=$webid");

?>