<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mysql') ? 'active':'' ?>" aria-current="page" href="/admin/share/server?setting=database&tab=mysql&act=index&webid=<?=$webid?>" onclick="loading()">MYSQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mssql') ? 'active':'' ?>" href="/admin/share/server?setting=database&tab=mssql&act=index&webid=<?=$webid?>" onclick="loading()">MSSQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mariadb') ? 'active':'' ?>" href="/admin/share/server?setting=database&tab=mariadb&act=index&webid=<?=$webid?>" onclick="loading()">MARIADB</a>
    </li>
</ul>