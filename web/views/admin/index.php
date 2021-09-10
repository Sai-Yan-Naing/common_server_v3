<?php 
    $main=$_GET['main'];
    if($main=='vps'){
        require_once('views/admin/vps.php');
    }else{
        require_once("views/admin/share.php");
    }
?>