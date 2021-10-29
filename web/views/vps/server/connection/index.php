<?php require_once('views/vps/header.php'); ?>
<div id="layoutSidenav">
<?php require_once('views/vps/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/vps/title.php') ?>
                    <?php require_once('views/vps/server/subtitle.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <!-- start -->
                        <div class="tab-content">
                            <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                            <form action="/vps/server?tab=connection&act=confirm" method="post" onsubmit="loading()">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label">グローバルIPアドレス</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <span><?=$webip?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label">管理者ID</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <span><?= WINSERVERROOT ?></span>
                                    </div>
                                </div>
                                <h6>PASSWORD変更</h6>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control" name="password" placeholder="12～40文字、英数記号大小文字組み合わせ">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-sm btn-outline-info form-control">変更</button>
                                    </div>
                                </div>
                                </form>
                                <div class="mb-4">
                                    <span>月次のキャンペーン内容をテキストで表示（顧客DBから参照）バナーはしつこいのでなし。テキストのみ</span>
                                </div>
                            </div>
                        </div>
                        <!-- end content -->
                    </div>
            </div>
        </main>
    </div>
</div> 
 <?php require_once("views/vps/footer.php"); ?>
