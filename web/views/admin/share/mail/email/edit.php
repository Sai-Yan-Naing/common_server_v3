<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM add_email WHERE id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">アカウントのパスワード変更</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/share/mail?setting=email&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="email_create">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="email" value="<?= $getRow['email'] ?>">
		<input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
    	<div class="form-group row mr-2">
    		<span for="email" class="form-label">メールアドレス</span>
		    <span  class="col-sm-6 form-label"><span id="change_mail_text"></span><?= htmlspecialchars($getRow['email'], ENT_QUOTES) ?>@<?= htmlspecialchars($webdomain, ENT_QUOTES) ?></span>
            <span class="col-sm-3"></span>
    	</div>
        <div class="form-group row mr-2">
            <div class="col-md-6">
                <label for="mail_pass_word"  class="form-label">パスワード</label>
            <input type="password" class="form-control" name="mail_pass_word" value="<?= $getRow['password'] ?>" id="mail_pass_word" placeholder="8～30文字、半角英数記号の組み合わせ">
            <span toggle="#mail_pass_word" class="fa fa-fw fa-eye field-icon toggle-password"></span>
             <label for="mail_pass_word" id="mail_pass_word_error" class="error"></label>
            </div>
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="email_create">変更</button>
</div>