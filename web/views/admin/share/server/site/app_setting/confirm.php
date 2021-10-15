<?php
require_once("views/admin/admin_shareconfig.php");
$webappversion = json_decode($webappversion);
    if ( isset($_GET['apply']) && $_GET['apply'] ==='web.config')
    {
        $file = $webrootuser."/".$webuser."/web/web.config";
        $value = $_POST['web_config'];
        putFile($file,$value);
        webconfigset($webrootuser.'/'.$webuser);
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='.user.ini')
    {
        $file = $webrootuser."/".$webuser."/web/.user.ini";
        $value = $_POST['php_ini'];
        putFile($file,$value);
        phpiniset($webrootuser.'/'.$webuser);
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='dotnet_version')
    {
        $version = $_POST['version'];
        shell_exec("%systemroot%\system32\inetsrv\APPCMD set apppool $webuser /managedRuntimeVersion:$version");
        $webappversion->app->dotnet=$version;
        $temp=$webappversion;
        $result=json_encode($temp);
        $query_dir = "UPDATE web_account SET app_version='$result' WHERE id= ?";
        $commons->doThis($query_dir,[$webid]);
        header("location: /admin/share/server?setting=site&tab=app_setting&act=index&webid=$webid");
        die();
    }

    if ( isset($_GET['apply']) && $_GET['apply'] ==='php_version')
    {
        $version = $_POST['version'];
        $exec = "e:/scripts/php_version/php_version_change.bat $webuser $version";

        echo shell_exec($exec);
        $webappversion->app->php=$version;
        $temp=$webappversion;
        $result=json_encode($temp);
        // print_r($result);
        $query_dir = "UPDATE web_account SET app_version='$result' WHERE id='$webid'";
        $commons->doThis($query_dir);
        header("location: /admin/share/server?setting=site&tab=app_setting&act=index&webid=$webid");
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
