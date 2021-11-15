<script>
        toastr.options = {  
                "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-full-width",
}
<?php if (isset($_SESSION['msg'])): ?>
toastr.success("<?php echo flash('msg');?>").css({"max-width":"50%","top":20,"text-align":"center"});
<?php endif; ?>
<?php if (isset($_SESSION['msgdel'])): ?>
toastr.error("<?php echo flash('msgdel');?>").css({"max-width":"50%","top":20,"text-align":"center"});
<?php endif; ?>
</script>
        </body>
</html>