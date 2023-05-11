<?php
require_once('views/admin/admin_vpsconfig.php');
$action = 'get_state';
$state = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v.ps1" '.$action." ".$webvmhost_ip." ".$webvmhost_user." ".$webvmhost_password." ". $webvm_name); 
echo json_encode(['state'=>$state]);
die;