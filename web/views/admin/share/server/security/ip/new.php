<!-- Modal Header -->
<?php require_once('views/admin/admin_shareconfig.php'); ?>
<div class="modal-header">
  <h4 class="modal-title">IPアクセス制限</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form action="/admin/share/server?setting=security&tab=ip&act=confirm&webid=<?= $webid?>" method="post" id="blockip_create">
      <input type="hidden" name="action" value="new">
      <div class="d-flex justify-content-center">
          <label for="block_ip" class="col-sm-2 text-right p-2">IPアドレス</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" column="block_ip" id="block_ip" name="block_ip" placeholder="eg: 0.0.0.0">
          </div>
      </div>
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer  d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="blockip_create">追加</button>
</div>