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
                            <?php

                                $getAll= $commons->getAllRow("SELECT * FROM `app` WHERE domain= ?",[$webdomain]);
                            ?>
                            <div class="tab-content">
                                <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_install&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アプリケーション追加</button>
                                    <div class="mt-4 table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="border-dark">サイト名</th>
                                                <th class="border-dark">アプリケーション</th>
                                                <th class="border-dark">バージョン</th>
                                                <th class="border-dark">Document Root</th>
                                                <th class="border-dark">Url</th>
                                                <th class="border-dark">ユーザー名</th>
                                                <th class="border-dark">Password</th>
                                                <th class="border-dark">Database</th>
                                                <th class="border-dark">DB ユーザー</th>
                                                <th class="border-dark">DB Password</th>
                                            </tr>
                                            <?php foreach($getAll as $app){ ?>
                                            <tr>
                                                <td class="border-dark"><?= $app['site_name'] ?></td>
                                                <td class="border-dark"><?= $app['app_name'] ?></td>
                                                <td class="border-dark"><?= $app['app_version'] ?></td>
                                                <td class="border-dark"><a href="/admin/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>">/<?= $webuser ?>/<?= $app['root']?></a></td>
                                                <td class="border-dark"><a href="<?= $app['url'] ?>/wp-admin/" target="_blank"><?= $app['url'] ?></a></td>
                                                <td class="border-dark"><?= $app['user_name'] ?></td>
                                                <td class="border-dark"><?= $app['password'] ?></td>
                                                <td class="border-dark"><?= $app['db_name'] ?></td>
                                                <td class="border-dark"><?= $app['db_user'] ?></td>
                                                <td class="border-dark"><?= $app['db_pass'] ?></td>
                                            </tr>
                                            <?php } ?>
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
