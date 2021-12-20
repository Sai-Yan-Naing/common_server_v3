<?php
require_once("views/admin/admin_shareconfig.php");
$app_name = $_POST["app"];
$app_version = $_POST["app-version"];
$url = $_POST["url"];
$site_name = $_POST["site_name"];
$user_name = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$db_name = $_POST["db_name"];
$db_user = $_POST["db_user"];
$db_pass = $_POST["db_pass"];

$root_url = explode("/", $url);
unset($root_url[0]);
unset($root_url[1]);
unset($root_url[2]);
$root_url = implode("/",$root_url);
$msg = "jp message";
$msgsession ="msg";
if($app_name ==="WORDPRESS")
{
    if ( ! $commons->addMyUserAndDB($db_name, $db_user, $db_pass))
    {
        $error = "Something error";
        require_once("views/admin/share/server/site/app_install/index.php");
        die("");
    }
    $insert_q = "INSERT INTO db_account (`domain`, `db_name`, `db_user`, `db_count`, `db_pass`) VALUES (?, ?, ?, ?, ?)";

    $insert_app = "INSERT INTO app (`domain`, `site_name`, `app_name`, `app_version`, `root`, `url`,`user_name`, `password`, `db_name`, `db_user`, `db_pass`) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?)";

    if ( ! $commons->doThis($insert_q,[$webdomain, $db_name, $db_user, 1, $db_pass]))
    {
        $error = "cannot add db account";
            require_once("views/admin/share/server/site/app_install/index.php");
            die("");
    }

    if ( ! $commons->doThis($insert_app,[$webdomain, $site_name, $app_name, $app_version, $root_url, $url,$user_name, $password, $db_name, $db_user, $db_pass]))
    {
        $error = "cannot add db account";
            require_once("views/admin/share/server/site/app_install/index.php");
            die("");
    }
    $src = APP_PATH."$app_name/$app_version";
    if ( $weborigin!==1)
    {  
        $dst = ROOT_PATH.$webrootuser.'/'.$webuser.'/web/'.$root_url;
    } else
    {
        $dst = ROOT_PATH.$webuser.'/web/'.$root_url;
    }
    copy_paste($src, $dst);
    copy(APP_CONFIG_PATH.'wordpress/wp-config.php', $dst.'/wp-config.php');
    $path_to_file = $dst.'/wp-config.php';
    $file_contents = file_get_contents($path_to_file);
    $file_contents = str_replace("wp_dbname",$db_name,$file_contents);
    $file_contents = str_replace("wp_username",$db_user,$file_contents);
    $file_contents = str_replace("wp_password",$db_pass,$file_contents);
    file_put_contents($path_to_file,$file_contents);
    // for sql
    copy(APP_CONFIG_PATH.'wordpress/replace_wp_db.sql', $dst.'/replace_wp_db.sql');
    $sql_file = $dst.'/replace_wp_db.sql';
    $sql_contents = file_get_contents($sql_file);
    $sql_contents = str_replace("replace_wp_dbname",$db_name,$sql_contents);
    $sql_contents = str_replace("replace_wp_site_title",$site_name,$sql_contents);
    $sql_contents = str_replace("replace_wp_username",$user_name,$sql_contents);
    $sql_contents = str_replace("replace_wp_password",md5($password),$sql_contents);
    $sql_contents = str_replace("replace_wp_email@gmail.com",$email,$sql_contents);
    $sql_contents = str_replace("replace_wp_url",$url,$sql_contents);
    file_put_contents($sql_file,$sql_contents);
    $import = file_get_contents($sql_file);

    if ( ! $commons->importWP($import,$db_name,$db_user,$db_pass))
    {
        echo "import fail";
    }  
}else{
    $msg = "system maintenance";
}
flash($msgsession,$msg);
header("location: /admin/share/server?setting=site&tab=app_install&act=index&webid=$webid");