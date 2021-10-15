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
$actArr = ['index','new','delete','edit','onoff','confirm','onoff_confirm','spec','osreinstall'];
        if ( isset($tab) && in_array($tab,$TabArr)) 
        {
            if ( isset($act) && in_array($act,$actArr)) 
            {
                    if ( $act=='onoff' || $act=="onoff_confirm") 
                    {
                        include "views/admin/vps/server/$act.php";
                    } else
                    {
                        include "views/admin/vps/server/$tab/$act.php";
                    }
            } else
            {
                include 'views/admin/vps/404.php';
            }
        } else
        {
            include 'views/admin/vps/404.php';
        }
die();