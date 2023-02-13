<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="#" class="subtitle pt-4 pb-4 text-dark">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webip?></span>
        </a>
        <a class="subtitle pt-4 pb-4">
            <label class="switch text-white common_dialog text-left m-0" gourl="/vps/various?setting=<?=$setting?>&tab=<?=$tab?>&act=onoff&webid=<?= $webid?>"  data-toggle="modal" data-target="#common_dialog">
                <input type="checkbox" <?= $webactive!=0? "checked":""  ?>>
                <span class="slider <?= $webactive!=0? "slideron":"slideroff"  ?>"></span>
                <span class="handle <?= $webactive!=0? "handleon":"handleoff"  ?>"></span>
                <span class="<?= $webactive!=0? "labelon":"labeloff"  ?>"><?= $webactive!=0? "起動":"停止"  ?></span>
            </label><br><br>
            <span class="text-dark ">Server Status </span>
        </a>
        <a href="/vps/various?setting=firewall&tab=firewall&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='firewall')?"active":"text-dark"?>" onclick="loading()">
            <?php if($web_os=='windows'):?>
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='firewall')?"firewall1":"firewall"?>.png" alt="site.png">
            <?php else: ?>
                <div style="font-size: 22px;"><i class="fa fa-terminal" aria-hidden="true"></i></div>
            <?php endif;?>
            
            <br>
            <span><?php if($web_os=='windows'):?>Firewall設定<?php else: ?>terminal <?php endif;?></span>
        </a>
        <?php if($web_os=='windows'){?>
        <a href="/vps/various?setting=load_status&tab=load_status&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='load_status')?"active":"text-dark"?> vpsrebtn" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='load_status')?"load_status1":"load_status"?>.png" alt="site.png">
            <br><br>
            <span>負荷状況確認</span>
        </a>
        <?php } ?>
        <a href="/vps/various?setting=option&tab=spec&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='option')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='option')?"option1":"option"?>.png" alt="site.png">
            <br><br>
            <span>オプション追加</span>
        </a>
        <?php if($web_os=='windows'){?>
        <a href="/vps/various?setting=easy_install&tab=easy_install&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='easy_install')?"active":"text-dark"?> vpsrebtn" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='easy_install')?"easy_install1":"easy_install"?>.png" alt="site.png">
            <br><br>
            <span>簡単インストール</span>
        </a>
        <?php } ?>
        <a href="/vps/various?setting=backup&tab=backup&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='backup')?"active":"text-dark"?> vpsrebtn" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='backup')?"backup1":"backup"?>.png" alt="site.png">
            <br><br>
            <span>バックアップ</span>
        </a>
</div>