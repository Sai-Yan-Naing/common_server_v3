<?php
require_once("views/share_config.php");
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">エラーページ追加</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/share/server?setting=site&tab=basic&act=confirm" method="post" id="error_create" onsubmit="loading()">
	    <input type="hidden" name="action" value="new">
	      <div class="form-group row">
	          <label for="status_code" class="col-sm-4">ステータスコード</label>
	          <div class="col-sm-8">
	            <input type="text" class="form-control" id="status_code" name="status_code" placeholder="1-14文字、半角英数字">
	          </div>
	      </div>
	      <div class="form-group row">
	          <label for="url" class="col-sm-4 col-form-label">URL指定</label>
	          <div class="col-sm-8">
	            <input type="text" class="form-control" id="url_spec" name="url_spec" placeholder="8～70文字、半角英数記号の組み合わせ">
	          </div>
	      </div>
	  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="error_create">作成</button>
</div>