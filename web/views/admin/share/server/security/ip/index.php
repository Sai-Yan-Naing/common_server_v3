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
                                                <button class="btn btn-info btn-sm common_modal" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/security/ip?act=new&webid=<?=$webid?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ブラックリストに追加</button>
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
                                                    <th class="font-weight-bold">IP</th>
                                                    <th class="font-weight-bold">subnetMask</th>
                                                    <th class="font-weight-bold">Status</th>
                                                    <th class="font-weight-bold">Action</th>
                                                </tr>
                                                    <?php
                                                        foreach($webblacklist as $key=>$value) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $value->ip ?></td>
                                                        <td><?= $value->mask ?></td>
                                                        <td><span class='text-danger'><?=$value->status?></span></td>
                                                        <td><button class="pr-2 btn btn-danger btn-sm common_dialog" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/security/ip?act=delete&webid=<?=$webid?>&act_id=<?=$key?>"><i class="fas fa-trash text-white"></i></button></td> 
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
