<!-- Modal Header -->
<?php
require_once('views/admin/admin_config.php');
$webid = $_GET['webid'];
$query = "SELECT * FROM web_account WHERE id='$webid'";
$getRow = $commons->getRow($query);
$dns = json_decode($getRow['dns']);
$act_id = $_GET['act_id'];
// echo $getRow['id'];
?>
<div class="modal-header">
  <h4 class="modal-title">レコード編集</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/dns?tab=share&act=confirm&webid=<?=$getRow['id'];?>" method="post" id="dns_create">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="act_id" value="<?=$act_id?>">
    <input type="hidden" name="type" value="<?=$dns->$act_id->type?>">
      <div class="row justify-content-center">
          <label for="type" class="col-sm-2 text-right p-2">タイプ</label>
          <div class="col-sm-10">
            <span class="p-2"><?= $dns->$act_id->type; ?></span>
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="sub" class="col-sm-2 text-right p-2">ホスト名</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="sub" name="sub" placeholder="1-14文字、半角英数字" value="<?= $dns->$act_id->sub; ?>">
          </div>
      </div>
      <div class="row justify-content-center">
          <label for="target" class="col-sm-2 text-right p-2">ＩＰ/ドメイン</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" column="target" id="target" name="target" placeholder="8～70文字、半角英数記号の組み合わせ" value="<?= $dns->$act_id->target; ?>">
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="dns_create">作成</button>
</div>