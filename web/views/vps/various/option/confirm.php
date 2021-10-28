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
// die('');
$subject ='Request Specification';
$body = file_get_contents('views/mailer/vps/option.php');
$body = str_replace('$memory', $memory, $body);
$body = str_replace('$cpu', $cpu, $body);
$body = str_replace('$disk', $disk, $body);
$body = str_replace('$ip_address', $ip_address, $body);
$body = str_replace('$virtual_switch', $virtual_switch, $body);
$body = preg_replace('/\\\\/','', $body); //Strip backslashes
$webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);
$_SESSION['error'] = false;
$_SESSION['message'] = 'Success';
header("location:/vps/various?setting=option&tab=spec&act=index");
die();