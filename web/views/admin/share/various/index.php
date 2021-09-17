<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['information','backup'];
// $TabArr = ['smtp','pop','tab'];
$actArr = ['index','new','delete','edit','onoff','apponoff','confirm','restore'];
if(isset($setting) && in_array($setting,$setArr)){
            if(isset($act) && in_array($act,$actArr)){
                    include "views/admin/share/various/$setting/$act.php";
            }else{
                include 'views/admin/share/404.php';
            }
}else{
    include 'views/admin/share/404.php';
}
// if(isset($setting) && isset($tab) && isset($act) && $tab != null && $setting != null && $act != null && in_array($setting,$setArr)){
//     // echo "hello";
//     include "views/admin/share/mail/$setting/$tab/$act.php";
// }else{
//     // echo "404";
//     include 'views/admin/share/404.php';
// }
die();
?>