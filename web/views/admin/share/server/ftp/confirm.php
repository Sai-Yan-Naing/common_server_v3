<?php
require_once('views/admin/admin_shareconfig.php');
$permission=$_POST['permission'];
$action = $_POST['action'];
// die($action);
$msg = "jp message";
$msgsession ="msg";
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
    $permission = implode(",",$permission);
	
	$msg = "FTPユーザー 「".$ftp_user."」 の追加が完了しました。";
	$msgsession ="msg";

    $insert_q = "INSERT INTO db_ftp (ftp_user, ftp_pass, domain, permission) VALUES ('$ftp_user', '$ftp_pass', '$webdomain', '$permission')";
	if ( !$commons->doThis($insert_q))
	{
		$error="cannot add ftp user";
		require_once('views/admin/share/server/ftp/index.php');
		die();
	}
} elseif ($action=='edit')
{
	 $ftp_user=$_POST['ftp_user'];
	 $ftp_pass=$_POST['ftp_pass'];
	 $act_id=$_POST['act_id'];
	 
	 $permission = implode(",",$permission);
     $update_q = "UPDATE db_ftp SET ftp_pass='$ftp_pass', permission='$permission' WHERE id='$act_id' and domain='$webdomain'";
	 if ( !$commons->doThis($update_q))
	 {
	 	$error="cannot update ftp";
		require_once('views/admin/share/server/ftp/index.php');
		die();
	 }
	 $msg = "FTPユーザー 「".$ftp_user."」 を変更しました";
	 $msgsession ="msg";
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
		require_once('views/admin/share/server/ftp/index.php');
		die();
	}
	
	$msg = "FTPユーザー 「".$ftp_user."」 を削除しました";
	$msgsession ="msg";
}
$originuser = '';
if ( $weborigin!=1)
{
	$originuser = $webrootuser;
}
Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/add_ftp.ps1" '. $ftp_user." ".$ftp_pass." ".$webuser." ".$per." ".$action." ".$originuser);
flash($msgsession,$msg);
header("location: /admin/share/server?setting=ftp&tab=tab&act=index&webid=$webid$pagy");
?>