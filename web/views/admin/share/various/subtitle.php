<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="http://<?=$webdomain?>" class="subtitle pt-4 pb-4 text-dark" target="_blank">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span class="pl-3 pr-3"><?=$webdomain?></span>
        </a>
        <a href="/admin/share/various?setting=information&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='information')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='information')?"information1":"information"?>.png" alt="site.png">
            <br><br>
            <span class="pl-3 pr-3">ご契約情報  </span>
        </a>
        <?php if( $webplnbackup == 'yes' || $webplanbackup=='yes'):?>
        <a href="/admin/share/various?setting=backup&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='backup')?"active":"text-dark"?>" onclick="loading()">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='backup')?"backup1":"backup"?>.png" alt="site.png">
            <br><br>
            <span class="pl-3 pr-3">⾃動バックアップ</span>
        </a>
        <?php endif; ?>
</div>