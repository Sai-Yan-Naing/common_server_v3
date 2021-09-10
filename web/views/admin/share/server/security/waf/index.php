<?php 
require_once('views/admin/share/header.php');
$waf = $commons->getRow("SELECT * FROM waf WHERE domain='$webdomain'");
?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/admin/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="waf" class="pr-3 pl-3 tab-pane active"><br>
                                        <div class="form-group row">
                                            <span class="col">WAF設定</span>
                                            <?php
                                                if(isset($error))
                                                {?>
                                            <span class="col error"><?= $error ?></span>
                                            <?php
                                                }
                                            ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="usage-setting" class="col-sm-2 col-form-label">利用設定</label>
                                            <label class="switch text-white">
                                                <input type="checkbox" <?= (int)$waf['usage']==1? "checked":""  ?>>
                                                <span class="slider <?= (int)$waf['usage']==1? "slideron":"slideroff"  ?>"></span>
                                                <span class="handle <?= (int)$waf['usage']==1? "handleon":"handleoff"  ?>"></span>
                                                <span class="<?= (int)$waf['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$waf['usage']==1? "停止":"起動"  ?></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="display-switch" class="col-sm-2 col-form-label">表示切替</label>
                                            <label class="switch text-white">
                                                <input type="checkbox" <?= (int)$waf['display']==1? "checked":""  ?>>
                                                <span class="slider <?= (int)$waf['display']==1? "slideron":"slideroff"  ?>"></span>
                                                <span class="handle <?= (int)$waf['display']==1? "handleon":"handleoff"  ?>"></span>
                                                <span class="<?= (int)$waf['display']==1? "labelon":"labeloff"  ?>"><?= (int)$waf['display']==1? "停止":"起動"  ?></span>
                                            </label>
                                        </div>
                                        <form action="/admin/share/servers/security/waf?confirm&webid=<?=$webid?>" method ="post" id="usage-onoff">
                                            <input type="hidden" name="switch" value="usage">
                                        </form>
                                        <form action="/admin/share/servers/security/waf?confirm&webid=<?=$webid?>" method ="post" id="display-onoff">
                                            <input type="hidden" name="switch" value="display">
                                        </form>
                                        <table class="table">
                                                <tr class="row">
                                                    <th class="col-sm-2">日時</th>
                                                    <th class="col-sm-2">Method</th>
                                                    <th class="col-sm-2">Action</th>
                                                    <th class="col-sm-2">攻撃元IPアドレス</th>
                                                    <th class="col-sm-4">攻撃ターゲットURL</th>
                                                </tr>
                                                <?php
                                                if($waf['usage']==1)
                                                {
                                                    $file = file_get_contents(SWAF_PATH);
                                                        $filearr = explode("\n", $file);
                                                        // echo "<pre>";
                                                        // print_r($filearr);
                                                        // echo "</pre>";
                                                        $double = array();
                                                        
                                                        foreach ($filearr as $key => $value) {
                                                            $double[$key] = array_values(array_filter(explode(" ", $value)));
                                                            
                                                        }
                                                        $count = 0;
                                                        $filter = "MONITOR";
                                                        if($waf['display']==1)
                                                        {
                                                            $filter = "BLOCKED";
                                                        }
                                                        if(count(wafFilter($double,$filter,$webdomain))>0)
                                                        {
                                                            foreach (wafFilter($double,$filter,$webdomain) as $keys => $values) {
                                                                
                                                                wafAction($values);
                                                                $count++;
                                                                if($count>=10)
                                                                {
                                                                    break;
                                                                }
                                                            
                                                            }
                                                        }else{
                                                            
                                                            echo "<tr><td colspan='5'>なし</td></tr>";
                                                        }
                                                }
                                                    
                                                
                                                ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
