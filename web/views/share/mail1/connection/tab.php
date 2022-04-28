<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='pop') ? 'active':'' ?>" aria-current="page" href="/share/mail?setting=connection&tab=pop&act=index" onclick="loading()">ＰＯＰ/ＩＭＡＰ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($tab=='smtp') ? 'active':'' ?>" href="/share/mail?setting=connection&tab=smtp&act=index" onclick="loading()">ＳＭＴＰ</a>
    </li>
</ul>