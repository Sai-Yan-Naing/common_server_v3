<?php require_once('views/admin/header.php');?>
        <div id="layoutSidenav">
        <?php require_once('views/admin/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main class="main-page">
                    <div class="container-fluid px-4 server">
						<?php require_once('views/admin/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <p class="saba"><span class="saba-tsuika">サーバー追加</span></p>
                                    <div class="row row-border">
                                        <div class="col-sm-3">
                                            <div class="kyoyo-saba">共用サーバー</div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="vps-saba">VPSサーバー</div>
                                            <div class="vps-btn btn-group" role="group" data-toggle="buttons">
                                                <button type="button" class="btn btn-primary btn-ssd active" onclick="vpsSSD()" checked autocomplete="off"> SSD</button>
                                                <button type="button" class="btn btn-primary btn-hdd" onclick="vpsHDD()" autocomplete="off"> HDD</button>
                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="wd-saba">WindowsDesktop</div>
                                            <div class="wd-btn btn-group" role="group" data-toggle="buttons">
                                                <button type="button" class="btn btn-primary btn-ssd" onclick="wdSSD()" autocomplete="off"> SSD</button>
                                                <button type="button" class="btn btn-primary btn-hdd" onclick="wdHDD()" autocomplete="off"> HDD</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="senyo-saba">専用サーバー</div>
                                        </div>
                                    </div>

                                    <div class="row saba-result">
                                        <div id="vps-ssd"> VPS SSD </div>
                                        <div id="vps-hdd"> VPS HDD </div>
                                        <div id="wd-ssd"> WD SSD </div>
                                        <div id="wd-hdd"> WD HDD </div>
                                    </div>
                                    <div class="back-button"><a href="/admin"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
                                </div>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('views/admin/footer.php'); ?>