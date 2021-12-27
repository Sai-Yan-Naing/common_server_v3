<?php
class CommonValidate
{
	public $pdo;
	public $mdpdo;
	public $mspdo;
	function __construct ()
	{
		$this->pdo = new PDO(DSN, ROOT, ROOT_PASS);
		$this->mdpdo = new PDO(MADSN, MAROOT, MAROOT_PASS);
		$this->mspdo = new PDO(SQLSERVER_2016_DSN, SQLSERVER_2016_USER, SQLSERVER_2016_PASS);
		$this->mspdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	function winUser ($checker)
	{
		$getshell = shell_exec('wmic useraccount get name');
		// $result = array_map('strtolower',$myArray);
		$getshell = array_map('strtolower', preg_replace('/\s+/', '', explode("\n", explode('\n', $getshell)[0])));
		if ( in_array (strtolower($checker), $getshell))
		{
			return true;
		}

		return false;
	}

	function checkInDb ($table, $column, $checker)
	{
		// @todo この処理は暫定。正しく存在するテーブルかカラムかをチェックしなければならない。
		// if ( ! (ctype_alnum($table) && ctype_alnum($column))) column can contain underscore( _ )
		if ( ctype_alnum($table) )
		{
			return false;
		}

		$query = "SELECT `$column` FROM `$table` WHERE `$column` = :checker";
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
		$stmt1 = $this->pdo->prepare($query);
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
		$stmt1 = $this->pdo->prepare($query);
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
		$query = 'SELECT User FROM mysql.user where user=:checker';
		$stmt1 = $this->mdpdo->prepare($query);
		$stmt1->execute(['checker' => $checker]);
		$data = $stmt1->fetch(PDO::FETCH_ASSOC);
		// return $data;
		if( count ( $data['User'] ) > 0)
		{
			return true;
		}

		return false;
	}

	function mariadDatabase ($checker)
	{
		$query = 'SHOW DATABASES LIKE :checker';
		$stmt1 = $this->mdpdo->prepare($query);
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
}
