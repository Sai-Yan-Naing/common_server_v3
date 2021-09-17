<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="#" class="subtitle pt-3 pb-3 text-dark">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webip?></span>
        </a>
        <a href="/admin/vps/various?setting=firewall&tab=firewall&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='firewall')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='firewall')?"firewall1":"firewall"?>.png" alt="site.png">
            <br><br>
            <span>Firewall設定 </span>
        </a>
        <a href="/admin/vps/various?setting=load_status&tab=load_status&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='load_status')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='load_status')?"load_status1":"load_status"?>.png" alt="site.png">
            <br><br>
            <span>負荷状況確認</span>
        </a>
        <a href="/admin/vps/various?setting=option&tab=spec&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='option')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='option')?"option1":"option"?>.png" alt="site.png">
            <br><br>
            <span>オプション追加</span>
        </a>
        <a href="/admin/vps/various?setting=easy_install&tab=easy_install&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='easy_install')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='easy_install')?"easy_install1":"easy_install"?>.png" alt="site.png">
            <br><br>
            <span>簡単インストール</span>
        </a>
        <a href="/admin/vps/various?setting=backup&tab=backup&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='backup')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='backup')?"backup1":"backup"?>.png" alt="site.png">
            <br><br>
            <span>バックアップ</span>
        </a>
</div>