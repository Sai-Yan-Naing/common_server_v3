<?php
require_once('views/share_config.php');
// die('hello');
// if ( !isset($_POST['switch'])){header("location: /share/server/security/waf/index?webid=$webid");}

require_once ('models/security.php');
$security = new Security;
$waf = $security->getSecurity($webdomain);
$switch = $_POST['switch'];
$onoff = 0;
if ( isset($_POST['onoff']) and $_POST['onoff'])
{
	$onoff = 1;
}
if ( $switch=='usage')
{
	echo $usage_query = "UPDATE waf SET `usage`=? WHERE `domain`=?";
	if ( !$commons->doThis($usage_query,[$onoff,$webdomain]))
	{
		$error = "Usage cannot be change";
		require_once ("views/share/server/security/waf/index.php");
		// header("location: /share/server/security/waf/index?webid=$webid");
	}
}else{
	echo $display_query = "UPDATE waf SET `display`=? WHERE `domain`=?";
	if ( !$commons->doThis($display_query,[$onoff,$webdomain]))
	{
		$error = "Display cannot be change";
		require_once ("views/share/server/security/waf/index.php");
		// header("location: /share/server/security/waf/index?webid=$webid");
	}
}
header("location: /share/server?setting=security&tab=waf&act=index");

?>