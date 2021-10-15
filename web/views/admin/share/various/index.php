<?php   
$setting = $_GET['setting'];
$tab = $_GET['tab'];
$act = $_GET['act'];
$setArr = ['information','backup'];
// $TabArr = ['smtp','pop','tab'];
$actArr = ['index','new','delete','edit','onoff','apponoff','confirm','restore'];
if ( isset($setting) && in_array($setting,$setArr) )
{
    if ( isset($act) && in_array($act,$actArr) )
    {
        include "views/admin/share/various/$setting/$act.php";
    } else
    {
        include 'views/admin/share/404.php';
    }
} else
{
    include 'views/admin/share/404.php';
}
die();