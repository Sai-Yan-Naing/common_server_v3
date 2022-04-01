<?php
header('Content-Type: application/json');
$remark = $_POST['remark'];
if(isset($_COOKIE['admin']) and $remark == 'error_file')
{
    require_once("views/admin/admin_shareconfig.php");
}elseif(isset($_COOKIE['share_user']) and $remark == 'error_file')
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
// echo $checkresult = $check->checkInDb('web_account', 'user', 'saiyannaing');
if($table !=='none')
{
    $checkresult = $check->checkInDb($table, $column, $checker);
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

// if ( $remark === 'winuser' )
// {
//     $checkresult = $check->winUser($checker);
//     if ( $checkresult )
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'mydbname' )
// {
//     $checkresult = $check->mysqlDatabase($checker);
//     if ( $checkresult )
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'mydbuser')
// {
//     $checkresult = $check->mysqlUser($checker);
//     if ( $checkresult)
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'msdbname')
// {
//     $checkresult = $check->mssqlDatabase($checker);
//     if ( $checkresult)
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'msdbuser')
// {
//     $checkresult = $check->mssqlUser($checker);
//     if ( $checkresult)
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'madbname')
// {
//     $checkresult = $check->mariadDatabase($checker);
//     if ( $checkresult)
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

// if ( $remark === 'madbuser')
// {
//     $checkresult = $check->mariadbUser($checker);
//     if ( $checkresult)
//     {
//         $status['status'] =$checkresult;
//         echo json_encode($status);
//         die();
//     }
    
// }

$status['status'] =false;
echo json_encode($status);
die();
// $status =["table"=>$table,"column"=>$column,"checker"=>$checker];
// echo json_encode($status);
// die();