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
				// die('exe');
				echo $sql . "<br>" . $e->getMessage();
			}
			
		}
	}

?>