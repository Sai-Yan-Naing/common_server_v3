<?php require_once("views/admin/admin_config.php");?>
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">マルチドメイン追加</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
<?php 
$contracts = $commons->getAllRow("SELECT * FROM web_account WHERE origin =? AND customer_id= ?",[1,$webadminID]);
?>
    <form action="/admin/multiple_domain?act=confirm" method="post" id="add_multiple_domain" class="form-content">
        <input type="hidden" name="token" value="<?php echo $token ;?>">
        <input type="hidden" name="action" value="new">
        <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">主契約ドメイン</label>
            <div class="col-sm-8">
                <input type="hidden" name="contractid" value="">
                <select class="form-select" name="web_server" id="web_server" required>
                      <option value="">Select contract domain</option>
                      <?php 
                      
                            foreach($contracts as $value):
                                $sitelimit = "SELECT * FROM web_account WHERE origin_id='$value[id]' and removal IS NULL";
                                $gethost = $commons->getAllRow($sitelimit);
                                $plan_t = $commons->getRow("SELECT * FROM plan_tbl WHERE id= ?",[$value['plan']]);
                      ?>
                      <option value="<?= $value['web_server_id'] ?>" data-webserver="<?= $value['id'] ?>" <?= (count($gethost)+1>=(int)$plan_t['site'])?'disabled':''; ?> title="Something"><?=$value['domain']?></option>
                      <?php 
                  endforeach;
                      ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">追加ドメイン</label>
            <div class="col-sm-8">
                <input type="text" class="form-control checkit" id="domain" column="domain" table="web_account" remark="" name="domain" placeholder="ドメイン名">
            </div>
        </div>
        <div class="form-group row">
            <label for="ftp_user" class="col-sm-2 col-form-label">FTPユーザー名</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ftp_user" name="ftp_user" column="ftp_user"  table="db_ftp" remark="winuser" placeholder="1～20文字、半角英数小文字と_-.@">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">パスワード</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="6～127文字、半角英数字記号の組み合わせ">
            </div>
        </div>
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer d-flex justify-content-center">
  <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
  <button type="submit" class="btn btn-outline-info btn-sm" form="add_multiple_domain">作成</button>
</div>
<div id="disabledopt" style="display:none;">I will show on hover</div>
<style type="text/css">
    select#web_server option:disabled {
color:#f0f0f5
}
</style>

<script type="text/javascript">
    
$("#web_server").change(function(event) {
  $.each($(this).find('option'), function(key, value) {
    $(value).removeClass('disable');
  })
  $('option:selected').addClass('disable');

});

$("#web_server").tooltip({
  placement: 'right',
  trigger: 'hover',
  container: 'body',
  title: function(e) {
    return $(this).find('.disable').attr('title');
  }
});

</script>