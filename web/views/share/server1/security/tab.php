<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ssl') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=security&tab=ssl&act=index" onclick="loading()">SSL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='waf') ? 'active':'' ?>" href="/share/server?setting=security&tab=waf&act=index" onclick="loading()">WAF</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='directory') ? 'active':'' ?>" href="/share/server?setting=security&tab=directory&act=index" onclick="loading()">ディレクトリアクセス</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ip') ? 'active':'' ?>" href="/share/server?setting=security&tab=ip&act=index" onclick="loading()">IPアクセス制限</a>
    </li>
</ul>