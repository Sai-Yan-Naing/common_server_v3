<?php require_once('views/admin/header.php'); ?>
<div id="layoutSidenav">
	<?php require_once('views/admin/sidebar.php'); ?>
	<div id="layoutSidenav_content">
		<main class="main-page">
			<div class="container-fluid px-4">
				<?php require_once('views/admin/title.php') ?>
				<div class="shadow-lg p-3 mb-5 bg-white rounded">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mt-3 mb-3">ドメイン取得</div>
							<form action="/admin/domain-transfer?tab=share&act=confirm&to=domain_search" method="post" id="domain_search_fm">
								<div class="form-group row">
									<label for="domain" class="col-sm-3 col-form-label">ドメイン名</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" id="domain_search" name="domain">
									</div>
									<div class="col-sm-3">
										<button type="submit" class="btn btn-outline-info" id="domain_checker_btn" disabled>取得申請</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mt-3 mb-4">ドメイン移管（他社から弊社に移管）</div>
							<form action="/admin/domain-transfer?tab=share&act=confirm&to=us" method="post" id="domian_transfer_tous">
								<div class="form-group row">
									<label for="domain" class="col-sm-3 col-form-label">ドメイン名</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="domain" id="usdomain">
									</div>
								</div>
								<div class="form-group row">
									<label for="authcode" class="col-sm-3 col-form-label">AuthCode</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="authcode" name="authcode">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-outline-info col-sm-6">申請</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-md-8">
							<div class="mb-3">ドメイン移管（弊社から他社に移管）</div>
							<form action="/admin/domain-transfer?tab=share&act=confirm&to=other" method="post" id="domian_transfer_to_other">
								<div class="form-group row">
									<label for="domain" class="col-sm-3 col-form-label">ドメイン名</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="domain">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-outline-info col-sm-6">他社移管申請</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="back-button"><a href="/admin"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
				</div>

			</div>
		</main>
	</div>
</div>
<?php require_once('views/admin/footer.php'); ?>