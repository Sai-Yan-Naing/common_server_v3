<?php
require_once('config/all.php');
require_once('models/common.php');
require_once('mails/mail.php');
$domainid = $_POST['domainid'];
$password = $_POST['pass'];
$cpassword = $_POST['cpass'];
$pass_encrypted = hash_hmac('sha256', $password, PASS_KEY);
$commons = new Common;
$webmailer = new Mailer;
if($password !== $cpassword)
{
    $error = "Password doesnot match";
    require_once('views/login/new_password.php');
}

if (filter_var($domainid, FILTER_VALIDATE_IP))
{
    $webroot_acc = $commons->doThis("UPDATE vps_account SET `password` = '$pass_encrypted 'WHERE `ip` ='$domainid'");
    if ($webroot_acc)
    {
        header("location: /login");
    } else
    {
        $error = "Password doesnot updated";
     require_once('views/login/new_password.php');
    }
} elseif ( is_valid_domain_name ($domainid))
{
    $webroot_acc = $commons->doThis("UPDATE web_account SET `password` = '$pass_encrypted 'WHERE `domain` ='$domainid'");
    if ($webroot_acc)
    {
        header("location: /login");
    } else
    {
        $error = "Password doesnot updated";
     require_once('views/login/new_password.php');
    }
} else
{
    $webroot_acc = $commons->doThis("UPDATE customer SET `password` = '$pass_encrypted 'WHERE `user_id` ='$domainid'");
    if ($webroot_acc)
    {
        header("location: /login");
    } else
    {
        $error = "Password doesnot updated";
     require_once('views/login/new_password.php');
    }
    
}

function is_valid_domain_name($domainid) {
    return (preg_match("/^([a-zA-Z0-9_.+-])+(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/", $domainid) //valid chars check
            // && preg_match("/^.{1,253}$/", $domainid) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domainid)   ); //length of each label
}

?>