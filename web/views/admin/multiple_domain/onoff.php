<?php
require_once('views/admin/admin_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM web_account WHERE id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"> ＷＥＢサイト起動/停止</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/multiple_domain?act=confirm<?=$pagy?>" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="onoff">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="stopped" value="<?= $getRow['stopped'] ?>">
    <input type="hidden" name="sitename" value="<?= $getRow['user'] ?>">
    <?= $getRow['stopped']==1? "起動" : "停止"  ?>しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff"><?= $getRow['stopped']==1? "起動" : "停止"  ?></button>
</div>