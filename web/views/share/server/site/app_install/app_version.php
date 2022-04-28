<?php

require_once("views/share_config.php");

if ( isset($_POST['app']) && $_POST['app']==='WORDPRESS' || $_POST['app'] === "ECCUBE" )
{
	$app = $_POST['app'];
	 foreach ($values = getDirlist($web_host,$web_user,$web_password,"G:\application/$app") as $key => $value) 
   {
    ?>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="app-version"  <?php if($values[0]===$value){ echo "checked";}?>  value="<?= $value ?>"><?= $value ?>
          </label>
        </div>
    <?php
    }
}

?>