<?php
require_once("views/admin/admin_shareconfig.php");
$action = $_POST['action'];
$msg = "jp message";
$msgsession ="msg";
if ( $action=='onoff' )
{
    $act_id = $_POST['act_id'];
    $stopped = $_POST['stopped']==0? 1 : 0;
    $startstop = $_POST['stopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];
    $qry = "UPDATE web_account SET `stopped` = ? WHERE `id` = ?";
    if ( ! $commons->doThis($qry,[$stopped,$act_id]) )
    {
            require_once("views/admin/share/various/information/index.php");
            die("");
    }
    echo shell_exec("%windir%\system32\inetsrv\appcmd.exe $startstop sites $sitename");
    // die;
} elseif ($action=='apponoff')
{
    $act_id = $_POST['act_id'];
    $appstopped = $_POST['appstopped']==0? 1 : 0;
    $startstop = $_POST['appstopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];
    $qry = "UPDATE web_account SET `appstopped` = ? WHERE `id` = ?";
    if ( ! $commons->doThis($qry,[$appstopped,$act_id]) )
    {
        require_once("views/admin/share/various/information/index.php");
            die("");
    }
    echo shell_Exec("%windir%\system32\inetsrv\appcmd.exe $startstop  apppool /apppool.name:$sitename");
}
flash($msgsession,$msg);
header("location: /admin/share/various?setting=information&act=index&webid=$webid");