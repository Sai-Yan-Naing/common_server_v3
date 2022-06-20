<?php
require_once('views/admin/admin_shareconfig.php');
$act_id = $_GET['act_id'];
$query = "SELECT * FROM sub_ftp WHERE id='$act_id' and domain='$webdomain'";
$getRows = new Common;
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">ユーザーパスワード編集</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/admin/share/server?setting=security&tab=directory&act=confirm&webid=<?=$webid?>" method="post" id="dir_path_create">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="act_id" value="<?=$getRow['id'] ?>">
      <div class="row justify-content-center">
          <label for="dir_path" class="col-sm-2 text-right p-2">/<?=$webuser?>/web/</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" column="dir_path" id="dir_path" name="dir_path" readonly placeholder="example" value="<?=$getRow['path'] ?>"><i class="fas fa-folder text-warning fa-lg" style="font-size: 2.33em; display:none;"></i>
            <label for=""><?=$getRow['path'] ?></label>
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="ftp_user" class="col-sm-2 text-right p-2">ユーザー名</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" readonly column="ftp_user" id="ftp_user" name="ftp_user" placeholder="1～14文字、半角英数字" value="<?=$getRow['ftp_user'] ?>">
            <label for=""><?=$getRow['ftp_user'] ?></label>
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="ftp_pass" class="col-sm-2 text-right p-2">パスワード</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" column="ftp_pass" id="ftp_pass" name="ftp_pass" placeholder="8～30文字、半角英数記号の組み合わせ" value="<?=$getRow['ftp_pass'] ?>">
            <span toggle="#ftp_pass" class="fa fa-fw fa-eye fa-eye-slash field-icon toggle-password"></span>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="dir_path_create">保存</button>
</div>