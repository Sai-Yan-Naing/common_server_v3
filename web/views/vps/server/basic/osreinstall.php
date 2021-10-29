<?php
require_once('views/vps_config.php');
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
    <form action="/vps/server?tab=basic&act=confirm" method="post" id="osreinstall" onsubmit="loading()">
        <input type="hidden" name="action" value="osreinstall">
        <input type="hidden" name="spec" value="<?= $getpln['plan'] ?>">
        <!-- <?= $getRow['domain'] ?>をバックアップしますか？ -->
        Are you sure to OS初期化 ?
        
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="osreinstall">確認</button>
</div>