<?php
require_once('views/share_config.php');
// if(!isset($_POST['db_user']) || !isset($_POST['type'])){header("location: /share/server/database?webid=$webid&db=mysql");}
// require_once('models/mysql.php');
$type = $_POST["type"];
$action = $_POST["action"];

$db_user = $_POST["db_user"];
$db_pass = $_POST["db_pass"];
	if ( $action=="new")
	{
		$db_name = $_POST["db_name"];
		if ( ! $commons->addMsUserAndDB($version="",$db_name, $db_user, $db_pass))
        {
            $error = "Something error";
            require_once("views/share/server/site/app_install/index.php");
            die("");
        }
		$hostname = SQLSERVER_2016_HOST_NAME;
		$hostip = SQLSERVER_2016_HOST_IP;
        $insert_q = "INSERT INTO db_account_for_mssql(`domain`, `host_name`, `host_ip`, `db_name`, `db_user`, `db_count`, `db_pass`) VALUES (?, ?, ?, ?, ?, ?, ?)";

		if ( ! $commons->doThis($insert_q,[$webdomain, $hostname, $hostip, $db_name, $db_user, 1, $db_pass]))
		{
			$error = "cannot add db account";
				require_once("views/share/server/database/mssql/index.php");
				die("");
			}
		
	}elseif ($action=="edit") 
	{
		if(!$commons->changeMssqlPassword($db_user,$db_pass))
		{
			$error = "Something errors";
				require_once("views/share/server/database/mssql/index.php");
				die("");
		}
	}else
	{
		$act_id = $_POST['act_id'];
		$db_name = $_POST['db_name'];
		// die($act_id.$db_user.$db_name);
		if(!$commons->deleteMssqlDB($act_id,$db_user,$db_name))
		{
			echo $error = "Something errors";
				require_once("views/share/server/database/mssql/index.php");
				die("");
		}
	}
	header("Location: /share/server?setting=database&tab=mssql&act=index&webid=$webid$pagy");
	die("");
	
?>