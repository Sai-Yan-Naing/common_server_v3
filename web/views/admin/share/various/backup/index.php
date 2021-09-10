<?php require_once('views/admin/share/header.php'); ?>
<?php 
// $dirname = "G:/backup/$webuser/";

// $backup = new Backup;
// $get_backup = $backup->checkScheduler($webdomain);
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
                                <div class="tab-content">
                                    <div class="mb-3">バックアップ</div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span>自動バックアップ</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <form action="/admin/share/various/backup?confirm&webid=<?=$webid?>" method = "post">
                                                <input type="hidden" name="action" value="auto_backup">
                                                <label class="switch text-white">
                                                    <input type="checkbox" <?= (int)$get_backup['scheduler']==1? "checked":""  ?>>
                                                    <span class="slider <?= (int)$get_backup['scheduler']==1? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= (int)$get_backup['scheduler']==1? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= (int)$get_backup['scheduler']==1? "labelon":"labeloff"  ?>"><?= (int)$get_backup['scheduler']==1? "停止":"起動"  ?></span>
                                                </label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <span>自動バックアップ</span>
                                        </div>
                                        <div class="col-sm-5">
                                            <button class="btn btn-outline-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/various/backup?act=new&webid=<?=$webid?>"><span class=""><i class="fas fa-plus"></i></span>バックアップを実施</button>
                                        </div>
                                    </div>
                                    <div id="changeBackup">
                                    <?php
                                        $file = showFolder($dirname);
                                        if($file){
                                    ?>
                                        <table class="table mt-3 table-bordered">
                                            <thead>
                                            <tr>
                                                <th>バックアップデータ</th>
                                                <th>バックアップ日</th>
                                                <th>作業</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?= $file ?></td>
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dirname.$file)) ?></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#common_modal" class="btn btn-warning btn-sm common_dialog"  gourl="/admin/share/various/backup?act=restore&webid=<?=$webid?>">リストア</button>
                                                    <button  data-toggle="modal" data-target="#common_modal" class="btn btn-danger btn-sm common_dialog"  gourl="/admin/share/various/backup?act=delete&webid=<?=$webid?>"><i class="fas fa-trash text-white"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <?php 
                                        } 
                                    ?>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
