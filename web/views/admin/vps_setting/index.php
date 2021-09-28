<?php
$act = $_GET['act'];
$actArr = ['index','delete','onoff','confirm'];
if(isset($act) && in_array($act,$actArr)){
    require_once("views/admin/vps_setting/$act.php");
}else{
   echo "error 404"; 
}
die();
?>