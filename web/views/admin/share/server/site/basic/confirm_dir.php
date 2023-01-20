<?php
require_once("views/admin/admin_shareconfig.php");
    $action = $_POST['action'];
    $for = $_GET['for'];
    $temp = json_decode($webbasicsetting,true);
    $bass_dir = $_POST['bass_dir'];
    $dir_path=$webpath.'/web/'.$bass_dir;
    $msg = "jp message";
    $msgsession ="msg";
    if ($for==='dir')
    {
        if ($action === 'new')
        {
            $msg = "BASIC認証「".$bass_dir."」を作成しました";
            $temp1 = json_decode($webbasicsetting, true);
	// print_r($temp1);die;
		foreach($temp1 as $t){
			if(in_array($bass_dir, $t)){
				$data = ['status'=>true, "field"=>"bass_dir", "error"=>"$bass_dir を取得することができません。別の名前を指定してください。"];
				echo json_encode($data);
				die;
			}
		}

            $temp["ID-".time()]["url"] =$bass_dir;
            $temp["ID-".time()]["user"] =null;
            // createDir($dir_path);
            // echo $dir_path;
            newDir($web_host,$web_user,$web_password,ROOT_PATH.$dir_path);

            $result = json_encode($temp);
    $query_dir = "UPDATE web_account SET basic_setting=? WHERE id=?";
    if ( ! $commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Basic Setting';
        require_once('views/admin/share/servers/sites/basic.php');
        die();
    }
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Success';
    addBassman($web_host,$web_user,$web_password,ROOT_PATH.$webpath,$result);

            $data = ['status'=>false, "message"=>"ok"];
		echo json_encode($data);
		flash($msgsession,$msg);
		die;
        }else{
            $msg = "BASIC認証「".$temp[$_POST['dir_id']]['url']."」を削除しました";
            unset($temp[$_POST['dir_id']]);
            // echo ROOT_PATH.$dir_path;
            // die();
            // delete_directory(ROOT_PATH.$dir_path);
            // deleteDir($web_host,$web_user,$web_password,ROOT_PATH.$dir_path);
        }
    } elseif ($for==='user')
    {
        $dir_id = $_POST['dir_id'];
        if ($action==='new')
        {
            $bass_user = $_POST['bass_user'];
            $bass_pass = $_POST['bass_pass'];
            $temp[$dir_id]['user']["ID-".time()] = ['bass_user'=>$bass_user,'bass_pass'=>$bass_pass];
            $msg = "認証ユーザー 「".$bass_user."」 を作成しました";

            $temp1 = json_decode($webbasicsetting, true);
                    foreach($temp1[$dir_id]['user'] as $t){
                        if($bass_user==$t['bass_user']){
                            $data = ['status'=>true, "field"=>"bass_user", "error"=>"$bass_user を取得することができません。別の名前を指定してください。"];
                        echo json_encode($data);
                        die;
                        }
                    }
            $result = json_encode($temp);
    $query_dir = "UPDATE web_account SET basic_setting=? WHERE id=?";
    if ( ! $commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Basic Setting';
        require_once('views/admin/share/servers/sites/basic.php');
        die();
    }
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Success';
    addBassman($web_host,$web_user,$web_password,ROOT_PATH.$webpath,$result);
    $data = ['status'=>false, "message"=>"ok"];
		echo json_encode($data);
		flash($msgsession,$msg);
die;
        } elseif ($action==='delete')
        {
            $act_id = $_POST['act_id'];
            $bass_user = $temp[$dir_id]['user'][$act_id]['bass_user'];
            $msg = "認証ユーザー 「".$bass_user."」 を削除しました";
            $act_id = $_POST['act_id'];
            unset($temp[$dir_id]['user'][$act_id]);
            
        }else{
            $bass_user = $_POST['bass_user'];
            $bass_pass = $_POST['bass_pass'];
            $act_id = $_POST['act_id'];
            $temp[$dir_id]['user'][$act_id]['bass_pass'] = $bass_pass;
            $msg = "認証ユーザー「".$bass_user."」のパスワードの変更が完了しました";

            $result = json_encode($temp);
    $query_dir = "UPDATE web_account SET basic_setting=? WHERE id=?";
    if ( ! $commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Basic Setting';
        require_once('views/admin/share/servers/sites/basic.php');
        die();
    }
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Success';
    addBassman($web_host,$web_user,$web_password,ROOT_PATH.$webpath,$result);
    $data = ['status'=>false, "message"=>"ok"];
		echo json_encode($data);
		flash($msgsession,$msg);
die;
        }
        
    }
    $result = json_encode($temp);

    // print_r($result);
    // die();
    $query_dir = "UPDATE web_account SET basic_setting=? WHERE id=?";
    if ( ! $commons->doThis($query_dir,[$result,$webid]))
    {
        $_SESSION['error'] = true;
        $_SESSION['message'] = 'Cannot Update Basic Setting';
        require_once('views/admin/share/servers/sites/basic.php');
        die();
    }
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Success';
    addBassman($web_host,$web_user,$web_password,ROOT_PATH.$webpath,$result);
    flash($msgsession,$msg);
    header("location: /admin/share/server?setting=site&tab=basic&act=index&webid=$webid");
    die();