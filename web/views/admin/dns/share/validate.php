<?php 
header('Content-Type: application/json; charset=utf-8');
require_once("views/admin/admin_config.php");
$webid = $_GET['webid'];
$query = 'SELECT * FROM web_account WHERE id = :web_id';
$getDns = $commons->getRow($query, ['web_id' => $webid]);
$temp = json_decode($getDns['dns'], true);
if(count($temp)>5)
{
    echo json_encode(['status'=>true]);
    die;
}
echo json_encode(['status'=>false]);