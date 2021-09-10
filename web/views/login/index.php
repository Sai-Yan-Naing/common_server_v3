<?php require_once('views/header.php');?>
<div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h1 class="font-weight-bold text-primary text-center">Winserver</h1>
                                        <h3 class="text-center font-weight-bold">Control Panel Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if($error!=null){ ?>
                                        <h5 class="text-danger text-center"><?= $error ?></h5>
                                        <?php } ?>
                                        <form action="/login?act=confirm" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="domainid" name="domainid" type="text" placeholder="name@example.com" />
                                                <label for="domainid">ご契約ID</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="パスワード" />
                                                <label for="password">パスワード</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">ログインを記憶する</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="/login?act=forgot-pass">PASSWORDをお忘れの方はこちらから</a>
                                                <button type="submit" name="post" class="btn btn-info">ログイン</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('views/footer.php'); ?>