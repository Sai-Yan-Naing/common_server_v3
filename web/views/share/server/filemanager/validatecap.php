<?php
require_once('views/share_config.php');


$res = array('status'=>false);
$webcapacity = folderSize($web_host,$web_user,$web_password,$webrootuser); 
// $webcapacity = 1196489688; 

if($webcapacity > $webplnwebcapacity(1073741824))
{
	$res = array('status'=>true);
}

echo json_encode($res);