<!-- Modal Header -->
<?php
require_once('views/admin/admin_config.php');
$webid = $_GET['webid'];
$query = "SELECT * FROM web_account WHERE id=:webid";
$getRow = $commons->getRow($query, ['webid' => $webid]);
$dns = json_decode($getRow['dns']);
$act_id = $_GET['act_id'];
// echo $getRow['id'];
?>
<div class="modal-header">
	<h4 class="modal-title">申請が完了しました。
弊社にて作業完了次第、ご連絡させていただきますので
反映まで今しばらくお待ちください。</h4>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/dns?tab=share&act=confirm&webid=<?= htmlspecialchars($getRow['id'], ENT_QUOTES); ?>" method="post" id="delete_dns">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="act_id" value="<?= htmlspecialchars($act_id, ENT_QUOTES); ?>">
		<b style="color: red"><?= htmlspecialchars($dns->$act_id->sub, ENT_QUOTES); ?>.<?= htmlspecialchars($getRow['domain'], ENT_QUOTES); ?> </b>’を削除しますか？
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
	<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
	<button type="submit" class="btn btn-outline-info btn-sm" form="delete_dns">削除</button>
</div>