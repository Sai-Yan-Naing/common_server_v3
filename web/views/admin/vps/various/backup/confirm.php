<?php
 require_once('views/admin/admin_vpsconfig.php');
if ( !isset($_POST['action']))
{ header("location: /admin/vps/various/backup?webid=$webid");}
// require_once('models/backup.php');
$date = date('d-m-Y');
$backupname = $date.'-'.time().'-'.$webip;
$dirname = "E:\Backup/$backupname/";

$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$vm_name = $webvm_name;

$msg = "jp message";
$msgsession ="msg";

        $getvpsbackup = $commons->getRow("SELECT * FROM vps_backup WHERE ip='$webip'");
	if ( isset($_POST['action']) and $_POST['action'] === "delete")
    {
        // die('delete');
        $action = "delete";
        $act_id=$_POST['act_id'];
        $delete_q = "DELETE FROM vps_backup WHERE id=?";
        if ( ! $commons->doThis($delete_q,[$act_id]))
        {
            echo $error="Cannot delete vps backup";
            // require_once('views/admin/share/servers/ftp/index.php');
            die();
        }
        $msg = $webip."のバックアップデータの削除が完了しました";
        // $backup_vmname = $_POST['backup_vmname'];
        $del_dir = $getvpsbackup['name'];
        Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\backup.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $del_dir);
    } elseif (isset($_POST['action']) and $_POST['action'] === "backup")
    {
        // die('ok');
        
        $del_dir = $getvpsbackup['name'];
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
        $msg = $webip."のバックアップが完了しました";
        //$dirname = "E:\Backup/$backupname/";
        // echo $webvm_name;
        // die('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname);
        // Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/manage_vm/vm.ps1" '. $webvm_name." ".$action." ".$dirname);
        $action = 'export_vm';
        echo  Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\backup.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $backupname." ". $del_dir);
        // die('ol');
    } elseif (isset($_POST['action']) and $_POST['action'] === "restore")
    {
        $back_name = $getvpsbackup['name'];
        $msg = $webip."のバックアップデータのリストアを完了しました";
        $getvps = $commons->getRow("SELECT * FROM vps_account WHERE ip=?",[$webip]);
        $active = $getvps['active'];
        $action = 'restore_backup';
        echo Shell_Exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vm_manager\backup.ps1" '.$action." ".$host_ip." ".$host_user." ".$host_password." ". $vm_name." ". $back_name);
        // die('restore');
    } elseif (isset($_POST['action']) and $_POST['action'] === "auto_backup")
    {
        echo $status = $getvpsbackup['scheduler'] == 1?0:1;
    	$stsp=$getvpsbackup['scheduler']==1? "停止" : "起動";
        $msg = "自動バックアップを".$stsp."しました";
        $update_q = "UPDATE vps_backup SET scheduler='$status' WHERE ip='$webip'";
        if ( !$commons->doThis($update_q))
        {
            echo $error="cannot create vps backup";
            die();
        }
        // die();
    }
    flash($msgsession,$msg);
    header("location: /admin/vps/various?setting=backup&tab=backup&act=index&webid=$webid");