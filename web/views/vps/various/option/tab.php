<ul class="nav nav-tabs">
    <?php if($web_os=='wins'){?>
    <li class="nav-item">
        <a href="/vps/various?setting=option&tab=spec&act=index&webid=<?=$webid?>" class="nav-link <?= ($tab=='spec') ? 'active':'' ?>" onclick="loading()">スペックオプション</a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a href="/vps/various?setting=option&tab=license&act=license&webid=<?=$webid?>" class="nav-link <?= ($tab=='license') ? 'active':'' ?>" onclick="loading()">有償ライセンスオプション</a>
    </li>
</ul>