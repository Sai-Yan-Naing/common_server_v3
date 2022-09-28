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
    
    $web_server_id = $_POST['web_server'];
    $contract = $_POST['contractid'];

    $getmailserver = $commons->getRow("
    select mailserver.ip,mailserver.username,mailserver.password from web_account inner join mailserver on mailserver.id =web_account.mailserver where web_account.id= ?",[$contract]);
    $mailserverip = $getmailserver['ip'];
    $mailserveruser = $getmailserver['username'];
    $mailserverpass = $getmailserver['password'];
// die;
    $web_server = "SELECT * FROM web_server_config WHERE id='$web_server_id'";
    $gethost = $commons->getRow($web_server);
    $web_host = $gethost['ip'];
    $web_user = $gethost['username'];
    $web_password = $gethost['password'];
    
    $temp["ID1-".time()] = ['type'=>'A','sub'=>'mail','target'=>$mailserverip];
    $temp["ID2-".time()] = ['type'=>'A','sub'=>'www','target'=>$web_host];
    $temp["ID3-".time()] = ['type'=>'A','sub'=>'','target'=>$web_host];
    $temp["ID4-".time()] = ['type'=>'MX','sub'=>'','target'=>'mail.'.$webdomain];
    
    $temp1["app"] = ['php'=>DEFAULT_PHP,'dotnet'=>DEFAULT_DOTNET];
    $dns = json_encode($temp);
    $app_version = json_encode($temp1);

    $msg = "サイトの追加が完了しました";
    $msgsession ="msg";

    $insert_q = "INSERT INTO web_account (domain, password, [user], [plan],web_server_id, customer_id,dns,app_version,origin_id,mail_cnt) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?)";
    $insert_ftp = "INSERT INTO db_ftp (ftp_user, ftp_pass, domain, permission) VALUES (?, ?, ?, ?)";
    $insert_waf = "INSERT INTO waf (domain, usage, display) VALUES (?, ?, ?)";
    $insert_mail = "INSERT INTO add_email (domain, email, password) VALUES ( ?, ?, ?)";

    if (
        !$commons->doThis($insert_q,[$webdomain, $password1, $user, 1, $web_server_id, $webadminID,$dns,$app_version,$contract,1]) ||
        !$commons->doThis($insert_ftp,[$user, $password, $webdomain, 'F,R,W']) ||
        !$commons->doThis($insert_waf,[$webdomain, 0, 0]) ||
        !$commons->doThis($insert_mail,[$webdomain, 'root', $password])
    )
    {
            require_once("views/admin/share.php");
            die("");
    }
    $query_origin = "SELECT * FROM web_account WHERE customer_id = '$_COOKIE[admin]' and origin=1 and id='$contract'";
    $origin= $commons->getRow($query_origin);
    $origin_user= $origin['user'];

    // shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/addsite.ps1" '.$webdomain.' '.$user.' '.$password.' '.$ip. ' '.$origin_user);

     shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/new.ps1" new '.$web_host.' '.$web_user.' '.$web_password.' '.$webdomain.' '.$user.' '.$password.' '.$web_host. ' '.$origin_user);

    // $commons->mail_server($webdomain,'winserverroot','welcome123!','new','noexist');

    $size = $webplnmail*1073741824;

    shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" new '.$mailserverip.' '.$mailserveruser.' '.$mailserverpass.' '.$webdomain.' '.$password.' '.$user.' '.$size);

    // die;
} elseif ( $action === 'onoff')
{
    // die('ok');
    $act_id = $_POST['act_id'];
    $stopped = $_POST['stopped']==0? 1 : 0;
    $startstop = $_POST['stopped']==0? "stop" : "start";
    $sitename = $_POST['sitename'];

    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $webdomain = $getRow['domain'];

    $web_server_id = $getRow['web_server_id'];

    $msgsession = $_POST['stopped']==0? "msgdel" : "msg";
    $msg = $_POST['stopped']==0? $webdomain."を停止しました" : $webdomain."を起動しました";

    $web_server = "SELECT * FROM web_server_config WHERE id='$web_server_id'";
    $gethost = $commons->getRow($web_server);
    $web_host = $gethost['ip'];
    $web_user = $gethost['username'];
    $web_password = $gethost['password'];

    $qry = "UPDATE web_account SET stopped = '$stopped' WHERE id = ?";
    if( ! $commons->doThis($qry,[$act_id])){
            require_once("views/admin/share.php");
            die("");
    }
    // shell_exec("%windir%\system32\inetsrv\appcmd.exe $startstop sites $sitename");
    shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/onoff.ps1" site '.$web_host.' '.$web_user.' '.$web_password.' '.$startstop. ' '.$sitename);
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

    $web_server_id = $getRow['web_server_id'];

    $web_server = "SELECT * FROM web_server_config WHERE id='$web_server_id'";
    $gethost = $commons->getRow($web_server);
    $web_host = $gethost['ip'];
    $web_user = $gethost['username'];
    $web_password = $gethost['password'];

    $msgsession = $_POST['appstopped']==0? "msgdel" : "msg";
    $msg = $_POST['appstopped']==0? $webdomain."を停止しました" : $webdomain."を起動しました";
    $qry = "UPDATE web_account SET appstopped = '$appstopped' WHERE id = ?";
    if ( ! $commons->doThis($qry,[$act_id])){
            require_once("views/admin/share.php");
            die("");
    }
    // echo shell_Exec("%windir%\system32\inetsrv\appcmd.exe $startstop  apppool /apppool.name:$sitename");
    shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/onoff.ps1" app '.$web_host.' '.$web_user.' '.$web_password.' '.$startstop. ' '.$sitename);
    // die;
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
    // $do = $_POST['sitebinding']==0? "+" : "-";
    $do = $_POST['sitebinding']==0? "new" : "remove";
    $msgsession = $_POST['sitebinding']==0? "msg" : "msgdel";
    $msg = $_POST['sitebinding']==0? 
    "$sitename.winserver.ne.jpを追加しました".
    "<br>ＤＮＳの追加まで今しばらくお待ちください".
    "<br>弊社よりＤＮＳ追加作業後連絡させていただきます" : 
    "$sitename.winserver.ne.jpを削除しました";

    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $webdomain = $getRow['domain'];


    $web_server_id = $getRow['web_server_id'];

    $web_server = "SELECT * FROM web_server_config WHERE id='$web_server_id'";
    $gethost = $commons->getRow($web_server);
    $web_host = $gethost['ip'];
    $web_user = $gethost['username'];
    $web_password = $gethost['password'];

    $qry = "UPDATE web_account SET sitebinding = '$sitebinding' WHERE id = $act_id";
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
    // shell_exec("%systemroot%\system32\inetsrv\appcmd.exe set site /site.name:$sitename /".$do."bindings.[protocol='http',bindingInformation='".$ip.":80:".$bindDomain."']");


    shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/sitebinding.ps1" '.$do.' '.$web_host.' '.$web_user.' '.$web_password.' '.$bindDomain.' '.$sitename);
    // die;
    
} elseif ($action == 'delete')
{
    
    $today = date("Y-m-d H:i:s");
    $act_id = $_POST['act_id'];
    $query = "SELECT * FROM web_account WHERE id='$act_id'";
    $getRow = $commons->getRow($query);
    $rquery = "SELECT * FROM web_account WHERE id='$getRow[origin_id]'";
    $rgetRow = $commons->getRow($rquery);
    $sitebinding = $_POST['sitebinding']==0? 1 : 0;
    $msgsession = "msgdel";
    $msg = $getRow['domain']."を削除しました";
    $del_query = "UPDATE web_account SET removal='$today' WHERE id='$act_id'";
    if(!$commons->doThis($del_query)){
            require_once("views/admin/share.php");
            die("");
    }
    $subject = 'サブドメイン「'.$getRow['domain'].'」が削除されました';
    $body = $rgetRow['domain'].'['.$webplnname.']<br>';
    $body .= 'サブドメイン「'.$getRow['domain'].'」<br>';
    $body .= '削除されました';
    if ( ! $webmailer->sendMail(TO, TONAME, $subject, $body))
    {
        echo $error = 'Cannot send email';
        die();
    }
    $sitename = $getRow['user'];
    $startstop = 'stop';
    shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/site/onoff.ps1" sitedelete '.$web_host.' '.$web_user.' '.$web_password.' '.$startstop. ' '.$sitename);
}
flash($msgsession,$msg);

header("location: /admin$pagyc");