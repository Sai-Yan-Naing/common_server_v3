<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$error_page = json_decode($weberrorpages);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">エラーページ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=site&tab=basic&act=confirm&webid=<?=$webid?>" method="post" id="onoff">
    <input type="hidden" name="action" value="onoff">
    <input type="hidden" name="act_id" value="<?= $act_id ?>">
    <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
    Are you sure to <?= $error_page->$act_id->stopped==1?  "OFF":"ON"  ?>?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>