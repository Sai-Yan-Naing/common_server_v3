<?php
header('Content-Type: application/json');
require 'config/all.php';
require 'models/common_validate.php';
$table = $_POST['table'];
$column = $_POST['column'];
$checker = $_POST['checker'];
$remark = $_POST['remark'];
$status = ['table'=>$table,'column'=>$column,'chekcer'=>$checker,'remark'=>$remark];
$check = new CommonValidate;
// echo $checkresult = $check->checkInDb('web_account', 'user', 'saiyannaing');
$checkresult = $check->checkInDb($table, $column, $checker);
if ( $checkresult )
{
    $status['status'] =$checkresult;
    echo json_encode($status);
    die();
}

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
    $checkresult = $check->winUser($checker);
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
    $checkresult = $check->mariadbUser($checker);
    if ( $checkresult)
    {
        $status['status'] =$checkresult;
        echo json_encode($status);
        die();
    }
    
}

$status['status'] =false;
echo json_encode($status);
die();
// $status =["table"=>$table,"column"=>$column,"checker"=>$checker];
// echo json_encode($status);
// die();