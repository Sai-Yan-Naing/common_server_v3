<div class="shadow-lg mb-3 bg-white rounded d-flex font-weight-bold" style="letter-spacing: 3px; font-size:12px">
        <a href="http://<?=$webdomain?>" class="subtitle pt-4 pb-4 text-dark" target="_blank">
            <img src="<?= call_ass() ?>img/subtitle/site.png" alt="site.png">
            <br><br>
            <span><?=$webdomain?></span>
        </a>
        <a href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='site')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='site')?"ftp1":"ftp"?>.png" alt="site.png">
            <br><br>
            <span>サイト設定 </span>
        </a>
        <a href="/admin/share/server?setting=security&tab=ssl&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='security')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='security')?"security1":"security"?>.png" alt="site.png">
            <br><br>
            <span>サイトセキュリティー</span>
        </a>
        <a href="/admin/share/server?setting=database&tab=mysql&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='database')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='database')?"database1":"database"?>.png" alt="site.png">
            <br><br>
            <span>データベース</span>
        </a>
        <a href="/admin/share/server?setting=ftp&tab=tab&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='ftp')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='ftp')?"ftp1":"ftp"?>.png" alt="site.png">
            <br><br>
            <span>FTP</span>
        </a>
        <a href="/admin/share/server?setting=filemanager&tab=tab&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='filemanager')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='filemanager')?"filemanager1":"filemanager"?>.png" alt="site.png">
            <br><br>
            <span>ファイルマネージャー</span>
        </a>
        <a href="/admin/share/server?setting=analysis&tab=tab&act=index&webid=<?=$webid?>" class="subtitle pt-4 pb-4 <?=($setting=='analysis')?"active":"text-dark"?>">
            <img src="<?= call_ass() ?>img/subtitle/<?=($setting=='analysis')?"analysis1":"analysis"?>.png" alt="site.png">
            <br><br>
            <span>アクセス分析</span>
        </a>
</div>