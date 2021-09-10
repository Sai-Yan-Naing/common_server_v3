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
                            <?php require_once("views/admin/vps/various/option/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3">
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=sql_license" method="post" id="sql_server_edition">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                SQL Server Web Edition追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=rdl" method="post" id="remote_desktop_license">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                Remote Desktop License追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="request" placeholder="個">
                                            </div>
                                            <div class="col-sm-2">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=office_l" method="post" id="office_license">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                OFFICE追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="request" placeholder="個">
                                            </div>
                                            <div class="col-sm-2">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=window_server_license" method="post" id="window_server_license">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                Windows Server Security追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span>年額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=site_guard_license" method="post" id="site_guard_license">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                Site Gird Server Edition追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/admin/vps/option/license_confirm?&webid=<?=$webid?>&act=ssl_license" method="post" id="ssl_license">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                SSL証明書追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span>年額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div> 
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/vps/footer.php"); ?>
