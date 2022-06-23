<?php require_once('views/admin/share/header.php'); ?>
<div id="layoutSidenav">
<?php require_once('views/admin/share/sidebar.php');?>
    <div id="layoutSidenav_content">
    <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/share/title.php') ?>
                    <?php require_once('views/admin/share/server/subtitle.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <!-- start -->
                        <nav class="navbar navbar-expand-sm" style="border-bottom: 2px solid #09CAE3;">
                            <ul class="navbar-nav mr-auto" id='dir_path'>
                                <li class="nav-item">
                                <button class="folder_click btn btn-info btn-sm mr-3" foldername="" style="padding: 5px 10px; cursor: pointer;"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">上へ移動</button>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link folder_click text-white" foldername="" style="padding: 5px 0; cursor: pointer;"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">Home</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="mr-3" style="cursor: pointer;"><a  class="text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=upload&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="fas fa-cloud-upload-alt nav-tab-icon"></i></a></li>
                                <li class="mr-3" style="cursor: pointer;"><a class="text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=new_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="" action="new_dir"><i class="far fa-folder nav-tab-icon"></i></a></li>
                                <li class="mr-3" style="cursor: pointer;"><a  class="text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=new_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"><i class="far fa-file nav-tab-icon"></i></a></li>
                                <li class="mr-3"></li>
                            </ul>

                            </nav>
                            <span id="common_path" path="" style="display: none;"></span>
                        <?php
                        
                            $dir = ROOT_PATH.$webpath;

                            $directories = array();
                            $files_list  = array();
                            // $files = scandir($dir);
                            // $ftpclient = new ftpclient('203.137.93.207',"ckmtestt5","welcome123!");
                            // // echo "<pre>";
                            // $ftpclient->rawDirList('web');
                            // die();
                            $files = get_dirlist($web_host,$web_user,$web_password,$dir);
                            // print_r($files);die();

                            foreach ($files as $key=>$file)
                            {
                                if ($file['mode']=='d')
                                {
                                    $directories[$key]  = $file;

                                }else{
                                    $files_list[$key]    = $file;

                                }
                                // echo "<pre>";
                                // print_r($file);
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
                                    <th class="font-weight-bold pl-4">作業</th>
                                    </tr>
                                </thead>
                                <tbody id="changebody">
                                    <?php 
                                    foreach ($directories as $key => $value):
                                    ?>
                                        <tr>
                                        <td class="folder_click" foldername="<?= $value['name'] ?>" style="cursor: pointer;"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">
                                            <div class="d-flex">
                                                <i class="far fa-folder  nav-tab-icon"></i> 
                                                <span class="ml-2 mt-1"><?= $value['name'] ?></span>
                                            </div>
                                        </td>
                                        <td><?= $value['lasttime'] ?></td>
                                        <td>Dir</td>
                                        <td><?php echo $value['length'] ?></td>
                                        <td class="d-flex">
                                            <div class="col-sm-12">
                                                <span class=""></span>
                                                <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                圧縮
                                                </button>
                                                <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=rename_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="rename">名前変更
                                                </button>
                                                <?php if ( $webpath.'/'.$value['name'] !== $webpath.'/web'):?>
                                                <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=delete_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ['name']?>" action="delete">
                                                削除
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        </tr>
                                        <?php 
                                    endforeach;
                                    $ext = array('html','css','php','js', 'txt' , 'config' , 'sql', 'ini', 'gitignore','env');
        
                                    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                                    
                                    $url = $protocol . $_SERVER['HTTP_HOST'];
                                    foreach ($files_list as $key => $value):
                                        $extension = $value['extension'];
                                        ?>
                                        <tr>
                                        
                                        <td class="open_file" style="cursor: pointer;" data-toggle="modal" <?php if (in_array($extension, $ext)){ echo 'data-target="#common_dialog"'; } ?> file_name="<?= $value['name'] ?>"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>">
                                        <div class="d-flex">
                                            <i class="far fa-file nav-tab-icon"></i><span class="ml-2 mt-1"><?= $value['name'] ?></span>
                                        </div></td>
                                        
                                        <td><?= $value['lasttime'] ?></td>
                                        <td>File</td>
                                        <td path="E:\webroot\LocalUser" file="<?=$value['name']?>">
                                            <?php echo sizeFormat($value['length']) ?>
                                        </td>
                                        <td class="d-flex" >
                                            <div class="col-sm-12 ">
                                                <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                圧縮
                                                </button>
                                                <?php 
                                                if($value['extension']=="zip")
                                                {?>
                                                    <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=unzip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                    解凍
                                                </button>
                                                <?php 
                                                }
                                                ?>
                                                <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=rename_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="rename">名前変更
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=delete_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="delete">
                                                削除
                                                </button>
                                                <a href="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>&download=<?=$value['name']?>&common_path=" class="btn download_file">
                                                <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </td>
                                        </tr>
                                    <?php
                                    endforeach
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
 <?php require_once("views/admin/share/footer.php"); ?>
