<?php require_once('views/admin/admin_vpsconfig.php'); ?>
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
        <script src="https://unpkg.com/jquery.terminal/js/jquery.terminal.min.js"></script>

        <link rel="stylesheet" href="https://unpkg.com/jquery.terminal/css/jquery.terminal.min.css" />
        <script type="text/javascript" src="<?= call_ass() ?>js/jquery.validate.min.js"></script>
        <script src="<?= call_ass() ?>js/scripts.js"></script>
        <script src="<?= call_ass() ?>js/common.js"></script>
        <script src="<?= call_ass() ?>js/filemanager.js"></script>
        <script src="<?= call_ass() ?>js/common_validate.js"></script>
        <!-- toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- <link rel="stylesheet" href="<?= call_ass() ?>node_modules/xterm/css/xterm.css" />
        <script src="<?= call_ass() ?>node_modules/xterm/lib/xterm.js"></script>
        <script src="<?= call_ass() ?>node_modules/xterm-addon-attach/lib/xterm-addon-attach.js"></script> -->
        <script src="<?= call_ass() ?>node_modules/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
        <!-- <style> -->
    </head>
    <body class="sb-nav-fixed">
        <span style="display:none" id="checkvps" checkvps=<?=$webid?>></span>
    <nav class="sb-topnav navbar navbar-expand" style="height: 75px;">
            <!-- <a class="navbar-brand ps-3" href="/admin/vps/server?tab=connection&act=index&webid=<?=$webid?>"><h2><span style="font-size:2em;">W</span>inserver</h2></a> -->
            <div class="navbar-brand ps-3"></div>
            <button class="btn btn-outline-info btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <h5 class="text-center font-weight-bold ms-auto text-dark h-title">Winserver VPS Control Panel</h5>
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0 me-lg-4">
                <li class="nav-item dropdown">
                    <form action="<?= call_ass() ?>logout" method="post" >
                        <input type="hidden" name="user" value="admin">
                        <button id="logout" type="submit" class="nav-link text-center text-dark logout font-weight-border"  role="button" aria-expanded="false" style="font-size: 20px;"><i class="fas fa-sign-out-alt"></i><br>ログアウト</button>
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
            foreach (array_values($url) as $value)
            {
                $ass.='../';
            }
            return $ass;

 }
  
require_once("views/common_modal.php");
require_once("views/loading.php");
?>
<script>
$(document).ready(function(){
    windowzoom(); 
})
$( window ).resize(function() { 
   windowzoom();
 });
 function windowzoom()
 { 
        $allowroute = ['admin/contactus?act=index','admin?main=vps','admin/vps?act=onoff&act_id=','admin/vps?act=confirm','admin/multiple_domain?act=onoff&act_id=','admin/multiple_domain?act=confirm']
    $url = document.URL.split("/");
    delete $url[0]
    delete $url[1]
    delete $url[2]
    $url = $url.filter(function(v){return v!==''});
    $url= $url.join("/")
        var width = $(window).width();
        if(width>750){
                $('#main1').show()
                $('#main2').hide()
                $('#nav1').show()
                $('#nav2').hide()
                // $("#layoutSidenav_nav").css({"transform": "translateX(0px)"})
                // $("#layoutSidenav_content").css({"padding-left": "225px"})
                $(".ver").show()
                $("#panel").hide()
                $("#bar").removeClass("fa-times");
                $("#bar").addClass("fa-bars");
        }else{
                $('#main1').hide()
                $('#main2').show()
                $('#nav1').hide()
                $('#nav2').show() 
                // $("#layoutSidenav_nav").css({"transform": "translateX(-225px)"})
                // $("#layoutSidenav_content").css({"padding-left": "225px","margin-left":"0px"})
                $("#layoutSidenav_content").css({"top": "0"})
                $(".ver").hide()
                $found = 0;
                for (let index = 0; index < $allowroute.length; index++) {
                        if($url.indexOf($allowroute[index]) !== -1)
                        {
                                $found=1;
                                console.log($allowroute[index]+'gg')
                        }
                        console.log($url)
                }
                if(!$found && $url!='admin')
                {
                        alert("こちらのページはモバイル版コントロールパネルでは表示できません。デスクトップ版に移動します。")
                }
        }
 }
 $(document).on("click","#bar",function() {
        if($(this).hasClass("fa-bars")){
                $("#bar").removeClass("fa-bars");
                $("#bar").addClass("fa-times");
                $("#panel").show()
        }else{
                $("#bar").addClass("fa-bars");
                $("#bar").removeClass("fa-times");
                $("#panel").hide()
        }
    
    
});
</script>