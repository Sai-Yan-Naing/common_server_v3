<?php
// echo $_POST['action'];
// die();
require_once('views/share_config.php');
$email=$_POST['email'];

$query = "SELECT * FROM add_email WHERE domain='$webdomain'";
$isexist='exist';
$msg = "jp message";
$msgsession ="msg";
// if ( count($commons->getAllRow($query)) > 0 )
// {
//     $isexist='exist';
// }
$action =$_POST['action'];
if ( isset($_POST['action']) and $_POST['action'] === 'new')
{
	$msg = "メールアドレス「".$email."@".$webdomain."」を追加しました";
	$msgsession ="msg";
	$mail_pass_word=$_POST['mail_pass_word'];
	$insert_q = "INSERT INTO add_email (domain, email, password) VALUES ( ?, ?, ?)";
	if ( ! $commons->doThis($insert_q,[$webdomain, $email, $mail_pass_word]))
	{
		$error  = "Email Cannot be add.";
		require_once('views/share/mail/index.php');
		die("");
	}
echo  shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" newuser '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$mail_pass_word.' '.$email);
// die;
} elseif ( isset($_POST['action']) and $_POST['action'] === 'edit') {
	$mail_pass_word=$_POST['mail_pass_word'];
	$act_id=$_POST['act_id'];
	$update_q = "UPDATE add_email SET password='$mail_pass_word'WHERE id=? and domain=? ";
	 if ( ! $commons->doThis($update_q,[$act_id,$webdomain]))
	 {
		$error  = "Email Cannot be update.";
		require_once('views/share/mail/index.php');
		die("");
	}
	$query = "SELECT * FROM add_email WHERE id=?";
	$getRow = $commons->getRow($query,[$act_id]);
	$msg = "メールアドレス「".$getRow['email']."@".$webdomain."」のパスワードを変更しました";;
	$msgsession ="msg";
echo  shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" edit '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$mail_pass_word.' '.$getRow['email']);
}elseif ( isset($_POST['action']) and $_POST['action'] === 'export')
{
	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	header('Content-Encoding: UTF-8');
	header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=mailuserlist.csv'); 
    $output = fopen("php://output", "w");  
    fputcsv($output, array(
        mb_convert_encoding('No', "ISO-2022-JP", "UTF-8"), 
        mb_convert_encoding('Mail User', "ISO-2022-JP", "UTF-8"), 
        mb_convert_encoding('Password', "ISO-2022-JP","UTF-8")
    ));
	// $query = "SELECT email, password FROM add_email where domain = ? ";
	// $getAllRow = $commons->getAllRow($query, [$webdomain]);
	// // print_r($getAllRow);
	// foreach($getAllRow as $row)  
 //      {  
 //           fputcsv($output, $row);  
 //      } 

 fputcsv($output, array('1','defaultuser','defaultpass')); 

      fclose($output);
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
echo '<pre>';
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
			foreach ($temp as $key => $value) {
				if ($value['email'] ==null && $value['email'] ==null) {
					unset($temp[$key]);
				}
			}
			$temp = array_values($temp);
			print_r($temp);
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
					if (preg_match("/\s/", $temp[$i]['email']) || !preg_match("/^[A-Za-z0-9_.#&+-]+$/", $temp[$i]['email']) || preg_match("/\s/", $temp[$i]['password']) || !preg_match("/^[!A-Za-z0-9_@.#&+-]{8,30}$/", $temp[$i]['password']) ){
						$dup = true;
					    //Email address is invalid.
					    $invalid[$i]['no'] = $temp[$i]['no'];
					    $invalid[$i]['email'] = $temp[$i]['email'];
					    $invalid[$i]['password'] = $temp[$i]['password'];
					}
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
				print_r($updatefromcsv);
				print_r($insertfromcsv);
				// die;
				// $uni = array_unique($unique);
				// if (count($uni)<count($unique)) {
				// 	$dup = true;
				// }
				$invmsg = '';
				if (count($invalid)>0) {
					$dup = true;
					$invmsg .= 'CSVファイル内に無効なメールアドレスまたはパスワードが含まれています<br>';
						foreach ($invalid as $key => $value) {
						 	$invmsg .= '[ '. $value['no'].' ] '. $value['email'].' and '.$value['password'].'<br>';
						 } 
				}
				$dbmsg = '';
				if (count($updatefromcsv)>0) {
					$dup = true;
					$dbmsg .= 'CSVファイル内に登録済みのユーザーと重複するメールアドレスがあります<br>';
						foreach ($updatefromcsv as $key => $value) {
						 	$dbmsg .= '[ '. $value['no'].' ] '. $value['email'].' and '.$value['password'].'<br>';
						 } 
				}
				$csvmsg = '';
				if (count($dupincsv)>0) {
					$dup = true;
					$csvmsg .= 'CSVファイルの中に重複するメールアドレスがあります<br>';
						foreach ($dupincsv as $key => $value) {
						 	$csvmsg .= '[ '. $value['no'].' ] '. $value['email'].' and '.$value['password'].'<br>';
						 }
				}
				
				

				if ($dup) {
					$msg = '<span class=error>';
					$msg .= $invmsg;
					$msg .= $dbmsg;
					$msg .= $csvmsg;
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
						shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" csv '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain." ".$incsv." ".$upcsv);
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
		require_once('views/share/mail/index.php');
		die();
	}
echo  shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" delete '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$getRow['email'].' '.$getRow['email']);
}

// $commons->mail_server($webdomain,$email,$mail_pass_word,$action,$isexist);
flash($msgsession,$msg);
header("location: /share/mail?setting=email&tab=tab&act=index&webid=$webid");

?>