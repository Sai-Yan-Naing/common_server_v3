<?php
require_once('views/vps_config.php');
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
        $query = "SELECT spec_info.value,price_tbl.plan_name, spec_units.[key] FROM service_db.dbo.price_tbl
        inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
        INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
                            AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
        $getspec = $commons->getSpec($query,[$plan]);
        $spec = [
        "plan_name"=>$getspec[0]['plan_name'], 
        "memory"=>$getspec[0]['value'], 
        "disk_hdd"=>$getspec[1]['value'],
        "core" => $getspec[2]['value']];
//         echo "<pre>";
// print_r($spec);
// die;
            $vm_storage = (int)$spec['disk_hdd']*1024*1048576;
            $getdisk = (int)$spec['disk_hdd'];
            // $vm_storage = 80*1024*1048576;

            $vm_memory = (int)$spec['memory']*1024*1048576;
            $getmemory = (int)$spec['memory'];
            $vm_cpu = (int)$spec['core'];
    
        if ($_POST["action"] !== "osreinstall" )
        {       
                $subject ='Request Specification';
                $body = file_get_contents('views/mailer/vps/info.php');
                $body = str_replace('$memory', $getmemory, $body);
                $body = str_replace('$disk', $getdisk, $body);
                $body = str_replace('$cpu', $vm_cpu, $body);
                $body = preg_replace('/\\\\/','', $body); //Strip backslashes
                $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body); 
                $cmd = "changeplan";

                $qry = "UPDATE vps_account SET `plan_update` = ? WHERE `id` = ?";
                if( ! $commons->doThis($qry,[$plan,$webid]) ){
                        // require_once("views/share.php");
                        die("error");
                }
                // shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu);

        } else
        {
                // $vm_storage = 60*1024*1048576;
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu.' '.$ipaddress.' '.$gateway);
        }
    }
header("location: /vps/server?tab=basic&act=index");

?>