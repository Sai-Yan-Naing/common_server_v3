<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$query = "select * from db_account where domain='$webdomain' and id=?";
$getRow = $commons->getRow($query,[$act_id]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">MySQL　削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=database&tab=mysql&act=confirm&webid=<?=$webid?><?=$pagy?>" method="post" id="delete_database">
    <input type="hidden" name="type" value="MYSQL">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="db_user" value="<?= $getRow['db_user'] ?>">
    <input type="hidden" name="db_pass" value="<?= $getRow['db_pass'] ?>">
    <input type="hidden" name="db_name" value="<?= $getRow['db_name'] ?>">
    <b style="color: red"><?= $getRow['db_user'] ?> </b>を削除しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_database">削除</button>
</div>