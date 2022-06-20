<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">FTPユーザー追加</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/server?setting=ftp&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="ftp_create">
    <input type="hidden" name="action" value="new">
      <div class="form-group row">
          <label for="ftp_user" class="col-sm-4">FTPユーザー</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="ftp_user" name="ftp_user" placeholder="1～20文字、半角英数小文字と_-." column="ftp_user"  table="db_ftp" remark="winuser">
          </div>
      </div>
      <div class="form-group row">
          <label for="ftp_pass" class="col-sm-4 col-form-label">ディレクトリパス</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" column="dir_path" id="dir_path" name="dir_path" placeholder="example"><i class="fas fa-folder text-warning fa-lg" style="font-size: 2.33em; display:none;"></i>
          </div>
      </div>
      <div class="form-group row">
          <label for="ftp_pass" class="col-sm-4 col-form-label">パスワード</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" id="ftp_pass" name="ftp_pass" placeholder="8～30文字、半角英数記号の組み合わせ">
            <span toggle="#ftp_pass" class="fa fa-fw fa-eye fa-eye-slash field-icon toggle-password"></span>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-4">
              <div class="form-group">
                  <span>接続許可ディレクトリ</span>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="form-group">
                  <div class="form-check-inline">
              <label class="form-check-label">
                <input type="hidden" class="form-check-input" id="full_control" name="permission[]" value="F">フルコントロール
              </label>
            </div>
            <!-- <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input permission" name="permission[]" value="R">読み
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input permission" name="permission[]" value="W">書き
              </label>
            </div>
                  <label for="permission" id="permission_error" class="error"></label>
              </div> -->
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="ftp_create">作成</button>
</div>