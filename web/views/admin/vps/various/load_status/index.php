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
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                        <h6>サーバー負荷状況</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                CPU
                                            </div>
                                            <div class="col-sm-6">
                                                Average of cpu usage : <span id="cpu_usage"><?= $cpu_usage ?>%</span>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if($cpu_usage<=60){ echo 'bg-success';}else if($cpu_usage>60 and $cpu_usage<80){ echo 'bg-warning';}else{echo 'bg-danger';} ?>" id="cpu" style="width:<?= $cpu_usage ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                            メモリ
                                            </div>
                                            <div class="col-sm-6">
                                                Average of memory usage : <span id="memory_usage"><?= $memory_usage ?>%</span>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if($memory_usage<=60){ echo 'bg-success';}else if($memory_usage>60 and $memory_usage<80){ echo 'bg-warning';}else{echo 'bg-danger';} ?>" id="memory" style="width:<?= $memory_usage ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                            ディスク読み書き
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="" readonly placeholder="1.2">
                                            </div>
                                            <div class="col-sm-2">
                                                平均10以下であれば問題ありません。
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            ※詳細な負荷状況の確認については、対象サーバーにログインの上、パフォーマンスモニタにてログを採取もしくは、モニターでご確認いただきますようお願いいたします。
                                        </div>
                                        <div class="mb-4">
                                            パフォーマンスモニター及び、ログの採取方法についてはマニュアルページよりご確認お願いいたします。
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
