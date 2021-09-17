<?php

class Common{
		public $pdo;
		function __construct()
		{
			$this->pdo = new PDO(DSN, ROOT, ROOT_PASS);
		}

		function getRow($query)
		{
			// die($query);
			$stmt1 = $this->pdo->prepare($query);
			$stmt1->execute();
			$data = $stmt1->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		function getAllRow($query)
		{
			// die($query);
			$stmt1 = $this->pdo->prepare($query);
			$stmt1->execute();
			$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		function doThis($query)
		{
			// die($query);
			try{
				$stmt1 = $this->pdo->prepare($query);
				if(!$stmt1->execute())
				{
					return false;
				}
				return true;
			}catch(PDOException $e){
				die('error');
				// echo $sql . "<br>" . $e->getMessage();
			}
			
		}

		function addMyUserAndDB($db, $db_user, $db_pass){
			try {
	
				$dsn2 = 'mysql:host=localhost:3306';
				$pdo = new PDO($dsn2, ROOT, ROOT_PASS);
				$db = trim($pdo->quote($db), "'\"");
				$stmt = $pdo->prepare("USE $db");
				if($stmt->execute())
				{
					die("db already exist");
				}
				$stmt = $pdo->prepare("CREATE DATABASE `$db`;");
				if(!$stmt->execute())
				{
					return false;
				}
				$stmt = $pdo->prepare("CREATE USER :db_user@'%' IDENTIFIED BY :db_pass;");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				$stmt->bindParam(":db_pass", $db_pass, PDO::PARAM_STR);
				if(!$stmt->execute())
				{
					$stmt = $pdo->prepare("DROP DATABASE `$db`;");
					$stmt->execute();
					return false;
				}
				$stmt = $pdo->prepare("GRANT ALL ON `$db`.* TO :db_user@'%';");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				$stmt->execute();
			} catch (PDOException $e) {
				//print('Error ' . $e->getMessage());
				$error_message = "データベースへの接続エラーです。";
				$pdo_account = NULL;
				die();
			}
			$pdo = NULL;
			return true;
		}

		function changeMysqlPassword($db_user,$db_pass){
					$pdo = new PDO(DSN, ROOT, ROOT_PASS);
					$stmt = $pdo->prepare("ALTER USER '$db_user'@'%' IDENTIFIED BY '$db_pass';");
					if(!$stmt->execute())
						return false;
					$stmt1 = $pdo->prepare("UPDATE db_account SET `db_pass` = ? WHERE `db_user` = ?");
					if(!$stmt1->execute(array($db_pass,$db_user)))
						return false;
						return true;
			}
		function deleteMysqlDB($dbid,$dbuser,$db){
				$pdo_account = new PDO(DSN, ROOT, ROOT_PASS);
				$stmt = $pdo_account->prepare("DROP USER '$dbuser'@'%'");
				if(!$stmt->execute())
					return false;
				$stmt1 = $pdo_account->prepare("DROP DATABASE $db");
				if(!$stmt1->execute())
					return false;
				$dstmt = $pdo_account->prepare("DELETE FROM `db_account` WHERE id = ?");
				if(!$dstmt->execute(array($dbid)))
					return false;
					return true;
		}

		function importWP($sql,$db_name,$db_username,$pass){
			try {
				$pdo_account = new PDO('mysql:host=localhost;dbname='.$db_name, $db_username, $pass);
				// echo $pdo_account->exec($sql);
				if($pdo_account->exec($sql)==0){
					return true;
				}else{
					return false;
				}
	
	
			} catch (PDOException $e) {
				//print('Error ' . $e->getMessage());
				$pdo_account = NULL;
				return false;
			}
			$pdo_account = NULL;
			return false;
		}

		function addMariaUserAndDB($db, $db_user, $db_pass){
			try {
				// $dsn2 = 'mysql:host=localhost:3307';
				$pdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
				$db = trim($pdo->quote($db), "'\"");
				$stmt = $pdo->prepare("CREATE DATABASE `$db`;");
				if(!$stmt->execute())
				{
					return false;
				}
				$stmt = $pdo->prepare("CREATE USER :db_user@'%' IDENTIFIED BY :db_pass;");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				$stmt->bindParam(":db_pass", $db_pass, PDO::PARAM_STR);
				if(!$stmt->execute())
				{
					$stmt = $pdo->prepare("DROP DATABASE `$db`;");
					$stmt->execute();
					return false;
				}
				$stmt = $pdo->prepare("GRANT ALL ON `$db`.* TO :db_user@'%';");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				if(!$stmt->execute())
				{
					return false;
				}
			} catch (PDOException $e) {
				$pdo_account = NULL;
				return false;
			}
			$pdo = NULL;
			return true;
		}
	
			function changeMariaPassword($dbuser,$dbpass){
				// $dsn2 = 'mysql:host=localhost:3307';
				$mapdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
				$stmt = $mapdo->prepare("ALTER USER '$dbuser'@'%' IDENTIFIED BY '$dbpass';");
				if(!$stmt->execute())
				{
					return false;
				}
				$mapdo = NULL;
	
				try {
				  $conn = new PDO(DSN, ROOT, ROOT_PASS);
					  // set the PDO error mode to exception
					  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
					  $sql = "UPDATE db_account_for_mariadb SET db_pass='$dbpass' WHERE db_user='$dbuser'";
	
					  // Prepare statement
					  $stmt = $conn->prepare($sql);
	
					  // execute the query
					  if(!$stmt->execute())
					  {
						  return false;
					  }
					} catch(PDOException $e) {
					  return false;
					}
	
					$conn = null;
				return true;
		}
	
		function deleteMariaDB($dbid,$dbuser,$db){
			// return $dbid.$dbuser.$db;
				// $dsn2 = 'mysql:host=localhost:3307';
				$mapdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
				$pdo_account = new PDO(DSN, ROOT, ROOT_PASS);
				$stmt = $mapdo->prepare("DROP USER '$dbuser'@'%'");
				if(!$stmt->execute())
				{
					return false;
				}
				$stmt1 = $mapdo->prepare("DROP DATABASE $db");
				if(!$stmt1->execute())
				{
					return false;
				}
				$dstmt = $pdo_account->prepare("DELETE FROM `db_account_for_mariadb` WHERE id = ?");
				// $ddata = $dstmt->fetchAll(PDO::FETCH_ASSOC);
				if(!$dstmt->execute(array($dbid)))
				{
					return false;
				}
				return true;
		}

		function mail_server($domain,$email,$password,$action,$isexist){
			// die('http://ssl8.ethical-sai.tech/index.php?domain='.$domain.'&'.'password='.$password.'&'.'email='.$email.'&'.'isexist='.$isexist.'&action='.$action);
			// return $email1=$email.'@'.$domain;
	
			// $domain="test.test";
			// $password="welcome";
			// $password = hash_hmac('sha256', $password, PASS_KEY);
				$result = $this->openURL(MAIL_SERVER.'/index.php?domain='.$domain.'&'.'password='.$password.'&'.'email='.$email.'&'.'isexist='.$isexist.'&action='.$action);
				$data = json_decode($result);
				// print_r($result);
				// echo $data->ok;
				// return $data;
				if($data->ok)
				{
					return 'ok';
				}
				return 'not ok';
		}
	
		function openURL($url) {
	 
		  // Create a new cURL resource
		  $ch = curl_init();
		 
		  // Set the file URL to fetch through cURL
		  curl_setopt($ch, CURLOPT_URL, $url);
		 
		  // Do not check the SSL certificates
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
		  // Return the actual result of the curl result instead of success code
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_HEADER, 0);
		  $data = curl_exec($ch);
		  curl_close($ch);
		  return $data;
		}
	}

?>