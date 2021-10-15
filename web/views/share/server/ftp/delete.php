<?php
require_once('views/share_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM db_ftp WHERE id= ?";
$getRow = $commons->getRow($query,[$act_id]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">FTPユーザー削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/server?setting=ftp&tab=tab&act=confirm" method="post" id="delete_ftp">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="ftp_user" value="<?= $getRow['ftp_user'] ?>">
    Are you sure to delete <b style="color: red"><?= $getRow['ftp_user'] ?> </b> ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_ftp">削除</button>
</div>