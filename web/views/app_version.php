<?php

require_once "commons/common.php";

if ( isset($_POST['app']) && $_POST['app']==='WordPress' || $_POST['app'] === "EC-CUBE" )
{
	$app = $_POST['app'];
	 foreach ($values = app_version($app) as $key => $value) 
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