<?php
require_once('views/share_config.php');
$act_id = $_GET['act_id'];
$backup = new Backup;
$get_backup = $backup->checkScheduler($webdomain);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">バックアップ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/various?setting=backup&act=confirm" method="post" id="onoff">
    <input type="hidden" name="action" value="auto_backup">
    <!-- <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="stopped" value="<?= $getRow['stopped'] ?>">
    <input type="hidden" name="sitename" value="<?= $getRow['user'] ?>"> -->
    <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
    <?= (int)$get_backup['scheduler']==1? "停止" : "起動" ?>しますか ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>