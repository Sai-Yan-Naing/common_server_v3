<?php require_once('views/share/header.php'); ?>
<?php 
 $query = "SELECT * FROM add_email WHERE domain= ?";
 $getAllRow=$commons->getAllRow($query, $webdomain);
?>
<div id="layoutSidenav">
<?php require_once('views/share/sidebar.php');?>
    <div id="layoutSidenav_content">
    <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/share/title.php') ?>
                    <?php require_once('views/share/mail/subtitle.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <!-- start -->
                        <div class="tab-content">
                            <div class="active">
                                <div class="row mt-3 mb-3">
                                    <div class="col-sm-3">
                                        <span>メールアドレス</span>
                                    </div>
                                    <div class="col-sm-9">
                                        <button class="btn btn-info btn-sm common_dialog" gourl="/share/mail?setting=email&tab=tab&act=new&webid=<?= $webid?>" data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>メールアドレス追加</button>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                        <tr>
                                            <th class="font-weight-bold border-dark">登録メールアドレス</th>
                                            <th class="font-weight-bold border-dark">パスワード</th>
                                            <th class="font-weight-bold border-dark">Action</th>
                                        </tr>
                                        <?php 
                                            foreach ($getAllRow as $key => $mail) :
                                        ?>
                                        <tr>
                                            <td class="border-dark"><?= $mail['email'];?>@<?= $webdomain ?></td>
                                            <td class="border-dark"><?= $mail['password'] ?></td>
                                            <td class="border-dark">
                                                <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/share/mail?setting=email&tab=tab&act=edit&act_id=<?= $mail['id'] ?>"  data-toggle="modal" data-target="#common_dialog">編集</a>
                                                <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/share/mail?setting=email&tab=tab&act=delete&act_id=<?= $mail['id'] ?>"  data-toggle="modal" data-target="#common_dialog">削除</a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!-- end content -->
                    </div>
            </div>
        </main>
    </div>
</div> 
 <?php 
 require_once("views/share/footer.php"); 