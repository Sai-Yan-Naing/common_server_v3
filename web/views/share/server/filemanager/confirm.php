<?php 

require_once('views/share_config.php');
$dir = ROOT_PATH.$webpath.'/';
// die;
if (isset($_POST['foldername']))
{
    $foldername = $_POST['foldername'];
    // echo $dir.$foldername;
    echo filepath($web_host,$web_user,$web_password,$dir,$foldername,$webid);
    die;
} elseif (isset($_POST['action']) and $_POST['action']==='rename')
{
    // die('rename');
    if ($_POST['common_path']===null || $_POST['common_path']==='')
	{
		$_dir=$dir;
	} else
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}
	$newdir = $_dir.$_POST['rename'];
	$olddir = $_dir.$_POST['old'];
	renameDir($web_host,$web_user,$web_password,$newdir,$olddir);
    // pathrename($_dir.$_POST['old'],$_dir.$_POST['rename']);
	echo filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
	die();
} elseif ($_POST['action'] ==='delete_file')
{
	if ($_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else
	{
		$_dir=$dir;
	}
    // echo $_dir.$_POST['delete_file'];
	// unlink($_dir.$_POST['delete_file']);
	deleteDir($web_host,$web_user,$web_password,$_dir.$_POST['delete_file']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
}elseif ($_POST['action'] ==='delete_dir')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	// delete_directory($_dir.$_POST['delete_dir']);;
	deleteDir($web_host,$web_user,$web_password,$_dir.$_POST['delete_dir']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='new_dir')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	// mkdir($_dir.$_POST['new_dir']);
// 	echo $_dir.$_POST['new_dir']);
// die;
	newDir($web_host,$web_user,$web_password,$_dir.$_POST['new_dir']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='new_file')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	// createFile($_dir.$_POST['new_file']);
// 	echo $_dir.$_POST['new_dir']);
// die;
	newFile($web_host,$web_user,$web_password,$_dir.$_POST['new_file']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='upload')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	// echo $webpath.'/'.$_FILES['upload'];
	// uploadFile($webpath,$_FILES['upload']);
	uploadFile($web_host,$web_ftp,$web_ftppass,$webpath,$_FILES['upload']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='zip')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
    // echo $_dir.$_POST['zip'].'dd'.$_POST['zip'];
    // die;
	// compressed($_dir,$_POST['zip'],$_POST['zip']);
	comFile($web_host,$web_user,$web_password,$_dir,$_POST['zip']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='unzip')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
    // echo $_dir.$_POST['zip'].'dd'.$_dir;
    // die;
	// uncompressed($_dir.$_POST['zip'],$_dir);
	uncomFile($web_host,$web_user,$web_password,$_dir,$_POST['zip']);
	filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
    die;
} elseif ( isset($_GET['download']))
{
	if ( $_GET['common_path']!==null and $_GET['common_path']!=='')
	{
		$webpath=$webpath.'/'.$_GET['common_path'].'/';
	}
    // echo $webpath;
    // // echo $_GET['common_path'];
    // die;
    // filepath($web_host,$web_user,$web_password,$dir,$_POST['common_path'],$webid);
	// download($webpath.$_GET['download'],$_GET['download']);
	download($web_host,$web_ftp,$web_ftppass,$webpath,$_GET['download']);
    // filepath($web_host,$web_user,$web_password,$dir,$_GET['common_path'],$webid);
    // die();
	// header("Location: filemanager.php");
} elseif ( isset($_POST['file_name']) and $_POST['action']==='open_file')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	} else
	{
		$_dir=$dir;
	}
	// echo $_dir.$_POST['file_name'];
	// echo $web_host.$web_user.$web_password;
	open_file($web_host,$web_user,$web_password,$_dir,$_POST['file_name'],$webid);
	// get_File($web_host,$web_user,$web_password,$_dir.$_POST['file_name']);
	die();
} elseif ( isset($_POST['text_editor_open']) and $_POST['action']==='save_file' )
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	echo save_file($web_host,$web_user,$web_password,$_dir.$_POST['openfile_name'],$_POST['text_editor_open'],$webid);
		die;
	// die($_dir.$_POST['openfile_name']);
}

function save_file($web_host,$web_user,$web_password,$file,$data,$webid)
{
	// $dir = 'E:\\webroot\\LocalUser\\';
	// file_put_contents($dir.$file, $data);
	// file_put_contents($file, $data);
    put_File($web_host,$web_user,$web_password,$file,$data);
	return "successfully saved";
}

class FlxZipArchive extends ZipArchive 
{
 public function addDir($location, $name) 
 {
       $this->addEmptyDir($name);
       $this->addDirDo($location, $name);
 } 
 private function addDirDo($location, $name) 
 {
    $name .= '/';
    $location .= '/';
    $dir = opendir ($location);
    while ($file = readdir($dir))
    {
        if ($file === '.' || $file === '..') continue;
        $do = (filetype( $location . $file) === 'dir') ? 'addDir' : 'addFile';
        $this->$do($location . $file, $name . $file);
    }
 } 
}

