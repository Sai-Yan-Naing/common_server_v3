<?php

function app_version($dir)
{
	$app_path = 'G:/application/';
	$dir = $app_path.$dir;
	$files = scandir($dir);

	foreach($files as $file)
	{
		if (($file !== '.') && ($file !== '..'))
		{
			if (is_dir($dir.'/'.$file))
			{
				$version[] = $file;
			}
		}
	}
	
	return $version;
}

function copy_paste($src, $dst)
{
	// open the source directory
	$dir = opendir($src);
	// Make the destination directory if not exist
	if ( ! is_dir($dst))
	{
		//Directory does not exist, so lets create it.
		@mkdir($dst, 0755, true);
	}

	//@mkdir($dst); 
	// Loop through the files in source directory
	while ($file = readdir($dir))
	{
		if (( $file !== '.' ) && ( $file !== '..' ))
		{
			if (is_dir($src . '/' . $file))
			{
				// Recursively calling custom copy function
				// for sub directory 
				copy_paste($src . '/' . $file, $dst . '/' . $file);
			}
			else
			{
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}

	closedir($dir);
}
function sharebackup($web_host,$web_user,$web_password,$src,$user,$date,$action)
{
    $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/backup.ps1" '.$action.' '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($src).' '.$user.' '.$date);
        return $shell;
}

// function folderSize($dir)
// {
// 	$count_size = 0;
// 	$count = 0;
// 	$dir_array = scandir($dir);
// 	foreach ($dir_array as $key => $filename)
// 	{
// 		if ($filename !== '..' && $filename !== '.')
// 		{
// 			if (is_dir($dir.'/'.$filename))
// 			{
// 				$new_folder_size = folderSize($dir.'/'.$filename);
// 				$count_size = $count_size + $new_folder_size;
// 			}
// 			elseif (is_file($dir.'/'.$filename))
// 			{
// 				$count_size = $count_size + filesize($dir.'/'.$filename);
// 				$count++;
// 			}
// 		}
// 	}

// 	return $count_size;
// }

function sizeFormat($bytes)
{
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;

	if (($bytes >= 0) && ($bytes < $kb))
	{
		return $bytes . ' B';
	}
	elseif (($bytes >= $kb) && ($bytes < $mb))
	{
		return ceil($bytes / $kb) . ' KB';
	}
	elseif (($bytes >= $mb) && ($bytes < $gb))
	{
		return ceil($bytes / $mb) . ' MB';
	}
	elseif (($bytes >= $gb) && ($bytes < $tb))
	{
		return ceil($bytes / $gb) . ' GB';
	}
	elseif ($bytes >= $tb)
	{
		return ceil($bytes / $tb) . ' TB';
	}
	else
	{
		return $bytes . ' B';
	}
}

/*Show Backup Folder*/
    function showFolder($dir){
        // Open a directory, and read its contents
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                if(($file != '.') && ($file != '..')){
                    return  $file ;
                }
            }
            closedir($dh);
            }
        } 
    } 

    function folderSize($web_host,$web_user,$web_password,$dir='')
    {
        // return 'dd';
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getdirsize.ps1" size '.$web_host.' '.$web_user.' '.$web_password.' '.ROOT_PATH.$dir);
        return $shell;
    }

    /*Delete Folder*/
    function deleteBackup($dir){  
        // Assigning files inside the directory
        $dir = new RecursiveDirectoryIterator(
            $dir, FilesystemIterator::SKIP_DOTS);
        // Reducing file search to given root
        // directory only
        $dir = new RecursiveIteratorIterator(
            $dir,RecursiveIteratorIterator::CHILD_FIRST);
        // Removing directories and files inside
        // the specified folder
        foreach ( $dir as $file ) { 
            $file->isDir() ?  rmdir($file) : unlink($file);
        }
        
    }   

    // get file extension
    function getFileExt($dir)
      {
        $ext = pathinfo($dir, PATHINFO_EXTENSION);

        // Returns html
        // echo $ext;
        return $ext;
      }

      function IpAndDomainRestriction($user)
      {
        // return $user;
        $shell=Shell_Exec(escapeshellcmd("powershell Get-WebConfiguration -Location $user -filter /system.webServer/security/ipSecurity |select -expand collection | select -expand attributes  | select Name, Value"));
            $shell = explode("\n",$shell);
            $shell = array_filter($shell);
            $shell = array_values($shell);
            $shell = array_diff_key($shell,[0,1]);
            $shell = array_diff($shell,['domainName                ']);
            // $shell = unset($shell[1]);
            $shell = array_values($shell);
            $temp=[];
            $count = 0;
            $tmp = [];
            for($i=0; $i<count($shell); $i++)
            {
                // echo "hello";
                if(strpos(strtolower(preg_replace("/\s+/", "", $shell[$i])), 'ipaddress') !== false)
                {
                    $tmp[$i]= str_replace("ipaddress","",strtolower(preg_replace("/\s+/", "", $shell[$i])));
                }else if(strpos(strtolower(preg_replace("/\s+/", "", $shell[$i])), 'subnetmask') !== false)
                {
                    $tmp[$i]= str_replace("subnetmask","",strtolower(preg_replace("/\s+/", "", $shell[$i])));
                }else{
                    $tmp[$i]= str_replace("allowed","",strtolower(preg_replace("/\s+/", "", $shell[$i])));
                }
                if(count($tmp)==3)
                {
                    $temp[]=array_values($tmp);
                    $tmp=[];
                }
            }
            return $temp;
      }

      function isExistBlackListIp($site,$ip)
      {
        $site.$ip;
        $shell=Shell_Exec(escapeshellcmd("powershell Get-WebConfiguration -Location $site -filter /system.webServer/security/ipSecurity |select -expand collection | select -expand attributes  | select Name, Value"));
        $shell = preg_replace("/\s+/", "", $shell);
        if (strpos($shell, $ip) !== false) {
            return true;
        }
        return false;
      }

      function createDir($dir)
      {
            $path = "E:\webroot\LocalUser/$dir";
            if(!is_dir($path)){
              //Directory does not exist, so lets create it.
              @mkdir($path, 0755, true);
              return true;
          }
          return false;
      }

      function newDir($web_host,$web_user,$web_password,$dir)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" newdir '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir));
        return $shell;
      }

      function newFile($web_host,$web_user,$web_password,$dir)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" newfile '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir));
        return $shell;
      }

      function deleteDir($web_host,$web_user,$web_password,$dir)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" deletedir '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir));
        return $shell;
      }

      function renameDir($web_host,$web_user,$web_password,$newdir,$olddir)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" renamedir '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($newdir).' '.escapeshellarg($olddir));
        return $shell;
      }

      function comFile($web_host,$web_user,$web_password,$dir,$fname)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" zip '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir).' '.escapeshellarg($fname));
        return $shell;
      }

      function uncomFile($web_host,$web_user,$web_password,$dir,$fname)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" unzip '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir).' '.escapeshellarg($fname));
        return $shell;
      }
       function copyFile($web_host,$web_user,$web_password,$dir1,$dir2)
      {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" copy '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir1).' '.escapeshellarg($dir2));
        return $shell;
      }

      function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file))
                             unlink($dirname."/".$file);
                        else
                             delete_directory($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             rmdir($dirname);
             return true;
        }

    function siteBinding($sitename,$do,$ip='*',$domain)
    {
        // die($sitename.$do.$ip.$domain);
        shell_exec("%systemroot%\system32\inetsrv\appcmd.exe set site /site.name:$sitename /".$do."bindings.[protocol='http',bindingInformation='".$ip.":80:".$domain."']");
    }

    function checkSiteBinding($checker,$site)
    {
        $all = shell_exec("%systemroot%\system32\inetsrv\appcmd.exe list site /site.name:$site");
        $all = explode('bindings:',$all);
        $all = explode(",",$all[1]);
        // echo "<pre>";
        // print_r($all);
        if(!in_array($checker,$all))
        {
            // die('noexit');
            return false;
        }
        // die('exit');
        return true;
    }

    function addBassman($web_host,$web_user,$web_password,$user,$bassmen_setting)
    {
        $bassmam_file = get_File($web_host,$web_user,$web_password,$user."/bassman/Bassman.setting");
        // if(file_exists($bassmam_file)) {
        //     unlink($bassmam_file);
        // } 
        $temp = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $temp .= '<bassman reloadkey="">'."\n";
        foreach(json_decode($bassmen_setting) as $bass_key => $bass_value)
        {
            $temp.="\t".'<area url="/'.$bass_value->url.'/.*" name="'.ucfirst($bass_value->url).'AREA">'."\n";
            foreach($bass_value->user as $user_key => $user_value)
            {
                $temp.="\t\t".'<user name="'.$user_value->bass_user.'" passwd="'.$user_value->bass_pass.'" />'."\n";
            }
            $temp.="\t</area>\n";
        }
        $temp .= '</bassman>'."\n";
        // putFile($user."/bassman/Bassman.setting",$temp);
        put_File($web_host,$web_user,$web_password,$user."/bassman/Bassman.setting",$temp);

    }
    function getFile($file)
    {
        $file = file_get_contents(ROOT_PATH.$file);
        return $file;
    }

    function get_File($web_host,$web_user,$web_password,$dir='')
    {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getdirlist.ps1" openfile '.$web_host.' '.$web_user.' '.$web_password.' '.$dir);
        return $shell;
    }
    function putFile($file,$value)
    {
        $file = file_put_contents(ROOT_PATH.$file,$value);
        return true;  
    }

    function put_File($web_host,$web_user,$web_password,$dir='',$value='')
    {
        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getdirlist.ps1" putfile '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir).' '.escapeshellarg(escapecmd($value)));
        return $shell;
    }
    
    // file list
    function fileList($dir)
    {
        $directories = array();
        $files = scandir($dir);
        foreach($files as $file){
            if(($file != '.') && ($file != '..')){
                if(is_dir($dir.'/'.$file)){
                    $directories[]  = $file;

                }
            }
        }
        return $directories;
    }

    function get_dirlist($web_host,$web_user,$web_password,$dir='')
    {
        // return fileList(PHP_ROOT_PATH);


        $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getdirlist.ps1" dirlist '.$web_host.' '.$web_user.' '.$web_password.' '.$dir);
        $shell = array_filter(preg_split ('/\n/', $shell));
        $shell = array_filter($shell, function($value) {
                   return strpos($value, 'PSComputerName') === false;
                });
        $shell = array_filter($shell, function($value) {
                   return strpos($value, 'RunspaceId ') === false;
                });
        // return $shell;
        $temp=array();
        $index = 0;
        foreach ($shell as $key => $value) {
            if(strpos($value, 'Name           :') !== false)
            {
                $temp[$index] = str_replace("Name           : ","",$value);
            }elseif (strpos($value, 'LastWriteTime  : ') !== false)
            {
                $temp[$index] = str_replace("LastWriteTime  : ","",$value);
            }elseif (strpos($value, 'Mode           : ') !== false)
            {
                $temp[$index] = str_replace('-','',str_replace("Mode           : ","",$value));
            }elseif (strpos($value, 'Length         : ') !== false)
            {
                $temp[$index] = str_replace("Length         : ","",$value);
            }else{
                $temp[$index] = str_replace('.','',str_replace("Extension      : ","",$value));
            }
            $index ++;
        }
        // $shell = implode("`,`",$shell);
        $index=1;
        $count=0;
        $temp1=array();
        // return $temp;
        // return count($temp);
        for ($i =0; $i<= count($temp)-1;$i++) {
            if($index<=5){
                
                if($index==1 && $count==0)
                {
                    $temp1[$count]['name']=$temp[$i];
                }elseif ($index==2) {
                    $temp1[$count]['lasttime']=$temp[$i];
                }elseif ($index==3) {
                    $temp1[$count]['mode']=$temp[$i];
                }elseif ($index==4) {
                    $temp1[$count]['length']=$temp[$i];
                }else{
                    $temp1[$count]['extension']=$temp[$i];
                }
                $index ++;
            }else{
                $count ++;
                $index =2;
                $temp1[$count]['name']=$temp[$i];
            }
        }
        return $temp1;
    }

    function getPhpVersion($web_host,$web_user,$web_password,$dir='C:\Program Files\PHP')
    {
        // return fileList(PHP_ROOT_PATH);

        // return system('pwsh -File Get-ChildItem -Name C:\Program Files\PHP');

         $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/getdirlist.ps1" phpversion '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir));
        return $shell = array_filter(preg_split ('/\n/', $shell));
    }

    function getDirlist($web_host,$web_user,$web_password,$dir='')
    {
        // return 'hello';

        // return system('pwsh -File Get-ChildItem -Name C:\Program Files\PHP');

         $shell = shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/dir_file.ps1" dirlist '.$web_host.' '.$web_user.' '.$web_password.' '.escapeshellarg($dir));
        return $shell = array_filter(preg_split ('/\n/', $shell));
    }

    function domainChecker($domain)
    {
        if(gethostbyname($domain) != $domain)
        {
            return true;
        }
        return false;
    }

