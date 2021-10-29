<?php
require_once('views/vps_config.php');
require_once('views/vps/various/load_status/usage.php');

if ( isset($_GET['case']) && $_GET['case']=='cpu')
{
    // die
    echo cpu_usage($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
}else{
    echo memory_usage(true,$webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
}