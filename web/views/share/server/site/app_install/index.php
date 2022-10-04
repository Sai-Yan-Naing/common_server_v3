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
                                                <div class="d-flex border p-2">
                                                    <div class="app-header col-sm-9 "><b style="cursor:pointer"><i class="fa fa-caret-right mr-2" aria-hidden="true"></i>サイト名:<?= $app['site_name'] ?> 【 <?=$app['app_name'].$app['app_version'] ?> 】</b></div>
                                                    <div class="col-sm-3">
                                                        <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog float-right" gourl="/share/server?setting=site&tab=app_install&act=delete&act_id=<?=$app['id']?>&webid=<?=$webid?><?=$pagy?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered app-body" style="display: none;">
                                                    <tr>
                                                            <th colspan="2" width="20%">ドキュメントルート</th>
                                                            <th width="20%">URL</th>
                                                            <th width="10%">ユーザー名</th>
                                                            <th width="15%">パスワード</th>
                                                            <th width="10%">データベース</th>
                                                            <th width="10%">DBユーザー</th>
                                                            <th width="15%">DBパスワード</th>
                                                        </tr>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" width="20%"><a href="/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>">/<?= $webuser ?>/<?= $app['root']?></a></td>
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
        $(this).parent().next(".app-body").slideToggle(function() {
        if($this.parent().next('.app-body').is(':hidden'))
        {
            $this.children('').children('').removeClass('fa-caret-down')
            $this.children('').children('').addClass('fa-caret-right')
        }else{
            $this.children('').children('').removeClass('fa-caret-right')
            $this.children('').children('').addClass('fa-caret-down')
        }
        });
    })
</script>
 <?php require_once("views/share/footer.php"); ?>
