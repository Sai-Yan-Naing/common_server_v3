<?php
require_once('views/admin/admin_shareconfig.php');
// if ( !isset($_POST['action'])){ header("location: /admin/share/various/backup?webid=$webid");}
// require_once('models/backup.php');
$date = date("Y-m-d");
$dirname = "G:/backup/$webuser/";

$getbackup = $commons->getRow("select * from backup_data where domain='$webdomain'");
$msg = "jp message";
$msgsession ="msg";

if (!$webuser) 
{
	die('error');
}
// die($_POST['user']);
	if ( isset($_POST['action']) and $_POST['action']=="delete")
    {
    	
        deleteBackup($dirname);
        
    } elseif ( isset($_POST['action']) and $_POST['action']=="backup")
    {
    	// die(ROOT_PATH."$webuser");
        $src = ROOT_PATH."$webrootuser/$webuser";
        $directory = "G:/backup/$webuser";
        $dst = "$directory/$webuser-$date";
        if (  is_dir($directory) )
        {
            deleteBackup($directory);
        }
        copy_paste($src, $dst);
    } elseif (isset($_POST['action']) and $_POST['action']=="restore")
    {
    	$file = showFolder($dirname);
    	$src = "G:/backup/$webuser/$file/";
        $dst = ROOT_PATH."$webrootuser/$webuser";
        if ( is_dir($dst)){
            deleteBackup($dst);
        }
        copy_paste($src, $dst);
        
    } elseif (isset($_POST['action']) and $_POST['action']=="auto_backup")
    {
    	$onoff=$getbackup['scheduler']==1? 0 : 1;
    	$stsp=$getbackup['scheduler']==1? "停止" : "起動";
        $msg = "自動バックアップを".$stsp."しました";
        
    	$backup = new Backup;

		$backup->addAutoBackup($webdomain,$webuser,$onoff);
    }
    flash($msgsession,$msg);
    header("location: /admin/share/various?setting=backup&act=index&webid=$webid");