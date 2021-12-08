<?php
require_once('views/admin/admin_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM vps_account WHERE id= ? ";
$getRow = $commons->getRow($query,[$act_id]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">VPS</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/vps?act=confirm<?=$pagy?>" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <b style="color: red"><?= $getRow['ip'] ?></b>を解約し、削除しますか？
    <br>※削除した場合、データの復旧を行うことはできません。
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">削除</button>
</div>