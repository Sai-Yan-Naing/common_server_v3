<?php require_once('views/share/header.php'); ?>
<?php 
    $query = "SELECT * FROM sub_ftp WHERE domain= ?";
    $getAllRow = $commons->getAllRow($query,[$webdomain]); 
?>
    <div id="layoutSidenav">
        <?php require_once('views/share/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/share/title.php') ?>
                            <?php require_once('views/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="ip-restriction" class=" pr-3 pl-3 pb-3 tab-pane active"><br>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <span>ディレクトリアクセス制限</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm  common_dialog" gourl="/share/server?setting=security&tab=directory&act=new&webid=<?= $webid?>" data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ディレクトリ追加</button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex mb-2">
                                                <div class="col-sm-3">Root path /<?=$webuser?>/web/</div>
                                                <div class="text-danger col-sm-6"><span class="text-center"><?php if (isset($error)) :
                                                    echo $error;
                                                endif; ?></span></div>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">ユーザー名</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">ディレクトリ</th>
                                                    <th class="font-weight-bold border-dark">Action</th>
                                                </tr>
                                                    <?php
                                                        foreach($getAllRow as $key=>$value):
                                                    ?>
                                                    <tr>
                                                        <td  class="border-dark"><?= $value['ftp_user'] ?></td>
                                                        <td  class="border-dark"><?= $value['ftp_pass'] ?></td>
                                                        <td  class="border-dark"><?=$value['path']?></td>
                                                        <td  class="border-dark">
                                                            <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/share/server?setting=security&tab=directory&act=edit&act_id=<?= $value['id'] ?>"  data-toggle="modal" data-target="#common_dialog">編集</a>
                                                            <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/share/server?setting=security&tab=directory&act=delete&act_id=<?= $value['id'] ?>"  data-toggle="modal" data-target="#common_dialog">削除</a>
                                                        </td> 
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
 <?php require_once("views/share/footer.php"); ?>
