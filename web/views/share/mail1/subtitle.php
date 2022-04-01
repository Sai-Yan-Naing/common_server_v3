<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="http://<?=$webdomain?>" class="subtitle pt-4 pb-4 text-dark" target="_blank">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webdomain?></span>
        </a>
        <a href="/share/mail?setting=email&tab=tab&act=index" class="subtitle pt-4 pb-4 <?=($setting==='email')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting==='email')?"setting1":"setting"?>.png" alt="site.png">
            <br><br>
            <span>メール設定 </span>
        </a>
        <a href="/share/mail?setting=connection&tab=pop&act=index" class="subtitle pt-4 pb-4 <?=($setting==='connection')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting==='connection')?"connection1":"connection"?>.png" alt="site.png">
            <br><br>
            <span>メール接続情報</span>
        </a>
        <a href="http://mail.<?=$webdomain?>/IClient/Login.aspx?ReturnUrl=%2fIClient%2fdefault.aspx" target="_blank" class="subtitle pt-4 pb-4 <?=($setting==='database')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/webmail.png" alt="site.png">
            <br><br>
            <span>WEBメール</span>
        </a>
        <a href="/share/mail?setting=list&tab=null&act=index" class="subtitle pt-4 pb-4 <?=($setting==='list')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting==='list')?"maillist1":"maillist"?>.png" alt="site.png">
            <br><br>
            <span>メーリングリスト</span>
        </a>
</div>