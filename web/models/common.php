<?php

class Common{
	public $pdo;

	function __construct()
	{
		// $this->pdo = new PDO(DBDSN, DBROOT, DBROOT_PASS);
			$this->pdo = new PDO(DBDSN, DBROOT, DBROOT_PASS);
			$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	function getCount($query, $params = [])
	{
		// return $query;die;
		$stmt1 = $this->pdo->prepare($query);
		$stmt1->execute($params);
		$data = $stmt1->fetchColumn();
		return $data;
	}

	function getRow($query, $params = [])
	{
		// die($query);
		$stmt1 = $this->pdo->prepare($query);
		$stmt1->execute($params);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		return $data;
	}

	function getAllRow($query, $params = [])
	{
		// die($query);
		// die($params);
		$stmt1 = $this->pdo->prepare($query);
		$stmt1->execute($params);
		$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	function doThis($query, $params = [])
	{
		// echo $query;
		// echo "<pre>";
		// print_r($params);
		// die();
		try
		{
			$stmt1 = $this->pdo->prepare($query);
			if( ! $stmt1->execute($params))
			{
				die('error2');
				return false;
			}
			return true;
		}
		catch (PDOException $e)
		{
			die('error');
			// echo $sql . "<br>" . $e->getMessage();
		}
	}

	

	function addMyUserAndDB($db, $db_user, $db_pass)
	{
		if ( ! preg_match('/^[a-zA-Z0-9\-_]+$/u', $db))
		{
			return false;
		}

		try
		{
			$dsn2 = 'mysql:host=localhost:3306';
			$pdo = new PDO(MYDSN, MYROOT, MYROOT_PASS);
			$db = trim($pdo->quote($db), "'\"");
			$stmt = $pdo->prepare('SHOW DATABASES LIKE :db');
			$stmt->execute(['db' => $db]);
			if ($stmt->fetch(PDO::FETCH_ASSOC))
			{
				die("db already exist");
			}

			$stmt = $pdo->prepare("CREATE DATABASE $db;");
			if (!$stmt->execute(['db' => $db]))
			{
				return false;
			}
			$stmt = $pdo->prepare("CREATE USER :db_user@'%' IDENTIFIED BY :db_pass;");
			$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
			$stmt->bindParam(":db_pass", $db_pass, PDO::PARAM_STR);
			if(!$stmt->execute())
			{
				$stmt = $pdo->prepare("DROP DATABASE $db;");
				$stmt->execute();
				return false;
			}
			$stmt = $pdo->prepare("GRANT ALL ON $db.* TO :db_user@'%';");
			$stmt->bindParam(':db_user', $db_user, PDO::PARAM_STR);
			$stmt->execute();
			return true;
		}
		catch (PDOException $e)
		{
			die($e);
		}

		$pdo = NULL;
		return true;
	}

	function addMyUserAndDB1($db, $db_user, $db_pass)
	{
		if ( ! preg_match('/^[a-zA-Z0-9\-_]+$/u', $db))
		{
			return false;
		}

		try
		{
			$pdo = new PDO(MYDSN, MYROOT, MYROOT_PASS);
			$db = trim($pdo->quote($db), "'\"");
			$stmt = $pdo->prepare('SHOW DATABASES LIKE :db');
			$stmt->execute(['db' => $db]);
			if ($stmt->fetch(PDO::FETCH_ASSOC))
			{
				die("db already exist");
			}

			$stmt = $pdo->prepare("CREATE DATABASE $db;");
			if (!$stmt->execute(['db' => $db]))
			{
				return false;
			}
			$stmt = $pdo->prepare("CREATE USER :db_user@'%' IDENTIFIED BY :db_pass;");
			$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
			$stmt->bindParam(":db_pass", $db_pass, PDO::PARAM_STR);
			if(!$stmt->execute())
			{
				$stmt = $pdo->prepare("DROP DATABASE $db;");
				$stmt->execute();
				return false;
			}
			$stmt = $pdo->prepare("GRANT ALL ON $db.* TO :db_user@'%';");
			$stmt->bindParam(':db_user', $db_user, PDO::PARAM_STR);
			$stmt->execute();
			return true;
		}
		catch (PDOException $e)
		{
			die();
		}

		$pdo = NULL;
		return true;
	}

	function changeMysqlPassword($db_user, $db_pass)
	{
		$pdo = new PDO(MYDSN, MYROOT, MYROOT_PASS);
		$stmt = $pdo->prepare("ALTER USER :db_user@'%' IDENTIFIED BY :db_pass;");
		if ( ! $stmt->execute(['db_user' => $db_user, 'db_pass' => $db_pass]))
		{
			return false;
		}
		
		$stmt1 = $pdo->prepare('UPDATE db_account SET db_pass = ? WHERE db_user = ?');
		if ( ! $stmt1->execute([$db_pass, $db_user]))
		{
			return false;
		}

		return true;
	}

	function deleteMysqlDB($dbid, $dbuser, $db)
	{
		if ( ! preg_match('/^[a-zA-Z0-9\-_]+$/u', $db))
		{
			return false;
		}

		$pdo_account = new PDO(MYDSN, MYROOT, MYROOT_PASS);
		$stmt = $pdo_account->prepare("DROP USER :dbuser@'%'");
		if ( ! $stmt->execute(['dbuser' => $dbuser]))
		{
			return false;
		}

		$stmt1 = $pdo_account->prepare("DROP DATABASE $db");
		if ( ! $stmt1->execute())
		{
			return false;
		}

		// $dstmt = $pdo_account->prepare('DELETE FROM db_account WHERE id = ?');
		// if ( ! $dstmt->execute([$dbid]))
		// {
		// 	echo $dbid;
		// 	die('error');
		// 	return false;
		// }

		return true;
	}

	function importWP($web_host,$sql, $db_name, $db_username, $pass)
	{
		if ( ! preg_match('/^[a-zA-Z0-9\-_]+$/u', $db_name))
		{
			return false;
		}

		try
		{
			// die($sql);
			$pdo_account = new PDO('mysql:host='.$web_host.':3310;dbname='.$db_name, $db_username, $pass);
			// echo $pdo_account->exec($sql);
			if ($pdo_account->exec($sql) === 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch (PDOException $e)
		{
			//print('Error ' . $e->getMessage());
			$pdo_account = NULL;
			return false;
		}

		$pdo_account = NULL;
		return false;
	}

		function addMsUserAndDB($version, $db, $db_user, $db_pass, $cap=""){
			$version="2016";
			$cap = ($cap*1024).'MB';
			// $dsn = constant("SQLSERVER_" . $version . "_DSN");
			// $user = constant("SQLSERVER_" . $version . "_USER");
			// $pass = constant("SQLSERVER_" . $version . "_PASS");
		// 	echo SQLSERVER_2016_DSN;
		// 	echo SQLSERVER_2016_USER;
		// 	echo SQLSERVER_2016_PASS;
		// die('no ok');
			try {
				
				$pdo = new PDO(SQLSERVER_2016_DSN, SQLSERVER_2016_USER, SQLSERVER_2016_PASS);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
				$db = trim($pdo->quote($db), "'\"");
	
				# データベースを作成
				$stmt = $pdo->prepare("CREATE DATABASE [$db];");
				$result = $stmt->execute();
				$stmt->closeCursor();
				if (!$result) { return false; }
				
				# データベースのファイルサイズを10GBに設定
				$stmt = $pdo->prepare("ALTER DATABASE [$db] MODIFY FILE ( NAME = N'$db', MAXSIZE = 10485760KB , FILEGROWTH = 1024KB );");
				$result = $stmt->execute();
				// $error_message = $stmt->errorInfo()[2];
				$stmt->closeCursor();
				if (!$result) {
					# トランザクションでロールバックできないため削除
					$stmt = $pdo->prepare("DROP DATABASE [$db];");
					$stmt->execute();
					return false;
				}
				
				# ユーザを作成
				$stmt = $pdo->prepare("CREATE LOGIN [$db_user] WITH PASSWORD=N'$db_pass', DEFAULT_DATABASE=[$db], CHECK_POLICY=ON, CHECK_EXPIRATION=OFF; DENY VIEW ANY DATABASE TO [$db_user]");
				$result = $stmt->execute();
				// $error_message = $stmt->errorInfo()[2];
				$stmt->closeCursor();
				if (!$result) {
					# トランザクションでロールバックできないため削除
					$stmt = $pdo->prepare("DROP DATABASE [$db];");
					$stmt->execute();
					return false;
				}
				
				# データベースの所有者を設定
				$stmt = $pdo->prepare("ALTER AUTHORIZATION ON DATABASE::[$db] TO [$db_user];");
				$result = $stmt->execute();
				// $error_message = $stmt->errorInfo()[2];
				$stmt->closeCursor();
				if (!$result) {
					# トランザクションでロールバックできないため削除
					$stmt = $pdo->prepare("DROP DATABASE [$db];");
					$stmt->execute();
					$stmt = $pdo->prepare("DROP LOGIN [$db_user];");
					$stmt->execute();
					return false;
				}
				$stmt = $pdo->prepare("ALTER DATABASE [$db] MODIFY FILE ( NAME = $db, MAXSIZE = $cap )");
				$result = $stmt->execute();
				$stmt->closeCursor();
				return true;
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				die("error");
				// require("views/allerror.php");
				if (!is_null($stmt)) { $stmt->closeCursor(); }
				$pdo = NULL;
				return false;
			}
			$pdo = NULL;
			return true;
		}
		function changeMssqlPassword($dbuser,$dbpass){
			$pdo = new PDO(SQLSERVER_2016_DSN, SQLSERVER_2016_USER, SQLSERVER_2016_PASS);
			$stmt = $pdo->prepare("ALTER LOGIN $dbuser WITH PASSWORD = '$dbpass';");
			if(!$stmt->execute())
			return false;
			

			try {
			  $conn = new PDO(DBDSN, DBROOT, DBROOT_PASS);
				  // set the PDO error mode to exception
				  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				  $sql = "UPDATE db_account_for_mssql SET db_pass='$dbpass' WHERE db_user='$dbuser'";

				  // Prepare statement
				  $stmt = $conn->prepare($sql);

				  // execute the query
				  if(!$stmt->execute())
				  {
				  	return false;
				  }
				} catch(PDOException $e) {
					$conn = null;
				  echo $sql . "<br>" . $e->getMessage();
				  return false;
				}

				$conn = null;
			return true;
	}
	function deleteMssqlDB($dbid,$dbuser,$db){
		// return $dbid.$dbuser.$db;
			// $dsn2 = 'mysql:host=localhost:3307';
			$mspdo = new PDO(SQLSERVER_2016_DSN, SQLSERVER_2016_USER, SQLSERVER_2016_PASS);
			$pdo_account = new PDO(DBDSN, DBROOT, DBROOT_PASS);
			$stmt1 = $mspdo->prepare("DROP DATABASE $db");
			if(!$stmt1->execute()) return false;
			
			$stmt = $mspdo->prepare("DROP LOGIN $dbuser");
			if(!$stmt->execute()) return false;
			
			// $dstmt = $pdo_account->prepare("DELETE FROM db_account_for_mssql WHERE id = ?");
			// // $ddata = $dstmt->fetchAll(PDO::FETCH_ASSOC);
			// if(!$dstmt->execute(array($dbid))) return false;
			return true;
	}

	function addMariaUserAndDB($db, $db_user, $db_pass){
			try {
				// $dsn2 = 'mysql:host=localhost:3307';
				// echo $db.$db_user.$db_pass;
				// die();
				$pdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
				$db = trim($pdo->quote($db), "'\"");
				$stmt = $pdo->prepare("CREATE DATABASE $db;");
				if(!$stmt->execute())
				{
					return false;
				}
				$stmt = $pdo->prepare("CREATE USER :db_user@'%' IDENTIFIED BY :db_pass;");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				$stmt->bindParam(":db_pass", $db_pass, PDO::PARAM_STR);
				if(!$stmt->execute())
				{
					$stmt = $pdo->prepare("DROP DATABASE $db;");
					$stmt->execute();
					return false;
				}
				$stmt = $pdo->prepare("GRANT ALL ON $db.* TO :db_user@'%';");
				$stmt->bindParam(":db_user", $db_user, PDO::PARAM_STR);
				if(!$stmt->execute())
				{
					return false;
				}
				return true;
			} catch (PDOException $e) {
				$conn = NULL;
				// die('error');
				return false;
			}
		}

		function changeMariaPassword($dbuser,$dbpass){
			// $dsn2 = 'mysql:host=localhost:3307';
			$mapdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
			$stmt = $mapdo->prepare("ALTER USER '$dbuser'@'%' IDENTIFIED BY '$dbpass';");
			// if(!$stmt->execute())
			// {
			// 	return false;
			// }
			$mapdo = NULL;

			try {
			  $conn = new PDO(DBDSN, DBROOT, DBROOT_PASS);
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

	function deleteMariaDB($dbid, $dbuser, $db)
	{
		if ( ! preg_match('/^[a-zA-Z0-9\-_]+$/u', $db))
		{
			return false;
		}

		// return $dbid.$dbuser.$db;
		// $dsn2 = 'mysql:host=localhost:3307';
		$mapdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
		$pdo_account = new PDO(DBDSN, DBROOT, DBROOT_PASS);
		$stmt = $mapdo->prepare("DROP USER :dbuser@'%'");
		if ( ! $stmt->execute(['dbuser' => $dbuser]))
		{
			return false;
		}

		$stmt1 = $mapdo->prepare("DROP DATABASE $db");
		if ( ! $stmt1->execute())
		{
			return false;
		}

		// $dstmt = $pdo_account->prepare('DELETE FROM db_account_for_mariadb WHERE id = ?');
		// // $ddata = $dstmt->fetchAll(PDO::FETCH_ASSOC);
		// if ( ! $dstmt->execute([$dbid]))
		// {
		// 	return false;
		// }

		return true;
	}

	function mail_server($domain, $email, $password, $action, $isexist)
	{
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
		if ($data->ok)
		{
			return 'ok';
		}

		return 'not ok';
	}

	function openURL($url)
	{
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

	function getSpec($query, $params = [])
	{
		// die($query);
		try{
			$pdo = new PDO(DBDSN, DBROOT, DBROOT_PASS);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$stmt1 = $pdo->prepare($query);
			$stmt1->execute($params);
			$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			// print_r($data);
			// die;
			return $data;
		} catch (PDOException $e) {
			die('error');
			$pdo = NULL;
			return false;
		}
		
	}
}
