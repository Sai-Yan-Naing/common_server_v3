<?php
 require_once('views/vps_config.php');
 $cmd = "firewall";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_action = $_GET['action'];
$pserr = false;
$res = 'noerror';
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
// die();
 if($vm_action === "change_rdp")
 {
    $vm_fw = $webrdp;
    $vm_change_action = $_POST['port'];
    $temp['rdp'] = array('port'=>$vm_change_action,'ip'=>$rdp->rdp->ip);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET rdp='$temp' WHERE ip= ?";
    $chport = $vm_change_action;
    $chip   = $rdp->rdp->ip;
 } elseif ($vm_action === "change_rdip")
 {
    //  die('ok');
    $vm_fw = $webrdp;
    $vm_change_action = $_POST['ip'];
    $temp['rdp'] = array('port'=>$rdp->rdp->port,'ip'=>$vm_change_action);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET rdp='$temp' WHERE ip= ?";
    $chport = $rdp->rdp->port;
    $chip   = $vm_change_action;
} elseif ($vm_action === "change_httprdp")
{
    $vm_fw = $webhttp_rdp;
    $vm_change_action = $_POST['port'];
    $temp['web'] = array('port'=>$vm_change_action,'ip'=>$web_rdp->web->ip);
    $temp = json_encode($temp);
    $insert_q = "UPDATE vps_account SET http_rdp='$temp' WHERE ip= ?";
    $chport = $vm_change_action;
    $chip   = $web_rdp->web->ip;
} elseif ($vm_action === "change_httprdip")
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
 // die('ok');
 $res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
    flash($msgsession,$msg);
header("location: /vps/various?setting=firewall&tab=firewall&act=index&webid=$webid");

?>