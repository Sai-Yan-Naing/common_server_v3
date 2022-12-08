<?php require_once('views/admin/share/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain=?";
$getAllRow=$commons->getAllRow($query,[$webdomain]);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/various/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="contract">
                                    <div class="server-info">
                                            <div class="mb-1 d-flex">
                                                <label for="con-server" class="col-sm-3 col-form-label">接続サーバー</label>
                                                <div class="col-sm-8"><span class="col-form-label"><?= $web_host ?></span></div>
                                            </div>
                                            <div class="mb-1 d-flex">
                                                <label for="status" class="col-sm-3 col-form-label">ステータス</label>
                                                <div class="col-sm-2"><span class="col-form-label"> <?= $webstopped==0? "起動中":"停止中" ?> </span></div>
                                                <label class="switch text-white common_dialog" gourl="/admin/share/various?setting=information&act=onoff&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $webstopped==0? "checked":""  ?>>
                                                    <span class="slider <?= $webstopped==0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $webstopped==0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $webstopped==0? "labelon":"labeloff"  ?>"><?= $webstopped==0? "起動":"停止"  ?></span>
                                                </label>
                                            </div>
                                            <div class="mb-1 d-flex">
                                                <label for="app-pool" class="col-sm-3 col-form-label">アプリケーションプール</label>
                                                <div class="col-sm-2"><span class="col-form-label"> <?= $webappstopped==0? "起動中":"停止中"  ?> </span></div>
                                                <label class="switch text-white common_dialog" gourl="/admin/share/various?setting=information&act=apponoff&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $webappstopped==0? "checked":""  ?>>
                                                    <span class="slider <?= $webappstopped==0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $webappstopped==0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $webappstopped==0? "labelon":"labeloff"  ?>"><?= $webappstopped==0? "起動":"停止"  ?></span>
                                                </label>
                                            </div>
                                            <div class="mb-1 d-flex">
                                                <label for="capacity-used" class="col-sm-3">使用ディスク容量</label>
                                                <!--<div class="col-sm-4" ><progress id="capacity-used" max="100" value="70"> </progress></div>-->
                                                <!-- <div class="col-sm-4" id="chartContainer" style="height: 300px; width: 100%;"> </div> -->
                                                <div class="col-sm-4"><span><?php if($weborigin!=1): echo sizeFormat(folderSize($web_host,$web_user,$web_password,$webrootuser."/$webuser"));else:echo sizeFormat(folderSize($web_host,$web_user,$web_password,$webuser));endif; ?></span></div>
                                            </div>
                                        <!-- <form action="/admin/share/various?confirm&webid=<?=$webid?>" method = "post" id="site-onoff">
                                            <input type="hidden" name="app" value="site">
                                        </form>
                                        <form action="/admin/share/various?confirm&webid=<?=$webid?>" method = "post" id="app-onoff">
                                            <input type="hidden" name="app" value="app">
                                        </form> -->
                                        <div class='ml-3 mr-2'>
                                            <div style="font-size: 1.2rem;">DNS</div>
                                            <table class="table table-bordered">
                                                <tr class="">
                                                    <th class="font-weight-bold border-dark">タイプ</th>
                                                    <th class="font-weight-bold border-dark">ホスト名</th>
                                                    <th class="font-weight-bold border-dark">ドメイン名</th>
                                                    <th class="font-weight-bold border-dark">IPアドレス/ドメイン名</th>
                                                </tr>
                                                    <?php
                                                        foreach(json_decode($webdns) as $key=>$value):
                                                    ?>
                                                <tr class="">
                                                    <td class="border-dark"><?= $value->type; ?></td>
                                                    <td class="border-dark"><?= $value->sub; ?></td>
                                                    <td class="border-dark">.<?=$webdomain?></td>
                                                    <td class="border-dark"><?= $value->target; ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </table>
                                        </div>
                                    </div>
                                
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
