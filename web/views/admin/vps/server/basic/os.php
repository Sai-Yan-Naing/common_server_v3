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
    <div class="row" id="allos">
        <div class="col-xl-3 col-md-6 selectos" data-os='wins'>
            <label class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class=""><img src="/img/osicon/win.png" alt="" class="nav-tab-icon"></div>
                    </div>
                </div>
                <div class="card-header osname">
                     Windows OS
                </div>
            </label>
        </div>
        <div class="col-xl-3 col-md-6 selectos" data-os='ubuntu'>
            <label class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class=""><img src="/img/osicon/ubuntu.png" alt="" class="nav-tab-icon"></div>
                    </div>
                </div>
                <div class="card-header osname">
                     Ubuntu OS
                </div>
            </label>
        </div>
    </div>
    <div class="d-none" id="wins">
        <div class="mb-3">
            <span class="osback" style="cursor:pointer"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="wins-16" class="os_change d-none" data-name="Windows server 2016">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/win.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Windows server 2016
                    </div>
                </label>
            </div>
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="wins-19" class="os_change d-none" data-name="Windows server 2019">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/win.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Windows server 2019
                    </div>
                </label>
            </div>
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="wins-22" class="os_change d-none" data-name="Windows server 2022">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/win.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Windows server 2022
                    </div>
                </label>
            </div>
        </div>
    </div>
    <div class="d-none" id="ubuntu">
        <div class="mb-3">
            <span class="osback" style="cursor:pointer"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="ubuntu-16" class="os_change d-none" data-name="Ubuntu 16.04.6 LTS">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/ubuntu.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Ubuntu 16.04.6 LTS
                    </div>
                </label>
            </div>
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="ubuntu-18" class="os_change d-none" data-name="Ubuntu 18.04.6 LTS">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/ubuntu.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Ubuntu 18.04.6 LTS
                    </div>
                </label>
            </div>
            <div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="osversion" form="osreinstall" value="ubuntu-20" class="os_change d-none" data-name="Ubuntu 20.04.4 LTS">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/ubuntu.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         Ubuntu 20.04.4 LTS
                    </div>
                </label>
            </div>
        </div>
    </div>
    <form action="/admin/vps/server?tab=basic&act=confirm&webid=<?=$webid?>" method="post" id="osreinstall" onsubmit="loading()">
        <input type="hidden" name="action" value="osreinstall">
        <input type="hidden" name="spec" value="<?= $getpln['plan'] ?>">
        <input type="hidden" name="osname">
        
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="osreinstall">確認</button>
</div>