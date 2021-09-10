<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_install') ? 'active':'' ?>" aria-current="page" href="/admin/share/server?setting=site&tab=app_install&act=index&webid=<?=$webid?>">アプリケーションインストール</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='basic') ? 'active':'' ?>" href="/admin/share/server?setting=site&tab=basic&act=index&webid=<?=$webid?>">基本設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_setting') ? 'active':'' ?>" href="/admin/share/server?setting=site&tab=app_setting&act=index&webid=<?=$webid?>">応用設定</a>
    </li>
</ul>