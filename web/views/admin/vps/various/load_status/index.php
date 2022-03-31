<?php 
require_once('views/admin/vps/header.php');
require_once('views/admin/vps/various/load_status/usage.php');
$cpu_usage = cpu_usage($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name); $memory_usage = memory_usage(true,$webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
$disk_read = disk_read($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name);
 ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/vps/title.php') ?>
                            <?php require_once('views/admin/vps/various/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="page-body" class="tab-pane active pr-3 pl-3"><br>
                                        <h6>サーバー負荷状況</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                CPU
                                            </div>
                                            <div class="col-sm-6">
                                                Average of cpu usage : <span id="cpu_usage"  gourl="/admin/vps/various?setting=load_status&tab=load_status&act=usage1&case=cpu&webid=<?=$webid?>"><?= $cpu_usage ?>%</span>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if($cpu_usage<=60){ echo 'bg-success';}else if($cpu_usage>60 and $cpu_usage<80){ echo 'bg-warning';}else{echo 'bg-danger';} ?>" id="cpu" style="width:<?= $cpu_usage ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                            メモリ
                                            </div>
                                            <div class="col-sm-6">
                                                Average of memory usage : <span id="memory_usage" gourl="/admin/vps/various?setting=load_status&tab=load_status&act=usage1&case=memory&webid=<?=$webid?>"><?= $memory_usage ?>%</span>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if($memory_usage<=60){ echo 'bg-success';}else if($memory_usage>60 and $memory_usage<80){ echo 'bg-warning';}else{echo 'bg-danger';} ?>" id="memory" style="width:<?= $memory_usage ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                            ディスク読み書き
                                            </div>
                                            <div class="col-sm-6">
                                                Disk Queue Length : <span id="disk_read_usage" gourl="/admin/vps/various?setting=load_status&tab=load_status&act=usage1&case=disk_read&webid=<?=$webid?>"><?= $disk_read ?></span>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if($disk_read<=60){ echo 'bg-success';}else if($disk_read>60 and $disk_read<80){ echo 'bg-warning';}else{echo 'bg-danger';} ?>" id="disk_read" style="width:<?= $disk_read ?>"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                平均10以下であれば問題ありません。
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            ※詳細な負荷状況の確認については、対象サーバーにログインの上、パフォーマンスモニタにてログを採取もしくは、モニターでご確認いただきますようお願いいたします。
                                        </div>
                                        <div class="mb-4">
                                            パフォーマンスモニター及び、ログの採取方法についてはマニュアルページよりご確認お願いいたします。
                                        </div>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/vps/footer.php"); ?>

 <script>
        $(document).ready(function(){
            $url1=$("#cpu_usage").attr("gourl");
            $url2=$("#memory_usage").attr("gourl");
            $url3=$("#disk_read_usage").attr("gourl");
            setInterval(function(){ 
                usage('cpu',$url1);
            }, 15000);
            setInterval(function(){
                usage('memory',$url2);
            }, 15000)
            setInterval(function(){
                usage('disk_read',$url3);
            }, 15000)
        });

        function usage($var,$gourl)
        {
            $url = document.URL.split('/');
	        $url=$url[0]+"//"+$url[2];
            $.ajax({
                type: "POST",
                url: $url+$gourl,
                data: {},
                success: function(data){
                    // if($var=='cpu')
                    // {
                        
                        if($var=='disk_read'){
                           $("#"+$var+"_usage").html(data); 
                       }else{
                        $("#"+$var+"_usage").html(data+ ' %');
                       }
                        $("#"+$var).css({"width":data+"%"})
                        $("#"+$var).removeClass();
                        if(data<=60)
                        {
                            $("#"+$var).addClass("progress-bar bg-success");
                        }else if(data>60 && data<=80)
                        {
                            $("#"+$var).addClass("progress-bar bg-warning");
                        }else{
                            $("#"+$var).addClass("progress-bar bg-danger");
                        }
                    // }
                    
                }
            });
        }
    </script>
