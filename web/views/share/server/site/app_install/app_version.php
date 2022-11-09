<?php

require_once("views/share_config.php");

if ( isset($_POST['app']) && $_POST['app']==='WordPress' || $_POST['app'] === "EC-CUBE" )
{
  $app = $_POST['app'];
  $webapp = ['5.6.2','5.6.3','5.7.1'];
  if($app=='EC-CUBE')
  {
    $webapp = ['eccube3','eccube-4.1'];
   
  }
  // foreach ($values = getDirlist($web_host,$web_user,$web_password,"G:\application/$app") as $key => $value) 
  foreach ($values=$webapp as $key => $value)
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