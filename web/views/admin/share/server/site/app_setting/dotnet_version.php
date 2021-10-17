<?php
require_once("views/admin/admin_shareconfig.php");
$webappversion = json_decode($webappversion);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">.NETバージョン</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
  <form action="/admin/share/server?setting=site&tab=app_setting&act=confirm&apply=dotnet_version&webid=<?=$webid?>" method="post" id="dotnet" onsubmit="loading()">
    <input type="hidden" name="action" value="new">
      <div class="row justify-content-center">
          <label for="dotnet_v" class="col-sm-2 text-right p-2">.NETバージョン</label>
          <div class="col-sm-10">
            <select name="version" id="dotnet_v" class="form-control">
              <option value="v2.0" <?php if($webappversion->app->dotnet=="v2.0"): echo "selected"; endif; ?>>v2.0 ( include 2.0 and 3.0 )</option>
              <option value="v4.0" <?php if($webappversion->app->dotnet=="v4.0"): echo "selected"; endif; ?>>v4.0</option>
            </select>
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="dotnet">Save</button>
</div>