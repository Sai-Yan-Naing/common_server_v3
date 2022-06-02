<?php

/**
 * 
 */
class ftpclient 
{
	public $con;
	public $host;
	public $user;
	public $pass;
	function __construct($host,$username,$pass)
	{
		$this->host = $host;
		$this->user = $username;
		$this->pass = $pass;
		$this->con = ftp_connect($this->host, 21) or die("Could not connect to $this->host");
		if($this->con) {
			$login = ftp_login($this->con, $this->user, $this->pass);
			ftp_pasv($this->con, true) or die("Passive mode failed");
			if($login){
				//echo "<br>logged in successfully!";
				}else {
					echo "<br>login failed!";
				}
			}
	}

	public function rawDirList($dir ='')
	{
		//echo $this->con->isDir($dir);
		$filelist = ftp_rawlist($this->con, $dir);

		foreach ($filelist as $line)
		{
		    $tokens = explode(" ", $line);
		    $name = $tokens[count($tokens) - 1];
		    $type = $tokens[0][0];

		    if ($type == 'd')
		    {
		        echo "$name\n";
		    }
		}
		$contents = ftp_mlsd($this->con, $dir);

		// output $contents
		var_dump($contents);
		//print_r(array_values(array_filter($filelist)));
		// die();
	}

	public function ftpclose()
	{
		if(ftp_close($this->con)) {
					echo "<br>Connection closed Successfully!";
				}
	}
}