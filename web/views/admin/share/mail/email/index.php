<?php require_once('views/admin/share/header.php'); ?>
<?php 
 $query = "SELECT * FROM add_email WHERE domain='$webdomain'";
 $getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/mail/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="active">
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-3">
                                                <span>メールアドレス</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages"><span class="mr-2"><i class="fas fa-plus-square"></i></span>メールアドレス追加</button>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">登録メールアドレス</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">Action</th>
                                                </tr>
                                                <?php 
                                                    foreach ($getAllRow as $key => $mail) {
                                                ?>
                                                <tr>
                                                    <td class="border-dark"><?= $mail['email'];?>@<?= $webdomain ?></td>
                                                    <td class="border-dark"><?= $mail['password'] ?></td>
                                                    <td class="border-dark">
                                                        <a href="javascript:;" data-toggle="modal" data-target="#common_modal" class="btn btn-warning btn-sm common_dialog"  gourl="/admin/share/mails?act=edit&webid=<?=$webid?>&act_id=<?=$mail['id']?>"><i class="fas fa-edit text-white"></i></a>
                                                        <a href="javascript:;"  data-toggle="modal" data-target="#common_modal" class="btn btn-danger btn-sm common_dialog"  gourl="/admin/share/mails?act=delete&webid=<?=$webid?>&act_id=<?= $mail['id']?>"><i class="fas fa-trash text-white"></i></a>
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
