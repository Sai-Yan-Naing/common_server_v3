<?php require_once('views/admin/surveillance/vps/config.php'); ?>
<?php

$action = $_POST['action'];
$type = 'vps';
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,$type]);
// print_r($getmails['id']);
// die;
    $temp = [];
    $temp1 = [];
    $temp2 = [];
if($action=='new'){
    $mail=$_POST['mail'];
    $t = time();
    $temp1['id']=$t;
    $temp1['mail']=$mail;
    // $temp1 = json_encode($temp1);
    if($getmails['id'] ==null){
        $insert_q = "INSERT INTO monitor_mail (type, mail, domain_ip) VALUES (?, ?, ?)";
    }else{
        $temp2 = json_decode($getmails['mail'],true);
        $insert_q = "UPDATE monitor_mail SET type = ?, mail=? where domain_ip=?  and  type ='$type'";
    }
    // echo '<pre>';
    $temp =$temp2;
    $temp[] =$temp1;
    // print_r(array_values(array_filter($temp)));
    $insert = json_encode(array_values(array_filter($temp)));
    // print_r($insert);
    if (!$commons->doThis($insert_q,[$type, $insert, $webid]))
    {
            die("Error.");
    }
    
}else if($action=='edit'){
    $act_id = $_POST['act_id'];
    $mail = $_POST['mail'];
    $arr = json_decode($getmails['mail'],true);
    foreach($arr as $key=>$t){
        $temp2[$key]['id']=$t['id'];
        $temp2[$key]['mail']=$t['mail'];
        if($act_id==$t['id']){
            $temp2[$key]['mail']=$mail;
        }
    }
    $insert_q = 'UPDATE monitor_mail SET type = ?, mail=? where domain_ip=?';
    // echo '<pre>';
    $temp =$temp2;
    $insert = json_encode(array_values(array_filter($temp)));
    // print_r($insert);
    if (!$commons->doThis($insert_q,[$type, $insert, $webid]))
    {
            die("Error.");
    }
}else if($action=='delete'){
    $act_id = $_POST['act_id'];
    $mail = $_POST['mail'];
    $arr = json_decode($getmails['mail'],true);
    foreach($arr as $key=>$t){
        if($act_id==$t['id']){
            unset($arr[$key]);
        }
    }
    $insert_q = "UPDATE monitor_mail SET type = ?, mail=? where domain_ip=? and  type ='$type'";
    // echo '<pre>';
    $temp =$arr;
    $insert = json_encode(array_values(array_filter($temp)));
    // print_r($insert);
    if (!$commons->doThis($insert_q,[$type, $insert, $webid]))
    {
            die("Error.");
    }
}else if($action=='ping'){
    $ping = $_POST['ping']==0? 1 : 0;
    $arr = json_decode($getmails['ping'],true);
    $temp2['ping'] = $ping;
    $temp2['device'] = $arr['device'];
    $temp2['sensor'] = $arr['sensor'];
    // if($arr['device']==null){
        $api_url = 'http://202.218.224.38/api/pause.htm?id=2127&tabid=1&action='.$ping.'&username=prtgadmin&password=BUHdfUtbGG4XWPT';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);
    // }
    print_r($response_data);
    // die();
    $insert_q = "UPDATE monitor_mail SET type = ?, ping=? where domain_ip=? and  type ='$type'";
    // echo '<pre>';
    print_r($temp2);
    $temp =$temp2;
    $insert = json_encode($temp);
    print_r($insert);
    if (!$commons->doThis($insert_q,[$type, $insert, $webid]))
    {
            die("Error.");
    }
    // die;
}



header("location: /admin?main=surveillance&act=new&tab=vps&webid=$webid");