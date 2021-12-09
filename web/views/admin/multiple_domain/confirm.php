<?php
require_once("views/admin/admin_config.php");
$action = $_POST['action'];
$msgsession = "";
$msg ="";
if ( $action === 'new' )
{
    $webdomain = $_POST['domain'];
    $password = $_POST['password'];
    $password1 = hash_hmac('sha256', $password, PASS_KEY);
    $user = $_POST['ftp_user'];
    
    $temp["ID1-".time()] = ['type'=>'A','sub'=>'mail','target'=>MAILIP];
    $temp["ID2-".time()] = ['type'=>'A','sub'=>'www','target'=>IP];
    $temp["ID3-".time()] = ['type'=>'A','sub'=>'','target'=>IP];
    $temp["ID4-".time()] = ['type'=>'MX','sub'=>'','target'=>'mail.'.$webdomain];
    
    $temp1["app"] = ['php'=>DEFAULT_PHP,'dotnet'=>DEFAULT_DOTNET];
    $dns = json_encode($temp);
    $app_version = json_encode($temp1);

    $msg = "サイトの追加が完了しました。";
    $msgsession ="msg";
    
    $insert_q = "INSERT INTO web_account (`domain`, `password`, `user`, `plan`, `customer_id`,`dns`,`app_version`,`origin_id`) VALUES (?, ?, ?, ?, ?, ?,?,?)";
    $insert_ftp = "INSERT INTO db_ftp (`ftp_user`, `ftp_pass`, `domain`, `permission`) VALUES (?, ?, ?, ?)";
    $insert_waf = "INSERT INTO waf (`domain`, `usage`, `display`) VALUES (?, ?, ?)";
    $insert_mail = "INSERT INTO add_email (`domain`, `email`, `password`) VALUES ( ?, ?, ?)";

    if (
        !$commons->doThis($insert_q,[$webdomain, $password1, $user, 1, $webadminID,$dns,$app_version,$webrootid]) ||
        !$commons->doThis($insert_ftp,[$user, $password, $webdomain, 'F,R,W']) ||
        !$commons->doThis($insert_waf,[$webdomain, 0, 0]) ||
        !$commons->doThis($insert_mail,[$webdomain, 'root', $password])
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
    $commons->mail_server($webdomain,'winserverroot','welcome123!','new','noexist');
} elseif ( $action === 'onoff')
{
    $act_id = $_POST['act_id'];
    $stopped = $_POST['stopped']==0? 1 : 0;
    $startstop = $_POST['stopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];

    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $webdomain = $getRow['domain'];

    $msgsession = $_POST['stopped']==0? "msgdel" : "msg";
    $msg = $_POST['stopped']==0? $webdomain."を停止しました" : $webdomain."を起動しました";

    $qry = "UPDATE web_account SET `stopped` = '$stopped' WHERE `id` = ?";
    if( ! $commons->doThis($qry,[$act_id])){
            require_once("views/admin/share.php");
            die("");
    }
    shell_exec("%windir%\system32\inetsrv\appcmd.exe $startstop sites $sitename");
    // die;
} elseif ( $action === 'apponoff')
{
    $act_id = $_POST['act_id'];
    $appstopped = $_POST['appstopped']==0? 1 : 0;
    $startstop = $_POST['appstopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];

    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $webdomain = $getRow['domain'];

    $msgsession = $_POST['appstopped']==0? "msgdel" : "msg";
    $msg = $_POST['appstopped']==0? $webdomain."を停止しました" : $webdomain."を起動しました";
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
    $subject = $_POST['sitebinding']==0? '【Winserver】エイリアスの追加申し込み完了': '【Winserver】エイリアスの削除完了';
// for powershell
    $sitename = $_POST['sitename'];
    $bindDomain = $sitename.'.winserver.ne.jp';
    $ip = IP;
    $checker="http/".$ip.":80:".$bindDomain;
    $do = $_POST['sitebinding']==0? "+" : "-";
    $msgsession = $_POST['sitebinding']==0? "msg" : "msgdel";
    $msg = $_POST['sitebinding']==0? 
    "$sitename.winserver.ne.jpを追加しました".
    "<br>ＤＮＳの追加まで今しばらくお待ちください".
    "<br>弊社よりＤＮＳ追加作業後連絡させていただきます" : 
    "$sitename.winserver.ne.jpを削除しました";
    $qry = "UPDATE web_account SET `sitebinding` = '$sitebinding' WHERE `id` = $act_id";
    if ( ! $commons->doThis($qry))
    {
            require_once("views/admin/share.php");
            die("");
    }
    $body = file_get_contents('views/mailer/admin/binding/delete.php');
    if ($_POST['sitebinding']==0)
    {
        $body = file_get_contents('views/mailer/admin/binding/add.php');
    }
    $body = str_replace('$name', $webadminName, $body);

    if ( ! $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body))
    {
        require_once("views/admin/share.php");
            die("");
    }
    shell_exec("%systemroot%\system32\inetsrv\appcmd.exe set site /site.name:$sitename /".$do."bindings.[protocol='http',bindingInformation='".$ip.":80:".$bindDomain."']");
    
} elseif ($action=='delete')
{
    
    $today = date("Y-m-d H:i:s");
    $act_id = $_POST['act_id'];
    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $sitebinding = $_POST['sitebinding']==0? 1 : 0;
    $msgsession = "msgdel";
    $msg = $getRow['domain']."を削除しました";
    $del_query = "UPDATE web_account SET removal='$today' WHERE id='$act_id'";
    if(!$commons->doThis($del_query)){
            require_once("views/admin/share.php");
            die("");
    }
}
flash($msgsession,$msg);

header("location: /admin$pagyc");


?>