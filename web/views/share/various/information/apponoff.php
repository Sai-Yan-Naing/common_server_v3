<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Web site</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/various?setting=information&act=confirm" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="apponoff">
    <input type="hidden" name="act_id" value="<?= $webid ?>">
    <input type="hidden" name="appstopped" value="<?= $webappstopped ?>">
    <input type="hidden" name="sitename" value="<?= $webuser ?>">
    <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
    <?= $webappstopped==0? "停止" : "起動" ?>しますか ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff"><?= $webappstopped==0? "停止" : "起動" ?></button>
</div>