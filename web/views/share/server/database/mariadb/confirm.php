<?php
require_once('views/share_config.php');
$type = $_POST["type"];
$action = $_POST["action"];

$db_user = $_POST["db_user"];
$db_pass = $_POST["db_pass"];
	if($action=="new")
	{
		$db_name = $_POST["db_name"];
		
		if(!$commons->addMariaUserAndDB($db_name, $db_user, $db_pass))
		{
			$error = "Something errors";
			require_once("views/share/server/database/mariadb/index.php");
			die("");
		}
        $insert_q = "INSERT INTO db_account_for_mariadb (`domain`, `db_name`, `db_user`, `db_count`, `db_pass`) VALUES ('$webdomain', '$db_name', '$db_user', 1, '$db_pass')";

		if(!$commons->doThis($insert_q)){
			$error = "cannot add db account";
				require_once("views/share/server/database/mariadb/index.php");
				die("");
			}
	}elseif ($action=="edit") {
		if(!$commons->changeMariaPassword($db_user,$db_pass))
		{
			$error = "Something errors";
				require_once("views/share/server/database/mariadb/index.php");
				die("");
		}
	}else{
		$act_id = $_POST['act_id'];
		$db_name = $_POST['db_name'];
		if(!$commons->deleteMariaDB($act_id,$db_user,$db_name))
		{
			$error = "Something errors";
				require_once("views/share/server/database/mariadb/index.php");
				die("");
		}
	}
	header("Location: /share/server?setting=database&tab=mariadb&act=index");
	die("");
	
?>