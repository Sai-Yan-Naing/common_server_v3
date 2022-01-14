<?php
$url = $_SERVER['REQUEST_URI'];
$url= explode('/',$url);
 ?>
<div id="layoutSidenav_nav"  style="z-index: 1040;">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"><a class="text-white" href="/admin" onclick="loading()"><h3><span style="font-size:50px;">W</span>inserver</h3></a></div>
                <div class="sb-sidenav-menu-heading text-white" style="font-size: x-large;">Main Menu<label style="border-top: 1px solid #fff; width:150px; display:block"></label></div>
                
                <a class="nav-link active" href="/admin" onclick="loading()">
                    <div class="sb-nav-link-icon"><img src="/img/sidebar/server.png" alt="" class="nav-tab-icon"></div>
                    サーバー設定
                    <?php if(strpos($url[1],'admin') !==false && ($url[2]==null || strpos($url[2],'domain-transfer') !==false || strpos($url[2],'add-server') !==false || strpos($url[2],'dns') !==false ) ){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                </a>
                
                <a class="nav-link active" href="#">
                    <div class="sb-nav-link-icon"><div class="sb-nav-link-icon"><span style="font-size: x-large;"><i class="fa fa-user" aria-hidden="true"></i></span></div></div>
                    ご契約情報
                </a>
                
                <a class="nav-link active" href="/admin/manual">
                    <div class="sb-nav-link-icon"><img src="/img/sidebar/manual.png" alt="" class="nav-tab-icon"></div>
                    マニュアル
                    <?php if ( strpos($url[1],'admin') !==false && strpos($url[2],'manual') !==false ): echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>'; endif ?>
                </a>
                
                <a class="nav-link active" href="/admin/contactus?act=index" onclick="loading()">
                    <div class="sb-nav-link-icon"><img src="/img/sidebar/contactus.png" alt="" class="nav-tab-icon"></div>
                    お問合せ
                    <?php if(strpos($url[1],'admin') !==false && strpos($url[2],'contactus') !==false ){echo '<span class="ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>';} ?>
                </a>
            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            D000123
        </div> -->
    </nav>
</div>