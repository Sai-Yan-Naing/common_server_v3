
<?php require_once('views/admin/surveillance/vps/header.php');?>
<div id="layoutSidenav">
<?php require_once('views/admin/sidebar.php');?>
<?php 
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,'vps']);
$ping = json_decode($getmails['ping'],true)
?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <span style="display:none" id="checkvps" checkvps='all'></span>
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php');?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <h4 class="mb-4">契約サービス</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/admin" onclick="loading()">共用サーバー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin?main=vps" onclick="loading()">VPS/デスクトップ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/admin?main=surveillance&act=index" onclick="loading()">監視</a>
                            </li>
                        </ul>
                        <div class="mt-3">
                        	<label><?= $webip ?>【<?= $webvm_name ?>】</label>
                        	<form action='/admin?main=surveillance&act=confirm&tab=vps&webid=<?=$webid?>' method="post">
                            <input type="hidden" name='action' value="new">
	                        	<div class="d-flex">
	                        		<div class="mr-2">通知先</div>
	                        		<div class="mr-2"><input type="email" name="mail" class="form-control form-control-sm" required></div>
	                        		<div class="mr-2"><button class="btn btn-info btn-sm">登録</button></div>
	                        	</div>
	                        </form>

	                        <table class="table table-bordered mt-3">
                                <tr>
                                    <th class="font-weight-bold border-dark">登録メールアドレス</th>
                                    <th class="font-weight-bold border-dark">操作</th>
                                </tr>
                                <?php 
                                // print_r(json_decode($getmails['mail'],true));
                                foreach(json_decode($getmails['mail'],true) as $val):
                                    // print_r(array_keys($val));
                                    // $key=array_keys($val);
                                    ?>
                                <tr>
                                    <td class="font-weight-bold "><?= $val['mail']?></td>
                                    <td class="font-weight-bold ">
                                    	<a href="javascript:;" gourl="/admin?main=surveillance&act=edit&tab=vps&webid=<?=$webid?>&act_id=<?=$val['id']?>" class="btn btn-outline-info btn-sm common_dialog"  data-toggle="modal" data-target="#common_dialog">編集</a>
                                     	<a href="javascript:;" gourl="/admin?main=surveillance&act=delete&tab=vps&webid=<?=$webid?>&act_id=<?=$val['id']?>" class="btn btn-outline-danger btn-sm common_dialog"  data-toggle="modal" data-target="#common_dialog">削除</a>
                                     </td>
                                </tr>
                                    <?php
                                    endforeach;
                                    ?>
                            </table>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2">PING監視</div>
                                <div class="col-2">
                                    <label class="switch text-white common_dialog" gourl="/admin?main=surveillance&act=ping&tab=vps&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                        <input type="checkbox" <?= (int)$ping['ping']==1? "checked":""  ?>>
                                        <span class="slider <?= (int)$ping['ping']==1? "slideron":"slideroff"  ?>"></span>
                                        <span class="handle <?= (int)$ping['ping']==1? "handleon":"handleoff"  ?>"></span>
                                        <span class="<?= (int)$ping['ping']==1? "labelon":"labeloff"  ?>"><?= (int)$ping['ping']==1? "起動":"停止"  ?></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2">HTTP監視</div>
                                <div class="col-2">
                                    <label class="switch text-white common_dialog" gourl="/admin/share/server?setting=security&tab=getmails&act=usage&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog11">
                                        <input type="checkbox" <?= (int)$getmails['usage']==1? "checked":""  ?>>
                                        <span class="slider <?= (int)$getmails['usage']==1? "slideron":"slideroff"  ?>"></span>
                                        <span class="handle <?= (int)$getmails['usage']==1? "handleon":"handleoff"  ?>"></span>
                                        <span class="<?= (int)$getmails['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$getmails['usage']==1? "起動":"停止"  ?></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2">URL監視</div>
                                <div class="col-2">
                                    <label class="switch text-white common_dialog" gourl="/admin/share/server?setting=security&tab=getmails&act=usage&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog11">
                                        <input type="checkbox" <?= (int)$getmails['usage']==1? "checked":""  ?>>
                                        <span class="slider <?= (int)$getmails['usage']==1? "slideron":"slideroff"  ?>"></span>
                                        <span class="handle <?= (int)$getmails['usage']==1? "handleon":"handleoff"  ?>"></span>
                                        <span class="<?= (int)$getmails['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$getmails['usage']==1? "起動":"停止"  ?></span>
                                    </label>
                                </div>
                                <div class="col-5 d-flex"><input type="text" class="form-control form-control-sm mr-1" name=""><span class="clone-input" style="font-size: 25px;margin-top: -5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12 clone-div" style="">
                                <div class="mr-2 col-2"></div>
                                <div class="col-2">
                                </div>
                                <div class="col-5 d-flex" ><input type="text" class="form-control form-control-sm mr-1" name=""><span class="delete-clone" style="font-size: 25px;margin-top: -5px;"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2">RDP監視</div>
                                <div class="col-2">
                                    <label class="switch text-white common_dialog" gourl="/admin/share/server?setting=security&tab=getmails&act=usage&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog11">
                                        <input type="checkbox" <?= (int)$getmails['usage']==1? "checked":""  ?>>
                                        <span class="slider <?= (int)$getmails['usage']==1? "slideron":"slideroff"  ?>"></span>
                                        <span class="handle <?= (int)$getmails['usage']==1? "handleon":"handleoff"  ?>"></span>
                                        <span class="<?= (int)$getmails['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$getmails['usage']==1? "起動":"停止"  ?></span>
                                    </label>
                                </div>
                                <div class="col-2">ユーザー名</div>
                                <div class="col-3"><input type="text" class="form-control form-control-sm" name=""></div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2"></div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">ﾊﾟｽﾜｰﾄﾞ</div>
                                <div class="col-3"><input type="text" class="form-control form-control-sm" name=""></div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2">SQL監視</div>
                                <div class="col-2">
                                    <label class="switch text-white common_dialog" gourl="/admin/share/server?setting=security&tab=getmails&act=usage&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog11">
                                        <input type="checkbox" <?= (int)$getmails['usage']==1? "checked":""  ?>>
                                        <span class="slider <?= (int)$getmails['usage']==1? "slideron":"slideroff"  ?>"></span>
                                        <span class="handle <?= (int)$getmails['usage']==1? "handleon":"handleoff"  ?>"></span>
                                        <span class="<?= (int)$getmails['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$getmails['usage']==1? "起動":"停止"  ?></span>
                                    </label>
                                </div>
                                <div class="col-2">ユーザー名</div>
                                <div class="col-3"><input type="text" class="form-control form-control-sm" name=""></div>
                            </div>
                            <div class="d-flex mt-3 col-6 col-sm-12">
                                <div class="mr-2 col-2"></div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">ﾊﾟｽﾜｰﾄ</div>
                                <div class="col-3"><input type="text" class="form-control form-control-sm" name=""></div>
                            </div>
                        </div>
                        <div class="back-button"><a href="/admin?main=surveillance&act=index" onclick="loading()"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php 
require_once('views/admin/surveillance/vps/footer.php');
?>
<script>
$(document).on('click','.clone-input',function(){
	$(this).parent().parent().next('.clone-div').clone().insertAfter('.clone-div:last');

});
$(document).on('click','.delete-clone', function(){
	$(this).parent().parent().remove();
})
</script>