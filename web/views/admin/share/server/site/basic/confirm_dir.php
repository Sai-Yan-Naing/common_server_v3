<?php
require_once("views/admin/admin_shareconfig.php");
    $action = $_POST['action'];
    $for = $_GET['for'];
    $temp = json_decode($webbasicsetting,true);
    $bass_dir = $_POST['bass_dir'];
    $dir_path=$webrootuser.'/'.$webuser.'/'.$bass_dir;
    $msg = "jp message";
    $msgsession ="msg";
    if ($for==='dir')
    {
        if ($action === 'new')
        {
            $msg = "BASIC認証を作成しました";
            $temp["ID-".time()]["url"] =$bass_dir;
            $temp["ID-".time()]["user"] =null;
            createDir($dir_path);
            // $temp
        }else{
            $msg = "BASIC認証を削除しました";
            unset($temp[$_POST['dir_id']]);
            // echo ROOT_PATH.$dir_path;
            // die();
            // delete_directory(ROOT_PATH.$dir_path);
        }
    } elseif ($for==='user')
    {
        $dir_id = $_POST['dir_id'];
        if ($action==='new')
        {
            $msg = "認証ユーザーを作成しました";
            $bass_user = $_POST['bass_user'];
            $bass_pass = $_POST['bass_pass'];
            $temp[$dir_id]['user']["ID-".time()] = ['bass_user'=>$bass_user,'bass_pass'=>$bass_pass];
        } elseif ($action==='delete')
        {
            $msg = "認証ユーザーを編集しました";
            $act_id = $_POST['act_id'];
            unset($temp[$dir_id]['user'][$act_id]);
            
        }else{
            $msg = "認証ユーザーを削除しました";
            $bass_user = $_POST['bass_user'];
            $bass_pass = $_POST['bass_pass'];
            $act_id = $_POST['act_id'];
            $temp[$dir_id]['user'][$act_id]['bass_pass'] = $bass_pass;
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
    addBassman($webrootuser.'/'.$webuser,$result);
    flash($msgsession,$msg);
    header("location: /admin/share/server?setting=site&tab=basic&act=index&webid=$webid");
    die();

?>