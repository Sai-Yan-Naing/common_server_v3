<?php
require_once('views/admin/admin_shareconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Web site</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/various?setting=information&act=confirm&webid=<?=$webid?>" method="post" id="onoff">
    <input type="hidden" name="action" value="onoff">
    <input type="hidden" name="act_id" value="<?= $webid ?>">
    <input type="hidden" name="stopped" value="<?= $webstopped ?>">
    <input type="hidden" name="sitename" value="<?= $webuser ?>">
    <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
    <?= $webstopped==0? "停止" : "起動" ?>しますか ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>