<?php
require_once('views/vps_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM vps_backup WHERE id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Server Backup Delete</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/vps/various?setting=backup&tab=backup&act=confirm&webid=<?=$webid?>" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
    Are you sure to delete ?
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>