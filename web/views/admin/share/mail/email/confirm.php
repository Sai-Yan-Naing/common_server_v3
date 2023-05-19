<?php
// echo $_POST['action'];
// die();
require_once('views/admin/admin_shareconfig.php');
$email=$_POST['email'];

$query = "SELECT * FROM add_email WHERE domain='$webdomain'";
$isexist='exist';
$msg = "jp message";
$msgsession ="msg";
$pserr = false;
$res = 'noerror';
// if ( count($commons->getAllRow($query)) > 0 )
// {
//     $isexist='exist';
// }
$action =$_POST['action'];
if ( isset($_POST['action']) and $_POST['action'] === 'new')
{
	$msg = "メールアドレス「".$email."@".$webdomain."」を追加しました";
	$msgsession ="msg";
	$mail_pass_word=htmlspecialchars($_POST['mail_pass_word'], ENT_QUOTES);

	$getcount = "SELECT count(add_email.id) FROM add_email INNER JOIN web_account on add_email.domain = web_account.domain where add_email.email = '$email' and add_email.domain='$webdomain'";
    $getindb = $commons->getCount($getcount);

	if($getindb>0){
        $data = ['status'=>true, "field"=>"email", "error"=>"$email を取得することができません。別の名前を指定してください。"];
        echo json_encode($data);
        die;
    }
	$insert_q = "INSERT INTO add_email (domain, email, password) VALUES ( ?, ?, ?)";
	if ( ! $commons->doThis($insert_q,[$webdomain, $email, $mail_pass_word]))
	{
		$error  = "Email Cannot be add.";
		require_once('views/admin/share/mail/index.php');
		die("");
	}
	$webmail_cnt +=1;
		$sql = "UPDATE web_account SET mail_cnt='$webmail_cnt' WHERE domain='$webdomain'";
		if( ! $commons->doThis($sql)) {
			$error = "cannot add mail account";
				require_once("views/admin/share/mail/index.php");
				die("");
			}
$res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" newuser '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$mail_pass_word.' '.$email);

$data = ['status'=>false, "message"=>"ok"];
echo json_encode($data);
if(preg_replace("/\s+/", "", $res)=='error'){
	$pserr = true;;
}
if($pserr){
$msgsession = 'msg';
$msg = 'powershellerror';
}
flash($msgsession,$msg);
die;
} elseif ( isset($_POST['action']) and $_POST['action'] === 'edit') {
	$mail_pass_word=htmlspecialchars($_POST['mail_pass_word'], ENT_QUOTES);
	$act_id=$_POST['act_id'];
	$update_q = "UPDATE add_email SET password='$mail_pass_word'WHERE id=? and domain=? ";
	 if ( ! $commons->doThis($update_q,[$act_id,$webdomain]))
	 {
		$error  = "Email Cannot be update.";
		require_once('views/admin/share/mail/index.php');
		die("");
	}
	$query = "SELECT * FROM add_email WHERE id=?";
	$getRow = $commons->getRow($query,[$act_id]);
	$msg = "メールアドレス「".$getRow['email']."@".$webdomain."」のパスワードを変更しました";;
	$msgsession ="msg";
$res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" edit '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$mail_pass_word.' '.$getRow['email']);
$data = ['status'=>false, "message"=>"ok"];
    echo json_encode($data);
	if(preg_replace("/\s+/", "", $res)=='error'){
        $pserr = true;;
    }
if($pserr){
    $msgsession = 'msg';
    $msg = 'powershellerror';
}
    flash($msgsession,$msg);
    die;
}elseif ( isset($_POST['action']) and $_POST['action'] === 'export')
{
	$file = 'views/mail_template.csv';
	$len = filesize($file); // Calculate File Size
    ob_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    header("Content-Type:application/octet-stream"); // Send type of file
    $header="Content-Disposition: attachment; filename=mail_template.csv;"; // Send File Name
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len); // Send File Size
    @readfile($file);
      // $msg = 'sucessfull export';
      die();
}elseif ( isset($_POST['action']) and $_POST['action'] === 'import')
{
	$temp = [];
	$filename=$_FILES["file"]["tmp_name"];   
     if($_FILES["file"]["size"] > 0)
     {
     	$i = 0;
     	 $file = fopen($filename, "r");
     	 if ($file === false) { exit("Failed to open uploaded CSV file"); }
     	 $query = "SELECT * FROM add_email where domain = ? ";
		 $getAllRow = $commons->getAllRow($query, [$webdomain]);
// echo '<pre>';
		 // print_r($getAllRow);
     	 while (($row = fgetcsv($file)) !== false) {
			  try {
			    if (count($row)<2) {
			    	continue;
			    }
			    
			    if ($i<=0) {
			    	$i++;
			    	continue;
			    }
			    $i++;
			    $temp[$i]['no'] =$row[0];
			    $temp[$i]['email'] =$row[1];
			    $temp[$i]['password'] =$row[2];
			  } catch (Exception $ex) { echo $ex->getmessage(); }
			}
			print_r($temp);
			foreach ($temp as $key => $value) {
				unset($temp[$key]);
				if ($value['no'] =='No' && $value['email'] =='Mail User' && $value['password']=='Password') {
					break;
				}
				
			}
			foreach ($temp as $key => $value) {
				if ($value['email'] ==null && $value['email'] ==null) {
					unset($temp[$key]);
				}
			}
			$temp = array_values($temp);
			print_r($temp);
			// die();
			// echo 'intersect';
			$msg = 'CSVファイルには少なくとも1件以上のメールアドレスを入力してください';
			if (count($temp)>0) {
				$insertfromcsv = [];
				$updatefromcsv = [];
				$unique = [];
				$dup = false;
				$invalid = [];

				for ($i=0; $i < count($temp) ; $i++) { 
					$unique[$i]= $temp[$i]['email'];
					// if (preg_match("/\s/", $temp[$i]['email']) || !preg_match("/^[A-Za-z0-9_.#&+-]+$/", $temp[$i]['email']) || preg_match("/\s/", $temp[$i]['password']) || !preg_match("/^[!A-Za-z0-9_@.#&+-]{8,30}$/", $temp[$i]['password']) ){
					// 	$dup = true;
					//     //Email address is invalid.
					//     $invalid[$i]['no'] = $temp[$i]['no'];
					//     $invalid[$i]['email'] = $temp[$i]['email'];
					//     $invalid[$i]['password'] = $temp[$i]['password'];
					// }
					for ($j=0; $j <count($getAllRow); $j++) { 
						if ($temp[$i]['email']==$getAllRow[$j]['email']) {
							$updatefromcsv[$i]['no'] = $temp[$i]['no'];
							$updatefromcsv[$i]['email'] = $temp[$i]['email'];
							$updatefromcsv[$i]['password'] = $temp[$i]['password'];
							$dup = true;
						}
							
					}
				}
				$insertfromcsv = $temp;
				$dupcsv = [];
				$dupincsv = [];
				// foreach ($updatefromcsv as $key => $value) {
				// 	unset($insertfromcsv[$key]);	
				// }
				foreach ($insertfromcsv as $key => $value) {
					$dupcsv[$key] = $insertfromcsv[$key]['email'];	
				}
				$unique = array_unique($dupcsv);

				$diffarr = array_diff_assoc($dupcsv, $unique);

				foreach ($insertfromcsv as $key => $value) { 
					foreach ($diffarr as $key1 => $value1) {
						if ($value['email']==$value1) {
						    $dupincsv[$key]['no'] = $insertfromcsv[$key]['no'];
						    $dupincsv[$key]['email'] = $insertfromcsv[$key]['email'];
						    $dupincsv[$key]['password'] = $insertfromcsv[$key]['password'];
						}
					}
				}
					print_r($unique);
					print_r($diffarr);
					print_r($dupincsv);
				echo 'invalid';
				print_r($invalid);
				// echo 'unique';
				// print_r($dupcsv);
				echo 'updatefromcsv';
				echo '<pre>';
				print_r($updatefromcsv);
				print_r($insertfromcsv);
				// die;
				// $uni = array_unique($unique);
				$qid = ( $weborigin != 1 )? $weborigin_id : $webid;
				$query3 = "SELECT mail_cnt FROM web_account where (origin_id = ? or id= ?)  and removal IS NULL";
				$getalldbcount = $commons->getAllRow($query3, [$qid,$qid]);
				$mail_cnt =0;
				foreach($getalldbcount as $value){
				    $mail_cnt +=$value['mail_cnt'];
				}
				$mailmsg = '';
				if (count($insertfromcsv) + $mail_cnt>$webplnmailuser) {
					$dup = true;
					$mailmsg .= 'mail user limited';
				}
				$invmsg = '';
				if (count($invalid)>0) {
					$dup = true;
					$invmsg .= 'CSVファイル内に無効なメールアドレスまたはパスワードが含まれています<br>';
						foreach ($invalid as $key => $value) {
						 	$invmsg .= htmlspecialchars('[ '. $value['no'].' ] '. $value['email'].' and '.$value['password']).'<br>';
						 } 
				}
				$dbmsg = '';
				if (count($updatefromcsv)>0) {
					$dup = true;
					$dbmsg .= 'CSVファイル内に登録済みのユーザーと重複するメールアドレスがあります<br>';
						foreach ($updatefromcsv as $key => $value) {
						 	$dbmsg .= htmlspecialchars('[ '. $value['no'].' ] '. $value['email'].' and '.$value['password']).'<br>';
						 } 
				}
				$csvmsg = '';
				if (count($dupincsv)>0) {
					$dup = true;
					$csvmsg .= 'CSVファイルの中に重複するメールアドレスがあります<br>';
						foreach ($dupincsv as $key => $value) {
						 	$csvmsg .= htmlspecialchars('[ '. $value['no'].' ] '. $value['email'].' and '.$value['password']).'<br>';
						 }
				}
				
				

				if ($dup) {
					$msg = '<span class=error>';
					$msg .= $invmsg;
					$msg .= $dbmsg;
					$msg .= $csvmsg;
					$msg .= $mailmsg;
					$msg .= '</span>';
					
				}else {
					$msg = 'アップロード完了';

					$incsv = 'ne@to@rev,';
					$upcsv = 'ne@to@rev,';

					
						foreach ($insertfromcsv as $key => $row) {
							// echo $row['email'];
							if ($incsv=='ne@to@rev,') {
								$incsv .=$row['email'].'pe1@2pe'.$row['password'];
							}else{
								$incsv .= ','.$row['email'].'pe1@2pe'.$row['password'];
							}
							

							$insert_q = "INSERT INTO add_email (domain, email, password) VALUES ( ?, ?, ?)";
							if ( ! $commons->doThis($insert_q,[$webdomain, $row['email'],  $row['password']]))
							{
								$error  = "Email cannot import.";
								die("");
							}
							$webmail_cnt +=1;
							$sql = "UPDATE web_account SET mail_cnt='$webmail_cnt' WHERE domain='$webdomain'";
							if( ! $commons->doThis($sql)) {
								$error = "cannot add mail account";
									require_once("views/admin/share/mail/index.php");
									die("");
								}
						}

						// foreach ($updatefromcsv as $key => $row) {

						// 	if ($upcsv=='ne@to@rev,') {
						// 		$upcsv .= $row['email'].'pe1@2pe'.$row['password'];
						// 	}else{
						// 		$upcsv .= ','.$row['email'].'pe1@2pe'.$row['password'];
						// 	}
							

						// 	$update_q = "UPDATE add_email SET password=? WHERE id=?";
						// 	if ( ! $commons->doThis($update_q,[$row['password'],  $row['id']]))
						// 	{
						// 		$error  = "Email cannot import.";
						// 		die("ddd");
						// 	}
						// }
						// echo $incsv;
						// echo '<br>';
						// echo 'update';
						// echo '<br>';
						// echo $upcsv;
						$res = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" csv '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain." ".$incsv." ".$upcsv);
						// echo ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" csv '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain." '".json_encode($temp)."'");
					// die();
				}

			}
			// print_r($insertfromcsv);
			// die();
			  
     }
}else {
	$act_id=$_POST['act_id'];
	$query = "SELECT * FROM add_email WHERE id=?";
	$getRow = $commons->getRow($query,[$act_id]);
	$msg = "メールアドレス「".$getRow['email']."@".$webdomain."」を削除しました";
	$msgsession ="msg";
    $delete_q = "DELETE FROM add_email WHERE id=?";
	if ( ! $commons->doThis($delete_q,[$act_id]))
	{
		$error = "Cannot Delete Email";
		require_once('views/admin/share/mail/index.php');
		die();
	}
	if ( $webmail_cnt<=0)
		{
			$webmail_cnt=0;
		}else{
			$webmail_cnt -=1;
		}
		$sql = "UPDATE web_account SET mail_cnt='$webmail_cnt' WHERE domain='$webdomain'";
		if( ! $commons->doThis($sql)) {
			$error = "cannot add mail account";
				require_once("views/admin/share/mail/index.php");
		}
$res =  shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" delete '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$getRow['email'].' '.$getRow['email']);
}
if(preg_replace("/\s+/", "", $res)=='error'){
	$pserr = true;;
}
if($pserr){
$msgsession = 'msg';
$msg = 'powershellerror';
}
// $commons->mail_server($webdomain,$email,$mail_pass_word,$action,$isexist);
flash($msgsession,$msg);
header("location: /admin/share/mail?setting=email&tab=tab&act=index&webid=$webid");

?>