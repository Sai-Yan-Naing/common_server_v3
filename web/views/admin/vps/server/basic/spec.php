<?php
require_once('views/admin/admin_vpsconfig.php');
$plan_q = "SELECT plan FROM vps_account Where id=?";
$getpln = $commons->getRow($plan_q,[$webid]);
$plans = ['78', '79', '80', '81'];

$query = "SELECT spec_info.value,price_tbl.plan_name FROM service_db.dbo.price_tbl
inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND
spec_units.[key] = ? WHERE price_tbl.service = '01' AND  price_tbl.type = '02' AND  price_tbl.pln = ?";

?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Change Plan</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <div class="row">
        <?php 
        
        foreach ($plans as $key=>$plan): 

        $getmemory = $commons->getSpec($query,['memory',$plan]);
        $getdisk = $commons->getSpec($query,['disk_hdd',$plan]);
        $getcore = $commons->getSpec($query,['core',$plan]);
        $spec = [
            "plan_name"=>$getmemory['plan_name'], 
            "memory"=>$getmemory['value'], 
            "disk_hdd"=>$getdisk['value'],
            "core" => $getcore['value']
        ];
?>
        <div class="col-xl-3 col-md-6">
            <label class="card mb-4 <?= ($plan === $getpln['plan'])? 'bg-primary text-white' : ''; ?>">
                <div class="card-header">
                     <?=$spec['plan_name'] ?>
                </div>
                <input type="radio" name="spec" form="updateplan" value="<?= $plan;?>" class="spec_change d-none" <?= ($plan === $getpln['plan'])? 'checked' : ''; ?>>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">メモリ</div>
                        <div class="col-6"><?= htmlspecialchars($spec['memory'], ENT_QUOTES); ?> GB</div>
                    </div>
                    <div class="row">
                        <div class="col-6">HDD</div>
                        <div class="col-6"><?= htmlspecialchars($spec['disk_hdd'], ENT_QUOTES); ?> GB</div>
                    </div>
                    <div class="row">
                        <div class="col-6">コア</div>
                        <div class="col-6"><?= htmlspecialchars($spec['core'], ENT_QUOTES); ?> コア</div>
                    </div>
                </div>
            </label>
        </div>
        <?php endforeach; ?>
        <form action="/admin/vps/server?tab=basic&act=confirm&webid=<?= $webid?>" method="post" id="updateplan" onsubmit="loading()">
        <input type="hidden" name="action" value="updateplan">
        </form>
    </div>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="updateplan">確認</button>
</div>