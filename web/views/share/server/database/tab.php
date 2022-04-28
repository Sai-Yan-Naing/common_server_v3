<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mysql') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=database&tab=mysql&act=index&webid=<?=$webid?>" onclick="loading()">MYSQL（5.7）</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mssql') ? 'active':'' ?>" href="/share/server?setting=database&tab=mssql&act=index&webid=<?=$webid?>" onclick="loading()">MSSQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mariadb') ? 'active':'' ?>" href="/share/server?setting=database&tab=mariadb&act=index&webid=<?=$webid?>" onclick="loading()">MARIADB</a>
    </li>
</ul>