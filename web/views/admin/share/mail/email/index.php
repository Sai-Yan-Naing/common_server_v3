<?php require_once('views/admin/share/header.php'); ?>
<?php 
$limit = 10;
$table = 'add_email';  
$params = [$webdomain];
require_once('views/pagination/start.php');
$query = "SELECT * FROM $table where domain = ?  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
$getAllRow = $commons->getAllRow($query, $params);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/mail/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="active">
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-3">
                                                <span>メールアドレス</span>
                                            </div>
                                            <?php if( (int)$webplnmailuser >= count($getAllRow ) || $webplnmailuser=='unlimited'):?>
                                            <div class="col-sm-9 d-flex">
                                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/mail?setting=email&tab=tab&act=new&webid=<?= $webid?>" data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>メールアドレス追加</button>
                                                <!-- <button class="btn btn-info btn-sm ml-2" form='email_export' type='submit'><span class="mr-2"><i class="fas fa-plus-square"></i></span>Export as CSV</button> -->
                                                <button class="btn btn-info btn-sm common_dialog ml-2" gourl="/admin/share/mail?setting=email&tab=tab&act=import&webid=<?= $webid?>" data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>アップロード</button>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <!-- <form id='email_export' action="/admin/share/mail?setting=email&tab=tab&act=confirm&webid=<?=$webid?>" method="post">
                                            <input type="hidden" name="action" value="export">
                                        </form> -->
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">登録メールアドレス</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">操作</th>
                                                </tr>
                                                <?php 
                                                    foreach ($getAllRow as $key => $mail): 
                                                ?>
                                                <tr>
                                                    <td class="border-dark"><?= htmlspecialchars($mail['email'], ENT_QUOTES);?>@<?= htmlspecialchars($webdomain, ENT_QUOTES) ?></td>
                                                    <td class="border-dark"><?= $mail['password'] ?></td>
                                                    <td class="border-dark">
                                                        <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/mail?setting=email&tab=tab&act=edit&act_id=<?= $mail['id'] ?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">編集</a>
                                                        <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/mail?setting=email&tab=tab&act=delete&act_id=<?= $mail['id'] ?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">削除</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content -->
                                <div class="d-flex mt-3">
                                    <div></div>
                                    <div class='ml-auto'>
                                        <?php 
                                            $paginatecount = "SELECT COUNT(*) FROM $table  where domain = ?";
                                            $page_url = "/admin/share/mail?setting=email&tab=tab&act=index&webid=".$webid."&page=";
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
