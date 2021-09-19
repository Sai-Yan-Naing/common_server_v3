<?php

if(isset($_POST['user']) && $_POST['user'] == 'admin')
{
	setcookie("admin","",time()-3600);
}else if (isset($_POST['user']) && $_POST['user'] == 'share_user') {
	setcookie("share_user","");
}else{
    setcookie("vps_user","");
}
header('Location: /login');