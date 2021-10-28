<?php
require_once("views/admin/admin_shareconfig.php");
$temp = json_decode($webbasicsetting);
$temp_key = $_GET['act_id'];
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">ディレクトリ削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
  <form action="/admin/share/server?setting=site&tab=basic&act=confirm_dir&for=dir&webid=<?=$webid?>" method="post" id="delete_bass_dir" onsubmit="loading()">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="dir_id" value="<?= $temp_key ?>">
    <input type="hidden" name="bass_dir" value="<?= $temp->$temp_key->url ?>">
    <b style="color: red"><?= $temp->$temp_key->url ?> </b>を削除しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_bass_dir">削除</button>
</div>