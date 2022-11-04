<?php require_once('views/admin/surveillance/vps/config.php'); ?>
<?php

$action = $_POST['action'];
$type = 'vps';
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,$type]);
$dev_config = $commons->getRow("SELECT * FROM device_config");
// print_r($dev_config);
// die;
    $temp = [];
    $temp1 = [];
    $temp2 = [];
    $temp3 = [];
    $temp4 = [];
    $arr_ping = [];
    $arr_rdp = [];
    $arr_http = [];
    $arr_url = [];
    $arr_sql = [];
    $arr_dgroup = [];
    $arr = json_decode($getmails['dgroup'],true);
    $groupid = $arr['group'];
    $deviceid = $arr['device'];
    if($getmails['id'] ==null){
        $gurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_group'].'&name='.$webip.'&targetid='.$dev_config['target_group'].'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        
        $groupid = getclone($gurl);
        // for resume
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$groupid.'&tabid=1&action=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);

        $durl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_device'].'&name='.$webip.'&host='.$webip.'&targetid='.$groupid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $deviceid = getclone($durl);

        
        // for resume
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$deviceid.'&tabid=1&action=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);

        // <!-- for ping sensor  -->
        $ping = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_ping'].'&name=ping&targetid='.$deviceid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $pingid = getclone($ping);

        // <!-- for sql sensor  -->

        $sqlurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_sql'].'&name=sql&targetid='.$deviceid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $sqlurlid = getclone($sqlurl);

        // <!-- for rdp sensor  -->

        $rdpurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_rdp'].'&name=rdp&targetid='.$deviceid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $rdpurlid = getclone($rdpurl);


        // for  sql sensor 
        $sqlarr['onoff']=0;
        $sqlarr['sensor']=$sqlurlid;
        $sqlarr['db_user']='';
        $sqlarr['db_pass']='';
        $sqlarr = json_encode($sqlarr);
        
        //for mail
        $mailarr = [];
        $mailarr = json_encode($mailarr);

        // for ping sensor 
        $pingarr['ping'] = 0;
        $pingarr['sensor'] = $pingid;
        $pingarr=json_encode($pingarr);

        // for http sensor 
        $httparr['onoff'] = 0;
        $httparr = json_encode($httparr);
        // for url 
        $urlarr = [];
        $urlarr = json_encode($urlarr);

        // for rdp sensor 
        $rdparr['onoff']=0;
        $rdparr['sensor']=$rdpurlid;
        $rdparr['username']='';
        $rdparr['password']='';
        $rdparr = json_encode($rdparr);

        // for devices and group 
        $dgrouparr['group']=$groupid;
        $dgrouparr['device']=$deviceid ;
        $dgrouparr=json_encode($dgrouparr);

        $params=[];
        if($getmails['id'] ==null){
            echo $insert_q = "INSERT INTO monitor_mail (device_id,type, mail, domain_ip, ping, http, url, rdp, sql, dgroup) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params=[1,$type, $mailarr, $webid, $pingarr, $httparr, $urlarr, $rdparr, $sqlarr, $dgrouparr];
        }
        
        if (!$commons->doThis($insert_q,$params))
        {
                die("Error.");
        }
    }
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,$type]);
$dev_config = $commons->getRow("SELECT * FROM device_config");
if($action=='new'){
    $mail=$_POST['mail'];
    $t = time();
    $temp1['id']=$t;
    $temp1['mail']=$mail;
    // $temp1 = json_encode($temp1);
    // if($getmails['id'] ==null){
    //     $insert_q = "INSERT INTO monitor_mail (type, mail, domain_ip) VALUES (?, ?, ?)";
    // }else{
        $temp2 = json_decode($getmails['mail'],true);
        $insert_q = "UPDATE monitor_mail SET type = ?, mail=? where domain_ip=?  and  type ='$type'";
    // }
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
    $arr_ping['ping'] = $ping;
    $arr_ping['sensor'] = $arr['sensor'];
    $arr_ping = json_encode($arr_ping);
    $insert_q = "UPDATE monitor_mail SET ping=? where domain_ip=? and  type ='$type'";
    if (!$commons->doThis($insert_q,[$arr_ping, $webid]))
    {
            die("Error.");
    }
    $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$arr['sensor'].'&tabid=1&action='.$ping .'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);
    // die;
}else if($action=='sql'){
    $sql = $_POST['sql']==0? 1 : 0;
    $arr = json_decode($getmails['sql'],true);
    $arr_sql['onoff']=$sql;
    $arr_sql['sensor']=$arr['sensor'];
    $arr_sql['db_user']=$arr['db_user'];
    $arr_sql['db_pass']=$arr['db_pass'];
    $arr_sql = json_encode($arr_sql);

    $insert_q = "UPDATE monitor_mail SET sql = ? where domain_ip=? and  type ='$type'";
    if (!$commons->doThis($insert_q,[$arr_sql, $webid]))
    {
            die("Error.");
    }
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$arr['sensor'].'&tabid=1&action='.$sql.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);
}else if($action=='rdp'){
    $rdp = $_POST['rdp']==0? 1 : 0;
    $arr = json_decode($getmails['rdp'],true);
    $arr_rdp['onoff']=$rdp;
    $arr_rdp['sensor']=$arr['sensor'];
    $arr_rdp['username']=$arr['username'];
    $arr_rdp['password']=$arr['password'];
    $arr_rdp = json_encode($arr_rdp);
    $insert_q = "UPDATE monitor_mail SET rdp = ? where domain_ip=? and  type ='$type'";
    if (!$commons->doThis($insert_q,[$arr_rdp, $webid]))
    {
            die("Error.");
    }
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$arr['sensor'].'&tabid=1&action='.$rdp.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);
}else if($action=='http'){
    $http = $_POST['http']==0? 1 : 0;
    $arr_http['onoff'] = $http;
    $arr_http = json_encode($arr_http);
    $insert_q = "UPDATE monitor_mail SET http = ? where domain_ip=? and  type ='$type'";
    if (!$commons->doThis($insert_q,[$arr_http, $webid]))
    {
            die("Error.");
    }
    // for pause and resume 
    $arr = json_decode($getmails['url'],true);
    foreach($arr as $val){
        echo $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$val['sensor'].'&tabid=1&action='.$http.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);
    }
}else if($action=='saveall'){
    $urls = $_POST['url'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];
    
    $arr = json_decode($getmails['http'],true);
    $arr_http['onoff'] = $arr['onoff'];

    $arr = json_decode($getmails['url'],true);
    foreach($arr as $val){//for delete sensor
        $delsensor = 'http://'.$dev_config['ip'].'/api/deleteobject.htm?id='.$val['sensor'].'&approve=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($delsensor);
    }
    foreach (array_filter($urls) as $key => $value) {

        // print_r(parse_url($value));
        $temp = parse_url($value);
        $rename = $temp['path'].'?'.$temp['query'];
            if($rename=="?"){
                $rename = "HTTP";
            }
        $uurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_http'].'&name='.$rename .'&targetid='.$deviceid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $uurlid = getclone($uurl);

        // for resume
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$uurlid.'&tabid=1&action='.$arr_http['onoff'].'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);
        // replace setting 
        $replaceurl = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$uurlid.'&name=httpurl&value='.$value.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($replaceurl);

        $temp1[]=['sensor'=>$uurlid,'value'=>$value];
    }
        $arr_url=$temp1;

    // for rdp sensor 
    $arr = json_decode($getmails['rdp'],true);
    $arr_rdp['onoff']=$arr['onoff'];
    $arr_rdp['sensor']=$arr['sensor'];
    $arr_rdp['username']=$username;
    $arr_rdp['password']=$password;
    
    $dgroup = json_decode($getmails['dgroup'],true);

    $setp = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$dgroup['device'].'&name=windowslogindomain&value='.$dev_config['ip'].'&username='.$dev_config['username'].'&password='.$dev_config['password'];
    execute_api($setp);
    $usernamep = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$dgroup['device'].'&name=windowsloginusername&value='.$username.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
    execute_api($usernamep);
    $passwordp = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$dgroup['device'].'&name=windowsloginpassword&value='.$password.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
    execute_api($passwordp);

    // for sql 
    $arr = json_decode($getmails['sql'],true);
    $arr_sql['onoff']=$arr['onoff'];
    $arr_sql['sensor']=$arr['sensor'];
    $arr_sql['db_user']=$db_user;
    $arr_sql['db_pass']=$db_pass;

    $dbuserp = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$dgroup['device'].'&name=dbuser&value='.$db_user.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
    execute_api($dbuserp);

    $db_passp = 'http://'.$dev_config['ip'].'/api/setobjectproperty.htm?id='.$dgroup['device'].'&name=dbpassword&value='.$db_pass.'&username='.$dev_config['username'].'&password='.$dev_config['password'];
    execute_api($dbuserp);
    
    $arr_http = json_encode($arr_http);
    $arr_url = json_encode($arr_url);
    $arr_sql = json_encode($arr_sql);
    $arr_rdp = json_encode($arr_rdp);

    $insert_q = "UPDATE monitor_mail SET http = ?, url=?, rdp=?, sql=? where domain_ip=? and  type ='$type'";
    $params = [$arr_http,$arr_url,$arr_rdp,$arr_sql,$webid];
    if (!$commons->doThis($insert_q,$params))
        {
                die("Error.");
        }
}

function execute_api($url)
{
    $data = file_get_contents($url);
}

function getclone($url)
  {
    // return true;
    $data = file_get_contents($url);
$html_sourcecode_get = htmlentities($data);
// echo $html_sourcecode_get;

$dochtml = new DOMDocument();
$dochtml->loadHTML($data);

// get the element with id="dv1"
$elm = $dochtml->getElementById('hiddenloginurl');

// get the tag name, and content
$tag = $elm->tagName;
$cnt = $elm->getAttribute('value');

$url_components = parse_url($cnt);
 
// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);
     
// Display result
 return $params['id'];
  }

// die;

header("location: /admin?main=surveillance&act=new&tab=vps&webid=$webid");