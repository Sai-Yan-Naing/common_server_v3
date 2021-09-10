<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ssl') ? 'active':'' ?>" aria-current="page" href="/admin/share/server?setting=security&tab=ssl&act=index&webid=<?=$webid?>">SSL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='waf') ? 'active':'' ?>" href="/admin/share/server?setting=security&tab=waf&act=index&webid=<?=$webid?>">WAF</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='directory') ? 'active':'' ?>" href="/admin/share/server?setting=security&tab=directory&act=index&webid=<?=$webid?>">ディレクトリアクセス</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='ip') ? 'active':'' ?>" href="/admin/share/server?setting=security&tab=ip&act=index&webid=<?=$webid?>">IPアクセス制限</a>
    </li>
</ul>