<?php
session_start();
require_once("views/vps_config.php");
// die('hello');
    if (isset($_POST['act']))
    {
        $act = $_POST['act'];
        /*echo */$pln = $_POST['pln'];
        $query = "SELECT [pln],[plan_name],[price] FROM service_db.dbo.price_tbl
                                where [PRICE_TBL].pln ='$pln' and [PRICE_TBL].type ='02' and [PRICE_TBL].service ='99'  ORDER BY [pln] ASC";
        $getspec = $commons->getSpec($query);
        $price = $getspec[0]['price'];
        // print_r($getspec);
       if ($act == "sql_license")
       {
        /*echo */$request ="SQL Server ".$_POST['request']." Web Edition追加 $price 円";
       } elseif ($act == "rdl")
       {
        $price = $price * $_POST['request'];
        /*echo */$request ="Remote Desktop License追加 ".$_POST['request']." 個 $price 円";
       } elseif ($act == "office_l")
       {
        $price = $price*$_POST['numoffice']*$_POST['mon'];
        /*echo */$request ="OFFICE追加 ".$_POST['request']." $price 円";
        // die();
       }elseif ($act == "window_server_license")
       {
        /*echo */$request ="Windows Server Security追加 $price 円";
       } elseif ($act == "site_guard_license")
       {
        /*echo */$request ="Site Gird Server Edition追加 $price 円";
       } else
       {
        /*echo */$request ="SSL証明書追加 $price 円";
       }
        // echo $request = $_POST['request'];
        // die('');
        $subject ='=?UTF-8?B?'.base64_encode('【Winserver】オプションの追加依頼完了').'?=';
        $body = file_get_contents('views/mailer/vps/license_option.php');
        $body = str_replace('$name', $webadminName, $body);
        $body = str_replace('$cost', $price, $body);
        $body = preg_replace('/\\\\/','', $body); //Strip backslashes
        $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
        $_SESSION['error'] = false;
        $_SESSION['message'] = 'Success';
        $msgsession =  "msg";
        $msg = "オプションの追加依頼をお受けいたしました <br>弊社より費用について御案内いたしますのでお待ちください。<br>費用の御案内については弊社営業時間内となります。<br>平日　9：00-12：00/13：00-17：00";
        flash($msgsession,$msg);
        header("location:/vps/various?setting=option&tab=license&act=license&webid=$webid");
        die();
    }
?>