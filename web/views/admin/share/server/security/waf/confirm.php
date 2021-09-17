<?php
require_once('views/admin/admin_shareconfig.php');
// die('hello');
// if(!isset($_POST['switch'])){header("location: /admin/share/server/security/waf/index?webid=$webid");}

require_once ('models/security.php');
$security = new Security;
$waf = $security->getSecurity($webdomain);
$switch = $_POST['switch'];
$onoff = 0;
if(isset($_POST['onoff']) and $_POST['onoff'])
{
	$onoff = 1;
}
if($switch=='usage')
{
	echo $usage_query = "UPDATE waf SET `usage`='$onoff' WHERE `domain`='$webdomain'";
	if(!$commons->doThis($usage_query))
	{
		$error = "Usage cannot be change";
		require_once ("views/admin/share/server/security/waf/index.php");
		// header("location: /admin/share/server/security/waf/index?webid=$webid");
	}
}else{
	echo $display_query = "UPDATE waf SET `display`='$onoff' WHERE `domain`='$webdomain'";
	if(!$commons->doThis($display_query))
	{
		$error = "Display cannot be change";
		require_once ("views/admin/share/server/security/waf/index.php");
		// header("location: /admin/share/server/security/waf/index?webid=$webid");
	}
}
header("location: /admin/share/server?setting=security&tab=waf&act=index&webid=$webid");

?>