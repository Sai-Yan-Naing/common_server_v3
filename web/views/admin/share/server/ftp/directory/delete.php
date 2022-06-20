<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM sub_ftp WHERE id='$act_id' and domain='$webdomain'";
$datas = new Common;
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">ディレクトリ削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=security&tab=directory&act=confirm&webid=<?=$webid?>" method="post" id="delete_ftp">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="dir_path" value="<?= $getRow['path'] ?>">
    <input type="hidden" name="ftp_user" value="<?= $getRow['ftp_user'] ?>">
    「<b style="color: red"><?= htmlspecialchars($getRow['path'], ENT_QUOTES); ?></b>」を削除しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_ftp">削除</button>
</div>