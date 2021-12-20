<?php require_once('views/admin/vps/header.php');?>
        <div id="layoutSidenav">
        <?php require_once('views/admin/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
			<main class="main-page">
                    <div class="container-fluid px-4">
						<?php require_once('views/admin/vps/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            	<h3>お問合せ</h3>
								<form action="/admin/vps/contactus?act=confirm&webid=<?=$webid?>" class="mt-3" id="contactus_form" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label class="font-weight-bold" for="name">名前 :</label>
												<input type="text" class="form-control" id="name" placeholder="名前を入力してください" name="name">
											</div>
											<div class="mb-3">
												<label class="font-weight-bold" for="phone">電話 :</label>
												<input type="text" class="form-control" id="phone" placeholder="電話を入力してください" name="phone">
											</div>
											<div class="mb-3">
												<label class="font-weight-bold" for="email">メールアドレス :</label>
												<input type="text" class="form-control" id="email" placeholder="メールアドレスを入力してください" name="email">
											</div>
										</div>
										<div style="text-align:center" class="col-md-1">
											<span class="ver"></span>
										</div>
										<div class="col-md-5">
											<div class="mb-3">
												<label class="font-weight-bold" for="message">お問合せ内容:</label>
												<textarea id="message" class="form-control" name="message" rows="6" placeholder="内容を入力してください"></textarea>
											</div>
											<div class="d-flex">
												<div></div>
												<button type="submit" class="btn btn-outline-info ml-auto col-sm-5">送信</>
											</div>
										</div>
									</div>
								</form>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('views/admin/vps/footer.php'); ?>