<?php
 require_once('views/admin/admin_vpsconfig.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM vps_backup WHERE id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Server Restore</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/vps/various?setting=backup&tab=backup&act=confirm&webid=<?=$webid?>" method = "post" id="vpsautobackup">
    <input type="hidden" name="action" value="restore">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    <input type="hidden" name="backup_vmname" value="<?= $getRow['name'] ?>">
    Are you sure to restore <b class="text-warning"><?= $getRow['name'] ?> </b> ?
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="vpsautobackup">作成</button>
</div>


