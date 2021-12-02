<?php require_once('views/admin/vps/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
<div id="layoutSidenav">
<?php require_once('views/admin/vps/sidebar.php');?>
    <div id="layoutSidenav_content">
    <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/vps/title.php') ?>
                    <?php require_once('views/admin/vps/various/subtitle.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <!-- start -->
                        <div class="tab-content">
                            <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                <h6>簡単インストール</h6>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <a class="btn btn-outline-info btn-sm my-2" href="/admin/vps/various?setting=easy_install&tab=easy_install&act=confirm&action=iisinstall&webid=<?=$webid?>" onclick="loading()">IISインストール</a>
                                    </div>
                                </div> 
                                <div class="mb-4">
                                    ※デフォルトの構成にて自動でインストールされます。
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label">SQＬ Server Express Edition</label>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-2"><button  type="submit" class="btn btn-sm btn-outline-info" form="sql_2016">2016インストール</button></div>
                                    <div class="col-sm-2"><button  type="submit" class="btn btn-sm btn-outline-info" form="sql_2017">2017インストール</button></div>
                                    <div class="col-sm-2"><button  type="submit" class="btn btn-sm btn-outline-info" form="sql_2019">2019インストール</button></div>
                                </div>                          
                            </div>
                        </div>
                        <form onsubmit="loading()" action="/admin/vps/various?setting=easy_install&tab=easy_install&act=confirm&webid=<?=$webid?>" id="sql_2016" method="post">
                            <input type="hidden" name="sqlv" value="2016">
                        </form>
                        <form onsubmit="loading()" action="/admin/vps/various?setting=easy_install&tab=easy_install&act=confirm&webid=<?=$webid?>" id="sql_2017" method="post">
                            <input type="hidden" name="sqlv" value="2017">
                        </form>
                        <form onsubmit="loading()" action="/admin/vps/various?setting=easy_install&tab=easy_install&act=confirm&webid=<?=$webid?>" id="sql_2019" method="post">
                            <input type="hidden" name="sqlv" value="2019">
                        </form>
                        <!-- end content -->
                    </div>
            </div>
        </main>
    </div>
</div> 
 <?php 
 require_once("views/admin/vps/footer.php");
 