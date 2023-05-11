<?php require_once('views/admin/vps/header.php'); ?>
<div id="layoutSidenav">
<?php require_once('views/admin/vps/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/vps/title.php') ?>
                    <?php require_once('views/admin/vps/server/subtitle.php') ?>
                    <?php
                    $plan = "SELECT [plan] FROM vps_account Where id=?";
                    $getpln = $commons->getRow($plan,[$webid]);
                    $plan_ = $getpln['plan'];
                    $query = "SELECT spec_info.value,price_tbl.plan_name, spec_units.[key] FROM service_db.dbo.price_tbl
                    inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
                    INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
					AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
                    $getspec = $commons->getSpec($query,[$plan_]);
                    $spec = [
                        "plan_name"=>$getspec[0]['plan_name'], 
                        "memory"=>$getspec[0]['value'], 
                        "disk_hdd"=>$getspec[1]['value'],
                        "core" => $getspec[2]['value']];
                    ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <!-- start -->
                        <div class="tab-content">
                            <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">OS</label>
                                        <div class="col-sm-8">
                                            <span><?= $web_osname?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">契約プラン</label>
                                        <div class="col-sm-8">
                                            <span><?= $spec['plan_name']  ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">メモリ</label>
                                        <div class="col-sm-8">
                                            <span><label for=""><?= $spec['memory']  ?></label> GB</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">ストレージ</label>
                                        <div class="col-sm-8">
                                            <span><label for=""><?= $spec['disk_hdd']?></label> GB</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">CPU</label>
                                        <div class="col-sm-8">
                                            <span><label for=""><?= $spec['core']  ?></label> コア</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-5">
                                            <button type="button" name="request" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/vps/server?tab=basic&act=spec&webid=<?=$webid?>" data-toggle="modal" data-target="#common_dialog" onclick="get_state(event,'admin',<?= $webid?>)">プラン変更依頼</button>
                                            <button type="button" name="request" class="btn btn-outline-info btn-sm common_dialog vpsrebtn" gourl="/admin/vps/server?tab=basic&act=os&webid=<?=$webid?>" data-toggle="modal" data-target="#common_dialog" onclick="get_state(event,'admin',<?= $webid?>)">OS初期化</button>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
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
