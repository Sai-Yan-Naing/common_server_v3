<?php require_once('views/admin/share/header.php'); ?>
<?php 
$query = "SELECT * FROM db_account_for_mariadb where domain = '$webdomain'";
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
                                    <div class="active">
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-3">
                                                <span>データベース</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/security/directory?act=new&webid=<?=$webid?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>データベース追加</button>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">データベース名</th>
                                                    <th class="font-weight-bold border-dark">ユーザー名</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">編集</th>
                                                    <th class="font-weight-bold border-dark">接続先情報</th>
                                                </tr>
                                                <?php 
                                                    foreach($getAllRow as $db) {
                                                ?>
                                                <tr>
                                                    <td class="border-dark"><?php echo $db['db_name']; ?></td>
                                                    <td class="border-dark"><?php echo $db['db_user']; ?></td>
                                                    <td class="border-dark"><?php echo $db['db_pass']; ?></td>
                                                    <td class="border-dark">
                                                        <a href="javascript:;" data-toggle="modal" data-target="#common_modal" class="btn btn-outline-info btn-sm common_dialog"  gourl="/admin/share/servers/database?webid=<?=$webid;?>&act=edit&db=mysql&act_id=<?=$db['id']?>" edit_id="<?php echo $db['id']; ?>" db="MYSQL">編集</a>
                                                        <a href="javascript:;"  data-toggle="modal" data-target="#common_modal" class="btn btn-outline-danger btn-sm edit_database common_dialog"  gourl="/admin/share/servers/database?webid=<?=$webid?>&act=delete&db=mysql&act_id=<?=$db['id']?>" delete_id="<?php echo $db['id']; ?>" db="MYSQL">削除</a>
                                                    </td>
                                                    <td class="border-dark">情報</td>
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
