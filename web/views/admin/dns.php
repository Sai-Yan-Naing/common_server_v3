<?php
$act = $_GET['act'];
$tab=$_GET['tab'];
$actArr = ['index','new','delete','edit','confirm'];
if ( isset($act) && in_array($act,$actArr))
{
    require_once("views/admin/dns/$tab/$act.php");
}else{
   echo "error 404"; 
}
die();