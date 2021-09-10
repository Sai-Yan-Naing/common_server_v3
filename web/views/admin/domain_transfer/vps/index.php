<?php require_once('views/admin/header.php');?>
        <div id="layoutSidenav">
        <?php require_once('views/admin/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
						<?php require_once('views/admin/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <h3 class="text-center">お問合せ</h3>
				  		<form action="/admin/contact_us/confirm" class="mt-3" id="contactus_form" method="post">
						    <div class="row">
						    	<div class="col-md-6">
							      <label class="font-weight-bold" for="name">名前:</label>
							      <input type="text" class="form-control" id="name" placeholder="名前を入力してください" name="name">
							    </div>
							    <div class="col-md-6">
							      <label class="font-weight-bold" for="email">メールアドレス:</label>
							      <input type="text" class="form-control" id="email" placeholder="メールアドレスを入力してください" name="email">
							    </div>
						    </div>
						    <div class="row">
						    	<div class="col-md-6">
							      <label class="font-weight-bold" for="phone">電話番号:</label>
							      <input type="text" class="form-control" id="phone" placeholder="電話番号を入力してください" name="phone">
							    </div>
							    <div class="col-md-6">
							      <label class="font-weight-bold" for="subject">件名:</label>
							      <input type="text" class="form-control" id="pwd" placeholder="件名を入力してください" name="subject">
							    </div>
						    </div>
						    <div class="row justify-content-center">
						    	<div class="col-md-6">
							      <label class="font-weight-bold" for="message">メッセージ:</label>
							      <textarea id="message" class="form-control" name="message" rows="4" placeholder="メッセージを入力してください"></textarea>
							    </div>
						    </div>
						    <div class="row justify-content-center mt-2">
						    	<div class="col-md-4">
							      <button class="btn btn-success form-control">送信</button>
							    </div>
						    </div>
						</form>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once('views/admin/footer.php'); ?>