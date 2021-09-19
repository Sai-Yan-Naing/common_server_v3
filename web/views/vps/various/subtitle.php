<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="#" class="subtitle pt-4 pb-4 text-dark">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webip?></span>
        </a>
        <a href="/vps/various?setting=firewall&tab=firewall&act=index" class="subtitle pt-4 pb-4 <?=($setting=='firewall')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='firewall')?"firewall1":"firewall"?>.png" alt="site.png">
            <br><br>
            <span>Firewall設定 </span>
        </a>
        <a href="/vps/various?setting=load_status&tab=load_status&act=index" class="subtitle pt-4 pb-4 <?=($setting=='load_status')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='load_status')?"load_status1":"load_status"?>.png" alt="site.png">
            <br><br>
            <span>負荷状況確認</span>
        </a>
        <a href="/vps/various?setting=option&tab=spec&act=index" class="subtitle pt-4 pb-4 <?=($setting=='option')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='option')?"option1":"option"?>.png" alt="site.png">
            <br><br>
            <span>オプション追加</span>
        </a>
        <a href="/vps/various?setting=easy_install&tab=easy_install&act=index" class="subtitle pt-4 pb-4 <?=($setting=='easy_install')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='easy_install')?"easy_install1":"easy_install"?>.png" alt="site.png">
            <br><br>
            <span>簡単インストール</span>
        </a>
        <a href="/vps/various?setting=backup&tab=backup&act=index" class="subtitle pt-4 pb-4 <?=($setting=='backup')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='backup')?"backup1":"backup"?>.png" alt="site.png">
            <br><br>
            <span>バックアップ</span>
        </a>
</div>