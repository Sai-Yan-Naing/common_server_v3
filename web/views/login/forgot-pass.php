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
                                <form>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">ご契約ID</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="btn btn-info" href="/login"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></a>
                                        <a class="btn btn-info" href="#">パスワードの再設定手続きを行う</a>
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