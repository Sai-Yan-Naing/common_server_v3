<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$error_page = json_decode($weberrorpages);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">エラーページ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=site&tab=basic&act=confirm&webid=<?=$webid?>" method="post" id="delete_error" onsubmit="loading()">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $act_id ?>">
    「エラーページ <?= $error_page->$act_id->statuscode?>」 を削除しますか？
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_error">削除</button>
</div>