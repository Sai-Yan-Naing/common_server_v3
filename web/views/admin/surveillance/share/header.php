<?php require_once('views/admin/surveillance/share/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>【Winserver】 管理画面</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?= call_ass() ?>css/styles.css" rel="stylesheet" />
        <link href="<?= call_ass() ?>css/server.css" rel="stylesheet" />
        <link href="<?= call_ass() ?>css/switch.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <!-- toaster -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        
        <script type="text/javascript" src="<?= call_ass() ?>js/jquery.validate.min.js"></script>
        <script src="<?= call_ass() ?>js/scripts.js"></script>
        <script src="<?= call_ass() ?>js/csvtoarray.js"></script>
        <script src="<?= call_ass() ?>js/common.js"></script>
        <script src="<?= call_ass() ?>js/filemanager.js"></script>
        <script src="<?= call_ass() ?>js/common_validate.js"></script>
        <!-- toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand" style="height: 75px;">
            <!-- <a class="navbar-brand ps-3" href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$webid?>"><h2><span style="font-size:2em;">W</span>inserver</h2></a> -->
            <div class="navbar-brand ps-3"></div>
            <button class="btn btn-sm order-1 order-lg-0 me-4 me-lg-0 btn-outline-info" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <h5 class="text-center font-weight-bold ms-auto text-dark h-title">Winserver Share Control Panel</h5>
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0 me-lg-4">
                <li class="nav-item dropdown">
                    <form action="<?= call_ass() ?>logout" method="post" >
                        <input type="hidden" name="user" value="admin">
                        <button id="logout" type="submit" class="nav-link text-center text-dark logout font-weight-border"  role="button" aria-expanded="false" style="font-size: 20px;"><i class="fas fa-sign-out-alt"></i><br>ログアウト</button>
					</form>
                </li>
            </ul>
        </nav>
        <?php $getphpv = json_decode($webappversion); ?>
        <div class="d-none" id='user_permission' data-permission="adminshare" data-webid="<?=$webid?>"></div>
        <div class="d-none" id='webphp' data-version="<?=$getphpv->app->php?>"></div>
        <?php 
        function call_ass()
        {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('/',$url);
            unset($url[0]);
            unset($url[1]);
            $ass = '';
            foreach (array_values($url) as $value)
            {
                $ass.='../';
            }
            return $ass;

 }
?>

<?php 
require_once("views/common_modal.php");
require_once("views/loading.php");