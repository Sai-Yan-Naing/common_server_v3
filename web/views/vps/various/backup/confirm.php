<?php
 require_once('views/vps_config.php');
if ( !isset($_POST['action']))
{ header("location: /vps/various/backup?webid=$webid");}
// require_once('models/backup.php');
$date = date('d-m-Y-his');
$backupname = $date.'-'.$webip;
$dirname = "C:/Hyper-V/Backup/$backupname/";

$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;

        $getvpsbackup = $commons->getRow("SELECT * FROM vps_backup WHERE ip='$webip'");
	if ( isset($_POST['action']) and $_POST['action'] === "delete")
    {
        // die('delete');
        $action = "delete_dir";
        $act_id=$_POST['act_id'];
        $delete_q = "DELETE FROM vps_backup WHERE id=?";
        if ( ! $commons->doThis($delete_q,[$act_id]))
        {
            echo $error="Cannot delete vps backup";
            // require_once('views/share/servers/ftp/index.php');
            die();
        }
        // $backup_vmname = $_POST['backup_vmname'];
        echo $del_dir = "C:/Hyper-V/Backup/$getvpsbackup[name]/";
        echo  Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v_init.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $dirname." ". $del_dir);
    } elseif (isset($_POST['action']) and $_POST['action'] === "backup")
    {
        // die('ok');
        
        $del_dir = "C:/Hyper-V/Backup/$getvpsbackup[name]/";
        if ( $getvpsbackup['id']!=null)
        {
            $insert_q = "UPDATE vps_backup SET name='$backupname' WHERE ip='$webip'";
            // echo $backupname;
            // die('alread exit');
        }else{
            $insert_q = "INSERT INTO vps_backup (ip, name, scheduler) VALUES ('$webip', '$backupname', 0)";
            // die('to instert');
        }
        if ( !$commons->doThis($insert_q))
        {
            echo $error="cannot create vps backup";
            die();
        }
        $dirname = "C:/Hyper-V/Backup/$backupname/";
        // echo $webvm_name;
        // die('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname);
        // Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname);
        $action = 'export_vm';
        echo  Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v_init.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $dirname." ". $del_dir);
        // die('ol');
    } elseif (isset($_POST['action']) and $_POST['action'] === "restore")
    {
        // die('restore');
        $act_id=$_POST['act_id'];
        $dirname = "C://Hyper-V//Backup//$getvpsbackup[name]//$webvm_name";
        $temp = "C://Hyper-V//Backup//$getvpsbackup[name]//$webvm_name//Virtual Machines";
        $directories = array();
        $files_list  = array();
        $backupfile = '';
        $files = scandir($temp);
        foreach ( $files as $file)
        {
           if ( ($file != '.') && ($file != '..'))
           {
              if ( is_dir($temp.'\\'.$file))
              {
                 $directories[]  = $file;

              } else
              {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if ( $ext === "vmcx")
                {
                    $backupfile = $file;
                }
              }
           }
        }
        // $insert_q = "UPDATE vps_backup SET active=0 WHERE ip='$webip'";
        // $commons->doThis($insert_q);
        // $ext = pathinfo($files_list, PATHINFO_EXTENSION);
        // die("D:\\$webvm_name.vhdx");
        // unlink("D:\\$webvm_name.vhdx");
        // die();
        // $dirname = "C:/Hyper-V/Backup/12-08-2021-010001-127.0.0.11/202189wind2019/Virtual Machines/41EE1485-F007-4668-81DD-D0F3AD95A830.vmcx";
        // print_r($dirname."\\".$backupfile);
        // echo $backupfile;
        // die('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname." ".$backupfile);
        $getvps = $commons->getRow("SELECT * FROM vps_account WHERE ip=?",[$webip]);
        $active = $getvps['active'];
        // die($active);
        // echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname." ".$backupfile." ".$active);
        $action = 'restore_backup';
        echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\hyper-v_init.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $dirname." ". $del_dir." ".$backupfile);
        // die('restore');
    } elseif (isset($_POST['action']) and $_POST['action'] === "auto_backup")
    {
        $status = $getvpsbackup['scheduler'] === 1?0:1;
            $update_q = "UPDATE vps_backup SET scheduler='$status' WHERE ip='$webip'";
        if ( !$commons->doThis($update_q))
        {
            echo $error="cannot create vps backup";
            die();
        }
    }
    header("location: /vps/various?setting=backup&tab=backup&act=index");

?>