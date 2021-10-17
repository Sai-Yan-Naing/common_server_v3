<?php 

require_once('views/admin/admin_shareconfig.php');
$user = $weborigin == 1?$webrootuser:$webrootuser."/".$webuser;
 $dir = ROOT_PATH.$user.'/';
// die;
if (isset($_POST['foldername']))
{
    $foldername = $_POST['foldername'];
    echo filepath($dir,$foldername,$webid);
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
    rename($_dir.$_POST['old'],$_dir.$_POST['rename']);
	echo filepath($dir,$_POST['common_path'],$webid);
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
	unlink($_dir.$_POST['delete_file']);
	filepath($dir,$_POST['common_path'],$webid);
    die;
}elseif ($_POST['action'] ==='delete_dir')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	delete_directory($_dir.$_POST['delete_dir']);;
	filepath($dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='new_dir')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	mkdir($_dir.$_POST['new_dir']);
	filepath($dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='new_file')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	createFile($_dir.$_POST['new_file']);
	filepath($dir,$_POST['common_path'],$webid);
    die;
} elseif ( $_POST['action'] ==='upload')
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	uploadFile($_dir,$_FILES['upload']);
	filepath($dir,$_POST['common_path'],$webid);
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
	compressed($_dir,$_POST['zip'],$_POST['zip']);
	filepath($dir,$_POST['common_path'],$webid);
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
	uncompressed($_dir.$_POST['zip'],$_dir);
	filepath($dir,$_POST['common_path'],$webid);
    die;
} elseif ( isset($_GET['download']))
{
	if ( $_GET['common_path']!==null and $_GET['common_path']!=='')
	{
		$_dir=$dir.$_GET['common_path'].'/';
	}else{
		$_dir=$dir;
	}
    // echo $_dir.$_GET['download'];
    // die;
	download($_dir.$_GET['download'],$_GET['download']);
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
	open_file($_dir,$_POST['file_name'],$webid);
	die();
} elseif ( isset($_POST['text_editor_open']) and $_POST['action']==='save_file' )
{
	if ( $_POST['common_path']!==null and $_POST['common_path']!=='')
	{
		$_dir=$dir.$_POST['common_path'].'/';
	}else{
		$_dir=$dir;
	}
	echo save_file($_dir.$_POST['openfile_name'],$_POST['text_editor_open'],$webid);
	// die($_dir.$_POST['openfile_name']);
}

function save_file($file,$data,$webid)
{
	// $dir = 'E:\\webroot\\LocalUser\\';
	// file_put_contents($dir.$file, $data);
	file_put_contents($file, $data);
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

function open_file($dir,$file_name, $webid)
{
	$file = $dir.$file_name;

	// check if form has been submitted
	if (isset($_POST['text']))
	{
	    // save the text contents
	    file_put_contents($file, $_POST['text']);

	    // redirect to form again
	    // header(sprintf('Location: %s', $url));
	    // printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
	    // exit();
	}

	// read the textfile
	$text = file_get_contents($file);
	?>

		<div class="modal-header">
            <button type="button" class="btn btn-outline-info mr-3" id="save_file" file_name="<?= $file_name ?>"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">Save</button>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"   webid="<?=$webid?>" method="post" id="file_editer">
              <div class="form-group">
                <textarea class="text-white bg-dark" id="text_editor_open" rows="25"><?php echo htmlspecialchars($text) ?></textarea>
              </div>
            </form>
          </div>

<?php
}

function download($file,$download)
{
	$filename=$download;
	
	$len = filesize($file); // Calculate File Size
	ob_clean();
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public"); 
	header("Content-Description: File Transfer");
	header("Content-Type:application/pdf"); // Send type of file
	$header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
	header($header );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".$len); // Send File Size
	@readfile($file);
	exit;
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

function filepath($dir,$foldername,$webid)
{
		if ( $foldername==="" || $foldername===null)
		{
			$dir    = $dir.$foldername;
		}else{
			$dir    = $dir.$foldername.'/';
		}
		
		// return $dir;
        // $myfiles = array_diff(scandir($dir,1), array('.', '..')); 

        // $dir = '/master/files';
        $directories = array();
        $files_list  = array();
        $files = scandir($dir);
        foreach($files as $file)
		{
           if ( ($file !== '.') && ($file !== '..'))
		   {
              if ( is_dir($dir.'/'.$file))
			  {
                 $directories[]  = $file;
              }else{
                 $files_list[]    = $file;
              }
           }
        }
        foreach ($directories as $key => $value) {
            ?>
    
    <tr>
                                                <td class="folder_click" foldername="<?php if ( $foldername!==null)
												{ echo $foldername.'/'.$value;}else{echo $value;} ?>" style="cursor: pointer;"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"  webid="<?=$webid?>">
                                                    <i class="far fa-folder  nav-tab-icon"></i> 
                                                    <span><?= $value ?></span>
                                                </td>
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td><?php echo sizeFormat(folderSize($dir.'/'.$value)) ?></td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="text-end col-sm-12">
                                                        <span class=""></span>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=rename_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="rename">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=delete_dir&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="delete">
                                                        削除
                                                        </button>
                                                    </div>
                                                </td>
                                                </tr>
                                                <?php 
                                            }
                                            $ext = array('html','css','php','js', 'txt' , 'config' , 'sql', 'ini');
                
                                            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) ? "https://" : "http://";
                                            
                                            $url = $protocol . $_SERVER['HTTP_HOST'];
                                            foreach ($files_list as $key => $value) {
                                                $extension = getFileExt($dir.'/'.$value);
                                                ?>
                                                <tr>
                                                
                                                <td class="open_file" style="cursor: pointer;" data-toggle="modal" <?php if (in_array($extension, $ext))
												{ echo 'data-target="#common_dialog"'; } ?> file_name="<?= $value ?>"  gourl="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>"><div><i class="far fa-file nav-tab-icon"></i><span class="ml-1"><?= $value ?></span></div></td>
                                                
                                                <td><?= date("Y-m-d h:i:sA", filemtime($dir.'/'.$value)) ?></td>
                                                <td><?= filetype($dir.'/'.$value)?></td>
                                                <td path="E:\webroot\LocalUser" file="<?=$value?>">
                                                    <?php echo sizeFormat(filesize($dir.'/'.$value)) ?>
                                                </td>
                                                <td class="d-flex" colspan="2">
                                                    <div class="col-sm-12 text-end">
                                                        <a href="/admin/share/server?setting=filemanager&tab=tab&act=confirm&webid=<?=$webid?>&download=<?=$value?>" class="btn text-dark download_file">
                                                        <i class="fa fa-download"></i>
                                                        </a>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=zip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                        圧縮
                                                        </button>
                                                        <?php 
                                                        if ( getFileExt($dir.'/'.$value)==="zip")
                                                        {?>
                                                            <button class="btn text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=unzip&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog"  uniquename="<?= $value ?>" action="zip">
                                                            解凍
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <button class="btn text-dark common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=rename_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="rename">名前変更
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm common_dialog_fm" gourl="/admin/share/server?setting=filemanager&tab=tab&act=delete_file&webid=<?=$webid?>"  data-toggle="modal" data-target="#common_dialog" uniquename="<?= $value ?>" action="delete">
                                                        削除
                                                        </button>
                                                    </div>
                                                </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
    <?php
        }
      
    ?> 