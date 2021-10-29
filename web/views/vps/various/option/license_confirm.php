<?php
session_start();
require_once("views/vps_config.php");
// die('hello');
    if (isset($_POST['act']))
    {
        $act = $_POST['act'];
       if ($act == "sql_license")
       {
        echo $request ="SQL Server Web Edition追加 1 月額";
       } elseif ($act == "rdl")
       {
        echo $request ="Remote Desktop License追加 ".$_POST['request']." 月額";
       } elseif ($act == "office_l")
       {
        echo $request ="OFFICE追加 ".$_POST['request']." 月額";
       }elseif ($act == "window_server_license")
       {
        echo $request ="Windows Server Security追加 1 年額";
       } elseif ($act == "site_guard_license")
       {
        echo $request ="Site Gird Server Edition追加 1 月額";
       } else
       {
        echo $request ="SSL証明書追加 1 年額";
       }
        // echo $request = $_POST['request'];
        // die('');
        $subject ='Request License';
        $body = file_get_contents('views/mailer/vps/license_option.php');
        $body = str_replace('$request', $request, $body);
        $body = preg_replace('/\\\\/','', $body); //Strip backslashes
        $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
        $_SESSION['error'] = false;
        $_SESSION['message'] = 'Success';
        header("location:/vps/various?setting=option&tab=license&act=license");
        die();
    }