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

	<!-- <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="form-group d-flex ">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary active">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> 個別入力
                        </label>
                    </div>
            </div>
        </div>
    </div> -->
	<form action="/share/mail?setting=email&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="email_create">

		<input type="hidden" name="action" value="new">
    	<div class="row mr-2 mb-1">
                <div class="d-flex">
                    <label for="email">メールアドレス</label>
                    <div class="ml-3">※ メールアカウント名を入力してください（例）infoと入力するとinfo＠<?=$webdomain?>で作成します。</div>
                </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="メールアドレス" column="email" id="email" name="email" column="email" table="add_email" remark="db">
            </div>
    	</div>
        <div class="form-group row mr-2 ">
            <div class="col-sm-6">
            <label for="mail_pass_word"  class="form-label">パスワード</label>
                <input type="password" class="form-control" name="mail_pass_word" id="mail_pass_word" placeholder="8～30文字、半角英数字記号の組み合わせ">
                <span toggle="#mail_pass_word" class="fa fa-fw fa-eye fa-eye-slash field-icon toggle-password"></span>
            </div>
            <div class="col-sm-2">

            </div>
            
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="email_create">作成</button>
</div>