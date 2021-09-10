<?php require_once('views/admin/share/header.php'); ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded text-danger">
                            <h3 class="text-center">404 Error</h3>
                                <div class="text-center mb-3">Page Could not be found</div>
                                <div class="d-flex justify-content-center"><a href="javascript:history.go(-1)"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
