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
                                $limit = 10;  
                                $table = 'app';
                                require_once('views/pagination/start.php');
                                $getAll= $commons->getAllRow("SELECT * FROM $table WHERE domain= ? and remove = 0  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY",[$webdomain]);
                            ?>
                            <div class="tab-content">
                                <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_install&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アプリケーション追加</button>
                                    <div class="mt-4 table-responsive">
                                            <?php foreach($getAll as $app){ ?>
                                                <table class="table table-bordered">
                                                        <tr>
                                                            <th class="app-header" width="10%"><i class="fa fa-caret-right mr-2" aria-hidden="true"></i> サイト名</th>
                                                            <td width="10%"><?= $app['site_name'] ?></td>
                                                            <th width="20%">アプリケーション</th>
                                                            <td width="10%"><?= $app['app_name'] ?></td>
                                                            <th width="15%">バージョン</th>
                                                            <td width="10%"><?= $app['app_version'] ?></td>
                                                            <th width="10%">操作</th>
                                                            <th width="15%">
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=app_install&act=delete&act_id=<?=$app['id']?>&webid=<?=$webid?><?=$pagy?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                            </th>
                                                        </tr>
                                                    <tbody style="display:none" class="app-body">
                                                        <tr><td colspan="8" style="border: none;"></td></tr>
                                                        <tr>
                                                            <th colspan="2" width="20%">ドキュメントルート</th>
                                                            <th width="20%">URL</th>
                                                            <th width="10%">ユーザー名</th>
                                                            <th width="15%">パスワード</th>
                                                            <th width="10%">データベース</th>
                                                            <th width="10%">DBユーザー</th>
                                                            <th width="15%">DBパスワード</th>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" width="20%"><a href="/admin/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>">/<?= $webuser ?>/<?= $app['root']?></a></td>
                                                            <td width="20%">
                                                                <a href="<?= $app['url'] ?><?= ($app['app_name']=="WordPress")? "/wp-admin/":(($app['app_version']=="eccube-4.1")?"/admin/login":"/admin")?>" target="_blank"><?= $app['url'] ?><?= ($app['app_name']=="WordPress")? "/wp-admin/":(($app['app_version']=="eccube-4.1")?"/admin/login":"/admin")?></a>
                                                            </td>
                                                            <td width="10%">
                                                                <?= $app['user_name'] ?>
                                                            </td>
                                                            <td width="15%">
                                                                <div toggle='star' class="d-flex"><div class="col-sm-8">
                                                        <span class="d-none workbreakall"><?php echo htmlspecialchars($app['password'], ENT_QUOTES); ?></span><span class="star workbreakall" style='margin-top:5px'>********</span>
                                                        </div>
                                                        <div class="ml-auto col-sm-2">
                <span class="fa fa-fw fa-eye fa-eye-slash tbtoggle-password"></span></div>
                                                            </td>
                                                            <td width="10%">
                                                                <?= $app['db_name'] ?>
                                                            </td>
                                                            <td width="10%"><?= $app['db_user'] ?></td>
                                                            <td width="15%">
                                                                <div toggle='star' class="d-flex"><div class="col-sm-8">
                                                        <span class="d-none workbreakall"><?php echo htmlspecialchars($app['db_pass'], ENT_QUOTES); ?></span><span class="star workbreakall" style='margin-top:5px'>********</span>
                                                        </div>
                                                        <div class="ml-auto col-sm-2">
                <span class="fa fa-fw fa-eye fa-eye-slash tbtoggle-password"></span></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end content -->
                            
                        <div class="d-flex mt-3">
                            <div></div>
                            <div class='ml-auto'>
                                <?php 
                                    $paginatecount = "SELECT COUNT(*) FROM $table WHERE domain = ? and remove = 0";
                                    $params = [$webdomain];
                                    $page_url = '/admin/share/server?setting=site&tab=app_install&act=index&webid='.$webid.'&page=';
                                    require_once('views/pagination/end.php')
                                ?>
                             </div>
                        </div>
                        </div>
                </div>
            </main>
        </div>
    </div> 

<script>
    $(document).on('click','.app-header',function(){
        $this = $(this);
        $(this).parent().parent().next(".app-body").slideToggle(function() {
        if($this.parent().parent().next('.app-body').is(':hidden'))
        {
            $this.children('').removeClass('fa-caret-down')
            $this.children('').addClass('fa-caret-right')
        }else{
            $this.children('').removeClass('fa-caret-right')
            $this.children('').addClass('fa-caret-down')
        }
        });
    })
</script>
 <?php require_once("views/admin/share/footer.php"); ?>
