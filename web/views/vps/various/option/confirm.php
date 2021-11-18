<?php 
require_once("views/vps_config.php");
// die('hello');
    // if(isset($_GET['act']))
    // {
$memory = $_POST['memory'];
$cpu = $_POST['cpu'];
$disk = $_POST['disk'];
$ip_address = $_POST['ip_address'];
$virtual_switch = $_POST['virtual_switch'];
// die('');
$subject ='【Winserver】オプションの追加依頼完了';
$body = file_get_contents('views/mailer/vps/option.php');
$body = str_replace('$name', $webvmhost_user, $body);
$body = str_replace('$memory', $memory, $body);
$body = str_replace('$cpu', $cpu, $body);
$body = str_replace('$disk', $disk, $body);
$body = str_replace('$ip_address', $ip_address, $body);
$body = str_replace('$virtual_switch', $virtual_switch, $body);
$body = preg_replace('/\\\\/','', $body); //Strip backslashes
$webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
$msgsession =  "msg";
$msg = "オプションの追加依頼をお受けいたしました。";
flash($msgsession,$msg);
header("location:/vps/various?setting=option&tab=spec&act=index");