<script>
        toastr.options = {  
                "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-full-width",
  "timeOut": 0,
    "extendedTimeOut": 0,
    "tapToDismiss": false
}
<?php if (isset($_SESSION['msg'])): ?>
        $('#common_dialog').modal('show');
        document.getElementById("display_dialog").innerHTML = '<div class="modal-body text-center>"'+"<?= flash('msg') ?>"+'</div>'+
        '<div class="modal-footer d-flex justify-content-center">'+
        '<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">OK</button></div>';
<?php endif; ?>
<?php if (isset($_SESSION['msgdel'])): ?>
        $('#common_dialog').modal('show');
        document.getElementById("display_dialog").innerHTML = '<div class="modal-body text-center">'+"<?= flash('msgdel') ?>"+'</div>'+
        '<div class="modal-footer d-flex justify-content-center">'+
        '<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">OK</button></div>';
<?php endif; ?>
</script>
        </body>
</html>