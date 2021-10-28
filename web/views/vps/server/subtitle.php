<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="#" class="subtitle pt-4 pb-4 text-dark">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webip?></span>
        </a>
        <a class="subtitle pt-4 pb-4">
            <label class="switch text-white common_dialog text-left m-0" gourl="/vps/server?tab=<?=$tab?>&act=onoff"  data-toggle="modal" data-target="#common_dialog" onsubmit="loading()">
                <input type="checkbox" <?= $webactive!=0? "checked":""  ?>>
                <span class="slider <?= $webactive!=0? "slideron":"slideroff"  ?>"></span>
                <span class="handle <?= $webactive!=0? "handleon":"handleoff"  ?>"></span>
                <span class="<?= $webactive!=0? "labelon":"labeloff"  ?>"><?= $webactive!=0? "起動":"停止"  ?></span>
            </label><br><br>
            <span class="text-dark ">Server Status </span>
        </a>
        <a href="/vps/server?tab=connection&act=index" class="subtitle pt-4 pb-4 <?=($tab=='connection')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($tab=='connection')?"site1":"site"?>.png" alt="site.png">
            <br><br>
            <span>接続情報</span>
        </a>
        <a href="/vps/server?tab=basic&act=index" class="subtitle pt-4 pb-4 <?=($tab=='basic')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($tab=='basic')?"info1":"info"?>.png" alt="site.png">
            <br><br>
            <span>基本設定</span>
        </a>
</div>