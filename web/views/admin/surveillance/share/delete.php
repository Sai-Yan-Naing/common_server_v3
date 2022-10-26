<?php
require_once('views/admin/surveillance/share/config.php');
$act_id = $_GET['act_id'];
$mail = '';
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,'share']);
$arr = json_decode($getmails['mail'],true);
foreach($arr as $t){
    if($act_id==$t['id']){
        $mail = $t['mail'];
        break;
    }
}
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">通知先</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin?main=surveillance&act=confirm&tab=share&webid=<?=$webid?>" method="post" id="deletemail">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="act_id" value="<?= $act_id ?>">
        <b style="color: red"><?= htmlspecialchars($mail, ENT_QUOTES) ?></b>を削除しますか？
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="deletemail">削除</button>
</div>