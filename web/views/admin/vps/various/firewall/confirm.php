<?php
 require_once('views/admin/admin_vpsconfig.php');
 $cmd = "firewall";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_action = $_GET['action'];
// $vm_change_action  = WINSERVERROOT;
//$getvps = $commons->getRow("SELECT * FROM vps_account WHERE ip='$webip'");
// echo "<pre>";
// echo $webip;
//print_r($getvps);
// json_decode($getvps['rdp'], true);
$rdp = json_decode($webrdp);
$web_rdp = json_decode($webhttp_rdp);
// echo $rdp->rdp->port;
// print_r($rdp);
$temp = [];
$pserr = false;
$res = 'noerror';
$msgsession = 'msg';
 if($vm_action == "remote_desktop_port")
 {
    $vm_fw = $webrdp;
    $vm_change_action = $_POST['port'];
    $temp['rdp'] = array('port'=>$vm_change_action,'ip'=>$rdp->rdp->ip);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET rdp='$temp' WHERE ip= ?";
    $chport = $vm_change_action;
    $chip   = $rdp->rdp->ip;
 } elseif ($vm_action == "remote_desktop_ip")
 {
    //  die('ok');
    $vm_fw = $webrdp;
    $vm_change_action = $_POST['ip'];
    $temp['rdp'] = array('port'=>$rdp->rdp->port,'ip'=>$vm_change_action);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET rdp='$temp' WHERE ip= ?";
    $chport = $rdp->rdp->port;
    $chip   = $vm_change_action;
} elseif ($vm_action == "web_access_port")
{
    $vm_fw = $webhttp_rdp;
    $vm_change_action = $_POST['port'];
    $temp['web'] = array('port'=>$vm_change_action,'ip'=>$web_rdp->web->ip);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET http_rdp='$temp' WHERE ip= ?";
    $chport = $vm_change_action;
    $chip   = $web_rdp->web->ip;
} elseif ($vm_action == "web_access_ip")
{
    $vm_fw = $webhttp_rdp;

    $vm_change_action = $_POST['ip'];
    $temp['web'] = array('port'=>$web_rdp->web->port,'ip'=>$vm_change_action);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET http_rdp='$temp' WHERE ip= ?";
    $chport = $web_rdp->web->port;
    $chip   = $vm_change_action;
}
// echo $temp;
// die;
if(!$commons->doThis($insert_q,[$webip]))
{
    echo $error="cannot update vps";
    die();
}
$res = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_v1.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$chport.' '.$chip);
$msg = 'success change';
$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
 flash($msgsession,$msg);
header("location: /admin/vps/various?setting=firewall&tab=firewall&act=index&webid=$webid");

?>