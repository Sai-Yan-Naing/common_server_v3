<?php require_once('views/share/header.php'); ?>
<?php 
$limit = 10;
$table = 'db_account';  
$params = [$webdomain];
require_once('views/pagination/start.php');
$query = "SELECT * FROM $table where domain = ?  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
$getAllRow = $commons->getAllRow($query, $params);

$query1 = "SELECT * FROM $table where domain = ?";
$getAllRow1 = $commons->getAllRow($query1, $params);

$query2 = "SELECT * FROM db_account_for_mariadb where domain = ?";
$getAllRow2 = $commons->getAllRow($query2, $params);

?>


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
                                <div class="tab-content">
                                    <div class="active">
                                        <div class="d-flex mt-3 mb-3">
                                            <?php if( $webplnmariadb == 'yes' && ((int)$webplnmariadbnum > (count($getAllRow1 )+ count($getAllRow2 )) || $webplnmariadbnum=='unlimited')):?>
                                            <div class="ml-3">
                                                <button class="btn btn-info btn-sm common_dialog" gourl="/share/server?setting=database&tab=mysql&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>データベース追加</button>
                                            </div>
                                            <?php endif; ?>
                                            <div class="ml-3">
                                                <a href="<?=MYMANAGER?>" target="_blank" class="btn btn-link"><u>MYSQL マネージャー</u></a>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                                <tr>
                                                    <th class="font-weight-bold border-dark">データベース名</th>
                                                    <th class="font-weight-bold border-dark">ユーザー名</th>
                                                    <th class="font-weight-bold border-dark">パスワード</th>
                                                    <th class="font-weight-bold border-dark">編集</th>
                                                    <th class="font-weight-bold border-dark">接続先情報</th>
                                                </tr>
                                                <?php 
                                                    foreach($getAllRow as $db):
                                                ?>
                                                <tr>
                                                    <td class="border-dark"><?php echo $db['db_name']; ?></td>
                                                    <td class="border-dark"><?php echo $db['db_user']; ?></td>
                                                    <td class="border-dark"><?php echo $db['db_pass']; ?></td>
                                                    <td class="border-dark">
                                                        <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/share/server?setting=database&tab=mysql&act=edit&act_id=<?= $db['id'] ?>&webid=<?=$webid?><?=$pagy?>"  data-toggle="modal" data-target="#common_dialog">編集</a>
                                                        <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/share/server?setting=database&tab=mysql&act=delete&act_id=<?= $db['id'] ?>&webid=<?=$webid?><?=$pagy?>"  data-toggle="modal" data-target="#common_dialog">削除</a>
                                                    </td>
                                                    <td class="border-dark"><a href="<?=MYMANAGER?>" target="_blank"><?=MYMANAGER?></a></td>
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
                                            $params = [$webdomain];
                                            $page_url = "/share/server?setting=database&tab=mysql&act=index&webid=".$webid."&page=";
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
