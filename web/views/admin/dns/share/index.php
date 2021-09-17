<?php require_once('views/admin/header.php');?>
        <div id="layoutSidenav">
        <?php require_once('views/admin/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main class="main-page">
                    <div class="container-fluid px-4">
						<?php require_once('views/admin/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <div class="row justify-content-center mt-4">
                                    <div class="col-md-2 text-right p-2">契約サービス</div>
                                        <div class="col-md-10">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" aria-current="page" href="">共用サーバー</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="">VPS/デスクトッププラン</a>
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-md-2 text-right">
                                        <label>契約ドメイン</label>
                                        <?php  
                                            $query = "SELECT * FROM web_account WHERE `customer_id` = 'D000123' && `removal` is null";
                                            $commons = new Common;
                                            $getAllRow=$commons->getAllRow($query);
                                        ?>
                                        <?php
                                            foreach($getAllRow as $value)
                                            {?>

                                            <a href="/admin/dns?tab=share&act=index&webid=<?=$value['id']?>"><div class="mb-2"><?= $value['domain']; ?></div></a>

                                        <?php	
                                        }

                                        ?>
                                    </div>
                                    <?php
                                        $webid = $_GET['webid'];
                                        if(!isset($webid) || $webid ==null){
                                            $query = "SELECT * FROM web_account WHERE `customer_id` = 'D000123' && `removal` is null && `origin`=1"; 
                                        }else{
                                            $query = "SELECT * FROM web_account WHERE `customer_id` = 'D000123' && `removal` is null && `id`=$webid";
                                        }
                                        
                                        $getDns = $commons->getRow($query);
                                    ?>
                                    <div class="col-md-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr class="row">
                                                        <th class="font-weight-bold col-md-2">タイプ</th>
                                                        <th class="font-weight-bold col-md-2">ホスト名</th>
                                                        <th class="font-weight-bold col-md-3">ドメイン名</th>
                                                        <th class="font-weight-bold col-md-3">ＩＰアドレス/ドメイン名</th>
                                                        <th class="font-weight-bold col-md-2">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $temp=json_decode($getDns['dns']);
                                                            foreach($temp as $key=>$value) {
                                                        ?>
                                                    <tr class="row">
                                                        <td class="col-md-2"><?= $value->type; ?></td>
                                                        <td class="col-md-2"><?= $value->sub; ?></td>
                                                        <td class="col-md-3">.<?=$getDns['domain']?></td>
                                                        <td class="col-md-3"><?= $value->target; ?></td>
                                                        <td class="col-md-2">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#common_dialog" class="btn btn-outline-info btn-sm common_dialog"  gourl="/admin/dns?tab=share&act=edit&webid=<?=$webid;?>&act_id=<?=$key?>">編集</a>
                                                            <a href="javascript:;"  data-toggle="modal" data-target="#common_dialog" class="btn btn-outline-danger btn-sm edit_database btn-sm common_dialog"  gourl="/admin/dns?tab=share&act=delete&webid=<?=$webid;?>&act_id=<?=$key?>">削除</a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                    if(count(json_decode($getDns['dns'],true))<5)
                                                    {
                                                ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-3"><button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_dialog" gourl="/admin/dns?tab=share&act=new&webid=<?=$getDns['id'];?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>レコード追加</button></div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="back-button"><a href="/admin"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('views/admin/footer.php'); ?>