<?php
if(!isset($_POST['post'])){?> This Page is not support Get Method
    <a href="javascript:history.go(-1)" title="Return to the previous page">« Go back</a>
    <?php }?>

<?php
require_once('config/all.php');
require_once('models/common.php');
$domainid = $_POST['domainid'];
$password = $_POST['password'];
$pass_encrypted = hash_hmac('sha256', $password, PASS_KEY);
$commons = new Common;

if (filter_var($domainid, FILTER_VALIDATE_IP)) {
    $webroot_acc = $commons->getRow("SELECT * FROM vps_account WHERE ip='$domainid'");
    if($webroot_acc != null){
        // setcookie("vps_user", $domainid);
        // setcookie("password", $pass_encrypted);
        // header("location: /admin");
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }else{
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }
}else if(is_valid_domain_name($domainid)){
    $webroot_acc = $commons->getRow("SELECT * FROM web_account WHERE domain='$domainid'");
    if($webroot_acc != null){
        // setcookie("doamin_user", $domainid);
        // setcookie("password", $pass_encrypted);
        // header("location: /admin");
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }else{
        $error = "ご契約ID and Password error";
        require_once('views/login/index.php');
    }
}else{
    $webroot_acc = $commons->getRow("SELECT * FROM customer WHERE user_id='$domainid' AND password='$pass_encrypted'");
    if($webroot_acc != null){
        setcookie("admin", $domainid);
        setcookie("password", $pass_encrypted);
        header("location: /admin");
        die('hello');
    }else{
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