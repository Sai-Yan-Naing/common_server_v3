<script>
        toastr.options = {  
                "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-full-width",
  "timeOut": 0,
    "extendedTimeOut": 0,
    "tapToDismiss": false
}
<?php if (isset($_SESSION['msg'])): ?>
        $('#common_dialog').modal('show');
        document.getElementById("display_dialog").innerHTML = '<div class="modal-body text-center">'+"<?= flash('msg') ?>"+'</div>'+
        '<div class="modal-footer d-flex justify-content-center">'+
        '<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">OK</button></div>';
<?php endif; ?>
<?php if (isset($_SESSION['msgdel'])): ?>
        $('#common_dialog').modal('show');
        document.getElementById("display_dialog").innerHTML = '<div class="modal-body text-center">'+"<?= flash('msgdel') ?>"+'</div>'+
        '<div class="modal-footer d-flex justify-content-center">'+
        '<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">OK</button></div>';
<?php endif; ?>

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
                        window.location.href = "/admin"
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
        </body>
</html>