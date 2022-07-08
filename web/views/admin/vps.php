<?php require_once('header.php');?>
<div id="layoutSidenav">
<?php require_once('sidebar.php');?>
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
                                <a class="nav-link active" href="/admin?main=vps" onclick="loading()">VPS/デスクトップ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin?main=surveillance&act=index" onclick="loading()">監視</a>
                            </li>
                        </ul>
                        <?php 
                            $limit = 10;  
                            $table = 'vps_account';
                            require_once('views/pagination/start.php'); 
                            $query = "SELECT * from $table where customer_id=? AND removal is null  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
                            $commons = new Common;
                            $getAllRow = $commons->getAllRow($query,[$webadminID]);
                        ?>
                        <div>
                        <table class="table table-borderless">
                            <thead>
                                <tr class="row">
                                <th class="vtb-width">IPアドレス</th>
                                <th class="vtb-width">プラン</th>
                                <th class="vtb-width">設定</th>
                                <th class="vtb-width">サーバー</th>
                                <th class="vtb-width">解約</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($getAllRow as $key=>$vps):
                                    $query = "SELECT spec_info.value,price_tbl.plan_name, spec_units.[key] FROM service_db.dbo.price_tbl
                                    inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
                                    INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
                                    AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
                                    $getspec = $commons->getSpec($query,[$vps['plan']]);
                                    $spec = [
                                        "plan_name"=>$getspec[0]['plan_name'], 
                                        "memory"=>$getspec[0]['value'], 
                                        "disk_hdd"=>$getspec[1]['value'],
                                        "core" => $getspec[2]['value']];
                                    ?>
                                    <tr class="row">
                                    <td class="vtb-width"><?=$vps['ip'] ?></td>
                                    <td class="vtb-width"><?= $spec['plan_name'] ?></td>
                                    <td class="vtb-width">
                                        <a href="/admin/vps/server?tab=connection&act=index&webid=<?= $vps['id'].$pagy ?>" class="btn btn-outline-info btn-sm" target="_blank">設定</a>
                                    </td>
                                    <td class="vtb-width">
                                            <form action="/admin/vps-confirm" method = "post">
                                                <input type="hidden" name="action" value="onoff">
                                                <input type="hidden" name="confirm" value="post">
                                                <input type="hidden" name="act_id" value="<?= $vps['id'] ?>">
                                                <label class="switch text-white common_dialog" gourl="/admin/vps?act=onoff&act_id=<?= $vps[id].$pagy?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $vps['active']!=0? "checked":""  ?>>
                                                    <span class="slider <?= $vps['active']!=0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $vps['active']!=0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $vps['active']!=0? "labelon":"labeloff"  ?>"><?= $vps['active']!=0? "起動":"停止"  ?></span>
                                                </label>
                                            </form>
                                    </td>
                                    <td class="vtb-width">
                                        <button type="button" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/vps?act=delete&act_id=<?= $vps[id]?><?=$pagy?>"  data-toggle="modal" data-target="#common_dialog">解約</button>
                                    </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center hbtn">
                                <div class="col-lg-3"><a href="/admin/domain-transfer?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">ドメイン取得/移管</a></div>
                                <div class="col-lg-3"><a href="/admin/add-server?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">サーバー追加</a></div>
                                <div class="col-lg-3"><a href="/admin/dns?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">DNS情報</a></div>
                        </div>
                        <div class="d-flex mt-3">
                            <div></div>
                            <div class='ml-auto'>
                                <?php 
                                    $paginatecount = "SELECT COUNT(*) FROM $table WHERE customer_id = ? AND removal is null";
                                    $params = [$webadminID];
                                    $page_url = '/admin?main=vps&page=';
                                    require_once('views/pagination/end.php')
                                ?>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
    </div>
</div>
<?php 
require_once('footer.php');