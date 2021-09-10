<?php
    $url = $_SERVER['REQUEST_URI'];
    $url= explode('/',$url);
 ?>
    <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading"><a class="" href="/admin/share/server"><h3><span style="font-size:50px;">W</span>inserver</h3></a></div> -->
                            <div class="sb-sidenav-menu-heading text-white" style="font-size: x-large;">Main Menu<label style="border-top: 1px solid #fff; width:150px; display:block"></label></div>
                            
                            <a class="nav-link active" href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$webid?>">
                                <div class="sb-nav-link-icon"><img src="/img/sidebar/server.png" alt="" style="width: 30px; height:30px"></div>
                                サーバー設定
                                <?php if($url[1]=='admin' && $url[2]=='share' && strpos($url[3],'server') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                            </a>
                            
                            <a class="nav-link active" href="/admin/share/mail?setting=email&tab=tab&act=index&webid=<?=$webid?>">
                                <div class="sb-nav-link-icon"><div class="sb-nav-link-icon"><img src="/img/sidebar/email.png" alt="" style="width: 30px; height:30px"></div></div>
                                メール設定
                                <?php if($url[1]=='admin' && $url[2]=='share' && strpos($url[3],'mail') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                            </a>
                            
                            <a class="nav-link active" href="/admin/share/various?setting=information&act=index&webid=<?=$webid?>">
                                <div class="sb-nav-link-icon"><img src="/img/sidebar/various.png" alt="" style="width: 30px; height:30px"></div>
                                各種設定
                                <?php if($url[1]=='admin' && $url[2]=='share' && strpos($url[3],'various') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                            </a>

                            <a class="nav-link active" href="#">
                                <div class="sb-nav-link-icon"><img src="/img/sidebar/manual.png" alt="" style="width: 30px; height:30px"></div>
                                マニュアル
                            </a>
                            
                            <a class="nav-link active" href="/admin/share/contactus?act=index&webid=<?=$webid?>">
                                <div class="sb-nav-link-icon"><img src="/img/sidebar/contactus.png" alt="" style="width: 30px; height:30px"></div>
                                お問合せ
                                <?php if($url[1]=='admin' && $url[2]=='share' && strpos($url[3],'contactus') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        D000123
                    </div> -->
                </nav>
            </div>