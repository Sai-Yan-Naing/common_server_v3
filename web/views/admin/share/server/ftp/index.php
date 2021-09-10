<?php require_once('views/admin/share/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="active">
                                        <div class="ftp-title mb-3">ＦＴＰサーバー情報</div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <span>ＦＴＰサーバー</span>
                                                </div>
                                                <div class="col-sm-9">
                                                    <span><?= IP ?></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label>Root Folder</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label>/<?= $webuser ?></label>
                                                </div>
                                          </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-3">
                                                <span>FTPアカウント</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/security/directory?act=new&webid=<?=$webid?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ＦＴＰユーザー追加</button>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold">FTP ユーザー名</th>
                                                    <th class="font-weight-bold">パスワード</th>
                                                    <th class="font-weight-bold">書き込み権限</th>
                                                    <th class="font-weight-bold">Action</th>
                                                </tr>
                                                <?php 
                                                    foreach ($getAllRow as $key => $ftp) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $ftp['ftp_user']; ?></td>
                                                    <td><?php echo $ftp['ftp_pass']; ?></td>
                                                    <td><?php echo $ftp['permission']; ?></td>
                                                    <td>
                                                        <a href="javascript:;" data-toggle="modal" data-target="#common_modal" class="btn btn-outline-info btn-sm common_dialog"  gourl="/admin/share/servers/database?webid=<?=$webid;?>&act=edit&db=mysql&act_id=<?=$db['id']?>" edit_id="<?php echo $db['id']; ?>" db="MYSQL">編集</a>
                                                        <a href="javascript:;"  data-toggle="modal" data-target="#common_modal" class="btn btn-outline-danger btn-sm edit_database common_dialog"  gourl="/admin/share/servers/database?webid=<?=$webid?>&act=delete&db=mysql&act_id=<?=$db['id']?>" delete_id="<?php echo $db['id']; ?>" db="MYSQL">削除</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
