<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">サーバーバックアップ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/share/various?setting=backup&act=confirm&webid=<?=$webid?>" method = "post" id="autobackup" onsubmit="loading()">
        <input type="hidden" name="action" value="restore">
「<b class="text-warning"><?=$webdomain ?> </b>（<?= $_GET['cron']?>）」をリストアしますか？
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="autobackup">作成</button>
</div>


