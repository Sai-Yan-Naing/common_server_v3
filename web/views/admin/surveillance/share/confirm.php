<?php require_once('views/admin/surveillance/share/config.php'); ?>
<?php
$action = $_POST['action'];
$type = 'share';
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,$type]);
$dev_config = $commons->getRow("SELECT * FROM device_config");
$temp = [];
    $temp1 = [];
    $temp2 = [];
    $temp3 = [];
    $temp4 = [];
    $arr_rdp = [];
    $arr_http = [];
    $arr_url = [];
    $arr_sql = [];
    $arr_dgroup = [];
    $arr = json_decode($getmails['dgroup'],true);
    $groupid = $arr['group'];
    $deviceid = $arr['device'];
    if($getmails['id'] ==null ||count($arr)<1){
        echo $gurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_group'].'&name='.$webdomain.'&targetid='.$dev_config['target_group'].'&username='.$dev_config['username'].'&password='.$dev_config['password'];
        
        $groupid = getclone($gurl);
        // for resume
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$groupid.'&tabid=1&action=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);

        $durl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_device'].'&name='.$webdomain.'&host='.$webdomain.'&targetid='.$groupid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

        $deviceid = getclone($durl);

        
        // for resume
        $pause = 'http://'.$dev_config['ip'].'/api/pause.htm?id='.$deviceid.'&tabid=1&action=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($pause);

        // for devices and group 
        $dgrouparr['group']=$groupid;
        $dgrouparr['device']=$deviceid ;
        $dgrouparr=json_encode($dgrouparr);

        // for http sensor 
        $httparr['onoff'] = 0;
        $httparr = json_encode($httparr);

        // for url 
        $urlarr = [];
        $urlarr = json_encode($urlarr);
        $params=[];
        $insert_q = "INSERT INTO monitor_mail (device_id,type, domain_ip, http, url, dgroup) VALUES (?, ?, ?, ?,?, ?)";
            $params=[1,$type, $webid, $httparr, $urlarr, $dgrouparr];
        
        if (!$commons->doThis($insert_q,$params))
        {
                die("Error.");
        }
    }
if($action=='new'){
    $mail=$_POST['mail'];
    $t = time();
    $temp1['id']=$t;
    $temp1['mail']=$mail;
        $temp2 = json_decode($getmails['mail'],true);
        echo $insert_q = "UPDATE monitor_mail SET type = ?, mail=? where domain_ip=?  and  type ='$type'";
    $temp =$temp2;
    $temp[] =$temp1;
    // print_r(array_values(array_filter($temp)));
    echo $insert = json_encode(array_values(array_filter($temp)));
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
}elseif ($action=='saveall') {
    $arr = json_decode($getmails['http'],true);
    $arr_http['onoff'] = $arr['onoff'];
    $urls = $_POST['url'];
    $arr = json_decode($getmails['url'],true);
    foreach($arr as $val){
        $delsensor = 'http://'.$dev_config['ip'].'/api/deleteobject.htm?id='.$val['sensor'].'&approve=1&username='.$dev_config['username'].'&password='.$dev_config['password'];
        execute_api($delsensor);
    }
    foreach (array_filter($urls) as $key => $value) {
        $uurl = 'http://'.$dev_config['ip'].'/api/duplicateobject.htm?id='.$dev_config['copy_http'].'&name=http&targetid='.$deviceid.'&username='.$dev_config['username'].'&password='.$dev_config['password'];

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
        $arr_url = json_encode($arr_url);
        $insert_q = "UPDATE monitor_mail SET url=? where domain_ip=? and  type ='$type'";
        $params = [$arr_url,$webid];
        if (!$commons->doThis($insert_q,$params))
        {
                die("Error.");
        }
}

function execute_api($url)
{
    file_get_contents($url);
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


  header("location: /admin?main=surveillance&act=new&tab=share&webid=$webid");