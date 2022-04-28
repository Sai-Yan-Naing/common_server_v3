<?php
setcookie("admin","");
setcookie("share_user","");
setcookie("vps_user","");
// if ( isset($_POST['user']) && $_POST['user'] == 'admin')
// {
// 	setcookie("admin","");
// } elseif (isset($_POST['user']) && $_POST['user'] == 'share_user')
// {
// 	setcookie("share_user","");
// } else
// {
//     setcookie("vps_user","");
// }
header('Location: /login');