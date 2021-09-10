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
                                    <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                    <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages"><span class="mr-2"><i class="fas fa-plus-square"></i></span>エラーページ追加</button>
                                        <div class="mt-4 table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Site Name</th>
                                                    <th>APP</th>
                                                    <th>Document Root</th>
                                                    <th>Url</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Database</th>
                                                    <th>DB User</th>
                                                    <th>DB Password</th>
                                                </tr>
                                                <tr>
                                                    <td>Travel Vlog</td>
                                                    <td>Wordpress APP1</td>
                                                    <td>/<?=$webuser?>/inputtext</td>
                                                    <td><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td>travelvlog</td>
                                                    <td>welcome123!</td>
                                                    <td>travelvlogdb</td>
                                                    <td>travelvloguser</td>
                                                    <td>welcome123!</td>
                                                </tr>
                                                <tr>
                                                    <td>Travel Vlog2</td>
                                                    <td>Wordpress APP2</td>
                                                    <td>/<?=$webuser?>/inputtext</td>
                                                    <td><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td>travelvlog</td>
                                                    <td>welcome123!</td>
                                                    <td>travelvlogdb</td>
                                                    <td>travelvloguser</td>
                                                    <td>welcome123!</td>
                                                </tr>
                                                <tr>
                                                    <td>Travel Vlog3</td>
                                                    <td>ECCUBE APP1</td>
                                                    <td>/<?=$webuser?>/inputtext</td>
                                                    <td><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td>travelvlog</td>
                                                    <td>welcome123!</td>
                                                    <td>travelvlogdb</td>
                                                    <td>travelvloguser</td>
                                                    <td>welcome123!</td>
                                                </tr>
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
