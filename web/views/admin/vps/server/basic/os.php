<?php
require_once('views/admin/admin_vpsconfig.php');
$plan_q = "SELECT [plan] FROM vps_account Where id=?";
$getpln = $commons->getRow($plan_q,[$webid]);
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">OS初期化</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <div class="row">
    	<div class="col-xl-3 col-md-6">
            <label class="card mb-4">
            	<input type="radio" name="spec" form="updateplan" value="window" class="spec_change d-none">
                <div class="card-body">
                    <div class="row">
                        <div class=""><img src="/img/osicon/win.png" alt="" class="nav-tab-icon"></div>
                    </div>
                </div>
                <div class="card-header">
                     Windows OS
                </div>
            </label>
        </div>
    	<div class="col-xl-3 col-md-6">
            <label class="card mb-4">
            	<input type="radio" name="spec" form="updateplan" value="ubuntu" class="spec_change d-none">
                <div class="card-body">
                    <div class="row">
                        <div class=""><img src="/img/osicon/ubuntu.png" alt="" class="nav-tab-icon"></div>
                    </div>
                </div>
                <div class="card-header">
                     Ubuntu OS
                </div>
            </label>
        </div>
    </div>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="button" class="btn btn-outline-info btn-sm" form="osreinstall">確認</button>
</div>