<?php 
require_once('views/admin/share/header.php');
$error_pages = json_decode($weberrorpages);
 ?>
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
                                    <div id="kihon-setting" class="active pr-3 pl-3 tab-pane">
                                        <div class="row mt-3">
                                            <div class="col-sm-2 font-weight-bold">エラーページ</div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=new&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>エラーページ追加</button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th  class="">エラーコード</th>
                                                    <th  class="">ファイルパス</th>
                                                    <th  class="">利用設定</th>
                                                </tr>
                                                    <?php
                                                        foreach($error_pages as $key=>$ep):
                                                    ?>
                                                    <tr>
                                                        <td class=""><?= htmlspecialchars($ep->statuscode, ENT_QUOTES); ?></td>
                                                        <td class=""><?= htmlspecialchars($ep->url, ENT_QUOTES); ?></td>
                                                        <td class="">
                                                            <div style="display: -webkit-inline-box;">
                                                                <button edit_id="<?= $key;?>" class="pr-2 btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=edit&act_id=<?=$key?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">編集</button>
                                                                <form action="/admin/share/servers/sites/basic?confirm&act=&webid=<?=$webid?>&error_pages&act_id=<?=$key?>" method = "post" class="ml-2" onsubmit="loading()">
                                                                    <input type="hidden" name="action" value="onoff">
                                                                    <input type="hidden" name="act_id" value="<?=$key;?>">
                                                                    <label class="switch text-white common_dialog" gourl="/admin/share/server?setting=site&tab=basic&errorcode=<?=$ep->statuscode?>&act=onoff&act_id=<?=$key?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                                        <input type="checkbox" <?= $ep->stopped==1? "checked":""  ?>>
                                                                        <span class="slider <?= $ep->stopped==1? "slideron":"slideroff"  ?>"></span>
                                                                        <span class="handle <?= $ep->stopped==1? "handleon":"handleoff"  ?>"></span>
                                                                        <span class="<?= $ep->stopped==1? "labelon":"labeloff"  ?>"><?= $ep->stopped==1? "ON":"OFF"  ?></span>
                                                                    </label>
                                                                </form>
                                                                
                                                                <a href="javascript:;" class="btn btn-outline-danger ml-2 btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=delete&act_id=<?=$key?>&webid=<?=$webid?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <h for="basic-auth" class="col-sm-2 col-form-label font-weight-bold">BASIC認証</h>
                                            <div class="col-sm-4">
                                            <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=new_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class="mr-2"><i class="fas fa-plus-square"></i></span>BASIC認証追加</button>
                                            </div>
                                        </div>
                                            <!-- basic setting1 -->
                                                <?php
                                                    $first = 0;
                                                    foreach(json_decode($webbasicsetting) as $main_key => $main_value):
                                                        $first++;
                                                        $key_replace = implode('_',explode('/',$main_key));
                                                ?>
                                                <div id="accordion<?=$first?>">
                                                <div class="card">
                                                    <div class="card-header" id="head-<?=$key_replace?>" style="background-color: white;">
                                                        <h5 class="mb-0 d-flex">
                                                            <!-- <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?=$key_replace?>" aria-expanded="<?= ($first==1)? true:false; ?>" aria-controls="collapse-<?=$key_replace?>">
                                                            BASIC認証設定 <?= $first ?>
                                                            </button> -->
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?=$key_replace?>" aria-expanded="true" aria-controls="collapse-<?=$key_replace?>">
                                                            BASIC認証設定 <?= $first ?>
                                                            </button>
                                                            <button class="btn btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=delete_dir&act_id=<?=$main_key?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-trash text-danger"></i></button>
                                                            <label class="ml-auto" data-toggle="collapse" data-target="#collapse-<?=$key_replace?>" aria-expanded="true" aria-controls="collapse-<?=$key_replace?>">
                                                            <input type="checkbox" style="display: none;" class="plusminus">
                                                            <span class="plusminus-btn"></span>
                                                            </label>
                                                        </h5>
                                                    </div>
                                                        <!-- <?php $show =($first==1)?"show":"";?> -->
                                                        <!-- <div id="collapse-<?=$key_replace?>" class="collapse <?=$show?>"  -->
                                                    <div id="collapse-<?=$key_replace?>" class="collapse show" aria-labelledby="head-<?=$key_replace?>" data-parent="#accordion<?=$first?>">
                                                        <div class="card-body">
                                                            <div class="row justify-content-center">
                                                                <label for="">対象ディレクトリ:  &nbsp;&nbsp;<?= $main_value->url ?></label>
                                                            </div>
                                                            <div class="mb-2 d-flex mt-2">
                                                                <div>認証ユーザー</div>
                                                            <div class="ml-5">
                                                                    <button class="btn btn-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=new_user&dir_id=<?=$main_key?>&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><span class=""><i class="fas fa-plus"></i></span>ユーザー追加</button>
                                                            </div>
                                                        </div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th class="font-weight-bold ">ユーザー名</th>
                                                                        <th class="font-weight-bold ">パスワード</th>
                                                                        <th class="font-weight-bold ">パスワード変更</th>
                                                                    </tr>
                                                                    <?php 
                                                                        foreach($main_value->user as $user_key => $user_value){
                                                                    ?>
                                                                    <tr>
                                                                        <td class=""><?= $user_value->bass_user ?></td>
                                                                        <td class=""><div toggle='star' class="d-flex"><div class="col-sm-8">
                                                        <span class="d-none workbreakall"><?= $user_value->bass_pass ?></span><span class="star workbreakall" style='margin-top:5px'>********</span>
                                                        </div>
                                                        <div class="ml-auto col-sm-2">
                <span class="fa fa-fw fa-eye fa-eye-slash tbtoggle-password"></span></div></td>
                                                                        <td class="">
                                                                            <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=edit_user&dir_id=<?=$main_key?>&act_id=<?=$user_key?>&webid=<?=$webid?>"   data-toggle="modal" data-target="#common_dialog">編集</a>
                                                                            <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" gourl="/admin/share/server?setting=site&tab=basic&act=delete_user&dir_id=<?=$main_key?>&act_id=<?=$user_key?>&webid=<?=$webid?>"   data-toggle="modal" data-target="#common_dialog">削除</a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <?php endforeach; ?>
                                            <!-- end basic -->
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
