<?php
require_once("views/admin/admin_config.php");
$to = $_GET['to'];
$t_domain = $_POST['domain'];

$msgsession =  "msg";
$msg = "申請が完了しました。<br>弊社にて申請を確認できましたら、作業について御案内させていただきますので今しばらくお待ちください";

if ($to === 'domain_search')
{
	$subject = "Domain search";
	$domain = "Domain search body";
	$body = "Domain $t_domain";
}
else
{
	$authcode = '';
	if (isset($_POST['authcode']) && $_POST['authcode'] !== null)
	{
		$authcode = 'AuthCode ' . $_POST['authcode'];
	}

	$subject = "Domain transfer";
	$body = "Domain $t_domain $authcode";
}

$webmailer->sendMail(TO, TONAME, $subject, $body);
flash($msgsession,$msg);
header("location: /admin/domain-transfer?tab=share&act=index");
