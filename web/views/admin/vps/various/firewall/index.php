<?php require_once('views/admin/vps/header.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
if($web_os=='windows'):
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/vps/title.php') ?>
                            <?php require_once('views/admin/vps/various/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="contract">
                                    <div class="server-info">
                                        <h6>Firewall</h6>
                                        <h6>RemoteDesktop</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                ポート
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdp&webid=<?=$webid?>" id="change_rdp" method="post">
                                                <input type="text" required class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdp&webid=<?=$webid?>" id="change_rdpd" method="post">
                                                <input type="hidden" class="form-control" name="port" value="3389">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdpd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdip&webid=<?=$webid?>" id="change_rdip" method="post">
                                                <input type="text" required class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdip&webid=<?=$webid?>" id="change_rdipd" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdipd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            ※ポートの変更及び、デフォルトに戻した場合、再起動を実施します。
                                        </div>
                                        <h6>WEBアクセス</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                ポート
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdp&webid=<?=$webid?>" id="change_httprdp" method="post">
                                                <input type="text" required class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdp&webid=<?=$webid?>" id="change_httprdpd" method="post">
                                                <input type="hidden" class="form-control" name="port" value="80">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdpd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdip&webid=<?=$webid?>" id="change_httprdip" method="post">
                                                <input type="text" required class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdip&webid=<?=$webid?>" id="change_httprdipd" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdipd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 

<?php else: ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main class="main-page">
                        <div class="container-fluid px-4">
                                <?php require_once('views/admin/vps/title.php') ?>
                                <?php require_once('views/admin/vps/various/subtitle.php') ?>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <div class="contract" id='terminal' style="height: 500px;" gourl="/admin/vps/various?setting=firewall&tab=firewall&act=terminal&webid=<?=$webid?>">
                                        
                                    </div>
                                </div>
                        </div>
                </main>
            </div>
    </div>

    <script>
    $(function() {
    $('#terminal').terminal(function(command, term) {
        $gourl = $(this).attr('gourl');
        $url = document.URL.split("/");
        $url = $url[0] + "//" + $url[2];
        $url = $url + $gourl;
        term.pause();
        $.post($url, {command: command}).then(function(response) {
            term.echo(response).resume();
        });
    }, {
        greetings: 'Welcome to Winserver'
    });
});
  </script>

<?php endif; ?>
 <?php require_once("views/admin/vps/footer.php"); ?>

