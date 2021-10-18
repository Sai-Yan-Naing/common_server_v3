<?php require_once('views/share/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
    <div id="layoutSidenav">
        <?php require_once('views/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/share/title.php') ?>
                            <?php require_once('views/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <nav class="navbar navbar-expand-sm" style="border-bottom: 2px solid #09CAE3;">
                                    <ul class="navbar-nav mr-auto" id='dir_path'>
                                        <li class="nav-item">
                                        <a class="nav-link folder_click text-white" foldername="" style="padding: 5px 0; cursor: pointer;"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">Home</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="mr-3" style="cursor: pointer;"><a  class="text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=upload&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-cloud-upload-alt nav-tab-icon"></i></a></li>
                                        <li class="mr-3" style="cursor: pointer;"><a class="text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=new_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="" action="new_dir"><i class="far fa-folder nav-tab-icon"></i></a></li>
                                        <li class="mr-3" style="cursor: pointer;"><a  class="text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=new_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="far fa-file nav-tab-icon"></i></a></li>
                                        <li class="mr-3"></li>
                                    </ul>

                                    </nav>
                                    <span id="common_path" path="" style="display: none;"></span>
                                <?php
                                if($weborigin!=1){
                                $dir    = ROOT_PATH.$webrootuser.'/'.$webuser;
                                }else{
                                $dir    = ROOT_PATH.$webuser;
                                }
                                    
                                    $myfiles = array_diff(scandir($dir,1), array('.', '..')); 

                                    // $dir = '/master/files';
                                    $directories = array();
                                    $files_list  = array();
                                    $files = scandir($dir);
                                    foreach($files as $file){
                                    if(($file != '.') && ($file != '..')){
                                        if(is_dir($dir.'/'.$file)){
                                            $directories[]  = $file;

                                        }else{
                                            $files_list[]    = $file;

                                        }
                                    }
                                    }

                                ?>
                                
                                    <!-- Tab panes -->
                                    <div class="tab-content filemanager">
                                        <div class=" pr-3 pl-3 tab-pane active">
                                        <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                            <th class="font-weight-bold">ディレクトリ名</th>
                                            <th class="font-weight-bold">更新日時</th>
                                            <th class="font-weight-bold">ファイル形式</th>
                                            <th class="font-weight-bold">ファイル容量</th>
                                            <th colspan="2" class="text-center font-weight-bold">作業</th>
                                            </tr>
                                        </thead>
                                        <tbody id="changebody">
                                            <?php 
                                            foreach ($directories as $key => $value) {
                                            ?>
                                                <tr>
                                                <td class="folder_click" foldername="<?= $value ?>" style="cursor: pointer;"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">
                                                    <i class="far fa-folder  nav-tab-icon"></i> 
                                                    <span><?= $value ?></span>
                                                </td>
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td><?php echo sizeFormat(folderSize($dir.'/'.$value)) ?></td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="text-end col-sm-12">
                                                        <span class=""></span>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=rename_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="rename">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=delete_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="delete">
                                                        削除
                                                        </button>
                                                    </div>
                                                </td>
                                                </tr>
                                                <?php 
                                            }
                                            $ext = array('html','css','php','js', 'txt' , 'config' , 'sql', 'ini');
                
                                            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                                            
                                            $url = $protocol . $_SERVER['HTTP_HOST'];
                                            foreach ($files_list as $key => $value) {
                                                $extension = getFileExt($dir.'/'.$value);
                                                ?>
                                                <tr>
                                                
                                                <td class="open_file" style="cursor: pointer;" data-toggle="modal" <?php if (in_array($extension, $ext)){ echo 'data-target="#common_dialog"'; } ?> file_name="<?= $value ?>"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"><div><i class="far fa-file nav-tab-icon"></i><span class="ml-1"><?= $value ?></span></div></td>
                                                
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td path="E:\webroot\LocalUser" file="<?=$value?>">
                                                    <?php echo sizeFormat(filesize($dir.'/'.$value)) ?>
                                                </td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="col-sm-12 text-end">
                                                        <a href="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>&download=<?=$value?>&common_path=" class="btn text-dark download_file">
                                                        <i class="fa fa-download"></i>
                                                        </a>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <?php 
                                                        if(getFileExt($dir.'/'.$value)=="zip")
                                                        {?>
                                                            <button class="btn text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=unzip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                            解凍
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=rename_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="rename">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=delete_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="delete">
                                                        削除
                                                        </button>
                                                    </div>
                                                </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
        <style type="text/css">
        textarea {
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
 <?php require_once("views/share/footer.php"); ?>
