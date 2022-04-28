
<?php
require_once('views/share_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM add_email WHERE id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Delete Email</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

	<form action="/share/mail?setting=email&tab=tab&act=confirm" method="post" id="delete_ftp">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
		<input type="hidden" name="email" value="<?= $getRow['email'] ?>">
		Are you sure to delete <b style="color: red"><?= htmlspecialchars($getRow['email'], ENT_QUOTES) ?>@<?= htmlspecialchars($webdomain, ENT_QUOTES) ?> </b> ?
	    
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="delete_ftp">削除</button>
</div>