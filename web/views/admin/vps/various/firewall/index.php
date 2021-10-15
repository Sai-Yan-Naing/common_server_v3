<?php require_once('views/admin/vps/header.php'); ?>
<?php 
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
                                                <input type="text" class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="change_rdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=default_rdp&webid=<?=$webid?>" id="default_rdp" method="post">
                                                <input type="hidden" class="form-control" name="port" value="3389">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="default_rdp">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdip&webid=<?=$webid?>" id="change_rdip" method="post">
                                                <input type="text" class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="change_rdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=default_rdip&webid=<?=$webid?>" id="default_rdip" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="default_rdip">デフォルトに戻す</button>
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
                                                <input type="text" class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="change_httprdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=default_httprdp&webid=<?=$webid?>" id="default_httprdp" method="post">
                                                <input type="hidden" class="form-control" name="port" value="80">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="default_httprdp">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdip&webid=<?=$webid?>" id="change_httprdip" method="post">
                                                <input type="text" class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="change_httprdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=default_httprdip&webid=<?=$webid?>" id="default_httprdip" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info" form="default_httprdip">デフォルトに戻す</button>
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
 <?php require_once("views/admin/vps/footer.php"); ?>
