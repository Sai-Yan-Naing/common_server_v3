<?php
require_once("views/admin/admin_config.php");
$to = $_GET['to'];
$t_domain = $_POST['domain'];

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
header("location: /admin/domain-transfer?tab=share&act=index");
