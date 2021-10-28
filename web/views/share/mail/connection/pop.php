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
                            <div id="pop-imap" class="tab-pane active pl-3"><br>
                                <form action="" method="post" id="">
                                    <div class="form-group row">
                                        <label for="cserver-name" class="col-sm-3 col-form-label">接続サーバー名</label>
                                        <div class="col-sm-8">
                                        <span class="col-form-label"> mail.<?= htmlspecialchars($webdomain, ENT_QUOTES); ?> </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="con-port" class="col-sm-3 col-form-label">接続ポート</label>
                                        <div class="col-sm-8">
                                            <span class="col-form-label">110 (POP) /143 (IMAP)</span>
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
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <span class="border border-secondary notice-msg">
                                                弊社ではＩＭＡＰでの接続を推奨しておりません。メールサーバー側にメールデータが溜まることによりメール確認に時間がかかることがあります。ＰＯＰ接続いただくことで、スムーズなメールの送受信が可能です。
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <span class="border border-secondary notice-msg">
                                            メールクライアントの設定によりメールサーバーにメールデータが溜まることでメール容量が一杯になりメール受信ができなくなることがありますので、メールクライアントの設定で、「サーバーを残す」設定にしていただいた場合は、期限を設定するなどを行って頂き、メール容量を管理してください。
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <span class="border border-danger text-danger notice-msg">容量がオーバーした場合はＷＥＢメールにてログインいただき、不要なメールの削除を行ってください。</span>
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
