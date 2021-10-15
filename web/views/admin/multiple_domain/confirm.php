<?php
require_once("views/admin/admin_config.php");
$action = $_POST['action'];
if ( $action === 'new' )
{
    $webdomain = $_POST['domain'];
    $password = $_POST['password'];
    $password1 = hash_hmac('sha256', $password, PASS_KEY);
    $user = $_POST['ftp_user'];
    
    $temp["ID1-".time()] = ['type'=>'A','sub'=>'mail','target'=>IP];
    $temp["ID2-".time()] = ['type'=>'A','sub'=>'www','target'=>IP];
    $temp["ID3-".time()] = ['type'=>'A','sub'=>'','target'=>IP];
    $temp["ID4-".time()] = ['type'=>'MX','sub'=>'','target'=>'mail.'.$webdomain];
    
    $temp1["app"] = ['php'=>DEFAULT_PHP,'dotnet'=>DEFAULT_DOTNET];
    $dns = json_encode($temp);
    $app_version = json_encode($temp1);
    
    $insert_q = "INSERT INTO web_account (`domain`, `password`, `user`, `plan`, `customer_id`,`dns`,`app_version`) VALUES (?, ?, ?, ?, ?,?,?)";
    $insert_ftp = "INSERT INTO db_ftp (`ftp_user`, `ftp_pass`, `domain`, `permission`) VALUES (?, ?, ?, ?)";
    $insert_waf = "INSERT INTO waf (`domain`, `usage`, `display`) VALUES (?, ?, ?)";
    if (
        !$commons->doThis($insert_q,[$webdomain, $password1, $user, 1, $webadminID,$dns,$app_version]) ||
        !$commons->doThis($insert_ftp,[$user, $password, $webdomain, 'F,R,W']) ||
        !$commons->doThis($insert_waf,[$webdomain, 0, 0])
    )
    {
            require_once("views/admin/share.php");
            die("");
    }
    $query_origin = "SELECT * FROM web_account WHERE `customer_id` = '$_COOKIE[admin]' and `origin`=1";
    $origin= $commons->getRow($query_origin);
    $origin_user= $origin['user'];
    $ip=IP;
	echo shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/addsite.ps1" '.$webdomain.' '.$user.' '.$password.' '.$ip. ' '.$origin_user);
} elseif ( $action === 'onoff')
{
    $act_id = $_POST['act_id'];
    $stopped = $_POST['stopped']==0? 1 : 0;
    $startstop = $_POST['stopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];
    $qry = "UPDATE web_account SET `stopped` = '$stopped' WHERE `id` = ?";
    if( ! $commons->doThis($qry,[$act_id])){
            require_once("views/admin/share.php");
            die("");
    }
    echo shell_exec("%windir%\system32\inetsrv\appcmd.exe $startstop sites $sitename");
    // die;
} elseif ( $action === 'apponoff')
{
    $act_id = $_POST['act_id'];
    $appstopped = $_POST['appstopped']==0? 1 : 0;
    $startstop = $_POST['appstopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];
    $qry = "UPDATE web_account SET `appstopped` = '$appstopped' WHERE `id` = ?";
    if ( ! $commons->doThis($qry,[$act_id])){
            require_once("views/admin/share.php");
            die("");
    }
    echo shell_Exec("%windir%\system32\inetsrv\appcmd.exe $startstop  apppool /apppool.name:$sitename");
} elseif ( $action=='sitebinding')
{
    $act_id = $_POST['act_id'];
    $sitebinding = $_POST['sitebinding']==0? 1 : 0;
    $subject = $_POST['sitebinding']==0? 'Add Binding': 'Delete Binding';
// for powershell
    $sitename = $_POST['sitename'];
    $bindDomain = $sitename.'.winserver.ne.jp';
    $ip = IP;
    $checker="http/".$ip.":80:".$bindDomain;
    $do = $_POST['sitebinding']===0? "+" : "-";
    $qry = "UPDATE web_account SET `sitebinding` = '$sitebinding' WHERE `id` = $act_id";
    if ( ! $commons->doThis($qry))
    {
            require_once("views/admin/share.php");
            die("");
    }
    $body = "Successfully $subject";
    if ( ! $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body))
    {
        require_once("views/admin/share.php");
            die("");
    }
    echo shell_exec("%systemroot%\system32\inetsrv\appcmd.exe set site /site.name:$sitename /".$do."bindings.[protocol='http',bindingInformation='".$ip.":80:".$bindDomain."']");
    
}elseif($action=='delete'){
    $today = date("Y-m-d H:i:s");
    $act_id = $_POST['act_id'];
    $sitebinding = $_POST['sitebinding']==0? 1 : 0;
    $del_query = "UPDATE web_account SET removal='$today' WHERE id='$act_id'";
    if(!$commons->doThis($del_query)){
            require_once("views/admin/share.php");
            die("");
    }
}

header('location: /admin');


?>