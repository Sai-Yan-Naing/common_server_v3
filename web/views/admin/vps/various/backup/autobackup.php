<?php
require_once('views/admin/admin_vpsconfig.php');
$getvpsbackup = $commons->getRow("SELECT * FROM vps_backup WHERE ip='$webip'");
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Server Auto Backup</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/vps/various?setting=backup&tab=backup&act=confirm&webid=<?=$webid?>" method="post" id="onoff">
    <input type="hidden" name="action" value="auto_backup">
    <?= $getvpsbackup['scheduler']==0? "起動" : "停止"  ?>しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff">確認</button>
</div>