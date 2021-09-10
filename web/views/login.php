<?php
$act = $_GET['act'];
if(isset($act)){
    require_once("views/login/$act.php");
}else{
    require_once('views/login/index.php');
}
?>