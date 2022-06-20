<?php require_once('views/admin/share/header.php'); ?>
<?php 
$limit = 10;
$table = 'db_ftp';  
$params = [$webdomain];
require_once('views/pagination/start.php');
$query = "SELECT * FROM $table WHERE domain=?  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
$getAllRow=$commons->getAllRow($query,$params);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="active">
                                        <div class="ftp-title mb-3">FTPサーバー情報</div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <span>FTPサーバー</span>
                                                </div>
                                                <div class="col-sm-9">
                                                    <span><?= $web_host ?></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label>Root Folder</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label>/<?= $webuser ?></label>
                                                </div>
                                          </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-3">
                                                <span>FTPアカウント</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=ftp&tab=tab&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>ＦＴＰユーザー追加</button>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">FTP ユーザー名</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">書き込み権限</th>
                                                    <th class="font-weight-bold border-dark">ディレクトリパス</th>
                                                    <th class="font-weight-bold border-dark">操作</th>
                                                </tr>
                                                <?php
                                                // print_r($getAllRow); 
                                                    foreach ($getAllRow as $key1 => $ftp):
                                                ?>
                                                <tr>
                                                    <td class="border-dark"><?php echo htmlspecialchars($ftp['ftp_user'], ENT_QUOTES); ?></td>
                                                    <td class="border-dark" toggle='star'><span class="d-none"><?php echo htmlspecialchars($ftp['ftp_pass'], ENT_QUOTES); ?></span><span class="star" style='margin-top:5px'>********</span>
                                                    <span class="fa fa-fw fa-eye fa-eye-slash tbfield-icon tbtoggle-password"></span></td>
                                                    <td class="border-dark">
                                                    <?php 
                                                        $permissions = explode(',',$ftp['permission']);
                                                        foreach ($permissions as $key=>$permission):
                                                            if ( $permission == 'F'):
                                                                echo "フルコントロール";
                                                            elseif ( $permission == 'R'):
                                                                echo "読み";
                                                            else:
                                                                echo "書き";
                                                            endif;
                                                            if(count($permissions) > $key + 1):
                                                                echo ',';
                                                             endif;
                                                        endforeach;
                                                    ?>
                                                    </td>
                                                    <td class="border-dark"><?php echo htmlspecialchars($ftp['dir_path'], ENT_QUOTES); ?></td>
                                                    <td class="border-dark">
                                                        <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/server?setting=ftp&tab=tab&act=edit&act_id=<?=$ftp['id']?>&webid=<?=$webid?><?=$pagy?>"   data-toggle="modal" data-target="#common_dialog">編集</a>
                                                    <?php
                                                    if($key1 !=0):?>
                                                        <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/server?setting=ftp&tab=tab&act=delete&act_id=<?=$ftp['id']?>&webid=<?=$webid?><?=$pagy?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                    <?php endif;?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    endforeach;
                                                ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content -->
                                <div class="d-flex mt-3">
                                    <div></div>
                                    <div class='ml-auto'>
                                        <?php 
                                            $paginatecount = "SELECT COUNT(*) FROM $table  where domain = ?";
                                            $page_url = "/admin/share/server?setting=ftp&tab=tab&act=index&webid=".$webid."&page=";
                                            require_once('views/pagination/end.php')
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
