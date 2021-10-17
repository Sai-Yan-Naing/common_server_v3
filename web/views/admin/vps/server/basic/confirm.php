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
    if ( isset($_POST['action']) )
    {
        $plan = $_POST['spec'];
        $qry = "UPDATE vps_account SET `plan` = ? WHERE `id` = ?";
        if( ! $commons->doThis($qry,[$plan,$webid]) ){
                // require_once("views/admin/share.php");
                die("error");
        }

        $query = "SELECT spec_info.value,price_tbl.plan_name FROM service_db.dbo.price_tbl
                inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
                INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND
                spec_units.[key] = ? WHERE price_tbl.service = '01' AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
            $getmemory = $commons->getSpec($query,['memory',$plan])['value'];
            $getdisk = $commons->getSpec($query,['disk_hdd',$plan])['value'];
            $getcore = $commons->getSpec($query,['core',$plan])['value'];
        
            $vm_storage = (int)$getdisk*1024*1048576;
            // $vm_storage = 80*1024*1048576;

            $vm_memory = (int)$getmemory*1024*1048576;
            $vm_cpu = (int)$getcore;
    
        if ($_POST["action"] !== "osreinstall" )
        {       
                $subject ='=?UTF-8?B?'.base64_encode('Request Specification').'?=';
                $body = file_get_contents('views/mailer/admin/vps/info.php');
                $body = str_replace('$memory', $getmemory, $body);
                $body = str_replace('$disk', $getdisk, $body);
                $body = str_replace('$cpu', $vm_cpu, $body);
                $body = preg_replace('/\\\\/','', $body); //Strip backslashes
                $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body,''); 
                $cmd = "changeplan";

                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu);

        } else
        {
                // $vm_storage = 60*1024*1048576;
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu.' '.$ipaddress.' '.$gateway);
        }
    }
header("location: /admin/vps/server?tab=basic&act=index&webid=$webid");

?>