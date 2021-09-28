<?php
require_once('views/admin/admin_shareconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Rename Directory</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="fm_fun" style="position:relative">
    <input type="hidden" name="action" value="rename">
    <label>Name:</label>
    <input type="hidden" name="old" id="old">
    <input type="text" class="form-control" name="rename" id="rename">
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">閉じる</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="fm_fun">保存</button>
</div>