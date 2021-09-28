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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="sql_server_edition">
                                    <input type="hidden" name="act" value="sql_license">
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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="remote_desktop_license">
                                    <input type="hidden" name="act" value="rdl">
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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="office_license">
                                    <input type="hidden" name="act" value="office_l">
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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="window_server_license">
                                    <input type="hidden" name="act" value="window_server_license">
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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="site_guard_license">
                                    <input type="hidden" name="act" value="site_guard_license">
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
                                    <form action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="ssl_license">
                                    <input type="hidden" name="act" value="ssl">
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
