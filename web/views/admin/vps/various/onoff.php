<?php
require_once('views/admin/vps/get_state1.php');
?>
<?php  
if($state=="Off"){
  $webactive=1;
}else if($state=="Running"){
  $webactive=0;
}
?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">VPS</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">

  <form action="/admin/vps/various?setting=<?=$setting?>&tab=<?=$tab?>&act=onoff_confirm&webid=<?=$webid?>" method="post" id="onoff" onsubmit="loading()">
    <input type="hidden" name="action" value="onoff">
    <input type="hidden" name="state" value="<?= $webactive ?>">
    <?= $webactive==0? "起動" : "停止"  ?>しますか？
      
  </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="onoff"><?= $webactive==0? "起動" : "停止"  ?></button>
</div>