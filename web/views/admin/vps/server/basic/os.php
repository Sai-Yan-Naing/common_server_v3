<?php
require_once('views/admin/admin_vpsconfig.php');
$plan_q = "SELECT [plan] FROM vps_account Where id=?";
$getpln = $commons->getRow($plan_q,[$webid]);
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$oslist = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vps_basicsetting\os.ps1" os '.$host_ip.' '.$host_user.' '.$host_password);
$oslist = explode("\n",rtrim($oslist));
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">OS初期化</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <div class="row" id="allos">
        <?php foreach ($oslist as $key => $value): ?>
        <div class="col-xl-3 col-md-6 selectos" data-os="<?=$value?>" gourl="/admin/vps/server?tab=basic&act=oslist&webid=<?=$webid?>">
            <label class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class=""><img src="/img/osicon/<?=$value?>.png" alt="" class="nav-tab-icon"></div>
                    </div>
                </div>
                <div class="card-header osname">
                     <?=$value?>
                </div>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="d-none" id="osfilelist">
        <div class="mb-3">
            <span class="osback" style="cursor:pointer"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
        </div>
        <div class="row" id='osresult'>
            Loading ....
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