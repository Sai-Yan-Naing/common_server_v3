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
                                        <a class="nav-link active" aria-current="page" href="/admin">共用サーバー</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/admin?main=vps">VPS/デスクトッププラン</a>
                                    </li>
                                </ul>
                                <?php  
                                    $query = "SELECT * FROM web_account WHERE `customer_id` = 'D000123' && `removal` is null";
                                    $commons = new Common;
                                    $multidomain=$commons->getAllRow($query);
                                ?>
                                <div>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="row">
                                            <th class="col-sm-2">契約ドメイン</th>
                                            <th class="col-sm-2">サイト設定</th>
                                            <th class="col-sm-2">使用容量</th>
                                            <th class="col-sm-1">サイト</th>
                                            <th class="col-sm-2">アプリケーションプール</th>
                                            <th class="col-sm-2">エイリアス</th>
                                            <th class="col-sm-1">削除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($multidomain as $domain){
                                        ?>
                                        <tr class="row">
                                            <td class="col-sm-2"><a href="http://<?=$domain[domain]?>" target="_blank" class="text-dark"><?=$domain['domain']?></a></td>
                                            <td class="col-sm-2">
                                                <a href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$domain[id]?>" target="_blank" class="btn btn-sm btn-outline-info">設定</a>
                                            </td>
                                            <td class="col-sm-2">
                                                <span><?php if($domain['origin']!=1){ echo sizeFormat(folderSize("E:/webroot/LocalUser/".$multidomain[0]['user']."/$domain[user]"));}else{echo sizeFormat(folderSize("E:/webroot/LocalUser/$domain[user]"));} ?></span>
                                            </td>
                                            <td class="col-sm-1">
                                                <form action="" method = "post">
                                                    <input type="hidden" name="app" value="site">
                                                    <input type="hidden" name="domain" value="<?=$domain['domain'] ?>">
                                                    <label class="switch text-white common_dialog" gourl="/admin/multiple_domain?act=onoff&act_id=<?= $domain[id]?>"  data-toggle="modal" data-target="#common_dialog">
                                                        <input type="checkbox" <?= $domain['stopped']==0? "checked":""  ?>>
                                                        <span class="slider <?= $domain['stopped']==0? "slideron":"slideroff"  ?>"></span>
                                                        <span class="handle <?= $domain['stopped']==0? "handleon":"handleoff"  ?>"></span>
                                                        <span class="<?= $domain['stopped']==0? "labelon":"labeloff"  ?>"><?= $domain['stopped']==0? "起動":"停止"  ?></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td class="col-sm-2">
                                                <form action="" method = "post">
                                                    <input type="hidden" name="app" value="site">
                                                    <input type="hidden" name="domain" value="<?=$domain['domain'] ?>">
                                                    <label class="switch text-white common_dialog"  gourl="/admin/multiple_domain?act=apponoff&act_id=<?= $domain[id]?>"  data-toggle="modal" data-target="#common_dialog">
                                                        <input type="checkbox" <?= $domain['appstopped']==0? "checked":""  ?>>
                                                        <span class="slider <?= $domain['appstopped']==0? "slideron":"slideroff"  ?>"></span>
                                                        <span class="handle <?= $domain['appstopped']==0? "handleon":"handleoff"  ?>"></span>
                                                        <span class="<?= $domain['appstopped']==0? "labelon":"labeloff"  ?>"><?= $domain['appstopped']==0? "起動":"停止"  ?></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td class="col-sm-2">
                                            <button class="btn btn-sm common_dialog <?= $domain['sitebinding']==0? "btn-outline-danger":"btn-outline-info"  ?>" gourl="/admin/multiple_domain?act=sitebinding&act_id=<?= $domain[id]?>"  data-toggle="modal" data-target="#common_dialog"><?= $domain['sitebinding']==0? "削除":"追加"  ?></button>
                                            </td>
                                            <td class="col-sm-1">
                                            <?php if($domain['origin']!=1){?>
                                                <button class="btn btn-sm btn-outline-danger common_dialog" gourl="/admin/multiple_domain?act=delete&act_id=<?= $domain[id]?>"  data-toggle="modal" data-target="#common_dialog">削除</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                                <div class="d-flex  justify-content-center">
                                    <div class="row justify-content-center col-sm-10 ">
                                        <div class="col-sm-3"><button class="btn btn-outline-info form-control common_dialog" gourl="/admin/multiple_domain?act=new" data-toggle="modal" data-target="#common_dialog">マルチドメイン追加</button></div>
                                        <div class="col-sm-3"><a href="/admin/domain-transfer?tab=share&act=index" class="btn btn-outline-info form-control">ドメイン取得/移管</a></div>
                                        <div class="col-sm-3"><a href="/admin/add-server?tab=share&act=index" class="btn btn-outline-info form-control">サーバー追加</a></div>
                                        <div class="col-sm-3"><a href="/admin/dns?tab=share&act=index" class="btn btn-outline-info form-control">DNS情報</a></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('footer.php'); ?>