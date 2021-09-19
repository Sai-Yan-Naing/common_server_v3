<?php require_once('views/vps_config.php'); ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script src="<?= call_ass() ?>js/scripts.js"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 75px;">
            <a class="navbar-brand ps-3" href="/vps/various?setting=firewall&tab=firewall&act=index"><h2><span style="font-size:2em;">W</span>inserver</h2></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <h5 class="text-center font-weight-bold ms-auto text-white">Winserver VPS Control Panel</h5>
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0 me-lg-4">
                <li class="nav-item dropdown">
                    <form action="<?= call_ass() ?>logout" method="post" >
                        <input type="hidden" name="user" value="vps_user">
                        <button id="logout" type="submit" class="nav-link text-center text-white logout"  role="button" aria-expanded="false"><i class="fas fa-sign-out-alt"></i><br>ログアウト</button>
                    </form>
                </li>
            </ul>
        </nav>

        <?php 
        function call_ass()
        {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('/',$url);
            unset($url[0]);
            unset($url[1]);
            $ass = '';
            foreach(array_values($url) as $value)
            {
                $ass.='../';
            }
            return $ass;

 }
?>