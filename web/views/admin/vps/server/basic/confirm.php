<?php
require_once('views/admin/admin_vpsconfig.php');
$cmd = "reinitializevm";
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;
$vm_user = JAPANSYS;
$vm_pass = JAPANSYS_PASS;
$vm_cpu = $_POST['cpu'];
        // echo $memory = $_POST['memory'];
        // echo $cpu = $_POST['cpu'];
        // echo $disk = $_POST['disk'];
        // echo $ip_address = $_POST['ip_address'];
        // echo $virtual_switch = $_POST['virtual_switch'];
        // // die('');
        
        if(!isset($_POST["osreinstall"]))
        {       
                $vm_storage = $_POST['storage']."GB";
                $vm_memory = $_POST['memory']."GB";
                $subject ='=?UTF-8?B?'.base64_encode('Request Specification').'?=';
                $body = file_get_contents('views/mailer/admin/vps/info.php');
                $body = str_replace('$memory', $vm_memory, $body);
                $body = str_replace('$disk', $vm_storage, $body);
                $body = str_replace('$cpu', $vm_cpu, $body);
                $body = preg_replace('/\\\\/','', $body); //Strip backslashes
                $webmailer->sendMail($to=TO,$toName=TONAME,$subject,$body);  
        }else{
                $vm_storage = $_POST['storage']*1024*1048576;
                $vm_memory = $_POST['memory']*1024*1048576;
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_memory.' '.$vm_storage.' '.$vm_cpu);
        }
header("location: /admin/vps/server?tab=basic&act=index&webid=$webid");

?>