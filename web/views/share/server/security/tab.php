<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ssl') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=security&tab=ssl&act=index">SSL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='waf') ? 'active':'' ?>" href="/share/server?setting=security&tab=waf&act=index">WAF</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='directory') ? 'active':'' ?>" href="/share/server?setting=security&tab=directory&act=index">ディレクトリアクセス</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ip') ? 'active':'' ?>" href="/share/server?setting=security&tab=ip&act=index">IPアクセス制限</a>
    </li>
</ul>