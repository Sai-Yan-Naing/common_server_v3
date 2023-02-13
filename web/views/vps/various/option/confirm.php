<?php 
require_once("views/vps_config.php");
// die('hello');
    // if(isset($_GET['act']))
    // {
echo $memory = $_POST['memory'];
echo $cpu = $_POST['cpu'];
echo $disk = $_POST['disk'];
echo $ip_address = $_POST['ip_address'];
echo $virtual_switch = $_POST['virtual_switch'];

$query = "SELECT [pln],[plan_name],[plan_name2],[price] FROM service_db.dbo.price_tbl
                        where [PRICE_TBL].pln in ('13','14','15','17','27') and [PRICE_TBL].type ='02' and [PRICE_TBL].service ='99' ORDER BY [pln] ASC";
                        $getspec = $commons->getSpec($query);
echo $mprice = $getspec[0]['price'] * $memory;
echo $cprice = $getspec[3]['price'] * $cpu;
$dprice = $getspec[1]['price'] * $disk;
$iprice = $getspec[2]['price'] * $ip_address;
$vprice = $getspec[4]['price'] * $virtual_switch;
$total = $mprice + $cprice + $dprice + $iprice +$vprice;
                        // echo "<pre>";
                        //     print_r($getspec);
                        //     die;
// die('');
$subject ='【Winserver】オプションの追加依頼完了';
$body = file_get_contents('views/mailer/vps/option.php');
$body = str_replace('$name', $webadminName, $body);
$body = str_replace('$cost', $total, $body);
$body = preg_replace('/\\\\/','', $body); //Strip backslashes
$webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
$msgsession =  "msg";
$msg = "オプションの追加依頼をお受けいたしました <br>弊社より費用について御案内いたしますのでお待ちください。<br>費用の御案内については弊社営業時間内となります。<br>平日　9：00-12：00/13：00-17：00";
flash($msgsession,$msg);
header("location:/vps/various?setting=option&tab=spec&act=index&webid=$webid");