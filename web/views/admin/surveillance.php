<?php
    $act = $_GET['act'];

    if (isset($_GET['tab'])) {
    	$tab = $_GET['tab'];
    }else{
    	$tab = 'share';
    }
    
    switch ( $act )
    {
        case "index": include "views/admin/surveillance/$tab/index.php";break;
        case "new": include "views/admin/surveillance/$tab/new.php";break;
        case "confirm": include "views/admin/surveillance/$tab/confirm.php";break;
        case "edit": include "views/admin/surveillance/$tab/edit.php";break;
        case "delete": include "views/admin/surveillance/$tab/delete.php";break;
        case "ping": include "views/admin/surveillance/$tab/ping.php";break;
        case "getapi": include "views/admin/surveillance/$tab/getapi.php";break;
        //default
        default: http_response_code(404); include'views/404.php'; break;
    }
?>
