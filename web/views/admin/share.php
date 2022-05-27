<?php require_once('header.php');?>
<div id="layoutSidenav">
<?php require_once('sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="d-flex">
                            <h4 class="mb-4">契約サービス</h4>
                            <?php 
                        // echo $webcapacity = folderSize($web_host,$web_user,$web_password,$webrootuser); 
                        // $capt = array('30GB'=>32212254720,'50GB'=>53687091200,'100GB'=>107374182400,'200GB'=>214748364800,'300GB'=>322122547200,'400GB'=>429496729600);

                        // echo $webplnwebcapacity;
                        // echo $capt[$webplnwebcapacity.'GB']
                        // $webcapacity = 107374182400;
                            // 1073741824 1GB in byte
                        if($webcapacity > ($webplnwebcapacity*1073741824)): ?>

                            <p class="ml-5 text-warning">
                                Warning Message
                            </p>
                        <?php
                        endif;

                        ?>
                            
                        </div>
                        


                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/admin" onclick="loading()">共用サーバー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin?main=vps" onclick="loading()">VPS/デスクトップ</a>
                            </li>
                        </ul>
                        <?php  
                            $limit = 20;
                            $table = 'web_account';  
                            require_once('views/pagination/start.php');
                            $query = "SELECT * FROM $table WHERE customer_id = ? AND removal is null ORDER BY id
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
                                $mdomain =$main_domain['domain'];
                                foreach($multidomain as $domain){
                                    if($main_domain['id'] == $domain['id'] || $main_domain['id']==$domain['origin_id'])
                                    {
                                        $site += 1; 
                                        $sites[$main_domain['id']] = $site;
                                        $subdomain = $domain['domain'];
                                        $db_account = "SELECT count(id) FROM db_account WHERE domain='$subdomain'";
                                         $mycount = $commons->getCount($db_account);
                                         $mysqlcount[$domain['id']] = $mycount;
                                         $mysqltotal +=$mycount;

                                         $madb_account = "SELECT count(id) FROM db_account_for_mariadb WHERE domain='$subdomain'";
                                         $macount = $commons->getCount($madb_account);
                                         $masqlcount[$domain['id']] = $macount;
                                         $masqltotal +=$macount;

                                         $msdb_account = "SELECT count(id) FROM db_account_for_mssql WHERE domain='$subdomain'";
                                         $mscount = $commons->getCount($msdb_account);
                                         $mssqlcount[$domain['id']] = $mscount;
                                         $mssqltotal +=$mscount;

                                        // echo 'hello';
                                    }

                                }
                        ?>
                        <div class="d-flex contract-domain <?= ($a==1)? '':'main-contract'?>">
                            <div class="col-md-3">
                                <i class="fa <?= ($a==1)? 'fa-caret-down':'fa-caret-right'?>" aria-hidden="true"></i>
                                <?= $main_domain['domain'] ?>[<?= $webroot_plan['name'] ?>]</div>
                            <div class="ml-auto col-md-3">マルチドメイン: <?= $sites[$main_domain['id']] ?>/<?= $webroot_plan['site'] ?></div>
                            <div class="col-md-3">MySQL/Mariadb: <?= $mysqltotal + $masqltotal ?>/<?= $webroot_plan['maria_db_num'] ?></div>
                            <div class="col-md-3">MSSQL: <?= $mssqltotal ?>/<?= $webroot_plan['mssql_db_num'] ?></div>
                        </div>
                        <div class="sub-domain" style=" display:<?= ($a==1)? '':'none'?>">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="row">
                                        <th class="tb-width-2">契約ドメイン</th>
                                        <th class="tb-width">サイト設定</th>
                                        <th class="tb-width">使用容量</th>
                                        <th class="tb-width">MySQL/Mariadb</th>
                                        <th class="tb-width">MSSQL</th>
                                        <th class="tb-width-1">サイト</th>
                                        <th class="tb-width-1">アプリケーションプール</th>
                                        <th class="tb-width">エイリアス</th>
                                        <th class="tb-width">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $a++;
                                        foreach($multidomain as $domain):
                                            if($main_domain['id'] == $domain['id'] || $main_domain['id']==$domain['origin_id']):
                                                $web_server = "SELECT * FROM web_server_config WHERE id=$domain[web_server_id]";
                                                $gethost = $commons->getRow($web_server);
                                                $web_host = $gethost['ip'];
                                                $web_user = $gethost['username'];
                                                $web_password = $gethost['password'];
                                            

                                    ?>
                                    <tr class="row">
                                        <td class="tb-width-2"><a href="http://<?=$domain[domain]?>" target="_blank" class="text-dark"><?=$domain['domain']?></a></td>
                                        <td class="tb-width">
                                            <a href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$domain[id]?>" target="_blank" class="btn btn-sm btn-outline-info">設定</a>
                                        </td>
                                        <td class="tb-width">
                                            <span><?php //if($domain['origin'] !=1 ){ echo sizeFormat(folderSize($web_host,$web_user,$web_password,$webrootuser."/".$domain['user']));}else{echo sizeFormat($webcapacity);} ?></span>
                                        </td>
                                        <td class="tb-width"><?= $mysqlcount[$domain['id']]+$masqlcount[$domain['id']]?></td>
                                        <td class="tb-width"><?= $mssqlcount[$domain['id']]?></td>
                                        <td class="tb-width-1">
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
                                        </td>
                                        <td class="tb-width-1">
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
                                        </td>
                                        <td class="tb-width">
                                        <button class="btn btn-sm common_dialog <?= $domain['sitebinding']==0? "btn-outline-info":"btn-outline-danger"  ?>" gourl="/admin/multiple_domain?act=sitebinding&act_id=<?= $domain[id].$pagy?>"  data-toggle="modal" data-target="#common_dialog"><?= $domain['sitebinding']==0? "追加":"削除"  ?></button>
                                        </td>
                                        <td class="tb-width">
                                        <?php if($domain['origin']!=1){?>
                                            <button class="btn btn-sm btn-outline-danger common_dialog" gourl="/admin/multiple_domain?act=delete&act_id=<?= $domain[id].$pagy?>"  data-toggle="modal" data-target="#common_dialog">削除</button>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        endif;
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                            endforeach;
                        ?>
                        <div class="row justify-content-center hbtn mt-4">
                                <div class="col-md-3"><button class="btn btn-outline-info form-control common_dialog" gourl="/admin/multiple_domain?act=new" data-toggle="modal" data-target="#common_dialog">マルチドメイン追加</button></div>
                                <div class="col-md-3"><a href="/admin/domain-transfer?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">ドメイン取得/移管</a></div>
                                <div class="col-md-3"><a href="/admin/add-server?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">サーバー追加</a></div>
                                <div class="col-md-3"><a href="/admin/dns?tab=share&act=index" class="btn btn-outline-info form-control" onclick="loading()">DNS情報</a></div>
                        </div>
                        <div class="d-flex mt-3">
                            <div></div>
                            <div class='ml-auto'>
                                <?php 
                                    $paginatecount = "SELECT COUNT(*) FROM $table WHERE customer_id = ? AND removal is null";
                                    // SELECT COUNT(*) FROM web_account WHERE customer_id = 'D000123' && removal is null
                                    $params = [$webadminID];
                                    $page_url = '/admin?page=';
                                    require_once('views/pagination/end.php')
                                ?>
                             </div>
                        </div>
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
