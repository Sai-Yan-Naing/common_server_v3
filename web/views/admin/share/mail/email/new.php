<?php
require_once('views/admin/admin_shareconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">新規メールアドレス追加</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

	<div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="form-group d-flex justify-content-center">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary active">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> 個別入力
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="options" id="option2" autocomplete="off"> CSV
                        </label>
                    </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
	<form action="/admin/share/mail?setting=email&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="email_create">
		<input type="hidden" name="action" value="new">
    	<div class="row mr-2 justify-content-center mb-1">
    		<div class="col-sm-3"><label for="email">メールアドレス</label></div>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="メールアドレス" column="email" onkeyup="change_mail_text(this.value)" id="email" name="email" column="email" table="add_email" remark="db">
            </div>
		    <div class="col-sm-3">
                <label  class="form-label"  for="email"><span id="change_mail_text"></span>@<?= $webdomain?></label>
            </div>
    	</div>
        <span class="row mr-2 justify-content-center mb-1">
            <label for="email" id="email_error" class="error col-sm-6"></label>
        </span>
        <div class="form-group row mr-2  justify-content-center">
            <div class="col-sm-3">
                <label for="mail_pass_word"  class="form-label">パスワード</label>
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="mail_pass_word" id="mail_pass_word" placeholder="8～70文字、半角英数記号の組み合わせ">
            </div>
            <div class="col-sm-3">

            </div>
            
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="email_create">作成</button>
</div>