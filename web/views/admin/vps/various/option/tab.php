<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="/admin/vps/various?setting=option&tab=spec&act=index&webid=<?=$webid?>" class="nav-link <?= ($tab=='spec') ? 'active':'' ?>" onclick="loading()">スペックオプション</a>
    </li>
    <li class="nav-item">
        <a href="/admin/vps/various?setting=option&tab=license&act=license&webid=<?=$webid?>" class="nav-link <?= ($tab=='license') ? 'active':'' ?>" onclick="loading()">有償ライセンスオプション</a>
    </li>
</ul>