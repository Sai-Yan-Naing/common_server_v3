<?php require_once('views/admin/share/header.php'); ?>
<?php 
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
?>
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
                                        <a class="nav-link folder_click text-white" foldername="" style="padding: 5px 0; cursor: pointer;"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">Home</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="mr-3" style="cursor: pointer;"><a data-toggle="modal" data-target="#upload_file"><i class="fas fa-cloud-upload-alt fa-2x"></i></a></li>
                                        <li class="mr-3" style="cursor: pointer;"><a class="fm_common_c text-dark" action="newDir"  data-toggle="modal" data-target="#fm_common_modal" file_name=""  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>"><i class="far fa-folder fa-2x"></i></a></li>
                                        <li class="mr-3" style="cursor: pointer;"><a class="fm_common_c text-dark" action="newFile"  data-toggle="modal" data-target="#fm_common_modal" file_name=""  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>"><i class="far fa-file fa-2x"></i></a></li>
                                        <li class="mr-3"></li>
                                    </ul>

                                    </nav>
                                    <span id="common_path" path="" style="display: none;"></span>
                                <?php
                                if($weborigin!=1){
                                $dir    = 'E:/webroot/LocalUser/'.$webrootuser.'/'.$webuser;
                                }else{
                                $dir    = 'E:/webroot/LocalUser/'.$webuser;
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
                                                <td class="folder_click" foldername="<?= $value ?>" style="cursor: pointer;"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">
                                                    <i class="far fa-folder fa-2x "></i> 
                                                    <span><?= $value ?></span>
                                                </td>
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td><?php echo sizeFormat(folderSize($dir.'/'.$value)) ?></td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="text-end col-sm-12">
                                                        <span class=""></span>
                                                        <button class="btn text-dark fm_common_c" action="zip" file="dir"  data-toggle="modal" data-target="#fm_common_modal" file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">
                                                        圧縮
                                                        </button>
                                                        <button class="btn text-dark fm_common_c" action="rename" file="dir" data-toggle="modal" data-target="#fm_common_modal" file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>" patd="<?=$value?>" action="delete_dir">
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
                                                
                                                <td class="open_file" style="cursor: pointer;" data-toggle="modal" <?php if (in_array($extension, $ext)){ echo 'data-target="#open_file"'; } ?> file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>"><div><i class="far fa-file fa-2x"></i><span class="ml-1"><?= $value ?></span></div></td>
                                                
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td path="E:\webroot\LocalUser" file="<?=$value?>">
                                                    <?php echo sizeFormat(filesize($dir.'/'.$value)) ?>
                                                </td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="col-sm-12 text-end">
                                                        <a href="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>&download=<?=$value?>&common_path=" class="btn text-dark download_file">
                                                        <i class="fa fa-download"></i>
                                                        </a>
                                                        <button class="btn text-dark fm_common_c" action="zip"  file="file" data-toggle="modal" data-target="#fm_common_modal" file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">
                                                        圧縮
                                                        </button>
                                                        <?php 
                                                        if(getFileExt($dir.'/'.$value)=="zip")
                                                        {?>
                                                            <button class="btn text-dark fm_common_c" action="unzip" data-toggle="modal" data-target="#fm_common_modal" file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">
                                                            解凍
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <button class="btn text-dark fm_common_c" action="rename" file="file" data-toggle="modal" data-target="#fm_common_modal" file_name="<?= $value ?>"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm delete_filedir"  gourl="/admin/share/servers/filemanager/confirm?webid=<?=$webid?>"  webid="<?=$webid?>" path="<?=$value?>"  action="delete_file">
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
 <?php require_once("views/admin/share/footer.php"); ?>
