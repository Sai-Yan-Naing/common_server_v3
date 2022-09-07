<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mysql') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=database&tab=mysql&act=index&webid=<?=$webid?>" onclick="loading()">MySQL（5.7）</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mariadb') ? 'active':'' ?>" href="/share/server?setting=database&tab=mariadb&act=index&webid=<?=$webid?>" onclick="loading()">MariaDB</a>
    </li>
    <?php if( ( $webplnmssqldb == 'yes' || (int)$webpmssql>0)){?>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='mssql') ? 'active':'' ?>" href="/share/server?setting=database&tab=mssql&act=index&webid=<?=$webid?>" onclick="loading()">MSSQL</a>
    </li>
    <?php } ?>
</ul>