<?php
require_once('views/admin/admin_vpsconfig.php');
$cmd = "reinitializevm";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$ipaddress = $webip;
$gateway = $webgateway;
$msgsession =  "msg";
$msg = "jb message";
    if ( isset($_POST['action']) )
    {
        
        $msg = "プラン変更依頼が完了しました。";
        $changedate = $_POST['changedate'];
        $plan = $_POST['spec'];
        $query = "SELECT spec_info.value,price_tbl.plan_name, spec_units.[key],price FROM service_db.dbo.price_tbl
        inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
        INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
                            AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
        $getspec = $commons->getSpec($query,[$plan]);
        $spec = [
        "plan_name"=>$getspec[0]['plan_name'], 
        "memory"=>$getspec[0]['value'], 
        "price"=>$getspec[0]['price'], 
        "disk_hdd"=>$getspec[1]['value'],
        "core" => $getspec[2]['value']];
//         echo "<pre>";
// print_r($webadminName);
// die;
            $vm_storage = (int)$spec['disk_hdd']*1024*1048576;
            $getdisk = (int)$spec['disk_hdd'];
            // $vm_storage = 80*1024*1048576;

            $vm_memory = (int)$spec['memory']*1024*1048576;
            $getmemory = (int)$spec['memory'];
            $vm_cpu = (int)$spec['core'];
            $price = (int)$spec['price'];
    
        if ($_POST["action"] !== "osreinstall" )
        {       
                // $msgsession =  "msg";
		// $msg = "OS初期化が完了しました。";
                $subject = '【Winserver】プラン変更依頼完了';
                $body = file_get_contents('views/mailer/admin/vps/info.php');
                // $body = str_replace('$memory', $getmemory, $body);
                // $body = str_replace('$disk', $getdisk, $body);
                // $body = str_replace('$cpu', $vm_cpu, $body);
                $body = str_replace('$name', $webadminName, $body);
                $body = str_replace('$cost', $price, $body);
                $body = preg_replace('/\\\\/','', $body); //Strip backslashes
                $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body); 
                $cmd = "changeplan";
                $qry = "UPDATE vps_account SET plan_update = ?, changedate = '$changedate' WHERE id = ?";
                if( ! $commons->doThis($qry,[$plan,$webid]) ){
                        // require_once("views/admin/share.php");
                        die("error");
                }
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vps_basicsetting\changeplan.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$changedate);

        } else
        {
            $update_q = "UPDATE vps_account SET reboot=1 WHERE id='$webid'";
            if ( ! $commons->doThis($update_q,[$status,$webid]))
            {
                echo $error="cannot update vps";
                require_once('views/admin/vps.php');
                die();
            }
                $msgsession =  "msg";
		$msg = "OS初期化が完了しました";
                // $vm_storage = 60*1024*1048576;
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu.' '.$ipaddress.' '.$gateway);
        }
    }
    flash($msgsession,$msg);
header("location: /admin/vps/server?tab=basic&act=index&webid=$webid");

?>