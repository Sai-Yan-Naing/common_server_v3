<?php require_once('views/admin/share/header.php'); ?>
<?php $webappversion = json_decode($webappversion); ?>
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
                        <div id="oyo-setting" class="active pr-3 pl-3 tab-pane">
                            <div class="row mt-3">
                                <?php 
                                print_r($ftphost);
                                echo $dir = ROOT_PATH.$webpath;
                                echo $web_ftp.$web_ftppass;
                                    echo ftpgetfile($web_host,$web_ftp,$web_ftppass,$dir);
                                 ?>
                                <div class="col-2">
                                    <div><label>Web.config 設定</label></div>
                                </div>
                                <div class="col-10">
                                    <div>
                                        <label>/<?=$webuser?>/web/web.config</label>
                                        <label><button class="btn btn-sm  common_dialog" gourl="/admin/share/server?setting=site&tab=app_setting&act=web.config&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-edit text-warning"></i></button></label>
                                    </div>
                                    <div id="webconfig_">
                                        <!-- <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= getFile($webpath."/web/web.config")?>
                                        </textarea> -->
                                        <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= get_File($web_host,$web_user,$web_password,ROOT_PATH.$webpath."/web/web.config")?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <div><label>PHP設定</label></div>
                                    <div>
                                        <label>PHPバージョン <?=$webappversion->app->php?></label>
                                        <label><button class="btn btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_setting&act=php_version&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-edit text-warning"></i></button></label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div>
                                        <label>/<?=$webuser?>/web/.user.ini</label>
                                        <label><button class="btn btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_setting&act=.user.ini&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-edit text-warning"></i></button></label>
                                    </div>
                                    <div id="phpini_">
                                        <!-- <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= getFile($webpath."/web/.user.ini")?>
                                        </textarea> -->
                                        <textarea type="text" class="form-control" rows="5" cols="30" readonly><?= get_File($web_host,$web_user,$web_password,ROOT_PATH.$webpath."/web/.user.ini")?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-2">
                                    <div><label>ASP.NET設定</label></div>
                                    <div>
                                        <label>.NETバージョン <?=$webappversion->app->dotnet?></label>
                                        <label><button class="btn btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_setting&act=dotnet_version&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-edit text-warning"></i></button></label>
                                    </div>
                                </div>
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
