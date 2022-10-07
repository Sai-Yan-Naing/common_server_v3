<?php
class CommonValidate
{
	public $pdo;
	public $mypdo;
	public $mapdo;
	public $mspdo;
	function __construct ()
	{
		// $this->pdo = new PDO(DSN, ROOT, ROOT_PASS);
		$this->pdo = new PDO(DBDSN, DBROOT, DBROOT_PASS);
		$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->mypdo = new PDO(MYDSN, MYROOT, MYROOT_PASS);
		$this->mapdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
		$this->mspdo = new PDO(SQLSERVER_2016_DSN, SQLSERVER_2016_USER, SQLSERVER_2016_PASS);
		$this->mspdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	function winUser ($checker,$web_host,$web_user,$web_password)
	{
		// return $web_host.$web_user.$web_password;
		$getshell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getuserlist.ps1" users '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($checker));
		// $getshell = shell_exec('wmic useraccount get name');
		$getshell = array_map('strtolower', preg_replace('/\s+/', '', explode("\n", explode('\n', $getshell)[0])));
		// $getshell = ['administrator','japansys','winserverroot','']
		if ( in_array (strtolower($checker), $getshell))
		{
			return true;
		}

		return false;
	}

	function checkInDb ($table, $column, $checker, $web_server_id=null)
	{
		// @todo この処理は暫定。正しく存在するテーブルかカラムかをチェックしなければならない。
		// if ( ! (ctype_alnum($table) && ctype_alnum($column))) column can contain underscore( _ )
		if ( ctype_alnum($table) )
		{
			return false;
		}
		$addition =null;
		if($web_server_id!=null)
		{
			$addition = "and web_account.web_server_id= $web_server_id";
		}

			$query = "SELECT $table.$column FROM $table INNER JOIN web_account on $table.domain = web_account.domain where $table.$column = :checker $addition";
		if($table =='web_account')
		{
			$query = "SELECT $table.$column FROM $table where $table.$column = :checker and web_account.web_server_id= $web_server_id  and removal IS NULL";
		}
		
		$stmt1 = $this->pdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if( count($data[$column]) > 0 )
		{
			return true;
		}

		return false;
	}

	function mysqlUser ( $checker )
	{
		$query = 'SELECT User FROM mysql.user where user = :checker';
		$stmt1 = $this->mypdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if ( count( $data['User'])>0 )
		{
			return true;
		}

		return false;
	}

	function mysqlDatabase ( $checker )
	{
		$query = 'SHOW DATABASES LIKE :checker';
		$stmt1 = $this->mypdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if( in_array ($checker, $data) )
		{
			return true;
		}

		return false;
	}

	function mariadbUser ( $checker )
	{
		$query = 'SELECT User FROM mysql.user where user = :checker';
		$stmt1 = $this->mapdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if ( count( $data['User'])>0 )
		{
			return true;
		}

		return false;
	}

	function mariadDatabase ($checker)
	{
		$query = 'SHOW DATABASES LIKE :checker';
		$stmt1 = $this->mapdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if ( in_array ( $checker, $data ) )
		{
			return true;
		}

		return false;
	}

	function mssqlUser ( $checker )
	{
		$query = "SELECT name from sys.server_principals sp where sp.type not in ('G', 'R') and name = :checker";
		$stmt1 = $this->mspdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if ( count( $data['name'] ) > 0)
		{
			return true;
		}

		return false;
	}

	function mssqlDatabase ( $checker )
	{
		$query = 'Select name from sysdatabases where name = :checker';
		$stmt1 = $this->mspdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if ( in_array( $checker, $data ) )
		{
			return true;
		}

		return false;
	}

	function domainChecker ( $domain )
	{
		if ( gethostbyname ( $domain ) !== $domain)
		{
			return true;
		}

		return false;
	}

	function errorFile($url)
	{
		// return 'hello';
		// return file_exists($url);
		if(!file_exists($url))
		{
			return true;
		}

		return false;
	}

	function checkappdb($db_dsn,$db_user,$db_pass)
	{
		try {
			  $conn = new PDO($db_dsn, $db_user, $db_pass);
			  // set the PDO error mode to exception
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  // echo "Connected successfully";
			  return false;
			} catch(PDOException $e) {
			  return true;
			}
	}

	function checkdblimit($qid,$webplnmariadbnum,$webplnmariadb)
	{
		$query = "SELECT mysql_cnt,mariadb_cnt,mssql_cnt FROM web_account where (origin_id = ? or id= ?)  and removal IS NULL";

		$stmt1 = $this->pdo->prepare($query);
		$stmt1->execute([$qid,$qid]);
		$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		$getalldbcount = $data;
		$totalmysql =0;
		$totalmssql =0;
		$totalmariasql =0;
		foreach($getalldbcount as $value){
		    $totalmysql +=$value['mysql_cnt'];
		    $totalmssql +=$value['mssql_cnt'];
		    $totalmariasql +=$value['mariadb_cnt'];
		}
		$totalmyma = (int)$totalmysql + (int)$totalmariasql;
		    $result = true;
		if( $webplnmariadb == 'yes' && ((int)$webplnmariadbnum > $totalmyma || $webplnmariadbnum=='unlimited')){
				$result = false;
		    }
		 return $result;
	}
}
