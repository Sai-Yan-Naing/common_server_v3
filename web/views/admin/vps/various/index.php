<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['firewall','load_status','option','easy_install','backup'];
// $TabArr = ['smtp','pop','tab'];
$actArr = ['index','new','delete','edit','license'];
if(isset($setting) && in_array($setting,$setArr)){
            if(isset($act) && in_array($act,$actArr)){
                    include "views/admin/vps/various/$setting/$act.php";
            }else{
                include 'views/admin/vps/404.php';
            }
}else{
    include 'views/admin/vps/404.php';
}
die();
?>