<?php require_once('header.php');?>
<div id="layoutSidenav">
<?php require_once('sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page" id="mobile-view">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="border-bt-blue text-center pb-2">VPS/デスクトップ</div>
                        <!-- //// -->
                        <?php 
                            $limit = 10;  
                            $table = 'vps_account';
                            require_once('views/pagination/start.php'); 
                            $query = "SELECT * from $table where customer_id=? AND removal is null  ORDER BY id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
                            $commons = new Common;
                            $getAllRow = $commons->getAllRow($query,[$webadminID]);
                        ?>
                        <?php
                                foreach($getAllRow as $key=>$vps):
                                    $query = "SELECT spec_info.value,price_tbl.plan_name, spec_units.[key] FROM service_db.dbo.price_tbl
                                    inner join hosting_db.dbo.spec_info on spec_info.price_id = price_tbl.id
                                    INNER JOIN hosting_db.dbo.spec_units on spec_info.spec_unit_id = spec_units.id AND spec_units.[key] IN ('memory', 'disk_hdd','core') WHERE price_tbl.service = '07' 
                                    AND  price_tbl.type = '02' AND  price_tbl.pln = ?";
                                    $getspec = $commons->getSpec($query,[$vps['plan']]);
                                    $spec = [
                                        "plan_name"=>$getspec[0]['plan_name'], 
                                        "memory"=>$getspec[0]['value'], 
                                        "disk_hdd"=>$getspec[1]['value'],
                                        "core" => $getspec[2]['value']];
                                    ?>
                        <div class="border-bt-blue">
                            <div class="text-center p-2"><?=$vps['ip'] ?></div>
                            <div class="row">
                                <div class="col-6">アプリケーションプール</div>
                                <div class="col-6">
                                <form action="/admin/vps-confirm" method = "post">
                                                <input type="hidden" name="action" value="onoff">
                                                <input type="hidden" name="confirm" value="post">
                                                <input type="hidden" name="act_id" value="<?= $vps['id'] ?>">
                                                <label class="switch text-white common_dialog" gourl="/admin/vps?act=onoff&act_id=<?= $vps[id].$pagy?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $vps['active']!=0? "checked":""  ?>>
                                                    <span class="slider <?= $vps['active']!=0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $vps['active']!=0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $vps['active']!=0? "labelon":"labeloff"  ?>"><?= $vps['active']!=0? "起動":"停止"  ?></span>
                                                </label>
                                            </form>
                                </div>
                            </div>
                        </div>
                            <?php endforeach;?>
                            <!-- ////// -->
                    </div>
            </div>
        </main>
    </div>
</div>
<script>
    $(document).on('click','.contract-domain',function(){
        $this = $(this);
        $(this).next(".sub-domain").slideToggle('slow',function() {
        if($this.next('.sub-domain').is(':hidden'))
        {
            $this.css({'border-bottom-right-radius':'10px','border-bottom-left-radius':'10px'})
            $this.children().children('').removeClass('fa-caret-down')
            $this.children().children('').addClass('fa-caret-right')
        }else{
            $this.css({'border-bottom-right-radius':'0px','border-bottom-left-radius':'0px'})
            $this.children().children('').removeClass('fa-caret-right')
            $this.children().children('').addClass('fa-caret-down')
        }
        });
    })
</script>
<?php 
require_once('footer.php');
