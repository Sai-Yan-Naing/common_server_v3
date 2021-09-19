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
$actArr = ['index','new','delete','edit'];
        if(isset($tab) && in_array($tab,$TabArr)){
            if(isset($act) && in_array($act,$actArr)){
                    include "views/vps/server/$tab/$act.php";
            }else{
                include 'views/vps/404.php';
            }
        }else{
            include 'views/vps/404.php';
        }
// if(isset($setting) && isset($tab) && isset($act) && $tab != null && $setting != null && $act != null && in_array($setting,$setArr)){
//     // echo "hello";
//     include "views/vps/server/$setting/$tab/$act.php";
// }else{
//     // echo "404";
//     include 'views/vps/404.php';
// }
die();
?>