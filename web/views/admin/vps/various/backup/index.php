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
                                        <h6>バックアップ</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="" class="col-form-label">手動バックアップ</label>
                                            </div>
                                            <div class="col-sm-7">
                                            <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/vps/backup/new?server=vps&setting=various&tab=backup&action=new&webid=<?=$webid?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>バックアップを実施</button>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="" class="col-form-label">自動バックアップ</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <form action="" method = "post" class="ml-2">
                                                    <input type="hidden" name="action" value="onoff">
                                                    <input type="hidden" name="key" value="<?=$key;?>">
                                                    <label class="switch text-white">
                                                        <input type="checkbox" <?= $domain['stopped']==0? "checked":""  ?>>
                                                        <span class="slider <?= $domain['stopped']==0? "slideron":"slideroff"  ?>"></span>
                                                        <span class="handle <?= $domain['stopped']==0? "handleon":"handleoff"  ?>"></span>
                                                        <span class="<?= $domain['stopped']==0? "labelon":"labeloff"  ?>"><?= $domain['stopped']==0? "停止":"起動"  ?></span>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="changeBackup">
                                        <table class="table mt-3 table-bordered">
                                            <tr>
                                                <th class="font-weight-bold border-dark">バックアップデータ</th>
                                                <th class="font-weight-bold border-dark">Date</th>
                                                <th class="font-weight-bold border-dark">Action</th>
                                            </tr>
                                                <?php 
                                                    $getAllRow=$commons->getAllRow("SELECT * FROM vps_backup WHERE ip='$webip'");
                                                    $dirname = "G:/vps_backup/$vps_backup[name]";
                                                    foreach ($getAllRow as $key => $vps_backup) {
                                                ?>
                                            <tr>
                                                <td class="border-dark"><?= $vps_backup['name'] ?></td>
                                                <td class="border-dark"><?= $vps_backup['date'] ?></td>
                                                <td class="border-dark">
                                                    <button data-toggle="modal" data-target="#common_modal" class="btn btn-warning btn-sm common_dialog"  gourl="/admin/vps/backup/restore?server=vps&setting=various&tab=backup&act=restore&act_id=<?=$vps_backup[id]?>&webid=<?=$webid?>">リストア</button>
                                                    <button  data-toggle="modal" data-target="#common_modal" class="btn btn-danger btn-sm common_dialog"  gourl="/admin/vps/backup/delete?server=vps&setting=various&tab=backup&act=delete&act_id=<?=$vps_backup[id]?>&webid=<?=$webid?>"><i class="fas fa-trash text-white"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                        <div class="mb-3">
                                            バックアップについて１世代分バックアップすることが可能です。
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
