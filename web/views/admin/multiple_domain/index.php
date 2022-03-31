<?php
$act = $_GET['act'];
$actArr = ['index','new','delete','onoff','apponoff','confirm','sitebinding','validatecap'];
if ( isset($act) && in_array($act,$actArr) )
{
    require_once("views/admin/multiple_domain/$act.php");
} else
{
   echo "error 404"; 
}
die();
?>