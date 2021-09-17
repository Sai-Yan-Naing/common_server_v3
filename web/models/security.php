<?php
	/**
	 * 
	 */
	class Security
	{
		public $pdo;
		function __construct()
		{
			$this->pdo = new PDO(DSN, ROOT, ROOT_PASS);
		}
		function getSecurity($domain)
		{
			$stmt = $this->pdo->prepare('SELECT * FROM `waf` WHERE `domain`=?');
			$stmt->execute(array($domain));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		function wafUsage($domain, $status)
		{
			try{
				$stmt = $this->pdo->prepare('UPDATE waf SET `usage` =? where `domain`=?');
				if(!$stmt->execute(array($status,$domain)))
				{
					return false;
				}
				return true;

			}catch(PDOException $e){
				// die('fail');
				return false;
			}
		}

		function wafDisplay($domain, $status)
		{
			$stmt = $this->pdo->prepare('UPDATE waf SET `display` =? where `domain`=?');
			if(!$stmt->execute(array($status,$domain)))
			{
				return false;
			}
			return true;
		}
	}
?>