<?php require_once('views/admin/header.php'); ?>
<div id="layoutSidenav">
	<?php require_once('views/admin/sidebar.php'); ?>
	<div id="layoutSidenav_content">
		<main class="main-page">
			<div class="container-fluid px-4">
				<?php require_once('views/admin/title.php') ?>
				<div class="shadow-lg p-3 mb-5 bg-white rounded">
					<div class="row justify-content-center mt-4 mb-4">
						<div class="col-sm-2 text-right p-2"></div>
						<div class="col-sm-10">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="/admin/dns?tab=share&act=index" onclick="loading()">共用サーバー</a>
								</li>
								<li class="nav-item">
									<a class="nav-link active" href="" onclick="loading()">VPS/デスクトップ</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="back-button"><a href="/admin?main=vps" onclick="loading()"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
				</div>
			</div>
		</main>
	</div>
</div>
<?php require_once('views/admin/footer.php'); ?>