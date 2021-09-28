<!-- Modal Header -->
<?php require_once('views/admin/admin_vpsconfig.php'); ?>
<div class="modal-header">
  <h4 class="modal-title">Server Backup</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/vps/various?setting=backup&tab=backup&act=confirm&webid=<?=$webid?>" method = "post" id="autobackup">
        <input type="hidden" name="action" value="backup">
        Are you sure to backup server <b style="color: green"><?=$webip?> </b> ?
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="autobackup">作成</button>
</div>