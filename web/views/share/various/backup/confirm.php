<?php
require_once('views/share_config.php');
// if ( !isset($_POST['action'])){ header("location: /share/various/backup?webid=$webid");}
// require_once('models/backup.php');
$date = date("Y-m-d");
$dirname = "G:/backup/$webuser/";

$getbackup = $commons->getRow("select * from backup_data where domain='$webdomain'");
$msg = "jp message";
$msgsession ="msg";
$action = $_POST['action'];

if (!$webuser) 
{
	die('error');
}
// die($_POST['user']);
	if ( isset($action) and $action=="delete")
    {
        
        $msg = "「".$webdomain."」のバックアップデータを削除しました";
    	
        // deleteBackup($dirname);

        deleteDir($web_host,$web_user,$web_password,$dirname);

        $query = "DELETE FROM share_backup WHERE domain=?";
            if ( ! $commons->doThis($query,[$webdomain]))
            {
                $error  = "Backup Cannot be add.";
                require_once('views/share/various/backup/index.php');
                die("");
            }
        
    } elseif ( isset($action) and $action=="backup")
    {
    	// die(ROOT_PATH."$webuser");
        $src = ROOT_PATH.$webpath;
        // $directory = "G:/backup/$webuser";
        $bkname = "$webuser-$date";
        $date = date("Y-m-d h:m:s");
        // if (  is_dir($directory) )
        // {
        //     deleteBackup($directory);
        // }
        // copy_paste($src, $dst);
        // die();
        $query = "SELECT * FROM share_backup WHERE domain=?";
        $getRow = $commons->getRow($query,[$webdomain]);
 // echo count($getRow['id']);
 // die;
        if(count($getRow['id'])>0)
        {
            $query = "UPDATE share_backup SET name=?, date=? WHERE domain=?";
            if ( ! $commons->doThis($query,[$bkname, $date, $webdomain]))
            {
                $error  = "Backup Cannot be add.";
                require_once('views/share/various/backup/index.php');
                die("");
            }
        }else{
           $query = "INSERT INTO share_backup (domain, name, date) VALUES ( ?, ?, ?)"; 
           if ( ! $commons->doThis($query,[$webdomain, $bkname, $date]))
            {
                $error  = "Backup Cannot be add.";
                require_once('views/share/various/backup/index.php');
                die("");
            }
        }
        sharebackup($web_host,$web_user,$web_password,$src,$webuser,$bkname,$action);
        $msg = $webdomain." のバックアップが完了しました";
    } elseif (isset($action) and $action=="restore")
    {
    	// $file = showFolder($dirname);
        // $date = "$directory/$webuser-$date";
    	$dst = ROOT_PATH.$webpath;

        $query = "SELECT * FROM share_backup WHERE domain=?";
        $getRow = $commons->getRow($query,[$webdomain]);

     //    $dst = ROOT_PATH."$webrootuser/$webuser";
     //    if ( is_dir($dst)){
     //        deleteBackup($dst);
     //    }
     //    copy_paste($src, $dst);
        sharebackup($web_host,$web_user,$web_password,$dst,$webuser,$getRow['name'],$action);
        $msg = "「".$webdomain."」のバックアップデータをリストアしました";
        
    } elseif (isset($action) and $action=="auto_backup")
    {
    	$onoff=$getbackup['scheduler']==1? 0 : 1;
    	$stsp=$getbackup['scheduler']==1? "停止" : "起動";
        $msg = "自動バックアップを".$stsp."しました";
        
  //   	$backup = new Backup;

		// $backup->addAutoBackup($webdomain,$webuser,$onoff);
        $query = "SELECT * FROM backup_data WHERE domain=?";
        $getRow = $commons->getRow($query,[$webdomain]);

        if(count($getRow['id'])>0)
        {
            $query = "UPDATE backup_data SET name=?, scheduler=? WHERE domain=?";
            if ( ! $commons->doThis($query,[$webuser, $onoff, $webdomain]))
            {
                $error  = "Backup Cannot be add.";
                require_once('views/share/various/backup/index.php');
                die("");
            }
            // die('ok');
        }else{
           $query = "INSERT INTO backup_data (domain, name, scheduler) VALUES ( ?, ?, ?)"; 
           if ( ! $commons->doThis($query,[$webdomain, $webuser, $onoff]))
            {
                $error  = "Backup Cannot be add.";
                require_once('views/share/various/backup/index.php');
                die("");
            }
        }
    }
    flash($msgsession,$msg);
    header("location: /share/various?setting=backup&act=index");