<?php
require_once("views/admin/admin_shareconfig.php");
$webappversion = json_decode($webappversion);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">PHPバージョン</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
  <form action="/admin/share/server?setting=site&tab=app_setting&act=confirm&apply=php_version&webid=<?=$webid?>" method="post" id="phpversion_fm">
    <input type="hidden" name="action" value="new">
      <div class="row justify-content-center">
          <label for="php_version" class="col-sm-2 text-right p-2">PHPバージョン</label>
          <div class="col-sm-10">
            <select name="version" id="php_version" class="form-control">
            <?php
                foreach(getPhpVersion() as $phpkey=>$phpvalue) : ?>

                <option value="<?=$phpvalue?>" <?php if($phpvalue==$webappversion->app->php){ echo "selected";} ?>><?=$phpvalue?></option>

            <?php endforeach; ?>
            </select>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="phpversion_fm">Save</button>
</div>