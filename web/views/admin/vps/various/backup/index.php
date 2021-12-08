<?php require_once('views/admin/vps/header.php'); ?>
<?php 
$query = "SELECT * FROM vps_backup WHERE ip=?";
$getvps=$commons->getRow($query,[$webip]);
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
                                        <h6>バックアップ</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="" class="col-form-label">手動バックアップ</label>
                                            </div>
                                            <div class="col-sm-7">
                                            <button class="btn btn-info btn-sm  common_dialog" gourl="/admin/vps/various?setting=backup&tab=backup&act=new&webid=<?= $webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>バックアップを実施</button>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="" class="col-form-label">自動バックアップに変更</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <form action="" method = "post" class="ml-2">
                                                    <input type="hidden" name="action" value="onoff">
                                                    <input type="hidden" name="key" value="<?=$key;?>">
                                                    <label class="switch text-white common_dialog" gourl="/admin/vps/various?setting=backup&tab=backup&act=autobackup&webid=<?= $webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                        <input type="checkbox" <?= $getvps['scheduler']==1? "checked":""  ?>>
                                                        <span class="slider <?= $getvps['scheduler']==1? "slideron":"slideroff"  ?>"></span>
                                                        <span class="handle <?= $getvps['scheduler']==1? "handleon":"handleoff"  ?>"></span>
                                                        <span class="<?= $getvps['scheduler']==1? "labelon":"labeloff"  ?>"><?= $getvps['scheduler']==1? "起動":"停止"  ?></span>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="changeBackup">
                                        <table class="table mt-3 table-bordered">
                                            <tr>
                                                <th class="font-weight-bold border-dark">バックアップデータ</th>
                                                <th class="font-weight-bold border-dark">日付</th>
                                                <th class="font-weight-bold border-dark">操作</th>
                                            </tr>
                                                <?php 
                                                    $getAllRow=$commons->getAllRow("SELECT * FROM vps_backup WHERE ip='$webip'");
                                                    $dirname = "G:/vps_backup/$vps_backup[name]";
                                                    foreach ($getAllRow as $key => $vps_backup) :
                                                ?>
                                            <tr>
                                                <td class="border-dark"><?= $vps_backup['name'] ?></td>
                                                <td class="border-dark"><?= $vps_backup['date'] ?></td>
                                                <td class="border-dark">
                                                    <button data-toggle="modal" class="btn btn-outline-info btn-sm  common_dialog" gourl="/admin/vps/various?setting=backup&tab=backup&act=restore&webid=<?=$webid?>" data-toggle="modal" data-target="#common_dialog">リストア</button>
                                                    <button class="btn btn-outline-danger btn-sm  common_dialog" gourl="/admin/vps/various?setting=backup&tab=backup&act=delete&act_id=<?= $vps_backup['id']?>&webid=<?=$webid?>" data-toggle="modal" data-target="#common_dialog">削除</button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                        <div class="mb-3">
                                            バックアップについて１世代分バックアップすることが可能です。
                                        </div>  
                                        <div class="mb-4">
                                            ※サーバー負荷状況により正しく取れない場合もありますのでお客様の方でもバックアップをお取りいただきますようよろしくお願いいたします。
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
