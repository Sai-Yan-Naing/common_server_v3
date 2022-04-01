<?php
require_once('views/share_config.php');
$webblacklist = json_decode($webblacklist);
$act_id = $_GET['act_id'];
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">IP削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
  <form action="/share/server?setting=security&tab=ip&act=confirm&webid=<?= $webid?>" method="post" id="delete_ip">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $act_id ?>">
    <input type="hidden" name="block_ip" value="<?= $webblacklist->$act_id->ip ?>"> 
    ブラックリストから「<b style="color: red"><?= $webblacklist->$act_id->ip ?> </b>」を削除しますか？ 
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_ip">削除</button>
</div>