  <!-- The Modal -->
  <div class="modal fade" id="common_dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="display_dialog">
	  	
      </div>
    </div>
  </div>
  <div id="common_modal_loading" style="display: none;">
	<!-- Modal Header -->
	<div class="modal-header">
		<h4 class="modal-title">Wait a few minutes ....</h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<!-- Modal body -->
	<div class="modal-body">
		<div class="d-flex align-items-center">
			<strong>Loading...</strong>
			<div class="spinner-grow text-muted"></div>
			<div class="spinner-grow text-primary"></div>
			<div class="spinner-grow text-success"></div>
		</div>
	</div>
</div>
  <div class="modal fade" id="common_modal_delete">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="display_modal_delete">
      	<!-- Modal Header -->
					<div class="modal-header">
					  <h4 class="modal-title">Wait a few minutes ....</h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
					    <div class="d-flex align-items-center">
						  <strong>Loading...</strong>
						  <div class="spinner-grow text-muted"></div>
						  <div class="spinner-grow text-primary"></div>
						  <div class="spinner-grow text-success"></div>
						</div>
					</div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="excommon_dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="exdisplay_dialog">
	  	  <div class="modal-body text-center">レコードが５件目以降の場合は別途追加費用1レコードにつき110円/月かかりますがよろしいですか？</div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button>
          <button type="button" class="btn btn-outline-info btn-sm" id="btn_Confirm">OK</button>
        </div>
      </div>
    </div>
  </div>