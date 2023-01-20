<?php require_once('header.php');?>
<div id="layoutSidenav">
<?php require_once('sidebar.php');?>

    <div id="layoutSidenav_content">
        <main class="main-page" id="mobile-view">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="border-bt-blue text-center pb-2">共用サーバー</div>
                        <?php  
                            $limit = 20;
                            $table = 'web_account';  
                            require_once('views/pagination/start.php');
                            $query = "SELECT web_account.*,plan_tbl.id as planid,name,site,web_capacity,mail_capacity,mail_user,mysql_db,mysql_db_num,mysql_db_capacity,maria_db,maria_db_num,
maria_db_capacity,mssql_db,mssql_db_num,mssql_db_capacity,waf,wp,dotnet,dotnetcore,asp,php,python,
free_ssl,original_ssl,fixed_ip,ftp,ftp_num,back_up,forein_ip,commercial_sale,resale FROM web_account INNER JOIN plan_tbl on web_account.[plan] =plan_tbl.id WHERE customer_id = ? AND removal is null ORDER BY web_account.id
                            OFFSET $start ROWS FETCH FIRST $limit ROWS ONLY";
                            $commons = new Common;
                            $multidomain=$commons->getAllRow($query,[$webadminID]);
                            $contracts = [];

                            foreach($multidomain as $domain){
                                if($domain['origin']==1)
                                {
                                    $contracts[]=$domain;
                                }

                            }
                            // echo '<pre>';
                            // print_r($multidomain);
                            // die();
                            $a = 1;

                            foreach($contracts as $main_domain):
                                $site = 0;
                                $sites=[];
                                $subdomain = '';
                                $mycount = 0;
                                $mysqlcount = [];
                                $mysqltotal =0;
                                $macount = 0;
                                $masqlcount = [];
                                $masqltotal =0;
                                $msount = 0;
                                $mssqlcount = [];
                                $mssqltotal =0;
                                $mailcount = [];
                                $mailtotal =0;
                                $mdomain =$main_domain['domain'];
                                foreach($multidomain as $domain){
                                    if($main_domain['id'] == $domain['id'] || $main_domain['id']==$domain['origin_id'])
                                    {
                                        $site += 1; 
                                        $sites[$main_domain['id']] = $site;
                                        $subdomain = $domain['domain'];
                                        // $db_account = "SELECT count(id) FROM db_account WHERE domain='$subdomain'";
                                         // $mycount = $commons->getCount($db_account);
                                         $mycount = $domain['mysql_cnt'];
                                         $mysqlcount[$domain['id']] = $mycount;
                                         $mysqltotal +=$mycount;

                                         // $madb_account = "SELECT count(id) FROM db_account_for_mariadb WHERE domain='$subdomain'";
                                         // $macount = $commons->getCount($madb_account);
                                         $macount = $domain['mariadb_cnt'];
                                         $masqlcount[$domain['id']] = $macount;
                                         $masqltotal +=$macount;

                                         // $msdb_account = "SELECT count(id) FROM db_account_for_mssql WHERE domain='$subdomain'";
                                         // $mscount = $commons->getCount($msdb_account);
                                         $mscount = $domain['mssql_cnt'];
                                         $mssqlcount[$domain['id']] = $mscount;
                                         $mssqltotal +=$mscount;

                                         $mcount = $domain['mail_cnt'];
                                         $mailcount[$domain['id']] = $mcount;
                                         $mailtotal +=$mcount;

                                        // echo 'hello';
                                    }

                                }
                        ?>
                        <?php 
                                    $a++;
                                        foreach($multidomain as $domain):
                                            if($main_domain['id'] == $domain['id'] || $main_domain['id']==$domain['origin_id']):
                                                $web_server = "SELECT * FROM web_server_config WHERE id=$domain[web_server_id]";
                                                $gethost = $commons->getRow($web_server);
                                                $web_host = $gethost['ip'];
                                                $web_user = $gethost['username'];
                                                $web_password = $gethost['password'];

                                                $mydbcount = $mysqlcount[$domain['id']]+$masqlcount[$domain['id']];
                                                $msdbcount = $mssqlcount[$domain['id']];
                                            

                                    ?>

                        <div class="border-bt-blue">
                            <div class="text-center p-2"><?=$domain[domain]?></div>
                            <div class="row pb-2">
                                <div class="col-6">サイト</div>
                                <div class="col-6">
                                <form action="" method = "post">
                                                <input type="hidden" name="app" value="site">
                                                <input type="hidden" name="domain" value="<?=$domain['domain'] ?>">
                                                <label class="switch text-white common_dialog" gourl="/admin/multiple_domain?act=onoff&act_id=<?= $domain[id].$pagy ?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $domain['stopped']==0? "checked":""  ?>>
                                                    <span class="slider <?= $domain['stopped']==0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $domain['stopped']==0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $domain['stopped']==0? "labelon":"labeloff"  ?>"><?= $domain['stopped']==0? "起動":"停止"  ?></span>
                                                </label>
                                            </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">アプリケーションプール</div>
                                <div class="col-6">
                                <form action="" method = "post">
                                                <input type="hidden" name="app" value="site">
                                                <input type="hidden" name="domain" value="<?=$domain['domain'] ?>">
                                                <label class="switch text-white common_dialog"  gourl="/admin/multiple_domain?act=apponoff&act_id=<?= $domain[id].$pagy?>"  data-toggle="modal" data-target="#common_dialog">
                                                    <input type="checkbox" <?= $domain['appstopped']==0? "checked":""  ?>>
                                                    <span class="slider <?= $domain['appstopped']==0? "slideron":"slideroff"  ?>"></span>
                                                    <span class="handle <?= $domain['appstopped']==0? "handleon":"handleoff"  ?>"></span>
                                                    <span class="<?= $domain['appstopped']==0? "labelon":"labeloff"  ?>"><?= $domain['appstopped']==0? "起動":"停止"  ?></span>
                                                </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <?php 
                                        endif;
                                        endforeach;
                                    endforeach;
                                    ?>

                            <!-- ///// -->
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
