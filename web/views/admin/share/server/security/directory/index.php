<?php require_once('views/admin/share/header.php'); ?>
<?php 
    $query = "SELECT * FROM sub_ftp WHERE domain='$webdomain'";
    $getAllRow = $commons->getAllRow($query); 
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/admin/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="ip-restriction" class=" pr-3 pl-3 pb-3 tab-pane active"><br>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <span>ディレクトリアクセス制限</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/security/directory?act=new&webid=<?=$webid?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ディレクトリ追加</button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex mb-2">
                                                <div class="col-sm-3">Root path /<?=$webuser?>/web/</div>
                                                <div class="text-danger col-sm-6"><span class="text-center"><?php if (isset($error)) {
                                                    echo $error;
                                                } ?></span></div>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">ユーザー名</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">ディレクトリ</th>
                                                    <th class="font-weight-bold border-dark">Action</th>
                                                </tr>
                                                    <?php
                                                        foreach($getAllRow as $key=>$value) {
                                                    ?>
                                                    <tr>
                                                        <td  class="border-dark"><?= $value['ftp_user'] ?></td>
                                                        <td  class="border-dark"><?= $value['ftp_pass'] ?></td>
                                                        <td  class="border-dark"><?=$value['path']?></td>
                                                        <td  class="border-dark">
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
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
