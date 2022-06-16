<?php
require_once('views/share_config.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">データベース追加</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/share/server?setting=database&tab=mssql&act=confirm&webid=<?=$webid?>" method="post" id="database_create">
      <input type="hidden" name="action" value="new">
        <div class="row mb-3">
            <div class="col-sm-2">
                <span>データベース種別</span>
            </div>
            <div class="col-sm-10">
                <div class="btn-group btn-group-toggle" data-toggle="buttons" id="typeofdb">
                    <!-- <label class="btn btn-outline-info">
                        <input type="radio" name="type" id="mysql" value="MYSQL" autocomplete="off" checked> MYSQL
                    </label> -->
                    <!-- <label class="btn btn-outline-info active"> -->
                        <input type="hidden" name="type" id="mssql" value="MSSQL" autocomplete="off"> MSSQL
                    <!-- </label> -->
                    <!-- <label class="btn btn-outline-info">
                        <input type="radio" name="type" id="mariadb" value="MARIADB" autocomplete="off"> MARIADB
                    </label>-->
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="db_name" class="col-sm-2 col-form-label">データベース名</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="db_name" name="db_name" placeholder="1～64文字、半角英数字記号"  column="db_name" table="db_account_for_mssql" remark="msdbname">
            </div>
        </div>
        <div class="form-group row">
            <label for="db_user" class="col-sm-2 col-form-label">ユーザー名</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="db_user" name="db_user" placeholder="1～32文字、半角英数字記号"  column="db_user" table="db_account_for_mssql" remark="msdbuser">
            </div>
        </div>
        <div class="form-group row">
            <label for="db_pass" class="col-sm-2 col-form-label">パスワード</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="db_pass" name="db_pass" placeholder="8～30文字、半角英数字記号">
              <span toggle="#db_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="database_create">作成</button>
</div>