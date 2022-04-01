<?php
require_once("views/share_config.php");
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
		// echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
		Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:/scripts/commons/errorpages.ps1" new '.$web_host.' '.$web_user.' '.$web_password.' '. $webuser." ". $code." ". $status_code." ".$url_spec." ".$status." new");
		// die;
		$msg = "「エラーページ ".$code."」 を追加しました";
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
		
		$msg = "「エラーページ ".$code."」 を編集しました";
				
		// echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status." edit");
		Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/errorpages.ps1" edit '.$web_host.' '.$web_user.' '.$web_password.' '. $webuser." ". $code." ". $status_code." ".$url_spec." ".$status." edit");
		// echo $code;
		// echo "<br>".$status_code;
		// die();
	} elseif ( $_POST['action'] === "delete")
	{
		 $action= $_POST['action'];
		 $act_id= $_POST['act_id'];
		$code = $temp[$act_id]['statuscode'];
		$msg = "「エラーページ ".$code."」を削除しました";
		unset($temp[$act_id]);
		$status_code ='noneed';
		$url_spec ='noneed';
		$status =0;
		// echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
		Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/errorpages.ps1" delete '.$web_host.' '.$web_user.' '.$web_password.' '. $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
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
		$msg = $status== 1? "ON" : "OFF";
		$msg = "「エラーページ ".$code."」 を".$msg."にしました";
		// echo $code;
		// die();
		// echo Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File E:/scripts/error_pages/error_pages.ps1 ". $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
		echo Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/errorpages.ps1" onoff '.$web_host.' '.$web_user.' '.$web_password.' '. $webuser." ". $code." ". $status_code." ".$url_spec." ".$status);
		// die;
	}

    $result = json_encode($temp);

    // print_r($result);
    // die();
    $query_dir = "UPDATE web_account SET error_pages=? WHERE id=?";
    if ( !$commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Error page';
        require_once('views/share/server/site/basic/index.php');
        die();
    }
    flash($msgsession,$msg);
	header("location : /share/server?setting=site&tab=basic&act=index");
}