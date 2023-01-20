<?php
// die();
require_once("views/admin/admin_shareconfig.php");
$app_name = $_POST["app"];
$action = $_POST["action"];
$app_version = $_POST["app-version"];
$url = $_POST["url"];
$site_name = $_POST["site_name"];
$user_name = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$db_name = $_POST["db_name"];
// $db_user = 'ec313_dbuser';
$db_user = $_POST["db_user"];
$db_pass = $_POST["db_pass"];
if(isset($_POST["update"])){
    $update = $_POST['update'];
}
$webappversion = json_decode($webappversion);
$root_url = explode("/", $url);
unset($root_url[0]);
unset($root_url[1]);
unset($root_url[2]);
if ($root_url[3] !='') {
    $root_url = implode("/",$root_url).'/';
}else{
    $root_url ='';
}
if ($root_url==null) {
    $url = explode("/", $url);
    unset($url[3]);
    $url = implode("/",$url);
    $src = APP_PATH."$app_name/$app_version/*";
    $dst = ROOT_PATH.$webpath.'/web/';
}else{
    $src = APP_PATH."$app_name/$app_version";
    $dst = ROOT_PATH.$webpath.'/web/'.$root_url;
}
$msg = "jp message";
$msgsession ="msg";
if ( $action=='new'){
    if($app_name ==="WordPress")
    {
        if($_POST['dbexist']=='new')
        {
            // die('exist');
            if ( ! $commons->addMyUserAndDB($db_name, $db_user, $db_pass))
            {
                $error = "Something error";
                require_once("views/admin/share/server/site/app_install/index.php");
                die("");
            }

            $insert_q = "INSERT INTO db_account (domain, db_name, db_user, db_count, db_pass) VALUES (?, ?, ?, ?, ?)";

            if ( ! $commons->doThis($insert_q,[$webdomain, $db_name, $db_user, 1, $db_pass]))
            {
                $error = "cannot add db account";
                    require_once("views/admin/share/server/site/app_install/index.php");
                    die("");
            }
            $webmysql_cnt +=1;
            $sql = "UPDATE web_account SET mysql_cnt='$webmysql_cnt' WHERE domain='$webdomain'";
            if( ! $commons->doThis($sql)) {
                $error = "cannot add db account";
                    die("");
                }
        }
        $dbquery = "SELECT id FROM db_account WHERE db_name=? and db_user=? and domain=?";
        $getdbid = $commons->getRow($dbquery,[$db_name, $db_user, $webdomain]);
        $insert_app = "INSERT INTO app (domain, site_name, app_name, app_version, root, url,user_name, password, db_name, db_user, db_pass, db_id, remove) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?)";
        if ( ! $commons->doThis($insert_app,[$webdomain, $site_name, $app_name, $app_version, $root_url, $url,$user_name, $password, $db_name, $db_user, $db_pass, $getdbid['id'], 0]))
            {
                $error = "cannot add db account";
                    require_once("views/admin/share/server/site/app_install/index.php");
                    die("");
            }
        // die('new');
        
        // die;
        // die;
        // copy(APP_CONFIG_PATH.'wordpress/wp-config.php', $dst.'/wp-config.php');
        $path_to_file = 'E:/app_config/wordpress/wp-config.php';
        $file_contents = file_get_contents($path_to_file);
        $file_contents = str_replace("db_host",'localhost:3310',$file_contents);
        $file_contents = str_replace("wp_dbname",$db_name,$file_contents);
        $file_contents = str_replace("wp_username",$db_user,$file_contents);
        $file_contents = str_replace("wp_password",$db_pass,$file_contents);
        // file_put_contents($path_to_file,$file_contents);
        // die;
        // for sql
        // copy(APP_CONFIG_PATH.'wordpress/replace_wp_db.sql', $dst.'/replace_wp_db.sql');
        $sql_file = 'E:/app_config/wordpress/replace_wp_db.sql';
        $sql_contents = file_get_contents($sql_file);
        $sql_contents = str_replace("replace_wp_dbname",$db_name,$sql_contents);
        $sql_contents = str_replace("replace_wp_site_title",$site_name,$sql_contents);
        $sql_contents = str_replace("replace_wp_username",$user_name,$sql_contents);
        $sql_contents = str_replace("replace_wp_password",md5($password),$sql_contents);
        $sql_contents = str_replace("replace_wp_email@gmail.com",$email,$sql_contents);
        $sql_contents = str_replace("replace_wp_url",$url,$sql_contents);
        // file_put_contents($sql_file,$sql_contents);
        // put_File($web_host,$web_user,$web_password,$dst.'/replace_wp_db.sql',$file_contents);
        // die();
        // $import = file_get_contents($sql_file);
    // die('ok');
        if ( ! $commons->importWP($web_host,$sql_contents,$db_name,$db_user,$db_pass))
        {
            $msg = "import fail";
        } else{

            copyFile($web_host,$web_user,$web_password,$src, $dst); 
            put_File($web_host,$web_user,$web_password,$dst.'/wp-config.php',$file_contents);
            $msg = "インストールが完了しました";
        }
        // die('ok');
    }else{
        // echo 'hello';
        if($_POST['dbexist']=='new')
        {
            if ( ! $commons->addMyUserAndDB($db_name, $db_user, $db_pass))
            {
                $error = "Something error";
                require_once("views/admin/share/server/site/app_install/index.php");
                die("");
            }
            $insert_q = "INSERT INTO db_account (domain, db_name, db_user, db_count, db_pass) VALUES (?, ?, ?, ?, ?)";
            if ( ! $commons->doThis($insert_q,[$webdomain, $db_name, $db_user, 1, $db_pass]))
            {
                $error = "cannot add db account";
                    require_once("views/admin/share/server/site/app_install/index.php");
                    die("");
            }

            $webmysql_cnt +=1;
            $sql = "UPDATE web_account SET mysql_cnt='$webmysql_cnt' WHERE domain='$webdomain'";
            if( ! $commons->doThis($sql)) {
                $error = "cannot add db account";
                    die("");
                }
        }
        $dbquery = "SELECT id FROM db_account WHERE db_name=? and db_user=? and domain=?";
        $getdbid = $commons->getRow($dbquery,[$db_name, $db_user, $webdomain]);
        $insert_app = "INSERT INTO app (domain, site_name, app_name, app_version, root, url,user_name, password, db_name, db_user, db_pass, db_id,remove) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?)";

        
        if ( ! $commons->doThis($insert_app,[$webdomain, $site_name, $app_name, $app_version, $root_url, $url,$user_name, $password, $db_name, $db_user, $db_pass, $getdbid['id'],0]))
        {
            $error = "cannot add db account";
                require_once("views/admin/share/server/site/app_install/index.php");
                die("");
        }
        
        // $src = APP_PATH."$app_name/$app_version/*";
        // $dst = ROOT_PATH.$webpath.'/web/'.$root_url;
        copyFile($web_host,$web_user,$web_password,$src, $dst);
        // die();
        if ($app_version=="eccube3")
        {
            // $clone = 'git clone https://github.com/Sai-Yan-Naing/eccube3.git '.$dst;
            // shell_exec($clone);
            // copy_paste($src, $dst);
            // echo $dst;
            $ECCUBE_AUTH_MAGIC = 'u5pCrNa6eNpJU8lDKX7WvyeO8P0out2Y';
            $salt = 'HRBidly19qChoa6H2LIKr6CElktVjNLo';
            $user_pass= hash_hmac('sha256',$password.':'.$ECCUBE_AUTH_MAGIC,$salt);
            $path_to_file = 'E:\app_config\configec3\eccube/config.yml';
            $file_contents = file_get_contents($path_to_file);
            $file_contents = str_replace("ec_strv_name",$site_name,$file_contents);
            // file_put_contents($path_to_file,$file_contents);
            put_File($web_host,$web_user,$web_password,$dst.'/app/config/eccube/config.yml',$file_contents);
            $path_to_file = 'E:\app_config\configec3\eccube/database.yml';
            $file_contents = file_get_contents($path_to_file);
            $file_contents = str_replace("ec_strv_dbname",$db_name,$file_contents);
            $file_contents = str_replace("ec_strv_dbuser",$db_user,$file_contents);
            $file_contents = str_replace("ec_strv_dbpass",$db_pass,$file_contents);
            // file_put_contents($path_to_file,$file_contents);
            put_File($web_host,$web_user,$web_password,$dst.'/app/config/eccube/database.yml',$file_contents);
            
            $path_to_file = 'E:\app_config\configec3\eccube/path.yml';
            $file_contents = file_get_contents($path_to_file);
            //$file_contents = str_replace("ec_strv_dir",$root_url,$file_contents);
            $file_contents = str_replace("ec_strv_rootpath",$dst ,$file_contents);
            $file_contents = str_replace("dir_path",$root_url ,$file_contents);
            // file_put_contents($path_to_file,$file_contents);
            put_File($web_host,$web_user,$web_password,$dst.'/app/config/eccube/path.yml',$file_contents);
            
            $sql_file = 'E:\app_config\configec3\eccube/config.sql';
            // print_r($sql_file);
            $file_contents = file_get_contents($sql_file);
            $file_contents = str_replace("ec_strv_db",$db_name,$file_contents);
            $file_contents = str_replace("ec_strv_email@gmail.com",$email,$file_contents);
            $file_contents = str_replace("ec_strv_name",$site_name,$file_contents);
            $file_contents = str_replace("ec_strv_id",$user_name,$file_contents);
            $import = str_replace("ec_strv_pass",$user_pass,$file_contents);
            if(isset($update) and $update=='update'){
                $version = 'v5.6.37';
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/php_version/phpversion.ps1" change '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser.' '.$version);
                // die;

                $webappversion->app->php=$version;
                $temp=$webappversion;
                $result=json_encode($temp);
                // print_r($result);
                $query_dir = "UPDATE web_account SET app_version='$result' WHERE id='$webid'";
                $commons->doThis($query_dir);
            }
            // file_put_contents($sql_file,$file_contents);
            // put_File($web_host,$web_user,$web_password,$dst.'/app/config/eccube/config.sql',$file_contents);
            // die('ok');
        }else{
            // echo $dst;
            // $clone = 'git clone https://github.com/Sai-Yan-Naing/eccube4.1.git '.$dst;
            // shell_exec($clone);
            $env = 'E:\app_config\config4/.env';
            $ECCUBE_AUTH_MAGIC = 'Mt7yAMxp69mUX3XHKkn1IXPjWMR8XUjn';
            $salt = 'CDJnBUsIOymOfp7pZqPGgJ8waBHkvkmN';
            $user_pass= hash_hmac('sha256',$password.':'.$ECCUBE_AUTH_MAGIC,$salt);

            $file_contents = file_get_contents($env);
            $file_contents = str_replace("e4replace_dbuser",$db_user,$file_contents);
            $file_contents = str_replace("e4replace_dbpass",$db_pass,$file_contents);
            $file_contents = str_replace("e4replace_dbname",$db_name,$file_contents);
            //$file_contents = str_replace("e4replace_dir",$root_url,$file_contents);
            // file_put_contents($env,$file_contents);
            put_File($web_host,$web_user,$web_password,$dst.'/.env',$file_contents);

            $sql_file = 'E:\app_config\config4/config.sql';
            $file_contents = file_get_contents($sql_file);
            $file_contents = str_replace("e4replace_dbname",$db_name,$file_contents);
            $file_contents = str_replace("e4replace_email@gmail.com",$email,$file_contents);
            $file_contents = str_replace("e4replace_sitename",$site_name,$file_contents);
            $file_contents = str_replace("e4replace_id",$user_name,$file_contents);
            $import = str_replace("e4replace_pass",$user_pass,$file_contents);
            // file_put_contents($sql_file,$file_contents);
            // put_File($web_host,$web_user,$web_password,$dst.'/config.sql',$file_contents);
            // die();
            if(isset($update) and $update=='update'){
                $version = 'v7.4.13';
                shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/php_version/phpversion.ps1" change '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser.' '.$version);
                // die;

                $webappversion->app->php=$version;
                $temp=$webappversion;
                $result=json_encode($temp);
                // print_r($result);
                $query_dir = "UPDATE web_account SET app_version='$result' WHERE id='$webid'";
                $commons->doThis($query_dir);
            }
        }
        
        // $import = file_get_contents($sql_file);
        // if ( ! $commons->importWP($import,$db_name,$db_user,$db_pass))
        if ( ! $commons->importWP($web_host,$import,$db_name,$db_user,$db_pass))
        {
            $msg = "import fail";
        }  else{
            $msg = "インストールが完了しました";

        }
    }
}elseif ($action=='delete') {
    $act_id=$_POST['act_id'];
    $site_name=$_POST['site_name'];
    $delete_q = "UPDATE app SET remove=1 WHERE id='$act_id'";
    $dbquery = "SELECT * FROM app WHERE id='$act_id'";
    $getdb = $commons->getRow($dbquery);
    $dbid = $getdb['db_id'];
    $db_user = $getdb['db_user'];
    $db_name = $getdb['db_name'];
    $delete_db = "DELETE FROM db_account WHERE id='$dbid'";
    $dbcount = "SELECT count(id) FROM db_account WHERE id='$dbid'";
    $getdb1 = $commons->getCount($dbcount);
    if($getdb1==1)
    {

        if(!$commons->deleteMysqlDB($dbid,$db_user,$db_name))
        {
            
            echo $error="Cannot delete app";
            die();
        }
        if ( !$commons->doThis($delete_db))
        {
            echo $error="Cannot delete app";
            die();
        }
    }
    if ( !$commons->doThis($delete_q))
    {
        echo $error="Cannot delete app";
        die();
    }

    if ( $webmysql_cnt<=0)
    {
        $webmysql_cnt=0;
    }else{
        $webmysql_cnt -=1;
    }
    $sql = "UPDATE web_account SET mysql_cnt='$webmysql_cnt' WHERE domain='$webdomain'";
    if( ! $commons->doThis($sql)) {
        $error = "cannot update db account";
        die;
    }
    
    $msg = "「".$site_name."」 を削除しました";
    $msgsession ="msg";
}
// die('no');
flash($msgsession,$msg);
header("location: /admin/share/server?setting=site&tab=app_install&act=index&webid=$webid");