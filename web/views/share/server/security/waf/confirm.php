<?php
require_once('views/share_config.php');
// die('hello');
// if ( !isset($_POST['switch'])){header("location: /share/server/security/waf/index?webid=$webid");}

require_once ('models/security.php');
$security = new Security;
$waf = $security->getSecurity($webdomain);
$switch = $_POST['switch'];
if ( $switch=='usage')
{
	$onoff = (int)$waf['usage']==1? 0 : 1;
	echo $usage_query = "UPDATE waf SET usage='$onoff' WHERE domain=?";
	if ( !$commons->doThis($usage_query,[$webdomain]))
	{
		$error = "Usage cannot be change";
		require_once ("views/share/server/security/waf/index.php");
		// header("location: /share/server/security/waf/index?webid=$webid");
	}
} else
{
	$onoff = (int)$waf['display']==1? 0 : 1;
	echo $display_query = "UPDATE waf SET display='$onoff' WHERE domain=?";
	if ( !$commons->doThis($display_query, [$webdomain]))
	{
		$error = "Display cannot be change";
		require_once ("views/share/server/security/waf/index.php");
		// header("location: /share/server/security/waf/index?webid=$webid");
	}
}
header("location: /share/server?setting=security&tab=waf&act=index");