<?php require_once('views/share/header.php'); ?>
<div id="layoutSidenav">
    <?php require_once('views/share/sidebar.php');?>
        <div id="layoutSidenav_content">
        <main class="main-page">
                <div class="container-fluid px-4">
                        <?php require_once('views/share/title.php') ?>
                        <?php require_once('views/share/mail/subtitle.php') ?>
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <?php require_once("views/share/mail/$setting/tab.php") ?>
                            <!-- start -->
                            <div class="tab-content">
                                <div id="smtp" class="tab-pane active pl-3"><br>
                                    <form action="" method="post" id="" />
                                        <div class="form-group row">
                                            <label for="cserver-name" class="col-sm-3 col-form-label">接続サーバー名</label>
                                            <div class="col-sm-8">
                                            <span class="col-form-label"><?= htmlspecialchars($maildomain, ENT_QUOTES); ?> </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="con-port" class="col-sm-3 col-form-label">接続ポート</label>
                                            <div class="col-sm-8">
                                                <span class="col-form-label"> 587 </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="protect-method" class="col-sm-3 col-form-label">接続保護方法</label>
                                            <div class="col-sm-8">
                                                <span class="col-form-label"> 接続の保護なし </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="authen-method" class="col-sm-3 col-form-label">認証方式</label>
                                            <div class="col-sm-8">
                                                <span class="col-form-label"> 通常のパスワード認証 </span>
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
 <?php require_once("views/share/footer.php"); ?>
