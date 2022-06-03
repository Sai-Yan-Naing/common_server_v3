
<?php
    $url = $_SERVER['REQUEST_URI'];
    $url= explode('/',$url);
 ?>
<div id="layoutSidenav_nav"  style="z-index: 1040;">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- <div class="sb-sidenav-menu-heading"><a class="" href="/share/server"><h3><span style="font-size:50px;">W</span>inserver</h3></a></div> -->
                    <div class="sb-sidenav-menu-heading"><a class="text-white" href="/share/server?setting=site&tab=app_install&act=index" onclick="loading()"><h3><span style="font-size:50px;">W</span>inserver</h3></a></div>
                    <div class="sb-sidenav-menu-heading text-white" style="font-size: x-large;">Main Menu<label style="border-top: 1px solid #fff; width:150px; display:block"></label></div>
                    
                    <a class="nav-link active" href="/share/server?setting=site&tab=app_install&act=index" onclick="loading()">
                        <div class="sb-nav-link-icon"><img src="/img/sidebar/server.png" alt="" class="nav-tab-icon"></div>
                        サーバー設定
                        <?php if($url[1]=='share' && strpos($url[2],'server') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                    </a>
                    
                    <a class="nav-link active" href="/share/mail?setting=email&tab=tab&act=index" onclick="loading()">
                        <div class="sb-nav-link-icon"><div class="sb-nav-link-icon"><img src="/img/sidebar/email.png" alt="" class="nav-tab-icon"></div></div>
                        メール設定
                        <?php if($url[1]=='share' && strpos($url[2],'mail') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                    </a>
                    
                    <a class="nav-link active" href="/share/various?setting=information&act=index" onclick="loading()">
                        <div class="sb-nav-link-icon"><img src="/img/sidebar/various.png" alt="" class="nav-tab-icon"></div>
                        各種設定
                        <?php if($url[1]=='share' && strpos($url[2],'various') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                    </a>

                    <a class="nav-link active" href="/share/manual?act=index" onclick="loading()">
                        <div class="sb-nav-link-icon"><img src="/img/sidebar/manual.png" alt="" class="nav-tab-icon"></div>
                        <?php if($url[1]=='share' && strpos($url[2],'manual') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                    </a>
                    
                    <!-- <a class="nav-link active" href="/share/contactus?act=index" onclick="loading()">
                        <div class="sb-nav-link-icon"><img src="/img/sidebar/contactus.png" alt="" class="nav-tab-icon"></div>
                        お問合せ
                        <?php if($url[1]=='share' && strpos($url[2],'contactus') !==false){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                    </a> -->
                </div>
            </div>
        </nav>
    </div>