<?php
require_once("views/admin/admin_shareconfig.php");
$temp = json_decode($weberrorpages,true);
$msg = "jp message";
$msgsession ="msg";
if ( isset($_POST['action']))
{
	if ( $_POST['action'] === "new")
	{
		// die('hello');
		$status = 1;
		$action= $_POST['action'];
		$status_code= $_POST['status_code'];
		$code = $status_code;
		$url_spec= $_POST['url_spec'];
        $temp['ID-'.$status_code] = ["url"=>$url_spec,"stopped"=>$status,"statuscode"=>$status_code];
		echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
	} elseif ( $_POST['action'] === "edit")
	{
		$action= $_POST['action'];
		$status_code= $_POST['status_code'];
		$url_spec= $_POST['url_spec'];
		$act_id= $_POST['act_id'];
		$code= $_POST['code'];
        $temp[$act_id]['url']=$url_spec;
        $temp[$act_id]['stopped']=$temp[$act_id]['stopped'];
        $temp[$act_id]['statuscode']=$status_code;	
		$status = $temp[$act_id]['stopped'];		
		echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status." edit");
		// echo $code;
		// echo "<br>".$status_code;
		// die();
	} else
	{
		$action= $_POST['action'];
		$act_id= $_POST['act_id'];
        $status = $temp[$act_id]['stopped'] === 0? 1 : 0;
        $temp[$act_id]['url']=$temp[$act_id]['url'];
        $temp[$act_id]['stopped']=$status;

		$status_code = $temp[$act_id]['statuscode'];
		$code = $status_code;
		$url_spec = $temp[$act_id]['url'];
		// echo $code;
		// die();
		echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
	}

    $result = json_encode($temp);

    // print_r($result);
    // die();
    $query_dir = "UPDATE web_account SET error_pages=? WHERE id=?";
    if ( !$commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Error page';
        require_once('views/admin/share/server/site/basic/index.php');
        die();
    }
    flash($msgsession,$msg);
	header("location : /admin/share/server?setting=site&tab=basic&act=index&webid=$webid");
}

?>