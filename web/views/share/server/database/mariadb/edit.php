<?php
require_once('views/share_config.php');
$act_id = $_GET['act_id'];
$query = "select * from db_account_for_mariadb where domain='$webdomain' and id='$act_id'";
$getRow = $commons->getRow($query);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">データベース編集</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

                <form action="/share/server?setting=database&tab=mariadb&act=confirm&webid=<?= $webid?>" method="post" id="database_create">
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" name="type" value="MARIADB">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <span>データベース種別</span>
                        </div>
                        <div class="col-sm-10">
                            MARIADB
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="db_user" class="col-sm-2 col-form-label">ユーザー名</label>
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" id="db_user" readonly name="db_user" value="<?= $getRow['db_user'] ?>" placeholder="8～70文字、半角英数記号の組み合わせ">
                          <label for=""><?= htmlspecialchars($getRow['db_user'], ENT_QUOTES) ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="db_pass" class="col-sm-2 col-form-label">パスワード</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="db_pass" value="<?= $getRow['db_pass'] ?>" name="db_pass" placeholder="8～70文字、半角英数記号の組み合わせ">
                        </div>
                    </div>
               </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="database_create">作成</button>
</div>