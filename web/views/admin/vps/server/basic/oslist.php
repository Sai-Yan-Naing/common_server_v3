<?php
require_once('views/admin/admin_vpsconfig.php');
$host_ip = $webvmhost_ip;
$host_user = $webvmhost_user;
$host_password = $webvmhost_password;
$os = $_POST['os'];
$oslist = Shell_Exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\vps_basicsetting\os.ps1" osfile '.$host_ip.' '.$host_user.' '.$host_password.' '.$os);
$oslist = explode("\n",rtrim($oslist));

foreach ($oslist as $key => $value) {
?>

<div class="col-xl-3 col-md-6">
                <label class="card mb-4">
                    <input type="radio" name="os" form="osreinstall" value="<?=$os?>" class="os_change d-none" data-name="<?=str_replace('.vhdx', '', $value);?>">
                    <div class="card-body">
                        <div class="row">
                            <div class=""><img src="/img/osicon/<?=$os?>.png" alt="" class="nav-tab-icon"></div>
                        </div>
                    </div>
                    <div class="card-header osname">
                         <?=str_replace('.vhdx', '', $value);?>
                    </div>
                </label>
            </div>

<?php } ?>