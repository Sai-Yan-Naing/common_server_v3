<?php
require_once('views/share_config.php');
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

  <form action="/share/server?setting=site&tab=basic&act=confirm&webid=<?=$webid?>" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="onoff">
    <input type="hidden" name="act_id" value="<?= $act_id ?>">
    エラー設定「<?= $_GET['errorcode']?>」を<?= $error_page->$act_id->stopped==1?  "OFF":"ON"  ?>にしますか?
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff"><?= $error_page->$act_id->stopped==1?  "OFF":"ON"  ?></button>
</div>