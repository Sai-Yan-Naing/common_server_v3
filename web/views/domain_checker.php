<?php 
    require_once('commons/common.php');
    header('Content-Type: application/json');
    
    $status =["status"=>domainChecker($_POST['domain'])];
    echo json_encode($status);

?>