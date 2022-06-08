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
        mb_convert_encoding('Mail User', "ISO-2022-JP", "UTF-8"), 
        mb_convert_encoding('Password', "ISO-2022-JP","UTF-8")
    ));
	$query = "SELECT email, password FROM add_email where domain = ? ";
	$getAllRow = $commons->getAllRow($query, [$webdomain]);
	// print_r($getAllRow);
	foreach($getAllRow as $row)  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);
      $msg = 'sucessfull export';
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
		 print_r($getAllRow);
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
			    $temp[$i]['email'] =$row[0];
			    $temp[$i]['password'] =$row[1];
			  } catch (Exception $ex) { echo $ex->getmessage(); }
			}
			$temp = array_values($temp);
			// print_r($temp);
			// echo 'intersect';
			$msg = 'cannot import without any user';
			if (count($temp)>0) {
				$duplicate = [];
				$duplicate1 = [];
				$unique = [];
				$dup = false;
				$string = '';

				for ($i=0; $i < count($temp) ; $i++) { 
					$unique[$i]= $temp[$i]['email'];
					// array to string
					// if ($string=='' || $string==null) {
					// 	$string = $temp[$i]['email'].'pe&pe'.$temp[$i]['password'];
					// }else
					// $string += ','.$temp[$i]['email'].'pe&pe'.$temp[$i]['password'];
					
					for ($j=0; $j <count($getAllRow); $j++) { 
						if ($temp[$i]['email']==$getAllRow[$j]['email']) {
							$duplicate1[$i]['id'] = $getAllRow[$j]['id'];
							$duplicate1[$i]['email'] = $getAllRow[$j]['email'];
							$duplicate1[$i]['password'] = $temp[$i]['password'];
						}
							
					}
				}
				$duplicate = $temp;
				$dupcsv = [];
				foreach ($duplicate1 as $key => $value) {
					unset($duplicate[$key]);	
				}
				foreach ($duplicate as $key => $value) {
					$dupcsv[$key] = $duplicate[$key]['email'];	
				}
				$unique = array_unique($dupcsv);

				$test = array_diff_assoc($dupcsv, $unique);

				foreach ($unique as $key => $value) { 
					foreach ($test as $key1 => $value1) {
						if ($value==$value1) {
							echo $key;
							echo 'hey';
							unset($duplicate[$key]);
						}
					}
				}
				// 	print_r($unique);
				// 	print_r($test);
				// // print_r($test);
				// echo 'unique';
				// print_r($dupcsv);
				// print_r($duplicate1);
				// echo 'update';
				// print_r($duplicate);
				// die;
				// $uni = array_unique($unique);
				// if (count($uni)<count($unique)) {
				// 	$dup = true;
				// }

				if ($dup) {
					$msg = 'cannot import duplicate mail user';
				}else {
					$msg = 'sucessfull import';

						foreach ($duplicate as $key => $row) {

							$insert_q = "INSERT INTO add_email (domain, email, password) VALUES ( ?, ?, ?)";
							if ( ! $commons->doThis($insert_q,[$webdomain, $row['email'],  $row['password']]))
							{
								$error  = "Email cannot import.";
								die("");
							}
						}

						foreach ($duplicate1 as $key => $row) {

							$update_q = "UPDATE add_email SET password=? WHERE id=?";
							if ( ! $commons->doThis($update_q,[$row['password'],  $row['id']]))
							{
								$error  = "Email cannot import.";
								die("ddd");
							}
						}
						// echo $string;
					// 	echo shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" csv '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain." '".json_encode($temp)."'");
					// 	echo ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" csv '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain." '".json_encode($temp)."'");
					// die();
				}

			}
			// print_r($duplicate);
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
// echo  shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/commons/email.ps1" delete '.MAILIP.' '.MAILUSER.' '.MAILPASS.' '.$webdomain.' '.$getRow['email'].' '.$getRow['email']);
}

// $commons->mail_server($webdomain,$email,$mail_pass_word,$action,$isexist);
flash($msgsession,$msg);
header("location: /share/mail?setting=email&tab=tab&act=index&webid=$webid");

?>