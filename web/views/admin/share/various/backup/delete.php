<?php
require_once('views/admin/admin_shareconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">サーバーバックアップ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/share/various?setting=backup&act=confirm&webid=<?=$webid?>" method = "post" id="autobackup" onsubmit="loading()">
        <input type="hidden" name="action" value="delete">
        「<b style="color: red"><?=$webdomain ?> </b>（<?=$_GET['cron']?>）」を削除しますか？
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="autobackup">削除</button>
</div>


