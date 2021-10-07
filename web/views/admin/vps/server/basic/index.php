<?php require_once('views/admin/vps/header.php'); ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/vps/title.php') ?>
                            <?php require_once('views/admin/vps/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                        <form action="/admin/vps/server?tab=basic&act=confirm&webid=<?=$webid?>" method="post">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">OS</label>
                                                <div class="col-sm-8">
                                                    <span>Windows server 2019</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">契約プラン</label>
                                                <div class="col-sm-8">
                                                    <span>SSD1902-16GB</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">メモリ</label>
                                                <div class="col-sm-8">
                                                    <span><input type="text" name="memory" value="<?=$web_memory?>"> GB</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">ストレージ</label>
                                                <div class="col-sm-8">
                                                    <span><input type="text" name="storage" value="<?=$web_storage?>"> GB</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label"> cpu</label>
                                                <div class="col-sm-8">
                                                    <span><input type="text" name="cpu" value="<?=$web_cpu?>"> プラン</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-5">
                                                    <button type="submit" name="request" class="btn btn-outline-info btn-sm">プラン変更依頼</button>
                                                    <button type="submit" name="osreinstall" class="btn btn-outline-info btn-sm">OS初期化</button>
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                        </form>
                                        <div class="mb-4">※OS初期化の場合、サーバーの再設定まで少しお時間をいただきますので予めご了承下さい。</div>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/vps/footer.php"); ?>
