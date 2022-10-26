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
	<form action="/admin?main=surveillance&act=confirm&tab=share&webid=<?=$webid?>" method="post" id="create_mail">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="act_id" value="<?= $act_id ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">メールアドレス</div>
                <div class="col-md-6"><input type="email" name="mail" value="<?= $mail?>" class="form-control"></div>
            </div>
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="create_mail">変更</button>
</div>