<?php 
    $main=$_GET['main'];
    if ( $main=='vps' )
    {
        require_once('views/admin/vps.php');
    }elseif ( $main=='surveillance' )
    {
        require_once('views/admin/surveillance.php');
    }else
    {
        require_once("views/admin/share.php");
    }