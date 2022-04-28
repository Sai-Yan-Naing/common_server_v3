<?php require_once('views/share/header.php'); ?>
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
                            <?php
                                $limit = 10;  
                                $table = 'app';
                                require_once('views/pagination/start.php');
                                $getAll= $commons->getAllRow("SELECT * FROM $table WHERE domain= ?  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY",[$webdomain]);
                            ?>
                            <div class="tab-content">
                                <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                <button class="btn btn-info btn-sm common_dialog" gourl="/share/server?setting=site&tab=app_install&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アプリケーション追加</button>
                                    <div class="mt-4 table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="border-dark">サイト名</th>
                                                <th class="border-dark">アプリケーション</th>
                                                <th class="border-dark">バージョン</th>
                                                <th class="border-dark">Document Root</th>
                                                <th class="border-dark">URL</th>
                                                <th class="border-dark">ユーザー名</th>
                                                <th class="border-dark">パスワード</th>
                                                <th class="border-dark">データベース</th>
                                                <th class="border-dark">DBユーザー</th>
                                                <th class="border-dark">DBパスワード</th>
                                            </tr>
                                            <?php foreach($getAll as $app){ ?>
                                            <tr>
                                                <td class="border-dark"><?= $app['site_name'] ?></td>
                                                <td class="border-dark"><?= $app['app_name'] ?></td>
                                                <td class="border-dark"><?= $app['app_version'] ?></td>
                                                <td class="border-dark"><a href="/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>">/<?= $webuser ?>/<?= $app['root']?></a></td>
                                                <td class="border-dark"><a href="<?= $app['url'] ?><?= ($app['app_name']=="WORDPRESS")? "/wp-admin/":(($app['app_version']=="eccube-4.1")?"/$app[root]/login":"/html")?>" target="_blank"><?= $app['url'] ?></a></td>
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
                            
                        <div class="d-flex mt-3">
                            <div></div>
                            <div class='ml-auto'>
                                <?php 
                                    $paginatecount = "SELECT COUNT(*) FROM $table WHERE domain = ?";
                                    $params = [$webdomain];
                                    $page_url = '/share/server?setting=site&tab=app_install&act=index&webid='.$webid.'&page=';
                                    require_once('views/pagination/end.php')
                                ?>
                             </div>
                        </div>
                        </div>
                </div>
            </main>
        </div>
    </div> 
 <?php require_once("views/share/footer.php"); ?>
