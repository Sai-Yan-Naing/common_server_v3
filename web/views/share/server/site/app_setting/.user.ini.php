<?php require_once("views/share_config.php"); ?>
    <div class="modal-header">
    <button type="button" class="btn btn-outline-info mr-3" form="php_ini_fm" id="php_ini_btn" gourl="/share/server?setting=site&tab=app_setting&act=confirm&apply=.user.ini">保存</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="" method="post" id="php_ini_fm" onsubmit="loading()">
            <div class="form-group">
            <textarea class="text-white bg-dark web" id="phpini" name="php_ini" rows="25"><?php echo htmlspecialchars(getFile($webpath."/web/.user.ini")) ?></textarea>
            </div>
        </form>
    </div>

    <style type="text/css">
        textarea.web {
        background: url(http://i.imgur.com/2cOaJ.png);
        background-attachment: local;
        background-repeat: no-repeat;
        padding-left: 35px;
        padding-top: 10px;
        border-color: #ccc;
        font-size: 13px;
        line-height: 16px;
        width:100%;
      }
      #upload_{
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        outline: none;
        opacity: 0;
      }
      .ps_absolute
      {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        border: 3px solid green; 
        font-weight: bold;
      }
    </style>