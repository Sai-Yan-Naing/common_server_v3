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
                                        <form action="/admin/vps/various?setting=option&tab=spec&act=confirm&webid=<?=$webid?>" method="post" id="spec_option" onsubmit="loading()">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                メモリ追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="memory" placeholder="GB">
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                コア追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="cpu" placeholder="コア">
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                ディスク追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="disk" placeholder="GB">
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IPアドレス追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="ip_address" placeholder="個">
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                仮想スイッチ追加
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="virtual_switch" placeholder="個">
                                            </div>
                                            <div class="col-sm-3">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        </form>
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
