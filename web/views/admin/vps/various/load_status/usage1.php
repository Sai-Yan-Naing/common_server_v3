<?php
require_once('views/admin/admin_vpsconfig.php');
require_once('views/admin/vps/various/load_status/usage.php');

if ( isset($_GET['case']) && $_GET['case']=='cpu')
{
    // die
    echo cpu_usage($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
} elseif(isset($_GET['case']) && $_GET['case']=='memory'){
    echo memory_usage(true,$webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
}else{
    echo disk_read($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
}