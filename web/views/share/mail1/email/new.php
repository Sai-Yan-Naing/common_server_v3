<?php
require_once('views/share_config.php');
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
	<form action="/share/mail?setting=email&tab=tab&act=confirm" method="post" id="email_create">
		<input type="hidden" name="action" value="new">
    	<div class="row mr-2 justify-content-center mb-1">
    		<label for="email" class="col-sm-3">メールアドレス</label>
		    <input type="text" class="form-control col-sm-6" placeholder="メールアドレス" column="email" onkeyup="change_mail_text(this.value)" id="email" name="email">
		    <label  class="col-sm-3 form-label"  for="email"><span id="change_mail_text"></span>@<?= $webdomain?></label>
    	</div>
        <span class="row mr-2 justify-content-center mb-1">
            <label for="email" id="email_error" class="error col-sm-6"></label>
        </span>
        <div class="form-group row mr-2  justify-content-center">
            <label for="mail_pass_word"  class="col-sm-3 form-label">パスワード</label>
            <input type="password" class="form-control col-sm-6" name="mail_pass_word" id="mail_pass_word" placeholder=" 8～30文字、半角英数記号の組み合わせ">
            <div class="col-sm-3"></div>
            <label for="mail_pass_word" id="mail_pass_word_error" class="error  col-sm-6"></label>
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="email_create">作成</button>
</div>