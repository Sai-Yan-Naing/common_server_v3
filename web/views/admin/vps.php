<?php require_once('header.php');?>
<div id="layoutSidenav">
<?php require_once('sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <h4 class="mb-4">契約サービス</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/admin" onclick="loading()">共用サーバー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/admin?main=vps" onclick="loading()">VPS/デスクトッププラン</a>
                            </li>
                        </ul>
                        <?php 
                            $limit = 2;  
                            $table = 'vps_account';
                            require_once('views/pagination/start.php'); 
                            $query = "SELECT * from $table where customer_id=? && `removal` is null LIMIT $start, $limit";
                            $commons = new Common;
                            $getAllRow = $commons->getAllRow($query,[$webadminID]);
                        ?>
                        <div>
                        <table class="table table-borderless">
                            <thead>
                                <tr class="row">
                                <th class="col-sm-3">Ip</th>
                                <th class="col-sm-3">プラン</th>
                                <th class="col-sm-2">設定</th>
                                <th class="col-sm-2">サーバー</th>
                                <th class="col-sm-2">解約</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($getAllRow as $key=>$vps):
                                    ?>
                                    <tr class="row">
                                    <td class="col-sm-3"><?=$vps['ip'] ?></td>
                                    <td class="col-sm-3">4 プラン</td>
                                    <td class="col-sm-2">
                                        <a href="/admin/vps/server?tab=connection&act=index&webid=<?= $vps['id'].$pagy ?>" class="btn btn-outline-info btn-sm" target="_blank">設定</a>
                                    </td>
                                    <td class="col-sm-2">
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
                                    <td class="col-sm-2">
                                        <button type="button" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/vps?act=delete&act_id=<?= $vps[id]?><?=$pagy?>"  data-toggle="modal" data-target="#common_dialog">削除</button>
                                    </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        </div>
                        <div class="d-flex  justify-content-center">
                            <div class="row justify-content-center col-sm-10 ">
                                <div class="col-sm-3"><a href="/admin/domain-transfer?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">ドメイン取得/移管</a></div>
                                <div class="col-sm-3"><a href="/admin/add-server?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">サーバー追加</a></div>
                                <div class="col-sm-3"><a href="/admin/dns?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">DNS情報</a></div>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div></div>
                            <div class='ml-auto'>
                                <?php 
                                    $paginatecount = "SELECT COUNT(*) FROM $table WHERE `customer_id` = ? && `removal` is null";
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