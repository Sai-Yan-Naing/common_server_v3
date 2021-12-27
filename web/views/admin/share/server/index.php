<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['site','security','database','ftp','filemanager','analysis'];
$TabArr = ['app_install','basic','app_setting','ssl','waf','directory','ip','mysql','mssql','mariadb','tab'];
// $securityTabArr = ['ssl','waf','directory','ip'];
// $databaseTabArr = ['mysql','mssql','mariadb'];
// $ftpTabArr = [''];
// $fileTabArr = [''];
// $analysisTabArr = [''];
$actArr = ['index','new','delete','edit','confirm','onoff','new_dir','delete_dir','confirm_dir','new_user','delete_user','edit_user','.user.ini','dotnet_version','php_version','web.config','usage','display','upload','new_file','zip','unzip','rename_dir','rename_file','delete_dir','delete_file','manager','testing'];
if ( isset($setting) && in_array($setting,$setArr))
{
        if ( isset($tab) && in_array($tab,$TabArr))
        {
            if ( isset($act) && in_array($act,$actArr))
            {
                if ( $tab!='tab')
                {
                    include "views/admin/share/server/$setting/$tab/$act.php"; 
                } else
                {
                    include "views/admin/share/server/$setting/$act.php";
                }
            } else
            {
                include 'views/admin/share/404.php';
            }
        } else
        {
            include 'views/admin/share/404.php';
        }
} else
{
    include 'views/admin/share/404.php';
}
// if ( isset($setting) && isset($tab) && isset($act) && $tab != null && $setting != null && $act != null && in_array($setting,$setArr))
// {
//     // echo "hello";
//     include "views/admin/share/server/$setting/$tab/$act.php";
// } else
// {
//     // echo "404";
//     include 'views/admin/share/404.php';
// }
die();