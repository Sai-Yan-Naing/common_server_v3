<?php
    $act = $_GET['act'];
    switch ($act)
    {
        case "index": include "views/vps/contactus/index.php";break;
        case "confirm": include "views/vps/contactus/confirm.php";break;
        //default
        default: http_response_code(404); include'views/404.php'; break;
    }
?>
