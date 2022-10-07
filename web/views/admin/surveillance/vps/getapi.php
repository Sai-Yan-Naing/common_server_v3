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
 $query ="SELECT * FROM monitor_mail ";
  $stmt1 = $conn->prepare($query);
        $stmt1->execute();
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $all){
        $mail = json_decode($all['mail'],true);
        $ping = json_decode($all['ping'],true);
        if($ping['ping']==1){
            send($mail,$ping);
        }
    }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

function send($mail,$sensor)
{
    $webmailer = new Mailer;
    $subject = 'sensor';
    $body = 'testing';
    // $body .= '削除されました';

    $api_url = 'http://202.218.224.38/api/getstatus.htm?id='.$sensor['sensor'].'&tabid=1&username=prtgadmin&password=BUHdfUtbGG4XWPT';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $getsensor = json_decode($json_data);
        echo '<pre>';
print_r($getsensor);
print_r($getsensor->Alarms);
echo 'sensor';
print_r($getsensor->UpSens);
if($getsensor->UpSens==1){
    $stop = true;
    $subject = 'server is started';
}else{
    $stop = false;
    $_SESSION['pingmail'] = true;
    $subject = 'server is shutting down';
}

if($_SESSION['pingmail']){// send mail
    if($stop){
        $_SESSION['pingmail'] = false;
    }
    foreach($mail as $val){
        if ( ! $webmailer->sendMail($val['mail'], TONAME, $subject, $body))
        {
            echo $error = 'Cannot send email';
            die();
        }
    }
}
   
    
}