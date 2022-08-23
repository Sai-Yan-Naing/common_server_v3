<form action="/admin/share/appinstall-confirm?webid=<?=$webid?>" method="post" id="app_install_form">
    <div class="form-group row">
        <label for="application" class="col-sm-3 col-form-label">アプリケーション</label>
        <div class="col-sm-8">
            <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input app" value="WORDPRESS" name="app" checked gourl="change/app_version">Word Press
            </label>
            </div>
            <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input app" value="ECCUBE" name="app" gourl="change/app_version">EC-CUBE
            </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="install-method" class="col-sm-3 col-form-label">インストール方法</label>
        <div class="col-sm-8">
            <label for="install-method" class="col-form-label">新規インストール</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="version" class="col-sm-3 col-form-label">バージョン</label>
        <div class="col-sm-8" id="version">
            <?php
            echo(getDirlist($web_host,$web_user,$web_password,"G:\application\WORDPRESS"));
            foreach ($values=getDirlist($web_host,$web_user,$web_password,"G:\application\WORDPRESS") as $key => $value) {
            ?>
                <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="app-version" <?php if($values[0]==$value){ echo "checked";}?> value="<?=$value?>"><?= $value ?>
                </label>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="url" class="col-sm-3 col-form-label">URL</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="url" name="url" placeholder="http(s)://ドメイン名/入力は任意" value="http://<?=$webdomain?>/">
        </div>
    </div>
    <div class="form-group row">
        <label for="site_name" class="col-sm-3 col-form-label">サイト名</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="site_name" name="site_name" placeholder="サイト名">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-3 col-form-label">ユーザー名</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="username" name="username" placeholder="1～255文字、半角英数小文字と_-.@">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">メールアドレス</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" id="email" name="email" placeholder="support@winserver.ne.jp">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">パスワード</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="password" placeholder=" 8～30文字、半角英数記号の組み合わせ">
        </div>
    </div>
    <div class="form-group row">
        <label for="database" class="col-sm-3 col-form-label">データベース</label>
        <label for="db-name" class="col-sm-3 col-form-label">データベース名</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="db_name" name="db_name" placeholder="データベース名" column="db_user" table="db_account" remark="mydbname">
            <label for="db_name" id="db_name_ex_error" class="error"></label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3"></div>
        <label for="db_user" class="col-sm-3 col-form-label">ユーザー名</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="db_user" name="db_user" placeholder="ユーザー名" column="db_user" table="db_account" remark="mydbuser">
            <label for="db_user" id="db_user_ex_error" class="error"></label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3"></div>
        <label for="db_pass" class="col-sm-3 col-form-label">パスワード</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="db_pass" name="db_pass" placeholder=" 8～30文字、半角英数字記号の組み合わせ">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <button type="reset" class="btn btn-outline-secondary text-outline-white">クリア</button>
            <button type="submit" class="btn btn-outline-info text-outline-white">インストール</button>
        </div>
    </div>
</form>