function open_file($web_host,$web_user,$web_password,$dir,$file_name, $webid)
{
	$file = $dir.$file_name;

	// check if form has been submitted

	// read the textfile
	// $text = file_get_contents($file);
	$text = get_File($web_host,$web_user,$web_password,$dir.$file_name);
	?>

		<div class="modal-header">
            <button type="button" class="btn btn-outline-info mr-3" id="save_file" file_name="<?= $file_name ?>"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">保存</button>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"   webid="<?=$webid?>" method="post" id="file_editer">
              <div class="form-group">
                <textarea class="text-white bg-dark" id="text_editor_open" rows="25"><?php echo htmlspecialchars($text) ?></textarea>
              </div>
            </form>
          </div>

<?php
}


function compressed($dir,$origin,$name)
{
	$the_folder = $dir;
	// $zip_file_name = $pathdir.$name.".zip";
	if ( is_file($dir.$origin))
	{
		zipFile($dir,$origin,$name);
	}else
	{
		$the_folder = $dir.$origin.'/';
		$zip_file_name = $dir.$name.'.zip';
		$za = new FlxZipArchive;
		$res = $za->open($zip_file_name, ZipArchive::CREATE);
		if ( $res === TRUE) 
		{
		    $za->addDir($the_folder, basename($the_folder));
		    $za->close();
		}
		else{
		echo 'Could not create a zip archive';
		}
	}
	
}

function zipFile($dir,$origin,$name)
{
	$pathdir = $dir; 
	$origin_ = $dir.$origin; 
	$zipcreated = $pathdir.$name.".zip";

// die($origin);
	$zip = new ZipArchive();
	$zip->open($zipcreated, ZipArchive::CREATE);
	  
	$zip->addFile($origin_,$origin);
	  
	$zip->close();
}

function uncompressed($from, $to)
{
	// die($from.$to);
	$zip = new ZipArchive();
	$zip->open($from, ZipArchive::CREATE);
	$zip->extractTo($to);
	$zip->close();
}

function filepath($web_host,$web_user,$web_password,$dir,$foldername,$webid)
{
		if ( $foldername==="" || $foldername===null)
		{
			$dir    = $dir.$foldername;
		}else{
			$dir    = $dir.$foldername.'/';
		}
		// return $dir;
		// return $dir;
        // $myfiles = array_diff(scandir($dir,1), array('.', '..')); 

        // $dir = '/master/files';
        $directories = array();
        $files_list  = array();
        // $files = scandir($dir);
        // echo "<pre>";
        $files = get_dirlist($web_host,$web_user,$web_password,$dir);
        // print_r($files);
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
        foreach ($directories as $key => $value) {
            ?>
    
    <tr>
                                                <td class="folder_click" foldername="<?php if ( $foldername!==null)
												{ echo $foldername.'/'.$value['name'];}else{echo $value['name'];} ?>" style="cursor: pointer;"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">
                                                    <div class="d-flex">
														<i class="far fa-folder  nav-tab-icon"></i> 
														<span class="ml-2 mt-1"><?= $value['name'] ?></span>
													</div>
                                                </td>
                                                <td><?= $value['lasttime'] ?></td>
                                                <td>Dir</td>
                                                <td><?php echo $value['length'] ?></td>
                                                <td class="d-flex" >
                                                    <div class=" col-sm-12">
                                                        <span class=""></span>
                                                        <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/share/server?setting=filemanager&tab=tab&act=rename_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="rename">名前変更
                                                        </button>
                                                        
														<?php if ( $webpath.'/'.$value !== $webpath.'/web'):?>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=delete_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="delete">
                                                        削除
                                                        </button>
                                                		<?php endif; ?>
                                                    </div>
                                                </td>
                                                </tr>
                                                <?php 
                                            }
                                            $ext = array('html','css','php','js', 'txt' , 'config' , 'sql', 'ini');
                
                                            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) ? "https://" : "http://";
                                            
                                            $url = $protocol . $_SERVER['HTTP_HOST'];
                                            foreach ($files_list as $key => $value) {
                                                $extension = $value['extension'];
                                                ?>
                                                <tr>
                                                
                                                <td class="open_file" style="cursor: pointer;" data-toggle="modal" <?php if (in_array($extension, $ext))
												{ echo 'data-target="#common_dialog"'; } ?> file_name="<?= $value['name'] ?>"  gourl="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"><div class="d-flex">
												<i class="far fa-file nav-tab-icon"></i><span class="ml-2 mt-1"><?= $value['name'] ?></span>
												</div></td>
                                                
                                                <td><?= $value['lasttime'] ?></td>
                                                <td>File</td>
                                                <td path="E:\webroot\LocalUser" file="<?=$value['name']?>">
                                                    <?php echo sizeFormat($value['length']) ?>
                                                </td>
                                                <td class="d-flex" >
                                                    <div class="col-sm-12 ">
                                                        <button class="btn common_dialog_fm  btn-outline-info btn-sm" gourl="/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <?php 
                                                        if ($value['extension']==="zip")
                                                        {?>
                                                            <button class="btn common_dialog_fm  btn-outline-info btn-sm" gourl="/share/server?setting=filemanager&tab=tab&act=unzip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value['name'] ?>" action="zip">
                                                            解凍
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <button class="btn common_dialog_fm btn-outline-info btn-sm" gourl="/share/server?setting=filemanager&tab=tab&act=rename_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="rename">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/share/server?setting=filemanager&tab=tab&act=delete_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value['name'] ?>" action="delete">
                                                        削除
                                                        </button>
                                                        <a href="/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>&download=<?=$value['name']?>" class="btn download_file">
                                                <i class="fa fa-download"></i>
                                                </a>
                                                    </div>
                                                </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
    <?php
        }
      
    ?> 