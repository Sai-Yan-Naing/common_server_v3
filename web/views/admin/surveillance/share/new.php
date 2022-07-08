
<?php require_once('views/admin/surveillance/share/header.php');?>
<div id="layoutSidenav">
<?php require_once('views/admin/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <span style="display:none" id="checkvps" checkvps='all'></span>
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php');?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <h4 class="mb-4">契約サービス</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/admin" onclick="loading()">共用サーバー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin?main=vps" onclick="loading()">VPS/デスクトップ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/admin?main=surveillance&act=index" onclick="loading()">監視</a>
                            </li>
                        </ul>
                        <div class="mt-3">
                        	<label><?= $webdomain ?>【<?= $webplnname ?>】</label>
                        	<form>
	                        	<div class="d-flex">
	                        		<div class="mr-2">通知先</div>
	                        		<div class="mr-2"><input type="text" name="mail" class="form-control form-control-sm"></div>
	                        		<div class="mr-2"><button class="btn btn-info btn-sm">登録</button></div>
	                        	</div>
	                        </form>

	                        <table class="table table-bordered mt-3">
                                <tr>
                                    <th class="font-weight-bold border-dark">登録メールアドレス</th>
                                    <th class="font-weight-bold border-dark">操作</th>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold border-dark">mailadress1</td>
                                    <td class="font-weight-bold border-dark">
                                    	<a href="javascript:;" class="btn btn-outline-info btn-sm">編集</a>
                                     	<a href="javascript:;" class="btn btn-outline-danger btn-sm">削除</a>
                                     </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold border-dark">mailadress2</td>
                                    <td class="font-weight-bold border-dark">
										<a href="javascript:;" class="btn btn-outline-info btn-sm">編集</a>
                                     	<a href="javascript:;" class="btn btn-outline-danger btn-sm">削除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold border-dark">mailadress3</td>
                                    <td class="font-weight-bold border-dark">
										<a href="javascript:;" class="btn btn-outline-info btn-sm">編集</a>
                                     	<a href="javascript:;" class="btn btn-outline-danger btn-sm">削除</a>
                                     </td>
                                </tr>
                            </table>
	                        	<div class="d-flex mt-3">
	                        		<div class="mr-2">URL監視</div>
	                        		<div class="mr-2"><button class="btn btn-info btn-sm clone-url">項目追加</button></div>
	                        	</div>
	                        	<form class="mt-3 urls-f">
	                        		<div class="d-flex urls-clone mt-3">
	                        			<div class="mr-2 col-4">
	                        				<input type="text" name="urls[]" class="form-control form-control-sm">
	                        			</div>
	                        			<div class="mr-2">
	                        				<button class="btn btn-outline-danger btn-sm delete-clone" type="button">削除</button>
	                        			</div>
	                        		</div>
	                        	</form>
	                        	<div class="mt-3">
	                        		<button class="btn btn-info btn-sm">監視登録</button>
	                        	</div>
                        </div>
                        <div class="back-button"><a href="/admin?main=surveillance&act=index" onclick="loading()"><button type="button" class="btn btn-outline-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="ml-3">戻る</span></button></a></div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php 
require_once('views/admin/surveillance/share/footer.php');
?>
<script>
$(document).on('click','.clone-url',function(){
	$(this).parent().parent().next().children('.urls-clone:first-child').clone().appendTo(".urls-f");
});
$(document).on('click','.delete-clone', function(){
	$(this).parent().parent().remove();
})
</script>