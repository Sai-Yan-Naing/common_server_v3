<?php
require_once('views/share_config.php');
$permission=$_POST['permission'];
$action = $_POST['action'];
// die($action);
$msg = "jp message";
$msgsession ="msg";
$pserr = false;
$res = 'noerror';
$per = "";
if (in_array("F", $permission))
{
    $per = "F";
} elseif (in_array("W", $permission))
{
    $per = "W";
}else{
    $per = "R";
}

if ( $action=='new')
{
    
	$ftp_user=$_POST['ftp_user'];
	
	$ftp_pass=$_POST['ftp_pass'];
	$dir_path=$_POST['dir_path'];
    $permission = implode(",",$permission);
	
	$msg = "FTPユーザー 「".$ftp_user."」 の追加が完了しました";
	$msgsession ="msg";
	$getcount = "SELECT count(db_ftp.id) FROM db_ftp INNER JOIN web_account on db_ftp.domain = web_account.domain where db_ftp.ftp_user = '$ftp_user' and web_account.web_server_id='$web_server_id' and db_ftp.domain = '$webdomain'";
    $getindb = $commons->getCount($getcount);
    if($getindb>0){
        $data = ['status'=>true, "field"=>"ftp_user", "error"=>"$ftp_user を取得することができません。別の名前を指定してください。"];
        echo json_encode($data);
        die;
    }
    $insert_q = "INSERT INTO db_ftp (ftp_user, ftp_pass, domain, permission, dir_path) VALUES ('$ftp_user', '$ftp_pass', '$webdomain', '$permission', '$dir_path')";
	if ( !$commons->doThis($insert_q))
	{
		$error="cannot add ftp user";
		require_once('views/share/server/ftp/index.php');
		die();
	}
	$dir_path = 'web\\'.$dir_path;
	if (isset($dir_path) && $dir_path !='') {
	  $res = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/directory.ps1" new '.$web_host.' '.$web_user.' '.$web_password.' '.$ftp_user.' '.$ftp_pass.' '.$webuser.'\\'.$dir_path.' F new '.$originuser);
	}
	
	$data = ['status'=>false, "message"=>"ok"];
    echo json_encode($data);
	$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
    flash($msgsession,$msg);
    die;
} elseif ($action=='edit')
{
	 $ftp_user=$_POST['ftp_user'];
	 $ftp_pass=$_POST['ftp_pass'];
	 $dir_path=$_POST['dir_path'];
	 $act_id=$_POST['act_id'];
	 
	 $permission = implode(",",$permission);
     $update_q = "UPDATE db_ftp SET ftp_pass='$ftp_pass', permission='$permission', dir_path='$dir_path' WHERE id='$act_id' and domain='$webdomain'";
	 if ( !$commons->doThis($update_q))
	 {
	 	$error="cannot update ftp";
		require_once('views/share/server/ftp/index.php');
		die();
	 }
	 $dir_path = 'web\\'.$dir_path;
	 if (isset($dir_path) && $dir_path !='') {
	  $res = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/directory.ps1" edit '.$web_host.' '.$web_user.' '.$web_password.' '.$ftp_user.' '.$ftp_pass.' '.$webuser.'\\'.$dir_path.' F edit '.$originuser);
	}
	 $msg = "FTPユーザー 「".$ftp_user."」 を変更しました";
	 $msgsession ="msg";
	 $data = ['status'=>false, "message"=>"ok"];
    echo json_encode($data);
	$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
    flash($msgsession,$msg);
    die;
}else
{
	$act_id=$_POST['act_id'];
	$ftp_user=$_POST['ftp_user'];
	$ftp_pass = "noneed";
	$per = "noneed";
    $delete_q = "DELETE FROM db_ftp WHERE id='$act_id'";
	if ( !$commons->doThis($delete_q))
	{
		$error="Cannot delete FTP";
		require_once('views/share/server/ftp/index.php');
		die();
	}
	$dir_path = 'web\\';
	if (isset($dir_path) && $dir_path !='') {
	  $res = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/directory.ps1" delete '.$web_host.' '.$web_user.' '.$web_password.' '.$ftp_user.' noneed '.$webuser.'\\'.$dir_path.' noneed delete '.$originuser);
	}
	
	$msg = "FTPユーザー 「".$ftp_user."」 を削除しました";
	$msgsession ="msg";
}
$originuser = '';
if ( $weborigin!=1)
{
	$originuser = $webrootuser;
}
// Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/add_ftp.ps1" '. $ftp_user." ".$ftp_pass." ".$webuser." ".$per." ".$action." ".$originuser);
// echo $per;
// die;
//if ($dir_path =='') {
//   Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/ftp.ps1" ftp '.$web_host.' '.$web_user.' '.$web_password.' '.$ftp_user.' '.$ftp_pass.' '.$webuser.' '.$per. ' '.$action.' '.$originuser);
// }

// die;
$res = json_decode($res);
    if($res->error){
        $pserr = true;
    }
	if($pserr){
        $msgsession = 'msg';
        $msg = $res->msg;
    }
flash($msgsession,$msg);
header("location: /share/server?setting=ftp&tab=tab&act=index&webid=$webid$pagy");
?>