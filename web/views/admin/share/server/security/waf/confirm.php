<?php
require_once('views/admin/admin_shareconfig.php');
// die('hello');
// if ( !isset($_POST['switch'])){header("location: /admin/share/server/security/waf/index?webid=$webid");}

require_once ('models/security.php');
$security = new Security;
$waf = $security->getSecurity($webdomain);
$switch = $_POST['switch'];
$msg = "jp message";
$msgsession ="msg";
if ( $switch=='usage')
{
	$onoff = (int)$waf['usage']==1? 0 : 1;
	$msg = (int)$waf['usage']==1? '利用設定をオフにしました' : '利用設定をONにしました。';
	$usage_query = "UPDATE waf SET `usage`='$onoff' WHERE `domain`=?";
	if ( !$commons->doThis($usage_query,[$webdomain]))
	{
		$error = "Usage cannot be change";
		require_once ("views/admin/share/server/security/waf/index.php");
		// header("location: /admin/share/server/security/waf/index?webid=$webid");
	}
} else
{
	$onoff = (int)$waf['display']==1? 0 : 1;
	$msg = (int)$waf['display']==1? '表示切替をオフにしました。' : '表示切替をONにしました。';
	 $display_query = "UPDATE waf SET `display`='$onoff' WHERE `domain`=?";
	if ( !$commons->doThis($display_query, [$webdomain]))
	{
		$error = "Display cannot be change";
		require_once ("views/admin/share/server/security/waf/index.php");
		// header("location: /admin/share/server/security/waf/index?webid=$webid");
	}
}
flash($msgsession,$msg);
header("location: /admin/share/server?setting=security&tab=waf&act=index&webid=$webid");