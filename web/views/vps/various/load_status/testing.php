<?php
require_once('views/vps_config.php');
require_once('views/vps/various/load_status/usage.php');

$memoryTotal = null;
        $memoryFree = null;
        $cmd = "loadstatus";
       echo $host_ip = $webvmhost_ip;
        echo ' '.$host_user = $webvmhost_user;
        echo ' '.$host_password = $webvmhost_password;
        echo ' '.$vm_name = $webvm_name;
        echo ' '.$vm_user = JAPANSYS;
        echo ' '.$vm_pass = JAPANSYS_PASS;
        echo ' '.$vm_action = "disk_rw";
        echo $shell =shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
        die();
// if(isset($_GET['case']) && $_GET['case']=='cpu')
// {
    // die
    // $shell = cpu_usage($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
    // echo "<pre";
    // $shell = explode('LoadPercentage ',$shell);
    // print_r($shell[1]);
// }else{
    // echo memory_usage(true,$webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
// }
echo '<br>';
echo $shell =shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);;
$shell = trim(preg_replace('/\s\s+/', ' ', $shell));
$shell = preg_replace('/\s+/', '', $shell);
$shell = explode("r_r",$shell);
$total = $shell[0];
$free = $shell[1];
$outputTotalPhysicalMemory = explode("TotalPhysicalMemory",$total);
$memoryTotal=(int)$outputTotalPhysicalMemory[1];
$outputFreePhysicalMemory = explode("FreePhysicalMemory",$free);
$memoryFree=(int)$outputFreePhysicalMemory[1];
echo"<pre>" ;
print_r($shell);
echo "</pre>";
$shell1 = explode("FreePhysicalMemory ",$shell1);

echo"<pre> gg" ;
print_r($shell1);
echo "</pre>";
// // echo round((100 - ((int)$shell1[1] * 1024 * 100 / (int)$shell[1])),2);
// echo "<br>";
// echo (int)$shell1[1] * 100 / (int)$shell[1];