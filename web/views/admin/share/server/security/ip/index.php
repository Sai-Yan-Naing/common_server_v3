<?php require_once('views/admin/share/header.php'); ?>
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
                                                <span>IPアクセス制限</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=security&tab=ip&act=new&webid=<?= $webid?>" data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ブラックリストに追加</button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex mb-2">
                                                <div class="col-sm-3">ブラックリスト</div>
                                                <div class="text-danger col-sm-6"><span class="text-center"><?php if (isset($error)) {
                                                    echo $error;
                                                } ?></span></div>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">IP</th>
                                                    <th class="font-weight-bold border-dark">subnetMask</th>
                                                    <th class="font-weight-bold border-dark">Status</th>
                                                    <th class="font-weight-bold border-dark">Action</th>
                                                </tr>
                                                    <?php
                                                    $webblacklist = json_decode($webblacklist);
                                                        foreach($webblacklist as $key=>$value) {
                                                    ?>
                                                    <tr>
                                                        <td class="border-dark"><?= $value->ip ?></td>
                                                        <td class="border-dark"><?= $value->mask ?></td>
                                                        <td class="border-dark"><span class='text-danger'><?=$value->status?></span></td>
                                                        <td class="border-dark"><button class="pr-2 btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/server?setting=security&tab=ip&act=delete&act_id=<?= $key ?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">削除</button></td> 
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
