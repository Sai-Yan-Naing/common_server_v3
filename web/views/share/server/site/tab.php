<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_install') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=site&tab=app_install&act=index">アプリケーションインストール</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='basic') ? 'active':'' ?>" href="/share/server?setting=site&tab=basic&act=index">基本設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_setting') ? 'active':'' ?>" href="/share/server?setting=site&tab=app_setting&act=index">応用設定</a>
    </li>
</ul>