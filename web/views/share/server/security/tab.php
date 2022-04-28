<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ssl') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=security&tab=ssl&act=index&webid=<?=$webid?>" onclick="loading()">SSL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='waf') ? 'active':'' ?>" href="/share/server?setting=security&tab=waf&act=index&webid=<?=$webid?>" onclick="loading()">WAF</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='directory') ? 'active':'' ?>" href="/share/server?setting=security&tab=directory&act=index&webid=<?=$webid?>" onclick="loading()">ディレクトリアクセス</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ip') ? 'active':'' ?>" href="/share/server?setting=security&tab=ip&act=index&webid=<?=$webid?>" onclick="loading()">IPアクセス制限</a>
    </li>
</ul>