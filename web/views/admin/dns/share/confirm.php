<?php
require_once("views/admin/admin_config.php");
$action = $_POST['action'];
$admin = $webadminID;
$webid = $_GET['webid'];
$type = $_POST['type'];
$sub = $_POST['sub'];
$target = $_POST['target'];
$query = 'SELECT * FROM web_account WHERE `id` = :web_id';
$getDns = $commons->getRow($query, ['web_id' => $webid]);
$domain = $getDns['domain'];
if ($action === 'new')
{
	$temp = json_decode($getDns['dns'], true);
	$temp['ID-' . time()] = ['type' => $type, 'sub' => $sub, 'target' => $target];
	$result = json_encode($temp);
	$msg = "申請が完了しました。<br>".
	"弊社にて作業完了次第、ご連絡させていただきますので<br>".
	"反映まで今しばらくお待ちください。";
    $msgsession ="msg";
}
elseif ($action === 'edit')
{
	$act_id = $_POST['act_id'];
	//  $addDns = $getweball->editDNS($getRow,$sub,$target,$act_id);
	$temp = json_decode($getDns['dns'], true);
	$temp[$act_id]['sub'] = $_POST['sub'];
	$temp[$act_id]['target'] = $_POST['target'];
	$result = json_encode($temp);
	$msg = "申請が完了しました。<br>".
	"弊社にて作業完了次第、ご連絡させていただきますので<br>".
	"反映まで今しばらくお待ちください。";
    $msgsession ="msg";
}
elseif ($action === 'delete')
{
	$act_id = $_POST['act_id'];
	$temp = json_decode($getDns['dns'], true);
	$type = $temp[$act_id]['type'];
	$sub = $temp[$act_id]['sub'];
	$target = $temp[$act_id]['target'];
	unset($temp[$act_id]);
	$result = json_encode($temp);
	$msg = "申請が完了しました。<br>".
	"弊社にて作業完了次第、ご連絡させていただきますので反映まで今しばらくお待ちください。";
    $msgsession ="msgdel";
}

$qry = 'UPDATE web_account SET `dns` = :dns WHERE `id` = :id';
if ( ! $commons->doThis($qry, ['dns' => $result, 'id' => $getDns['id']]))
{
	$error = 'Cannot insert dns';
	require('views/admin/dns/share/index.php');
	die();
}

// $subject = '=?UTF-8?B?' . base64_encode('DNS情報変更申請') . '?=';
// $subject = 'DNS情報変更申請';
$subject = '【Winserver】DNSレコード追加申請完了';
$body = file_get_contents('views/mailer/admin/dns.php');
$body = str_replace('$admin', $webadminName, $body);
$body = str_replace('$sub', $sub, $body);
$body = str_replace('$domain', $domain, $body);
$body = str_replace('$target', $target, $body);
if ( ! $webmailer->sendMail(TO, TONAME, $subject, $body))
{
	$error = 'Cannot send email';
	require('views/admin/dns/share/index.php');
	die();
}
flash($msgsession,$msg);
header('location: /admin/dns?tab=share&act=index&webid=' . $webid.$pagy);
