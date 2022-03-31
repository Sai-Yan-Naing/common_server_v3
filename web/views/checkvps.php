<?php 
header("Content-Type:application/json");
require_once("config/all.php");
require_once("models/common.php");

$param = $_GET['param'];

$commons = new Common;
if($param != 'all')
{
	$vpsactive = $commons->getRow("SELECT * FROM vps_account WHERE id= ?", [$param]);
	// print_r($vpsactive);	
	// if($vpsactive['active']==0 || ($vpsactive['active']==1 AND $vpsactive['reboot']==1)){
	// 	$data['active']
	// 	// echo json_encode($data);
	// }else{
	// 	// echo json_encode($data);
	// }
	$data['active'] = $vpsactive['active'];
	$data['reboot'] = $vpsactive['reboot'];
}else{
	$vpsactive = $commons->getAllRow("SELECT * FROM vps_account WHERE customer_id=?", [$_COOKIE['admin']]);
}
echo json_encode($data);
// echo "<pre>";
// print_r($vpsactive);