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
                                    <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アプリケーション追加</button>
                                        <div class="mt-4 table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="border-dark">サイト名</th>
                                                    <th class="border-dark">プリケーション</th>
                                                    <th class="border-dark">Document Root</th>
                                                    <th class="border-dark">Url</th>
                                                    <th class="border-dark">ユーザー名</th>
                                                    <th class="border-dark">Password</th>
                                                    <th class="border-dark">Database</th>
                                                    <th class="border-dark">DB ユーザー</th>
                                                    <th class="border-dark">DB Password</th>
                                                </tr>
                                                <tr>
                                                    <td class="border-dark">Travel Vlog</td>
                                                    <td class="border-dark">Wordpress APP1</td>
                                                    <td class="border-dark">/<?=$webuser?>/inputtext</td>
                                                    <td class="border-dark"><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td class="border-dark">travelvlog</td>
                                                    <td class="border-dark">welcome123!</td>
                                                    <td class="border-dark">travelvlogdb</td>
                                                    <td class="border-dark">travelvloguser</td>
                                                    <td class="border-dark">welcome123!</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-dark">Travel Vlog2</td>
                                                    <td class="border-dark">Wordpress APP2</td>
                                                    <td class="border-dark">/<?=$webuser?>/inputtext</td>
                                                    <td class="border-dark"><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td class="border-dark">travelvlog</td>
                                                    <td class="border-dark">welcome123!</td>
                                                    <td class="border-dark">travelvlogdb</td>
                                                    <td class="border-dark">travelvloguser</td>
                                                    <td class="border-dark">welcome123!</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-dark">Travel Vlog3</td>
                                                    <td class="border-dark">ECCUBE APP1</td>
                                                    <td class="border-dark">/<?=$webuser?>/inputtext</td>
                                                    <td class="border-dark"><a href="http://<?=$webdomain?>/inputtext">http://<?=$webdomain?>/inputtext</a></td>
                                                    <td class="border-dark">travelvlog</td>
                                                    <td class="border-dark">welcome123!</td>
                                                    <td class="border-dark">travelvlogdb</td>
                                                    <td class="border-dark">travelvloguser</td>
                                                    <td class="border-dark">welcome123!</td>
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
