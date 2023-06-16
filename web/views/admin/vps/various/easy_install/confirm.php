<?php
 require_once('views/admin/admin_vpsconfig.php');

$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;

$pserr = false;
$res = 'noerror';
$msgsession = 'msg';
if ( isset($_GET['action']) and $_GET['action']=='iisinstall')
{
    $cmd = "iisinstall";
    $vm_action = "iisinstall";
    $qry = "UPDATE vps_account SET iis = ? WHERE id = ?";
    if( ! $commons->doThis($qry,[1,$webid]) ){
            // require_once("views/admin/share.php");
            die("error");
    }
    $msgsession = 'msg';
    $msg = 'IISはインストール済みです。';
    if($web_iis==0){
        $res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
        $msg = "IISのインストールが完了しました。";
    }
    
} else
{
    $cmd = "install_sqlserver";
    $vm_action = $_POST['sqlv'];

    $qry = "UPDATE vps_account SET ssms = ? WHERE id = ?";
    if( ! $commons->doThis($qry,[1,$webid]) ){
            // require_once("views/admin/share.php");
            die("error");
    }
// echo $;
// die;
    $msgsession = 'msg';
    $msg = "SQLサーバー $vm_action のインストールが完了しました。";
    $install = true;
    if($vm_action==2016){
        $qry = "UPDATE vps_account SET mssql_16 = ? WHERE id = ?";
        if($web_mssql_2016==1){
            $msgsession = 'msg';
            $msg = "SQLサーバー $vm_action はインストール済みです";
            $install = false;
        }
    }elseif ($vm_action==2017){
        $qry = "UPDATE vps_account SET mssql_17 = ? WHERE id = ?";
        if($web_mssql_2017==1){
            $msgsession = "msg";
            $msg = "SQLサーバー $vm_action はインストール済みです";
            $install = false;
        }
    }else{
        $qry = "UPDATE vps_account SET mssql_19 = ? WHERE id = ?";
        if($web_mssql_2019==1){
            $msgsession = "msg";
            $msg = "SQLサーバー $vm_action はインストール済みです";
            $install = false;
        }
    }
    if($install)
    {
        if( ! $commons->doThis($qry,[1,$webid]) ){
                // require_once("views/admin/share.php");
                die("error");
        }
        $res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$web_ssms);
        // die();
    }
    
    // shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action.' '.$web_ssms);
}
$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
flash($msgsession,$msg);

header("location: /admin/vps/various?setting=easy_install&tab=easy_install&act=index&webid=$webid");

?>