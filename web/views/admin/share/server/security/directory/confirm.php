<?php
require_once('views/admin/admin_shareconfig.php');
if ( !isset($_POST['action']) || !isset($_POST['ftp_user']))
{ 
	header("location: /admin/share/server?setting=security&tab=directory&act=index&webid=$webid"); die();
}
$msg = "jp message";
$msgsession ="msg";
$originuser = '';
if ( $weborigin!=1)
{
	$originuser = $webrootuser;
}
if ( isset($_POST['action']) and $_POST['action'] === 'new')
{
	$ftp_user=$_POST['ftp_user'];
	$ftp_pass=$_POST['ftp_pass'];
	$dir_path=$_POST['dir_path'];
	$msg = "ディレクトリ [".$dir_path."] に　ユーザー [".$ftp_user."] のアクセス権限に追加しました。";
    $insert_q = "INSERT INTO sub_ftp (domain, ftp_user, ftp_pass, path) VALUES (?, ?, ?, ?)";
	if ( !$commons->doThis($insert_q,[$webdomain, $ftp_user, $ftp_pass, $dir_path]))
	{
		$error=$ftp_user." cannot insert to Database";
		require_once('views/admin/share/server/security/directory/index.php');
		die();
	}
	if ( !createDir($webrootuser.'/'.$webuser.'/web/'.$dir_path))
	{
		$error=$ftp_user." cannot create directory.";
		require_once('views/admin/share/server/security/directory/index.php');
		die();
	}
	Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/add_ftp.ps1" '. $ftp_user." ".$ftp_pass." ".$webuser.'/web/'.$dir_path." F"." new ".$originuser);
}elseif ( isset($_POST['action']) and $_POST['action']==='edit')
{
	 $ftp_user=$_POST['ftp_user'];
	 $ftp_pass=$_POST['ftp_pass'];
	 $dir_path=$_POST['dir_path'];
	 $act_id=$_POST['act_id'];
     $update_q = "UPDATE sub_ftp SET ftp_pass='$ftp_pass' WHERE id=? and domain=? ";
	 if ( !$commons->doThis($update_q,[$act_id,$webdomain]))
	 {
	 	$error=$ftp_user." cannot update password.";
		require_once('views/admin/share/server/security/directory/index.php');
		die();
	 }
	 Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/add_ftp.ps1" '. $ftp_user." ".$ftp_pass." ".$webuser.'/web/'.$dir_path." F"." edit ".$originuser);	
}else
{
	$act_id=$_POST['act_id'];
	$ftp_user=$_POST['ftp_user'];
	$dir_path=$_POST['dir_path'];
    $delete_q = "DELETE FROM sub_ftp WHERE id= ? ";
	$msg = "ディレクトリ [".$dir_path."] に　ユーザー [".$ftp_user."] のアクセス権限を削除しました。";
	if ( !$commons->doThis($delete_q,[$act_id]))
	{
		$error=$ftp_user." cannot delete.";
		require_once('views/admin/share/server/security/directory/index.php');
		die();
	}
	Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/ftp/add_ftp.ps1" '. $ftp_user." "."noneed"." ".$webuser.'/web/'.$dir_path." "."noneed"." delete ".$originuser);
	$dirname = "E:\webroot\LocalUser/$webrootuser/$webuser/web/$dir_path";
	if ( is_dir($dirname))
	{
          //Directory does not exist, so lets create it.
          // @mkdir($path, 0755, true);
		delete_directory($dirname);
      }
}
flash($msgsession,$msg);
header("location: /admin/share/server?setting=security&tab=directory&act=index&webid=$webid");

?>