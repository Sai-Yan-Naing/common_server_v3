<?php 
require_once("views/admin/admin_vpsconfig.php");
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
$body = file_get_contents('views/mailer/admin/vps/option.php');
$body = str_replace('$name', $webadminName, $body);
$body = str_replace('$memory', $memory, $body);
$body = str_replace('$cpu', $cpu, $body);
$body = str_replace('$disk', $disk, $body);
$body = str_replace('$ip_address', $ip_address, $body);
$body = str_replace('$virtual_switch', $virtual_switch, $body);
$body = str_replace('$mprice', $mprice, $body);
$body = str_replace('$cprice', $cprice, $body);
$body = str_replace('$dprice', $dprice, $body);
$body = str_replace('$iprice', $iprice, $body);
$body = str_replace('$vprice', $vprice, $body);
$body = str_replace('$total', $total, $body);
$body = preg_replace('/\\\\/','', $body); //Strip backslashes
$webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
$msgsession =  "msg";
$msg = "オプションの追加依頼をお受けいたしました";
flash($msgsession,$msg);
header("location:/admin/vps/various?setting=option&tab=spec&act=index&webid=$webid");