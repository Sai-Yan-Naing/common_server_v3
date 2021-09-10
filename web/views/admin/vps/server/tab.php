<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='connection') ? 'active':'' ?>" aria-current="page" href="/admin/vps/server?tab=connection&act=index&webid=<?=$webid?>">接続情報</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='basic') ? 'active':'' ?>" href="/admin/vps/server?tab=basic&act=index&webid=<?=$webid?>">基本設定</a>
    </li>
</ul>