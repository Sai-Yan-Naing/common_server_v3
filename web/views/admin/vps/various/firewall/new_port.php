<?php
// die('hello');
require_once('views/admin/admin_vpsconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">リモートデスクトップ接続</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=remote_desktop_port&webid=<?=$webid?>" method="post" id="rdp">
    <input type="hidden" name="action" value="new">
      <div class="form-group row">
          <label for="port" class="col-sm-4">ポート</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="port" name="port" column="port"  table="" remark="">
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="rdp">変更</button>
</div>