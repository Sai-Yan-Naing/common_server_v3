<?php 
require_once('views/share/header.php');
$waf = $commons->getRow("SELECT * FROM waf WHERE domain =? ",[$webdomain]);
?>
    <div id="layoutSidenav">
        <?php require_once('views/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/share/title.php') ?>
                            <?php require_once('views/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="waf" class="pr-3 pl-3 tab-pane active"><br>
                                        <div class="form-group row">
                                            <span class="col">WAF利用設定</span>
                                            <?php
                                                if ( isset($error)):?>
                                            <span class="col error"><?= $error ?></span>
                                            <?php
                                                endif;
                                            ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="usage-setting" class="col-sm-2 col-form-label">利用設定</label>
                                            <label class="switch text-white common_dialog" gourl="/share/server?setting=security&tab=waf&act=usage&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                <input type="checkbox" <?= (int)$waf['usage']==1? "checked":""  ?>>
                                                <span class="slider <?= (int)$waf['usage']==1? "slideron":"slideroff"  ?>"></span>
                                                <span class="handle <?= (int)$waf['usage']==1? "handleon":"handleoff"  ?>"></span>
                                                <span class="<?= (int)$waf['usage']==1? "labelon":"labeloff"  ?>"><?= (int)$waf['usage']==1? "起動":"停止"  ?></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="display-switch" class="col-sm-2 col-form-label">表示切替</label>
                                            <label class="switch text-white common_dialog" gourl="/share/server?setting=security&tab=waf&act=display&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog">
                                                <input type="checkbox" <?= (int)$waf['display']==1? "checked":""  ?>>
                                                <span class="slider <?= (int)$waf['display']==1? "slideron":"slideroff"  ?>"></span>
                                                <span class="handle <?= (int)$waf['display']==1? "handleon":"handleoff"  ?>"></span>
                                                <span class="<?= (int)$waf['display']==1? "labelon":"labeloff"  ?>"><?= (int)$waf['display']==1? "起動":"停止"  ?></span>
                                            </label>
                                        </div>
                                        <table class="table table-borderless">
                                                <tr class="row">
                                                    <th class="col-sm-2">日時</th>
                                                    <th class="col-sm-2">Method</th>
                                                    <th class="col-sm-2">Action</th>
                                                    <th class="col-sm-2">攻撃元IPアドレス</th>
                                                    <th class="col-sm-4">攻撃ターゲットURL</th>
                                                </tr>
                                                <?php
                                                if ( $waf['usage']==1)
                                                {
                                                    $file = file_get_contents(SWAF_PATH);
                                                        $filearr = explode("\n", $file);
                                                        // echo "<pre>";
                                                        // print_r($filearr);
                                                        // echo "</pre>";
                                                        $double = array();
                                                        
                                                        foreach ($filearr as $key => $value):
                                                            $double[$key] = array_values(array_filter(explode(" ", $value)));
                                                            
                                                        endforeach;
                                                        $count = 0;
                                                        $filter = "MONITOR";
                                                        if ( $waf['display']==1)
                                                        {
                                                            $filter = "BLOCKED";
                                                        }
                                                        if ( count( wafFilter($double,$filter,$webdomain))>0)
                                                        {
                                                            foreach (wafFilter($double,$filter,$webdomain) as $keys => $values) {
                                                                
                                                                wafAction($values);
                                                                $count++;
                                                                if ( $count>=10)
                                                                {
                                                                    break;
                                                                }
                                                            
                                                            }
                                                        } else
                                                        {
                                                            
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
        <?php 
    function wafAction($values)
    {
        ?>
<tr class="row">
    <td class="col-sm-2"><?= date('d-M-Y H:i:s A', $values[0]) ?></td>
     <?php 
        foreach ($values as $key => $value) {
        
        if ( in_array($value, ['GET','POST','HEAD','PUT','DELETE','CONNECT','OPTIONS','TRACE','PATCH','PROPFIND']))
        {
    ?>
        <td class="col-sm-2"><?= $value ?></td>
        <?php
        }
    }

        foreach ($values as $key => $value) {
        
        if ( str_replace(":","",$value)=="ACTIONMONITOR" || str_replace(":","",$value)=="ACTIONBLOCKED")
        {
    ?>
        <td class="col-sm-2"><?= str_replace("ACTION","",str_replace(":","",$value)) ?></td>
        <?php
        }

    }
        foreach ($values as $key => $value) {
        
        if ( filter_var($value, FILTER_VALIDATE_IP))
        {
    ?>
        <td class="col-sm-2"><?= $value ?></td>
        <?php
        }
    }
        foreach ($values as $key => $value) {
        
        if ( filter_var($value, FILTER_VALIDATE_URL))
        {
    ?>
        <td class="col-sm-4" style="word-break: break-all;"><?= $value ?></td>
        <?php
        }
    }
    ?>
</tr>
    <?php
    
}

function wafFilter($double,$filter,$webdomain)
    {
        $temp = [];
        foreach($double as $keys=>$values)
        {
            if (strpos(implode(' ', $double[$keys]),$webdomain) !== false)
            {
                foreach($values as $key=>$value)
                {
                    if ( str_replace(":","",$value) == "ACTION$filter")
                    {
                        $temp[$keys]=$values;
                    }

                }
            }

        }
        return $temp;
    }
?>
 <?php require_once("views/share/footer.php"); ?>
