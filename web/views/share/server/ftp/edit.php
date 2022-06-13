<?php
require_once('views/share_config.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM db_ftp WHERE id=?";
$getRow = $commons->getRow($query,[$act_id]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">FTPユーザー編集</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/share/server?setting=ftp&tab=tab&act=confirm&webid=<?=$webid?><?=$pagy?>" method="post" id="ftp_create">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="act_id" value="<?= $getRow['id'] ?>">
      <div class="form-group row">
          <label for="ftp_user" class="col-sm-4 col-form-label">FTPユーザー</label>
          <div class="col-sm-8">
            <input type="hidden" class="form-control" readonly value="<?= $getRow['ftp_user'] ?>" name="ftp_user" placeholder="1～14文字、半角英数字">
            <label for=""><?= $getRow['ftp_user'] ?></label>
          </div>
      </div>
      <div class="form-group row">
          <label for="ftp_pass" class="col-sm-4 col-form-label">パスワード</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" id="ftp_pass" name="ftp_pass" value="<?= $getRow['ftp_pass'] ?>" placeholder="6～127文字、半角英数記号の組み合わせ">
                <label for="ftp_pass" id="ftp_pass_error" class="error"></label>
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
                <input type="checkbox" class="form-check-input" id="full_control" name="permission[]" <?php if ( in_array("F", explode(",",$getRow['permission']))) : echo "checked"; endif ?> value="F">フルコントロール
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input permission" name="permission[]" value="R" <?php if ( in_array("R", explode(",",$getRow['permission']))) : echo "checked";endif ?>>読み
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input permission" name="permission[]" value="W" <?php if ( in_array("W", explode(",",$getRow['permission']))) : echo "checked"; endif; ?>>書き
              </label>
            </div>
                  <label for="permission" id="permission_error" class="error"></label>
              </div>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="ftp_create">変更</button>
</div>