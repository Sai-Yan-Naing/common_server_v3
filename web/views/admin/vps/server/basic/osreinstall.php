<?php
require_once('views/admin/admin_vpsconfig.php');
$plan_q = "SELECT plan FROM vps_account Where id=?";
$getpln = $commons->getRow($plan_q,[$webid]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">OS初期化</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/admin/vps/server?tab=basic&act=confirm&webid=<?=$webid?>" method="post" id="osreinstall" onsubmit="loading()">
        <input type="hidden" name="action" value="osreinstall">
        <input type="hidden" name="spec" value="<?= $getpln['plan'] ?>">
        <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
        OSの初期化を行いますか ?
        
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="osreinstall">確認</button>
</div>