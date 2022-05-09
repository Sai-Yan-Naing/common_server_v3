<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM app WHERE id=?";
$getRow = $commons->getRow($query,[$act_id]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">アプリケーション削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=site&tab=app_install&act=confirm&webid=<?=$webid?><?=$pagy?>" method="post" id="delete_ftp">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="site_name" value="<?= $getRow['site_name'] ?>">
    <b style="color: red"><?= $getRow['site_name'] ?> </b>を削除しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_ftp">削除</button>
</div>