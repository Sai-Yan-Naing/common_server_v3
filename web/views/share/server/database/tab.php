<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mysql') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=database&tab=mysql&act=index" onclick="loading()">MYSQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mssql') ? 'active':'' ?>" href="/share/server?setting=database&tab=mssql&act=index" onclick="loading()">MSSQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mariadb') ? 'active':'' ?>" href="/share/server?setting=database&tab=mariadb&act=index" onclick="loading()">MARIADB</a>
    </li>
</ul>