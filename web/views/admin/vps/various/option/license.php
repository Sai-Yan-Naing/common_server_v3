<?php require_once('views/admin/vps/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/vps/title.php') ?>
                            <?php require_once('views/admin/vps/various/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/admin/vps/various/option/tab.php") ?>
                                <!-- start -->
                                <?php
                                $query = "SELECT [pln],[plan_name],[price] FROM service_db.dbo.price_tbl
                                where [PRICE_TBL].pln in ('50','51','55','18','33','28','43','39','22','29','33','34','56','57','58') and [PRICE_TBL].type ='02' and [PRICE_TBL].service ='99'  ORDER BY [pln] ASC";
                                $getspec = $commons->getSpec($query);
                                //     echo "<pre>";
                                //     print_r($getspec);
                                //     die;
                            ?>
                                <div class="tab-content">
                                    <div class="tab-pane active p-3">
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="sql_server_edition">
                                    <input type="hidden" name="act" value="sql_license">
                                    <input type="hidden" name="pln" value="" id="sql_license">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                SQL Server Web Edition追加
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="request"  class="form-control" required id="sqlserver">
                                                    <option value="">SQLサーバーのバージョンをご選択下さい</option>
                                                    <option value="2016" data-price="<?=$getspec[8]['price']?>" data-pln="<?=$getspec[8]['pln']?>">2016</option>
                                                    <option value="2017" data-price="<?=$getspec[9]['price']?>" data-pln="<?=$getspec[9]['pln']?>">2017</option>
                                                    <option value="2019" data-price="<?=$getspec[10]['price']?>" data-pln="<?=$getspec[10]['pln']?>">2019</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total">0 円</div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="remote_desktop_license">
                                    <input type="hidden" name="act" value="rdl">
                                    <input type="hidden" name="pln" value="<?=$getspec[0]['pln']?>" id="rdl">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                Remote Desktop License追加
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <input type="text" class="form-control" name="request" placeholder="個">
                                            </div> -->
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control paid_price" name="request" placeholder="個" value="0" min='0'>
                                                      <div class="input-group-append">
                                                        <span class="input-group-text">個</span>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>1個/<?=$getspec[0]['price']?> 円</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span  data-price="<?=$getspec[0]['price']?>">月額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total">0 円</div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="office_license">
                                    <input type="hidden" name="act" value="office_l">
                                    <input type="hidden" name="pln" id="office_l">
                                    <input type="hidden" name="mon">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                OFFICE追加
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <input type="text" class="form-control" name="request" placeholder="個">
                                            </div> -->

                                            <div class="col-sm-3">
                                                <select name="request"  class="form-control" required id="office">
                                                    <option value="" data-pname="月額" data-mon='0' data-price='0'>Officeのバージョンをご選択下さい</option>
                                                    <!-- <option value="Microsoft Office 2013 Standard" data-price="<?=$getspec[1]['price']?>" data-pln="<?=$getspec[1]['pln']?>" data-pname="月額">Microsoft Office 2013 Standard</option>
                                                    <option value="Microsoft Office 2013 Professional" data-price="<?=$getspec[3]['price']?>" data-pln="<?=$getspec[3]['pln']?>" data-pname="月額">Microsoft Office 2013 Professional</option> -->
                                                    <option value="Microsoft Office 2016 Standard" data-price="<?=$getspec[4]['price']?>" data-pln="<?=$getspec[4]['pln']?>" data-pname="月額" data-mon='1'>Microsoft Office 2016 Standard</option>
                                                    <option value="Microsoft Office 2016 Professional" data-price="<?=$getspec[5]['price']?>" data-pln="<?=$getspec[5]['pln']?>" data-pname="月額" data-mon='1'>Microsoft Office 2016 Professional</option>
                                                    <!-- <option value="Microsoft 365 Apps for Business" data-price="<?=$getspec[11]['price']?>" data-pln="<?=$getspec[11]['pln']?>" data-pname="月額">Microsoft 365 Apps for Business</option> -->
                                                    <option value="Microsoft 365 Business Standard" data-price="<?=$getspec[13]['price']?>" data-pln="<?=$getspec[13]['pln']?>" data-pname="年額" data-mon='12'>Microsoft 365 Business Standard</option>
                                                    <option value="Microsoft 365 Apps for Enterprise" data-price="<?=$getspec[12]['price']?>" data-pln="<?=$getspec[12]['pln']?>" data-pname="年額" data-mon='12'>Microsoft 365 Apps for Enterprise</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <select name="numoffice" required class="form-control
                                                ">
                                                        <option value="">select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                      <div class="input-group-append">
                                                        <span class="input-group-text">個</span>
                                                      </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <span data-price="">月額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total">0 円</div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="window_server_license">
                                    <input type="hidden" name="act" value="window_server_license">
                                    <input type="hidden" name="pln" value="<?=$getspec[2]['pln']?>">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                セキュリティソフト追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                
                                            </div>
                                            <div class="col-sm-2">
                                                <span>年額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total"><span><?=$getspec[2]['price']?> 円</span></div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="site_guard_license">
                                    <input type="hidden" name="act" value="site_guard_license">
                                    <input type="hidden" name="pln" value="<?=$getspec[7]['pln']?>">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                Site Guard Server Edition追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>月額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total"><span><?=$getspec[7]['price']?> 円</span></div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form onsubmit="loading()" action="/admin/vps/various?setting=option&tab=license&act=license_confirm&webid=<?=$webid?>" method="post" id="ssl_license">
                                    <input type="hidden" name="act" value="ssl">
                                    <input type="hidden" name="pln" value="<?=$getspec[6]['pln']?>">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                SSL証明書追加
                                            </div>
                                            <div class="col-sm-3">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span></span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span>年額</span>
                                            </div>
                                            <div class="col-sm-3 row">
                                                <div class="col-sm-6 total"><span><?=$getspec[6]['price']?>  円</span></div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-outline-info">依頼</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div> 
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/vps/footer.php"); ?>

 <script type="text/javascript">
    $(document).on('change','#sqlserver', function(){
        $value=0;
        if($(this).val() !='')
        $value = $('option:selected', this).data('price');
        $pln = $('option:selected', this).data('pln');
        $("#sql_license").val($pln);
        console.log($value)
        $(this).parent().next().next().next().children('.total').html($value+ ' 円')
    })
    $(document).on('change','#office', function(){
        $value=0;
        if($(this).val() !='')
        $value = $('option:selected', this).data('price');
        $pname = $('option:selected', this).data('pname');
        $pln = $('option:selected', this).data('pln');
        $mon = $('option:selected', this).data('mon');
        $num = $('select[name=numoffice]').val();
        $('input[name=mon]').val($mon);
        if ($num=='') {
            $num=0
        }
        $("#office_l").val($pln);
        $total = $value*$num*$mon;
        
        // console.log($num)
        $(this).parent().next().next().next().children('.total').html($total+ ' 円')
        $(this).parent().next().next().children().html($pname)
    })
    $(document).on('change','select[name=numoffice]',function(){
        $num = $(this).val()
        $value = $('#office option:selected').data('price')
        $mon = $('#office option:selected').data('mon')
        if ($num=='') {
            $num=0
        }
        $total = $value*$num*$mon;
        $('#office').parent().next().next().next().children('.total').html($total+ ' 円')
    })
     $(document).on('change','.paid_price',function(){
        $value = $(this).val();
        $price = $(this).parent().parent().next().next().children().data('price');
        $total = $value*$price;
        console.log($price)
        $(this).parent().parent().next().next().next().children('.total').html($total+ ' 円')
     })

 </script>
