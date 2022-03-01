<?php
require_once('views/admin/admin_shareconfig.php');
// if(!isset($_POST['db_user']) || !isset($_POST['type'])){header("location: /admin/share/server/database?webid=$webid&db=mysql");}
// require_once('models/mysql.php');
$type = $_POST["type"];
$action = $_POST["action"];

$db_user = $_POST["db_user"];
$db_pass = $_POST["db_pass"];
$msgsession =  "msg";
$msg = "jp message";
	if ( $action== "new")
	{
		$db_name = $_POST["db_name"];
		$msgsession =  "msg";
		$msg = "DB 「".$db_name."」 の追加が完了しました ";
		if ( ! $commons->addMyUserAndDB($db_name, $db_user, $db_pass))
        {
            echo $error = "Something error";
			die;
            require_once("views/admin/share/server/site/app_install/index.php");
            die("");
        }
        // die;
        $insert_q = "INSERT INTO db_account (domain, db_name, db_user, db_count, db_pass) VALUES (?, ?, ?, ?, ?)";

		if ( ! $commons->doThis($insert_q,[$webdomain, $db_name, $db_user, 1, $db_pass]))
		{
			echo $error = "cannot add db account";
			die;
				require_once("views/admin/share/server/database/mysql/index.php");
				die("");
			}
	} elseif ( $action=="edit") 
	{
		if( ! $commons->changeMysqlPassword($db_user,$db_pass))
		{
			$error = "Something errors";
				require_once("views/admin/share/server/database/mysql/index.php");
				die("");
		}
		$query = "SELECT * FROM db_account WHERE db_user=?";
		$getRow = $commons->getRow($query,[$db_user]);
		$msgsession =  "msg";
		$msg = "DB 「".$getRow['db_user']."」 パスワードを変更しました";
	} else
	{
		$act_id = $_POST['act_id'];
		$db_name = $_POST['db_name'];
		if(!$commons->deleteMysqlDB($act_id,$db_user,$db_name))
		{
			$error = "Something errors";
				require_once("views/admin/share/server/database/mysql/index.php");
				die("");
		}
		$msgsession =  "msg";
		$msg = "DB 「".$db_name."」 の削除が完了しました";
	}
	flash($msgsession,$msg);
	header("Location: /admin/share/server?setting=database&tab=mysql&act=index&webid=$webid$pagy");