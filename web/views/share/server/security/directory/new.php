<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">ディレクトリ</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/share/server?setting=security&tab=directory&act=confirm&webid=<?=$webid?>" method="post" id="dir_path_create">
      <input type="hidden" name="action" value="new">
      <div class="row justify-content-center">
          <label for="dir_path" class="col-sm-2 text-right p-2">/<?=$webuser?>/web/</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" column="dir_path" id="dir_path" name="dir_path" placeholder="example"><i class="fas fa-folder text-warning fa-lg" style="font-size: 2.33em; display:none;"></i>
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="ftp_user" class="col-sm-2 text-right p-2">ユーザー名</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ftp_user" name="ftp_user" placeholder="1～20文字、半角英数字"  column="ftp_user"  table="sub_ftp" remark="winuser"><i class="fas fa-folder text-warning fa-lg" style="font-size: 2.33em; display:none;"></i>
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="ftp_pass" class="col-sm-2 text-right p-2">パスワード</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" column="ftp_pass" id="ftp_pass" name="ftp_pass" placeholder="6～127文字、半角英数記号の組み合わせ"><i class="fas fa-folder text-warning fa-lg" style="font-size: 2.33em; display:none;"></i>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="dir_path_create">作成</button>
</div>