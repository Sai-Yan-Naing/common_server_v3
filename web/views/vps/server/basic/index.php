<?php require_once('views/vps/header.php'); ?>
    <div id="layoutSidenav">
        <?php require_once('views/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/vps/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/vps/server/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                        <form action="" method="post">
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
                                                    <span>GB</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">ストレージ</label>
                                                <div class="col-sm-8">
                                                    <span>GB</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-5">
                                                    <a href="" class="btn btn-outline-info btn-sm">プラン変更依頼</a>
                                                    <a href="" class="btn btn-outline-info btn-sm">OS初期化</a>
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
 <?php require_once("views/vps/footer.php"); ?>
