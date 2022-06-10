<?php
require_once('views/admin/admin_shareconfig.php');
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Import mail user from csv</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
	<form action="/admin/share/mail?setting=email&tab=tab&act=confirm&webid=<?=$webid?>" method="post" id="email_import"  style="position:relative"  enctype="multipart/form-data">

		<input type="hidden" name="action" value="import">
        <div class="form-group">
            <label class="ps_absolute">ファイルをドラッグ＆ドロップしてください</label>
		    <div style="position: relative; height: 200px">
		        <input type="file" class="form-control" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="upload_">
		    </div>
            
        </div>
	</form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="email_import">Import</button>
</div>

<style type="text/css">
      #upload_{
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        outline: none;
        opacity: 0;
      }
      .ps_absolute
      {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        border: 3px solid green; 
        font-weight: bold;
      }
    </style>