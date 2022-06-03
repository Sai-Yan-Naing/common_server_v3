<?php
require_once("views/share_config.php");
$webappversion = json_decode($webappversion);
$msg = "jp message";
$msgsession ="msg";
    if ( isset($_GET['apply']) && $_GET['apply'] ==='web.config')
    {
        $file = $webpath."/web/web.config";
        $value = $_POST['web_config'];
        // putFile($file,$value);
        // webconfigset($webpath);
        //put_File($web_host,$web_user,$web_password,ROOT_PATH.$file,$value);
        ftpsavefile($web_host,$web_ftp,$web_ftppass,'web','web.config',$value);
        webconfig_set($web_host,$web_ftp,$web_ftppass);
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='.user.ini')
    {
        $file = $webpath."/web/.user.ini";
        $value = $_POST['php_ini'];
        // putFile($file,$value);
        // phpiniset($webpath);
        // put_File($web_host,$web_user,$web_password);
        put_File($web_host,$web_user,$web_password,ROOT_PATH.$file,$value);
        phpini_set($web_host,$web_ftp,$web_ftppass);
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='dotnet_version')
    {
        $version = $_POST['version'];
        // shell_exec("%systemroot%\system32\inetsrv\APPCMD set apppool $webuser /managedRuntimeVersion:$version");

        shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/dotnet/dotnet.ps1" change '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser.' '.$version);
        // die;

        $webappversion->app->dotnet=$version;
        $temp=$webappversion;
        $result=json_encode($temp);
        $query_dir = "UPDATE web_account SET app_version='$result' WHERE id= ?";
        $commons->doThis($query_dir,[$webid]);
        $msg = ".NETバージョン 「".$version."」 を変更しました";
        flash($msgsession,$msg);
        header("location: /share/server?setting=site&tab=app_setting&act=index&webid=$webid");
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='php_version')
    {
        $version = $_POST['version'];
        // $exec = "e:/scripts/php_version/php_version_change.bat $webuser $version";

        // echo shell_exec($exec);


        shell_exec ('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts/php_version/phpversion.ps1" change '.$web_host.' '.$web_user.' '.$web_password.' '.$webuser.' '.$version);
        // die;

        $webappversion->app->php=$version;
        $temp=$webappversion;
        $result=json_encode($temp);
        // print_r($result);
        $query_dir = "UPDATE web_account SET app_version='$result' WHERE id='$webid'";
        $commons->doThis($query_dir);
        $msg = "PHPバージョンを「".$version."」 に変更しました";
        flash($msgsession,$msg);
        header("location: /share/server?setting=site&tab=app_setting&act=index&webid=$webid");
    }


function phpiniset($webuser)
{?>
    <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= getFile($webuser."/web/.user.ini")?>
                                        </textarea>
<?php }
function webconfigset($webuser)
{?>
    <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= getFile($webuser."/web/web.config")?>
                                        </textarea>
<?php }
?>
<?php
function phpini_set($web_host,$web_ftp,$web_ftppass)
{?>
    <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= htmlspecialchars(ftpgetfile($web_host,$web_ftp,$web_ftppass,'web','.user.ini'))?>
                                        </textarea>
<?php }
function webconfig_set($web_host,$web_ftp,$web_ftppass)
{?>
    <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= htmlspecialchars(ftpgetfile($web_host,$web_ftp,$web_ftppass,'web','web.config'))?>
                                        </textarea>
<?php }
?>