function createFile($file)
{
	// $file="E:\webroot\LocalUser/test1.php";
	$myfile = fopen("$file", "w") or die("Unable to open file!");
	fclose($myfile);
	// return "created new File";
}
function uploadFile($web_host,$web_user,$web_password,$dir,$file)
{
    // return 'ok';
	$ftp = $web_host;
        $username = $web_user;
        $pwd = $web_password;
        $filename = $file['name'];
        $tmp = $file['tmp_name'];
       
        $connect = ftp_connect($ftp)or die("Unable to connect to host");
        ftp_login($connect,$username,$pwd)or die("Authorization Failed");
        // echo "Connected!<br/>";
        ftp_pasv($connect, true);

       
        if(!$filename)
            {
                // echo"Please select a file";
            }
        else
            {
                ftp_put($connect,$dir.'/'.$filename,$tmp,FTP_ASCII)or die("Unable to upload");
                        // echo"File successfully uploaded to FTP";
            }
}

function download($web_host,$web_user,$web_password,$dir,$dfile)
{
        $ftp = $web_host;
        $username = $web_user;
        $pwd = $web_password;
        $filename = $dfile;
        $file = "E:\webroot\LocalUser\\temp\\$filename";
       
        $connect = ftp_connect($ftp)or die("Unable to connect to host");
        ftp_login($connect,$username,$pwd)or die("Authorization Failed");
        "Connected!<br/>";
        ftp_pasv($connect, true);
        ftp_get($connect, $file, $dir.'/'.$dfile, FTP_ASCII);

        $file = "E:\webroot\LocalUser\\temp\\$filename";

        // echo $filename=$filename;
    
    echo $len = filesize($file); // Calculate File Size
    ob_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    header("Content-Type:application/pdf"); // Send type of file
    $header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len); // Send File Size
    @readfile($file);
    exit;
}

function flash($name, $text = '' )
{
    if (isset($_SESSION[$name]))
    {
        $msg = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $msg;
    }else{
        $_SESSION[$name] = $text;
    }
    return '';
}

function escapecmd($value)
{
    // $value ='"hello"';
    $value = str_replace('"', "`dbq;", $value);
    $value = preg_replace('/\n/', "`n", $value);
    $value = str_replace(" ", "`sp;", $value);
    $value = str_replace("!", "`ex;", $value);
    return $value;
}
