<?php
require_once('views/vps_config.php');
$plan_q = "SELECT * FROM vps_account Where id=?";
$getpln = $commons->getRow($plan_q,[$webid]);
$plans = ['42','43','44','45','46','47','48'];
$query = "SELECT price_tbl.pln,spec_info.value,price_tbl.plan_name, spec_units.[key] FROM service_db.dbo.price_tbl
inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
AND  price_tbl.type = '02' AND  price_tbl.pln IN ('42','43','44','45','46','47','48')";
$getspecs = $commons->getSpec($query,$plans);
$specs = [];
foreach($getspecs as $getspec)
{
    foreach($plans as $plan)
      {  if ($getspec['pln']==$plan)
        {
            // $specs[$plan][$getspec['key']] =[
            //     $getspec[value]
            // ];
            $specs[$plan]['plan_name'] =$getspec['plan_name'];
            $specs[$plan]['pln'] =$getspec['pln'];
            if ($getspec['key']==='memory')
            {
                $specs[$plan]['memory'] = $getspec['value'];
            } elseif ($getspec['key']==='disk_hdd')
            {
                $specs[$plan]['disk_hdd'] = $getspec['value'];
            }else{
                $specs[$plan]['core'] = $getspec['value'];
            }
            
        }
    }
}
// $spec = [
//     "plan_name"=>$getspec[0]['plan_name'], 
//     "memory"=>$getspec[0]['value'], 
//     "disk_hdd"=>$getspec[1]['value'],
//     "core" => $getspec[2]['value']];
// echo "<pre>";
// print_r($specs);
// die;
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">プラン変更</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <div class="row">
        <?php 
        if ((int)end($specs)['pln'] === (int) $getpln['plan'] ):
            echo "<div>This plan is the last plan</div>";
        endif;
        foreach ($specs as $key=>$spec):
        if ((int)$key > (int)$getpln['plan']):
?>
        <div class="col-xl-3 col-md-6">
            <label class="card mb-4">
                <div class="card-header">
                     <?=$spec['plan_name'] ?>
                </div>
                <input type="radio" name="spec" form="updateplan" value="<?= (int)$key;?>" class="spec_change d-none">
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
        <?php endif;endforeach; ?>
        <form action="/vps/server?tab=basic&act=confirm" method="post" id="updateplan">
        <input type="hidden" name="action" value="updateplan">
        </form>
    </div>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="updateplan">確認</button>
</div>