<?php
require_once('views/admin/admin_shareconfig.php');
$waf = $commons->getRow("SELECT * FROM waf WHERE domain= ? ", [$webdomain]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">WAF設定</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=security&tab=waf&act=confirm&webid=<?=$webid?>" method="post" id="onoff">
    <input type="hidden" name="switch" value="usage">
    <input type="hidden" name="onoff" value="<?= (int)$waf['usage']==1? 0 : 1 ?>">
    <?= (int)$waf['usage']==1? "停止" : "起動" ?>しますか ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>