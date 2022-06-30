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
                                $getAll= $commons->getAllRow("SELECT * FROM $table WHERE domain= ? and remove = 0  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY",[$webdomain]);
                            ?>
                            <div class="tab-content">
                                <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                <button class="btn btn-info btn-sm common_dialog" gourl="/share/server?setting=site&tab=app_install&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アプリケーション追加</button>
                                    <div class="mt-4 table-responsive">
                                            <?php foreach($getAll as $app){ ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="app-header"><i class="fa fa-caret-right mr-2" aria-hidden="true"></i> サイト名</th>
                                                            <td><?= $app['site_name'] ?></td>
                                                            <th>アプリケーション</th>
                                                            <td><?= $app['app_name'] ?></td>
                                                            <th>バージョン</th>
                                                            <td><?= $app['app_version'] ?></td>
                                                            <th>操作</th>
                                                            <td>
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/share/server?setting=site&tab=app_install&act=delete&act_id=<?=$app['id']?>&webid=<?=$webid?><?=$pagy?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="display:none" class="app-body">
                                                        <tr>
                                                            <th colspan="2">ドキュメントルート</th>
                                                            <th>URL</th>
                                                            <th>ユーザー名</th>
                                                            <th>パスワード</th>
                                                            <th>データベース</th>
                                                            <th>DBユーザー</th>
                                                            <th>DBパスワード</th>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><a href="/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>">/<?= $webuser ?>/<?= $app['root']?></a></td>
                                                            <td>
                                                                <a href="<?= $app['url'] ?><?= ($app['app_name']=="WORDPRESS")? "/wp-admin/":(($app['app_version']=="eccube-4.1")?"/admin/login":"/admin")?>" target="_blank"><?= $app['url'] ?><?= ($app['app_name']=="WORDPRESS")? "/wp-admin/":(($app['app_version']=="eccube-4.1")?"/admin/login":"/admin")?></a>
                                                            </td>
                                                            <td>
                                                                <?= $app['user_name'] ?>
                                                            </td>
                                                            <td>
                                                                <div toggle='star' class="d-flex"><div class="col-sm-8">
                                                        <span class="d-none workbreakall"><?php echo htmlspecialchars($app['password'], ENT_QUOTES); ?></span><span class="star workbreakall" style='margin-top:5px'>********</span>
                                                        </div>
                                                        <div class="ml-auto col-sm-2">
                <span class="fa fa-fw fa-eye fa-eye-slash tbtoggle-password"></span></div>
                                                            </td>
                                                            <td>
                                                                <?= $app['db_name'] ?>
                                                            </td>
                                                            <td><?= $app['db_user'] ?></td>
                                                            <td>
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
 <?php require_once("views/share/footer.php"); ?>
