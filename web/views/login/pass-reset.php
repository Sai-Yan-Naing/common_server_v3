<?php
require_once('config/all.php');
require_once('models/common.php');
require_once('mails/mail.php');
$domainid = $_POST['domainid'];
$password = $_POST['password'];
$pass_encrypted = hash_hmac('sha256', $password, PASS_KEY);
$commons = new Common;
$webmailer = new Mailer;

if (filter_var($domainid, FILTER_VALIDATE_IP))
{
    $webroot_acc = $commons->getRow("SELECT * FROM vps_account WHERE ip=?",[$domainid]);
    if ( $webroot_acc != null)
    {
        $cusomteracc = $commons->getRow("SELECT * FROM customer WHERE user_id=?",[$webroot_acc['customer_id']]);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $subject = "password reset confirmation";
        $body = 'Hello, <p><a href="'.$url.'/login?act=new_password&token='.$cusomteracc['token'].'">password reset link</a></p>';
        if ( ! $webmailer->sendMail($cusomteracc['email'], $cusomteracc['user'], $subject, $body))
        {
           echo  $error = 'Cannot send email';
            die();
        }
        setcookie("domainid", $domainid);
        header('location: /login?act=check-email');
        die;
    } else
    {
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }
} elseif ( is_valid_domain_name ($domainid))
{
    $webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE domain=?",[$domainid]);
    if ( $webroot_acc != null)
    {
        $cusomteracc = $commons->getRow("SELECT * FROM customer WHERE user_id=?",[$webroot_acc['customer_id']]);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $subject = "password reset confirmation";
        $body = 'Hello, <p><a href="'.$url.'/login?act=new_password&token='.$cusomteracc['token'].'">password reset link</a></p>';
        if ( ! $webmailer->sendMail($cusomteracc['email'], $cusomteracc['user'], $subject, $body))
        {
           echo  $error = 'Cannot send email';
            die();
        }
        setcookie("domainid", $domainid);
        header('location: /login?act=check-email');
        die;
    } else
    {
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }
} else
{
    $webroot_acc = $commons->getRow("SELECT * FROM customer WHERE user_id='$domainid'");
    if ( $webroot_acc != null)
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $subject = "password reset confirmation";
        $body = 'Hello, <p><a href="'.$url.'/login?act=new_password&token='.$webroot_acc['token'].'">password reset link</a></p>';
        if ( ! $webmailer->sendMail($webroot_acc['email'], $webroot_acc['user'], $subject, $body))
        {
           echo  $error = 'Cannot send email';
            die();
        }
        setcookie("domainid", $domainid);
        header('location: /login?act=check-email');
        die('hello');
    } else
    {
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }
    
}

function is_valid_domain_name($domainid) {
    return (preg_match("/^([a-zA-Z0-9_.+-])+(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/", $domainid) //valid chars check
            // && preg_match("/^.{1,253}$/", $domainid) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domainid)   ); //length of each label
}

?>