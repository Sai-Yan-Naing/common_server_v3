<?php
session_start();
require_once('mails/mail.php');
$servername = "202.218.224.21";
$username = "tester";
$password = "welcome123!";
$dbname = "japan_system_development_18102021";
try {

  define('DBDSN','sqlsrv:Server=202.218.224.21;Database=japan_system_development_18102021');
// define('SERVICEDSN','sqlsrv:Server=202.218.224.21;Database=service_db');
define('DBROOT','tester');
define('DBROOT_PASS','welcome123!');
define('JAPANSYS','administrator');
define('JAPANSYS_PASS','bmbivPanKuQ5AVe');
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$conn = new PDO(DBDSN, DBROOT, DBROOT_PASS);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$type = 'share';
$query ="SELECT monitor_mail.*,device_config.*,web_account.domain as domainip,customer.name as customer FROM monitor_mail inner join device_config on device_config.id = monitor_mail.device_id inner join web_account on web_account.id = monitor_mail.domain_ip inner join customer on customer.user_id = web_account.customer_id where monitor_mail.type = '$type'";
$stmt = $conn->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
alldata($data);
// echo '<pre>';
// print_r($data);
// die;

$type = 'vps';
$query ="SELECT monitor_mail.*,device_config.*,vps_account.os as osname,vps_account.ip as domainip,customer.name as customer FROM monitor_mail inner join device_config on device_config.id = monitor_mail.device_id inner join vps_account on vps_account.id = monitor_mail.domain_ip inner join customer on customer.user_id = vps_account.customer_id where monitor_mail.type = '$type'";
$stmt = $conn->prepare($query);
$stmt->execute();
$data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($data1);
alldata($data1);
// die;
    
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

function alldata($data)
{
    // echo '<pre>';
    // print_r($data);die;
    foreach($data as $all){
        $mail = json_decode($all['mail'],true);
        $ip = $all['ip'];
        $username = $all['username'];
        $password = $all['password'];
        $ping = json_decode($all['ping'],true);
        $http = json_decode($all['http'],true);
        $url = json_decode($all['url'],true);
        $rdp = json_decode($all['rdp'],true);
        $sql = json_decode($all['sql'],true);
        $domainip = $all['domainip'];
        $customer = $all['customer'];
        // echo '<pre>';
        if($ping['ping']==1){
            // echo 'test';
            $api_url = 'http://'.$ip.'/api/getstatus.htm?id='.$ping['sensor'].'&tabid=1&username='.$username.'&password='.$password;
            send($mail,$api_url,$domainip,$customer,$domainip,'PING');
        }
        // print_r($mail);
        // print_r($ping);
        // print_r($http);
        // print_r($url);
        // print_r($rdp);
        if($http['onoff']==1){
            // echo 'hello';
            foreach ($url as $key => $value) {
               $api_url = 'http://'.$ip.'/api/getstatus.htm?id='.$value['sensor'].'&tabid=1&username&username='.$username.'&password='.$password;
                send($mail,$api_url,$domainip,$customer,$value['value'],'HTTP');
            }
        }
        if($rdp['onoff']==1){
                $api_url = 'http://'.$ip.'/api/getstatus.htm?id='.$rdp['sensor'].'&tabid=1&username='.$username.'&password='.$password;
                send($mail,$api_url,$domainip,$customer,$rdp['sensor'],'RDP');
        }
        if($sql['onoff']==1){
                $api_url = 'http://'.$ip.'/api/getstatus.htm?id='.$rdp['sensor'].'&tabid=1&username='.$username.'&password='.$password;
                send($mail,$api_url,$domainip,$customer,$rdp['sensor'],'SQL');
        }
    }
}

function send($mail,$api_url,$domainip,$customer,$sensor,$sensorname)
{
    $webmailer = new Mailer;
    $subject = 'sensor';
    // print_r($mail);
    // $body .= '削除されました';

    // $api_url = 'http://202.218.224.38/api/getstatus.htm?id='.$sensor['sensor'].'&tabid=1&username=prtgadmin&password=BUHdfUtbGG4XWPT';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $getsensor = json_decode($json_data);
        // print_r($getsensor);
        // die;
        $stop = $_SESSION[$sensor.'-stop'] =true;
if($getsensor->UpSens==1){
    $stop = $_SESSION[$sensor.'-stop'] =true;
    $subject= 'started';
    $subject = '['.$domainip.']  ダウン状態終了('.$sensorname.')';
    $body = $customer.'様    <br>';
    $body .='お世話になっております。  <br>';
    $body .='ウィンサーバーサポートでございます。 <br>';
    $body .='お客様のサーバーの状態変化を検知致しましたので、  <br>';
    $body .='ご確認をお願い致します。    <br>';
    $body .='【'.$sensorname.'監視】  <br>';
    $body .=$domainip.' :  '.$sensorname.'ダウン状態が終了致しました。（現在：アップ）<br>';
    $body .='╋━━━━━━━━━━━━━━━━━━━━━━━━━━━━━╋ <br>';
    $body .='Windows サーバーのレンタルサーバー　ホスティングサービス<br>';
    $body .='---------------------------------------------  <br>';
    $body .='アシストアップ株式会社  <br>';
    $body .='大阪市中央区久太郎町3-6-8 御堂筋ダイワビル8F';
    $body .='TEL：0120-951-168　FAX：06-6121-7525  <br>';
    $body .='mailto:support@winserver.ne.jp  <br>';
    $body .='http://www.winserver.ne.jp/  <br>';
    $body .='╋━━━━━━━━━━━━━━━━━━━━━━━━━━━━━╋  <br>';


}else{
    $stop = $_SESSION[$sensor.'-stop'] =false;
    $_SESSION[$sensor] = true;
    $subject = 'server is shutting down';
    $subject = '['.$domainip.'] ダウン('.$sensorname.')';
    $body = $customer.'様    <br>';
    $body .='お世話になっております。 <br>';
    $body .='ウィンサーバーサポートでございます。<br>';
    $body .='お客様のサーバーの状態変化を検知致しましたので、 <br>';
    $body .='ご確認をお願い致します。 <br>';
    $body .='【'.$sensorname.'監視】  <br>';
    $body .=$domainip.' :  '.$sensorname.'ダウン状態となっております。<br>';
    $body .='╋━━━━━━━━━━━━━━━━━━━━━━━━━━━━━╋ <br>';
    $body .='Windows サーバーのレンタルサーバー　ホスティングサービス<br>';
    $body .='---------------------------------------------  <br>';
    $body .='アシストアップ株式会社  <br>';
    $body .='大阪市中央区久太郎町3-6-8 御堂筋ダイワビル8F';
    $body .='TEL：0120-951-168　FAX：06-6121-7525  <br>';
    $body .='mailto:support@winserver.ne.jp  <br>';
    $body .='http://www.winserver.ne.jp/  <br>';
    $body .='╋━━━━━━━━━━━━━━━━━━━━━━━━━━━━━╋  <br>';

}
echo $sensorname."<br>ww1";
echo "<br>";
echo $_SESSION[$sensor]."<br>ww";
echo "<br>";
echo $stop;
if($_SESSION[$sensor]){// send mail
    if($stop){
        $_SESSION[$sensor] = false;
    }
    foreach($mail as $val){
        $val['mail'];
        if ( ! $webmailer->sendMail($val['mail'], TONAME, $subject, $body))
        {
            echo $error = 'Cannot send email';
            die();
        }
    }
}
   
    
}