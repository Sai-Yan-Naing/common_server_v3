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
// die('');
$subject ='【Winserver】オプションの追加依頼完了';
$body = file_get_contents('views/mailer/admin/vps/option.php');
$body = str_replace('$name', $webadminName, $body);
$body = str_replace('$memory', $memory, $body);
$body = str_replace('$cpu', $cpu, $body);
$body = str_replace('$disk', $disk, $body);
$body = str_replace('$ip_address', $ip_address, $body);
$body = str_replace('$virtual_switch', $virtual_switch, $body);
$body = preg_replace('/\\\\/','', $body); //Strip backslashes
$webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
$msgsession =  "msg";
$msg = "オプションの追加依頼をお受けいたしました";
flash($msgsession,$msg);
header("location:/admin/vps/various?setting=option&tab=spec&act=index&webid=$webid");