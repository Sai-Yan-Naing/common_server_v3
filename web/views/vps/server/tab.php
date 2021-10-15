<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='connection') ? 'active':'' ?>" aria-current="page" href="/vps/server?tab=connection&act=index" onclick="loading()">接続情報</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='basic') ? 'active':'' ?>" href="/vps/server?tab=basic&act=index" onclick="loading()">基本設定</a>
    </li>
</ul>