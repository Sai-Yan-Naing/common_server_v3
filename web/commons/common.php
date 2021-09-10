<?php

function app_version($dir)
{
  $app_path="G:/application/";
  $dir=$app_path.$dir;
  $files = scandir($dir);

  foreach($files as $file){
     if(($file != '.') && ($file != '..')){
        if(is_dir($dir.'/'.$file)){
           $version[]  = $file;

        }
     }
  }
  return $version;
}

  function copy_paste($src, $dst) { 
      // open the source directory
      $dir = opendir($src); 
      // Make the destination directory if not exist
      if(!is_dir($dst)){
          //Directory does not exist, so lets create it.
          @mkdir($dst, 0755, true);
      }
      //@mkdir($dst); 
      // Loop through the files in source directory
      while( $file = readdir($dir) ) { 
          if (( $file != '.' ) && ( $file != '..' )) { 
              if ( is_dir($src . '/' . $file) ) { 
                  // Recursively calling custom copy function
                  // for sub directory 
                  copy_paste($src . '/' . $file, $dst . '/' . $file); 

              }else { 
                  copy($src . '/' . $file, $dst . '/' . $file); 
              } 
          } 
      } 
      closedir($dir);
  } 

  function folderSize($dir){
    $count_size = 0;
    $count = 0;
    $dir_array = scandir($dir);
      foreach($dir_array as $key=>$filename){
        if($filename!=".." && $filename!="."){
           if(is_dir($dir."/".$filename)){
              $new_foldersize = foldersize($dir."/".$filename);
              $count_size = $count_size+ $new_foldersize;
            }else if(is_file($dir."/".$filename)){
              $count_size = $count_size + filesize($dir."/".$filename);
              $count++;
            }
       }
     }
    return $count_size;
  }

function sizeFormat($bytes){ 
    $kb = 1024;
    $mb = $kb * 1024;
    $gb = $mb * 1024;
    $tb = $gb * 1024;

    if (($bytes >= 0) && ($bytes < $kb)) {
    return $bytes . ' B';

    } elseif (($bytes >= $kb) && ($bytes < $mb)) {
    return ceil($bytes / $kb) . ' KB';

    } elseif (($bytes >= $mb) && ($bytes < $gb)) {
    return ceil($bytes / $mb) . ' MB';

    } elseif (($bytes >= $gb) && ($bytes < $tb)) {
    return ceil($bytes / $gb) . ' GB';

    } elseif ($bytes >= $tb) {
    return ceil($bytes / $tb) . ' TB';
    } else {
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

    function addBassman($user,$bassmen_setting)
    {
        $bassmam_file = getFile($user."/bassman/Bassman.setting");
        if(file_exists($bassmam_file)) {
            unlink($bassmam_file);
        } 
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
        putFile($user."/bassman/Bassman.setting",$temp);

    }
    function getFile($file)
    {
        $file = file_get_contents(ROOT_PATH.$file);
        return $file;
    }
    function putFile($file,$value)
    {
        $file = file_put_contents(ROOT_PATH.$file,$value);
        return true;  
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

    function getPhpVersion()
    {
        return fileList(PHP_ROOT_PATH);
    }

    function domainChecker($domain)
    {
        if(gethostbyname($domain) != $domain)
        {
            return true;
        }
        return false;
    }



?>