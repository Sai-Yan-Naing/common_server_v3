<?php require_once('views/admin/vps/header.php');?>
<div id="layoutSidenav">
<?php require_once('views/admin/vps/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/vps/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="tab-content">
                            
                        <?php
                                    $txt = fopen("E:\webroot\LocalUser\common_server_v3_dev\web/views\admin\manual\manual.txt", "r") or die("Unable to open file!");
                                    echo fread($txt,filesize("E:\webroot\LocalUser\common_server_v3_dev\web/views\admin\manual\manual.txt"));
                                    fclose($txt);
                                ?>
                        </div>
                    </div>
            </div>
        </main>
    </div>
</div>