<?php require_once('views/vps/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/vps/title.php') ?>
                            <?php require_once('views/vps/various/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/vps/various/option/tab.php") ?>
                                <!-- start -->
                                <?php
                        $query = "SELECT [pln],[plan_name],[price] FROM service_db.dbo.price_tbl
                        where [PRICE_TBL].pln in ('13','14','15','17','27') and [PRICE_TBL].type ='02' and [PRICE_TBL].service ='99' ORDER BY [pln] ASC";
                        $getspec = $commons->getSpec($query);
                            // echo "<pre>";
                            // print_r($getspec);
                            // die;
                    ?>
                                <div class="tab-content">
                                    <div class="tab-pane active p-3">
                                        <form action="/vps/various?setting=option&tab=spec&act=confirm&webid=<?=$webid?>" method="post" id="spec_option" onsubmit="loading()">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                メモリ追加
                                            </div>
                                            <div class="col-sm-3 input-group">
                                                <input type="number" class="form-control spec_price" name="memory" placeholder="GB" value="0" min='0'>
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">GB</span>
                                                  </div>
                                            </div>
                                            <div class="col-sm-3"><span>1GB/<?=$getspec[0]['price']?> 円</span></div>
                                            <div class="col-sm-2">
                                                <span data-price="<?=$getspec[0]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-2" data-total="0" id='total1'>
                                                <span>0 円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                コア追加
                                            </div>
                                            <div class="col-sm-3 input-group">
                                                <input type="number" class="form-control spec_price" name="cpu" placeholder="コア" value="0" min='0'>
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">コア</span>
                                                  </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>1コア/<?=$getspec[3]['price']?> 円</span>
                                            </div>    
                                            <div class="col-sm-2">
                                                <span data-price="<?=$getspec[3]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-2" data-total="0" id='total2'>
                                                <span>0 円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                ディスク追加
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <input type="text" class="form-control" name="disk" placeholder="GB"  value="<?= $spec['disk_hdd']  ?>">
                                            </div> -->
                                            <div class="col-sm-3 input-group">
                                                <input type="number" class="form-control spec_price" name="disk" placeholder="GB" value="0" min='0'>
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">GB</span>
                                                  </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <span>1GB/<?=$getspec[1]['price']?> 円</span>
                                            </div> 
                                            <div class="col-sm-2">
                                                <span data-price="<?=$getspec[1]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-2" data-total="0" id='total3'>
                                                <span>0 円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                IPアドレス追加
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <input type="text" class="form-control" name="ip_address" placeholder="個" value="<?= $webip  ?>">
                                            </div> -->

                                            <div class="col-sm-3 input-group">
                                                <input type="number" class="form-control spec_price" name="ip_address" placeholder="個" value="0" min='0'>
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">個</span>
                                                  </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <span>1個/<?=$getspec[2]['price']?> 円</span>
                                            </div> 

                                            <div class="col-sm-2">
                                                <span data-price="<?=$getspec[2]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-2" data-total="0" id='total4'>
                                                <span>0 円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                仮想スイッチ追加
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <input type="text" class="form-control" name="virtual_switch" placeholder="個">
                                            </div> -->
                                            <div class="col-sm-3 input-group">
                                                <input type="number" class="form-control spec_price" name="virtual_switch" placeholder="個" value="0" min='0'>
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">個</span>
                                                  </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <span>1個/<?=$getspec[4]['price']?> 円</span>
                                            </div> 
                                            <div class="col-sm-2">
                                                <span data-price="<?=$getspec[4]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-2" data-total="0" id='total5'>
                                                <span>0 円</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                        </div>
                                        <div class="col-sm-2">Total</div>
                                        <div class="col-sm-2" id="total">0 円</div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
        
 <?php require_once("views/vps/footer.php"); ?>
        <script type="text/javascript">
           $(document).on('change','.spec_price',function(){
                $value = $(this).val();
                $price = $(this).parent().next().next().children().data('price');
                $total = $value*$price;
                $(this).parent().next().next().next().html($total+' 円')
                $(this).parent().next().next().next().attr('data-total',$total)
                $total1 = $("#total1").attr('data-total');
                $total2 = $("#total2").attr('data-total');
                $total3 = $("#total3").attr('data-total');
                $total4 = $("#total4").attr('data-total');
                $total5 = $("#total5").attr('data-total');
                $total = parseInt($total1)+parseInt($total2)+parseInt($total3)+parseInt($total4)+parseInt($total5);
                $("#total").html($total+' 円')
           }) 
        </script>