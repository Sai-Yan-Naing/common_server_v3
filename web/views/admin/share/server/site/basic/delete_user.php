<?php
require_once("views/admin/admin_shareconfig.php");
$dir_id = $_GET['dir_id'];
$act_id = $_GET['act_id'];
$temp = json_decode($webbasicsetting);
// print_r($getBassSetting);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">ユーザー削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
  <form action="/admin/share/server?setting=site&tab=basic&act=confirm_dir&for=user&webid=<?=$webid?>" method="post" id="delete_bass_user" onsubmit="loading()">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="bass_dir" value="<?= $temp->$dir_id->url ?>">
    <input type="hidden" name="act_id" value="<?= $act_id ?>">
    <input type="hidden" name="dir_id" value="<?= $dir_id ?>">
    ユーザー削除「<b style="color: red"><?= $temp->$dir_id->user->$act_id->bass_user ?></b>」を削除しますか？
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_bass_user">削除</button>
</div>