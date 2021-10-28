<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">新規ディレクトリ作成</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/server?setting=filemanager&tab=tab&act=confirm" method="post" id="fm_fun" style="position:relative">
    <input type="hidden" name="action" value="new_dir">
    <label>Name:</label>
    <input type="text" class="form-control" name="new_dir">
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">閉じる</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="fm_fun">保存</button>
</div>