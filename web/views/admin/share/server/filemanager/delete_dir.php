<?php
require_once('views/admin/admin_shareconfig.php');
// $act_id = $_GET['act_id'];
// $query = "SELECT * FROM db_ftp WHERE id='$act_id'";
// $getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">FTPユーザー削除</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="fm_fun" style="position:relative">
    <input type="hidden" name="action" value="delete_dir">
    <input type="hidden" name="delete_dir" value="delete">
    <b style="color: red" id="delete_name">domainname</b>を削除しますか ?
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="fm_fun">削除</button>
</div>