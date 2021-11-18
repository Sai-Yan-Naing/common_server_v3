<?php
require_once("views/admin/admin_config.php");
$to = $_GET['to'];
$t_domain = $_POST['domain'];

$msgsession =  "msg";
$msg = "申請が完了しました。<br>弊社にて申請を確認できましたら、作業について御案内させていただきますので今しばらくお待ちください";

if ($to === 'domain_search')
{
	$subject = "【Winserver】ドメインの取得申請完了";
	$body = file_get_contents('views/mailer/admin/domain/domain_search.php');
	$body = str_replace('$domain', $t_domain, $body);
	$body = str_replace('$name', $webadminName, $body);
}
else
{
	$authcode = '';
	if (isset($_POST['authcode']) && $_POST['authcode'] !== null)
	{
		$authcode = $_POST['authcode'];
	}
	$subject = "【Winserver】ドメインの移管申請完了";
	$body = file_get_contents('views/mailer/admin/domain/domain_transfer.php');
	$body = str_replace('$domain', $t_domain, $body);
	$body = str_replace('$authcode', $authcode, $body);
	$body = str_replace('$name', $webadminName, $body);
}

$webmailer->sendMail(TO, TONAME, $subject, $body);
flash($msgsession,$msg);
header("location: /admin/domain-transfer?tab=share&act=index");
