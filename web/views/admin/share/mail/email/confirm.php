<?php
require_once('views/admin/admin_shareconfig.php');
$email=$_POST['email'];

$query = "SELECT * FROM add_email WHERE domain='$webdomain'";
$isexist='noexist';
if(count($commons->getAllRow($query)) > 0 )
{
    $isexist='exist';
}
$action =$_POST['action'];
if(isset($_POST['action']) and $_POST['action']=='new')
{
	$mail_pass_word=$_POST['mail_pass_word'];
	$insert_q = "INSERT INTO add_email (`domain`, `email`, `password`) VALUES ('$webdomain', '$email', '$mail_pass_word')";
	if(!$commons->doThis($insert_q))
	{
		$error  = "Email Cannot be add.";
		require_once('views/admin/share/mail/index.php');
		die("");
	}
}else if(isset($_POST['action']) and $_POST['action']=='edit') {
	$mail_pass_word=$_POST['mail_pass_word'];
	$act_id=$_POST['act_id'];
	$update_q = "UPDATE add_email SET password='$mail_pass_word'WHERE id='$act_id' and domain='$webdomain'";
	 if(!$commons->doThis($update_q))
	 {
		$error  = "Email Cannot be update.";
		require_once('views/admin/share/mail/index.php');
		die("");
	}
}else{
	$act_id=$_POST['act_id'];
    $delete_q = "DELETE FROM add_email WHERE id='$act_id'";
	if(!$commons->doThis($delete_q))
	{
		$error = "Cannot Delete Email";
		require_once('views/admin/share/mail/index.php');
		die();
	}
}

$commons->mail_server($webdomain,$email,$mail_pass_word,$action,$isexist);
header("location: /admin/share/mail?setting=email&tab=tab&act=index&webid=$webid");

?>