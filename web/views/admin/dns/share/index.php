<?php require_once('views/admin/header.php'); ?>
<div id="layoutSidenav">
	<?php require_once('views/admin/sidebar.php'); ?>
	<div id="layoutSidenav_content">
		<main class="main-page">
			<div class="container-fluid px-4">
				<?php require_once('views/admin/title.php') ?>
				<div class="shadow-lg p-3 mb-5 bg-white rounded">
					<div class="row justify-content-center mt-4">
						<div class="col-sm-2 text-right p-2"></div>
						<div class="col-sm-10">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="" onclick="loading()">共用サーバー</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="" onclick="loading()">VPS/デスクトッププラン</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="row mb-4 justify-content-center">
						<div class="col-sm-2 text-right">
							<label>契約サービス</label>
							<div>
							<?php
							$limit = 10;
                            $table = 'web_account';  
                            require_once('views/pagination/start.php');
                            
							$webid = isset($_GET['webid']) ? $_GET['webid'] : null;
							$query = "SELECT * FROM $table WHERE `customer_id` = ? && `removal` is null LIMIT $start, $limit";
							$commons = new Common;
							$getAllRow = $commons->getAllRow($query,[$webadminID]);
							if ($webid == null):
								$param = $webrootid;
							else:
								$param = $webid;
							endif;
							?>
							<?php foreach ($getAllRow as $value): ?>
								<a href="/admin/dns?tab=share&act=index&webid=<?= htmlspecialchars($value['id'], ENT_QUOTES); ?><?= $pagy ?>">
									<div class="mb-2 pr-2 pl-2 py-1 <?= ($param==$value['id'])? 'bg-info text-white font-weight-bold h5':'text-secondary' ?>"><?= htmlspecialchars($value['domain'], ENT_QUOTES);; ?></div>
								</a>
							<?php endforeach; ?>
							</div>
							
							<!-- pagination -->
							<div class="d-flex mt-3">
								<div></div>
								<div class='ml-auto'>
									<?php 
										$paginatecount = "SELECT COUNT(*) FROM $table WHERE `customer_id` = ? && `removal` is null";
										// SELECT COUNT(*) FROM web_account WHERE `customer_id` = 'D000123' && `removal` is null
										$params = [$webadminID];
										$page_url = "/admin/dns?tab=share&act=index&webid=$param&page=";
										require_once('views/pagination/end.php')
									?>
								</div>
							</div>
							<!-- end pagination -->
						</div>
						<?php
						$webid = isset($_GET['webid']) ? $_GET['webid'] : null;
						if ($webid == null):
							$param = $webrootid;
							$query = 'SELECT * FROM web_account WHERE `customer_id` = :customer_id && `removal` is null && `origin`=:param';
						else:
							$param = $webid;
							$query = 'SELECT * FROM web_account WHERE `customer_id` = :customer_id && `removal` is null && `id`=:param';
						endif;

						$getDns = $commons->getRow($query, ['customer_id' => $webadminID,'param' => $param]);
						?>
						<div class="col-sm-10">
							<div class="card">
								<div class="card-body">
									<table class="table table-borderless">
										<thead>
											<tr class="row">
												<th class="font-weight-bold col-sm-2">タイプ</th>
												<th class="font-weight-bold col-sm-2">ホスト名</th>
												<th class="font-weight-bold col-sm-3">ドメイン名</th>
												<th class="font-weight-bold col-sm-3">IPアドレス/ドメイン名</th>
												<th class="font-weight-bold col-sm-2">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$temp = json_decode($getDns['dns']);
											foreach ($temp as $key => $value): ?>
												<tr class="row">
													<td class="col-sm-2"><?= htmlspecialchars($value->type, ENT_QUOTES); ?></td>
													<td class="col-sm-2"><?= htmlspecialchars($value->sub, ENT_QUOTES); ?></td>
													<td class="col-sm-3">.<?= htmlspecialchars($getDns['domain'], ENT_QUOTES);  ?></td>
													<td class="col-sm-3"><?= htmlspecialchars( $value->target, ENT_QUOTES); ?></td>
													<td class="col-sm-2">
														<a href="javascript:;" data-toggle="modal" data-target="#common_dialog" class="btn btn-outline-info btn-sm common_dialog" gourl="/admin/dns?tab=share&act=edit&webid=<?= $getDns['id']; ?>&act_id=<?= $key ?><?= $pagy ?>">編集</a>
														<a href="javascript:;" data-toggle="modal" data-target="#common_dialog" class="btn btn-outline-danger btn-sm edit_database btn-sm common_dialog" gourl="/admin/dns?tab=share&act=delete&webid=<?= $getDns['id']; ?>&act_id=<?= $key ?>">削除</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<?php if (count(json_decode($getDns['dns'], true)) < 5): ?>
										<div class="row justify-content-center">
											<div class="col-sm-3"><button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_dialog" gourl="/admin/dns?tab=share&act=new&webid=<?= $getDns['id']; ?>"><span class="mr-2"><i class="fas fa-plus-square"></i></span>レコード追加</button></div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="back-button"><a href="/admin" onclick="loading()"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
				</div>
			</div>
		</main>
	</div>
</div>
<?php require_once('views/admin/footer.php'); ?>