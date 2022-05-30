<?php
header('Content-Type: application/json');
$remark = $_POST['remark'];
$status =[];
            
if(isset($_COOKIE['admin']) and isset($_GET['webper']) && $_GET['webper'] =='admin' and isset($_GET['webid']))
{
// $status['status'] ='test';
//             echo json_encode($status);
//             die();
    require_once("views/admin/admin_shareconfig.php");
}else if(isset($_COOKIE['admin']) and $_GET['webper']=='admin')
{
    require_once("views/admin/admin_config.php");
}else if(isset($_COOKIE['share_user']))
{
    require_once('views/share_config.php');
}else{
    require 'config/all.php';
}

require 'models/common_validate.php';
$table = $_POST['table'];
$column = $_POST['column'];
$checker = $_POST['checker'];
$status = ['table'=>$table,'column'=>$column,'chekcer'=>$checker,'remark'=>$remark];
$check = new CommonValidate;
// echo json_encode(['status'=>$web_mydbuser]);
//      die;
if($table !=='none')
{
    $checkresult = $check->checkInDb($table, $column, $checker, $web_server_id);
    if ( $checkresult )
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
}
// for error page
// if ( $remark === 'error_file' )
// {
//     // $status['status'] =ROOT_PATH.$webpath.'/web/'.$checker;
//     //     echo json_encode($status);
//     //     die();
//     $checkresult = $check->errorFile(ROOT_PATH.$webpath.'/web/'.$checker);
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
    
// }

if ( $remark === 'domain' )
{
    $checkresult = $check->domainChecker($checker);
    if ( $checkresult )
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}
if ( $remark === 'winuser' )
{
     
    $checkresult = $check->winUser($checker,$web_host,$web_user,$web_password);
    if ( $checkresult )
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'mydbname' )
{
    $checkresult = $check->mysqlDatabase($checker);
    if ( $checkresult )
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'mydbuser')
{
    $checkresult = $check->mysqlUser($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'msdbname')
{
    $checkresult = $check->mssqlDatabase($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'msdbuser')
{
    $checkresult = $check->mssqlUser($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'madbname')
{
    $checkresult = $check->mariadDatabase($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'madbuser')
{
    // $status['status'] ='hello';
    //     echo json_encode($status);
    // die();
    $checkresult = $check->mariadbUser($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

if ( $remark === 'checkappdb')
{
    
    $db_name = $_POST['db_name'];
    $db_user= $_POST['db_user'];
    $db_pass= $_POST['db_pass'];
    $db_dsn = "mysql:host=$web_host:3310;dbname=$db_name";
    // $status['status'] =$db_dsn;
    //     echo json_encode($status);
    // die();
    
    if($check->mysqlDatabase($db_name) || $check->mysqlUser($db_user))
    {
        $checkresult = $check->checkappdb($db_dsn,$db_user,$db_pass);
        if ( $checkresult == false)
        {
            // $status['status'] ='hello';
            // echo json_encode($status);
            $status['status'] ='ok';
            echo json_encode($status);
            die();
        }
        $status['status'] ='doesnotmatch';
            echo json_encode($status);
            die;
    }  
}


    if ( $remark === 'checkdblimit')
    {
        $qid = ( $weborigin != 1 )? $weborigin_id : $webid;
        $checkresult = $check->checkdblimit($qid,$webplnmariadbnum,$webplnmariadb);
        $status['status'] =$checkresult;
            echo json_encode($status);
            die;
    }

$status['status'] =false;
echo json_encode($status);
die();