<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['email','connection','list'];
$TabArr = ['smtp','pop','tab'];
$actArr = ['index','new','delete','edit'];
if(isset($setting) && in_array($setting,$setArr)){
        if(isset($tab) && in_array($tab,$TabArr)){
            if(isset($act) && in_array($act,$actArr)){
                if($tab=='smtp' || $tab=='pop'){
                    include "views/admin/share/mail/$setting/$tab.php"; 
                }else{
                    include "views/admin/share/mail/$setting/$act.php";
                }
            }else{
                include 'views/admin/share/404.php';
            }
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