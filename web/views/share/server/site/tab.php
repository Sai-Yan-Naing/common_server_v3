<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_install') ? 'active':'' ?>" aria-current="page" href="/share/server?setting=site&tab=app_install&act=index&webid=<?=$webid?>" onclick="loading()">アプリケーションインストール</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='basic') ? 'active':'' ?>" href="/share/server?setting=site&tab=basic&act=index&webid=<?=$webid?>" onclick="loading()">基本設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='app_setting') ? 'active':'' ?>" href="/share/server?setting=site&tab=app_setting&act=index&webid=<?=$webid?>" onclick="loading()">応用設定</a>
    </li>
</ul>