<?php
require_once("views/share_config.php");
$temp = json_decode($webbasicsetting);
$temp_key = $_GET['dir_id'];
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">認証ユーザー</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/server?setting=site&tab=basic&act=confirm_dir&for=user&webid=<?=$webid?>" method="post" id="basic_adduser_create">
    <input type="hidden" name="action" value="new">
    <input type="hidden" name="dir_id" value="<?= $temp_key?>">
      <div class="row justify-content-center">
        <label for="bass_dir" class="col-sm-2 text-right p-2">対象ディレクトリ</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="bass_dir" readonly value="<?=$temp->$temp_key->url ?>">
        </div>
      </div>
      
      <div class="row justify-content-center">
          <label for="bass_user" class="col-sm-2 text-right p-2">ユーザー名</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" column="bass_user" id="bass_user" name="bass_user" placeholder="1～20文字、半角英数字">
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="bass_pass" class="col-sm-2 text-right p-2">パスワード</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" column="bass_pass" id="bass_pass" name="bass_pass" placeholder="8～30文字、半角英数字記号の組み合わせ">
            <span toggle="#bass_pass" class="fa fa-fw fa-eye fa-eye-slash field-icon toggle-password"></span>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="basic_adduser_create">作成</button>
</div>