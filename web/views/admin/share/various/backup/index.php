<?php require_once('views/admin/share/header.php'); ?>
<?php 
$dirname = "G:/backup/$webuser/";

$backup = new Backup;
$get_backup = $backup->checkScheduler($webdomain);
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
                                                <label class="switch text-white common_dialog" gourl="/admin/share/various?setting=backup&act=onoff&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= (int)$get_backup['scheduler']==1? "checked":""  ?>>
                                                    <span class="slider <?= (int)$get_backup['scheduler']==1? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= (int)$get_backup['scheduler']==1? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= (int)$get_backup['scheduler']==1? "labelon":"labeloff"  ?>"><?= (int)$get_backup['scheduler']==1? "起動":"停止"  ?></span>
                                                </label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <span>自動バックアップ</span>
                                        </div>
                                        <div class="col-sm-5">
                                            <button class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/various?setting=backup&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class=""><i class="fas fa-plus"></i></span>バックアップを実施</button>
                                        </div>
                                    </div>
                                    <div id="changeBackup">
                                    <?php
                                        $file = showFolder($dirname);
                                        if($file):
                                    ?>
                                        <table class="table mt-3 table-bordered">
                                            <tr>
                                                <th class="border-dark">バックアップデータ</th>
                                                <th class="border-dark">バックアップ日</th>
                                                <th class="border-dark">作業</th>
                                            </tr>
                                            <tr>
                                                <td class="border-dark"><?= $file ?></td>
                                                <td class="border-dark"><?= date("Y-m-d h:i:sA", filemtime($dirname.$file)) ?></td>
                                                <td class="border-dark">
                                                    <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/various?setting=backup&act=restore&webid=<?=$webid?>"   data-toggle="modal" data-target="#common_dialog">リストア</a>
                                                    <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/various?setting=backup&act=delete&webid=<?=$webid?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php 
                                        endif;
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
