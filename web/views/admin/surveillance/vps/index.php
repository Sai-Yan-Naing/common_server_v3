<?php require_once('views/admin/header.php');?>
<div id="layoutSidenav">
<?php require_once('views/admin/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <span style="display:none" id="checkvps" checkvps='all'></span>
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <h4 class="mb-4">契約サービス</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/admin" onclick="loading()">共用サーバー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin?main=vps" onclick="loading()">VPS/デスクトップ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/admin?main=surveillance&act=index" onclick="loading()">監視</a>
                            </li>
                        </ul>
                        <?php 
                            $query = "SELECT web_account.id as webid,* FROM web_account INNER JOIN plan_tbl on web_account.[plan] = plan_tbl.id WHERE customer_id = ? AND removal is null AND origin = 1";
                            $commons = new Common;
                            $contracts=$commons->getAllRow($query,[$webadminID]);
                            foreach ($contracts as $key => $contract):
                        ?>
                    <div class="mt-3">
                        <label><?= $contract['domain'] ?>【<?= $contract['name'] ?>】</label>
                        <div class="row">
                            <div class="col-md-2">URL監視</div>
                            <div class="col-md-2">月額５００円</div>
                            <div class="col-md-2">〇個設定済み</div>
                            <div class="col-md-2">○○円/月</div>
                            <div class="col-md-4">
                                <a href="/admin?main=surveillance&act=new&webid=<?=$contract['webid']?>" class="btn btn-info btn-sm">監視追加</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                        $query = "SELECT * FROM vps_account WHERE customer_id = ? AND removal is null";
                        $commons = new Common;
                        $getAllRow=$commons->getAllRow($query,[$webadminID]);
                        foreach ($getAllRow as $key => $vps):
                        ?>
                    <div>
                        <label><?= $vps['ip'] ?>【<?= $vps['instance'] ?>】</label>
                        <div class="row">
                            <div class="col-md-2">監視</div>
                            <div class="col-md-2">月額５００円</div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <a href="" class="btn btn-info btn-sm">監視追加</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php 
require_once('views/admin/footer.php');