<?php
require_once('views/admin/surveillance/vps/config.php');
$act_id = $_GET['act_id'];
$mail = '';
$getmails = $commons->getRow("SELECT * FROM monitor_mail WHERE domain_ip=? and type=?",[$webid,'vps']);
$arr = json_decode($getmails['ping'],true);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">PING監視</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin?main=surveillance&act=confirm&tab=vps&webid=<?=$webid?>" method="post" id="deletemail">
		<input type="hidden" name="action" value="ping">
		<input type="hidden" name="ping" value="<?= $arr['ping']?>">
        <b style="color: s"> <?= $arr['ping']==1? "停止" : "起動"  ?>しますか？
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="deletemail"><?= $arr['ping']==1? "停止" : "起動"  ?></button>
</div>