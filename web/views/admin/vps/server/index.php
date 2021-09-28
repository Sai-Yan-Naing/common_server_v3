<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$TabArr = ['connection','basic'];
// $securityTabArr = ['ssl','waf','directory','ip'];
// $databaseTabArr = ['mysql','mssql','mariadb'];
// $ftpTabArr = [''];
// $fileTabArr = [''];
// $analysisTabArr = [''];
$actArr = ['index','new','delete','edit','onoff','confirm','onoff_confirm'];
        if(isset($tab) && in_array($tab,$TabArr)){
            if(isset($act) && in_array($act,$actArr)){
                    if($act=='onoff' || $act=="onoff_confirm"){
                        include "views/admin/vps/server/$act.php";
                    }else{
                        include "views/admin/vps/server/$tab/$act.php";
                    }
            }else{
                include 'views/admin/vps/404.php';
            }
        }else{
            include 'views/admin/vps/404.php';
        }
// if(isset($setting) && isset($tab) && isset($act) && $tab != null && $setting != null && $act != null && in_array($setting,$setArr)){
//     // echo "hello";
//     include "views/admin/vps/server/$setting/$tab/$act.php";
// }else{
//     // echo "404";
//     include 'views/admin/vps/404.php';
// }
die();
?>