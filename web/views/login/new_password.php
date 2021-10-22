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
                            <?php if($error!=null): ?>
                                <h5 class="text-danger text-center"><?= $error ?></h5>
                                <?php 
                                endif;
                                if (isset($_COOKIE['domainid'])):
                                    $domainid =$_COOKIE['domainid'];
                                endif;
                                ?>
                                <form action="/login?act=newpass-reset" method="post">
                                    <input type="hidden" name="domainid" value="<?=$domainid;?>">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="address" name="pass" type="password" placeholder="*****" />
                                        <label for="inputEmail">New Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="address" name="cpass" type="password" placeholder="*****" />
                                        <label for="inputEmail">Comfirm Nassword</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="btn btn-outline-info" href="/login"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></a>
                                        <button class="btn btn-outline-info" type='submit'>パスワードの再設定手続きを行う</button>
                                    </div>
                                </form>
                                <div class="text-center mt-4">
                                再発行ボタンをクリックいただくと、ご登録いただいているお客様情報のメールアドレスにパスワード再設定の認証メールを送付いたしますので、メールをご確認の上手続きをお願いいたします
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php 
require_once('views/footer.php');