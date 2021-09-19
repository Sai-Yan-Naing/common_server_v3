<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['site','security','database','ftp','filemanager','analysis'];
$TabArr = ['app_install','basic','app_setting','ssl','waf','directory','ip','mysql','mssql','mariadb','tab'];
$actArr = ['index','new','delete','edit','confirm','onoff','new_dir','delete_dir','confirm_dir','new_user','delete_user','edit_user','.user.ini','dotnet_version','php_version','web.config','usage','display'];
if(isset($setting) && in_array($setting,$setArr)){
        if(isset($tab) && in_array($tab,$TabArr)){
            if(isset($act) && in_array($act,$actArr)){
                if($tab!='tab'){
                    include "views/share/server/$setting/$tab/$act.php"; 
                }else{
                    include "views/share/server/$setting/$act.php";
                }
            }else{
                include 'views/share/404.php';
            }
        }else{
            include 'views/share/404.php';
        }
}else{
    include 'views/share/404.php';
}
// if(isset($setting) && isset($tab) && isset($act) && $tab != null && $setting != null && $act != null && in_array($setting,$setArr)){
//     // echo "hello";
//     include "views/share/server/$setting/$tab/$act.php";
// }else{
//     // echo "404";
//     include 'views/share/404.php';
// }
die();
?>