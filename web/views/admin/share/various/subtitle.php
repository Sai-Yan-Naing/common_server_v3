<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="http://<?=$webdomain?>" class="subtitle pt-3 pb-3 text-dark" target="_blank">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webdomain?></span>
        </a>
        <a href="/admin/share/various?setting=information&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='information')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='information')?"information1":"information"?>.png" alt="site.png">
            <br><br>
            <span>ご契約情報  </span>
        </a>
        <a href="/admin/share/various?setting=backup&act=index&webid=<?=$webid?>" class="subtitle pt-3 pb-3 <?=($setting=='backup')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='backup')?"backup1":"backup"?>.png" alt="site.png">
            <br><br>
            <span>⾃動バックアップ</span>
        </a>
</div>