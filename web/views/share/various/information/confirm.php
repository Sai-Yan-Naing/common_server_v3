<?php
require_once("views/share_config.php");
$action = $_POST['action'];
$msg = "jp message";
$msgsession ="msg";
$pserr = false;
$res = 'noerror';
if ( $action=='onoff' )
{
    $act_id = $_POST['act_id'];
    $stopped = $_POST['stopped']==0? 1 : 0;
    $startstop = $_POST['stopped']==0? "stop" : "start";
    $stsp = $_POST['stopped']==0? "停止" : "起動";
    $sitename = $_POST['sitename'];
    $msg = "WEBサイト「".$sitename ."」を".$stsp."しました";
    $qry = "UPDATE web_account SET stopped = ? WHERE id = ?";

    if ( ! $commons->doThis($qry,[$stopped,$act_id]) )
    {
            require_once("views/share/various/information/index.php");
            die("");
    }
    // echo shell_exec("%windir%\system32\inetsrv\appcmd.exe $startstop sites $sitename");
    $res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/onoff.ps1" site '.$web_host.' '.$web_user.' '.$web_password.' '.$startstop. ' '.$sitename);
    if(preg_replace("/\s+/", "", $res)=='error'){
        $pserr = true;;
    }
    // die;
} elseif ($action=='apponoff')
{
    $act_id = $_POST['act_id'];
    $appstopped = $_POST['appstopped']==0? 1 : 0;
    $startstop = $_POST['appstopped']==0? "stop" : "start";
    $stsp = $_POST['appstopped']==0? "停止" : "起動";
    $sitename = $_POST['sitename'];
    $msg = "アプリケーションプールを".$stsp."しました";
    $qry = "UPDATE web_account SET appstopped = ? WHERE id = ?";
    if ( ! $commons->doThis($qry,[$appstopped,$act_id]) )
    {
        require_once("views/share/various/information/index.php");
            die("");
    }
    // echo shell_Exec("%windir%\system32\inetsrv\appcmd.exe $startstop  apppool /apppool.name:$sitename");
    
    $res = shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/onoff.ps1" app '.$web_host.' '.$web_user.' '.$web_password.' '.$startstop. ' '.$sitename);
    if(preg_replace("/\s+/", "", $res)=='error'){
        $pserr = true;;
    }
}
if($pserr){
    $msgsession = 'msg';
    $msg = 'powershellerror';
}
flash($msgsession,$msg);
header("location: /share/various?setting=information&act=index");