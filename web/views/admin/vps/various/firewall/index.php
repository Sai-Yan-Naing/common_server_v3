<?php require_once('views/admin/vps/header.php'); ?>
<?php
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: *');
if($web_os=='windows'):
    $query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
    $getAllRow=$commons->getAllRow($query);
    $rdp = json_decode($webrdp)->rdp;
    $web_rdp = json_decode($webhttp_rdp)->web;
    ?>
<div id="layoutSidenav">
    <?php require_once('views/admin/vps/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                <?php require_once('views/admin/vps/title.php') ?>
                <?php require_once('views/admin/vps/various/subtitle.php') ?>
                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                    <!-- start -->
                    <div class="contract">
                        <div class="server-info">
                            <h6 class="mb-2">Firewall</h6>
                            <h6 class="mt-3">リモートデスクトップ接続</h6>
                            <div class="form-group row ml-1">
                                <div class="col-sm-2 d-flex align-items-center">
                                    ポート
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <?= $rdp->port ?>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-sm btn-outline-info vpsrebtn common_dialog" type="button"
                                        data-toggle="modal" data-target="#common_dialog"
                                        gourl="/admin/vps/various?setting=firewall&tab=firewall&act=new_port&action=remote_desktop_port&webid=<?=$webid?>">変更</button>
                                </div>
                                <?php if ($rdp->port !== '3389'): ?>
                                <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                    <form
                                        action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=remote_desktop_port&webid=<?=$webid?>"
                                        id="remote_desktop_port" method="post">
                                        <input type="hidden" name="default" value="1">
                                        <input type="hidden" class="form-control" name="port" value="3389">
                                    </form>
                                    <button type="submit" class="btn btn-sm btn-outline-info vpsrebtn"
                                        form="remote_desktop_port">デフォルトに戻す</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group row ml-1">
                                <div class="col-sm-2 d-flex align-items-center">
                                    IP接続制限
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <?= ($rdp->ip === 'any') ? '制限なし' : $rdp->ip ?>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-sm btn-outline-info vpsrebtn common_dialog" type="button"
                                        data-toggle="modal" data-target="#common_dialog"
                                        gourl="/admin/vps/various?setting=firewall&tab=firewall&act=new_ip_restriction&action=remote_desktop_ip&webid=<?=$webid?>">変更</button>
                                </div>
                                <?php if ($rdp->ip !== 'any'): ?>
                                <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                    <form
                                        action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=remote_desktop_ip&webid=<?=$webid?>"
                                        id="remote_desktop_ip" method="post">
                                        <input type="hidden" name="default" value="1">
                                        <input type="hidden" class="form-control" name="ip" value="any">
                                    </form>
                                    <button type="submit" class="btn btn-sm btn-outline-info vpsrebtn">デフォルトに戻す</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                ※ポートの変更及び、デフォルトに戻した場合、再起動を実施します。
                            </div>
                            <h6 class="mt-3">WEBアクセス</h6>
                            <div class="form-group row ml-1">
                                <div class="col-sm-2 d-flex align-items-center">
                                    ポート
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <?= $web_rdp->port ?>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-sm btn-outline-info vpsrebtn common_dialog" type="button"
                                        data-toggle="modal" data-target="#common_dialog"
                                        gourl="/admin/vps/various?setting=firewall&tab=firewall&act=new_port&action=web_access_port&webid=<?=$webid?>">変更</button>
                                </div>
                                <?php if ($web_rdp->port !== '80'): ?>
                                <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                    <form
                                        action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=web_access_port&webid=<?=$webid?>"
                                        id="web_access_port" method="post">
                                        <input type="hidden" name="default" value="1">
                                        <input type="hidden" class="form-control" name="port" value="80">
                                    </form>
                                    <button type="submit" class="btn btn-sm btn-outline-info vpsrebtn"
                                        form="web_access_port">デフォルトに戻す</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group row ml-1">
                                <div class="col-sm-2 d-flex align-items-center">
                                    IP接続制限
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <?= ($web_rdp->ip === 'any') ? '制限なし' : $web_rdp->ip ?>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-sm btn-outline-info vpsrebtn common_dialog" type="button"
                                        data-toggle="modal" data-target="#common_dialog"
                                        gourl="/admin/vps/various?setting=firewall&tab=firewall&act=new_ip_restriction&action=web_access_ip&webid=<?=$webid?>">変更</button>
                                </div>
                                <?php if ($web_rdp->ip !== 'any'): ?>
                                <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                    <form
                                        action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=web_access_ip&webid=<?=$webid?>"
                                        id="web_access_ip" method="post">
                                        <input type="hidden" name="default" value="1">
                                        <input type="hidden" class="form-control" name="ip" value="any">
                                    </form>
                                    <button type="submit" class="btn btn-sm btn-outline-info vpsrebtn"
                                        form="web_access_ip">デフォルトに戻す</button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end content -->
                </div>
            </div>
        </main>
    </div>
</div>

<?php else: ?>
<div id="layoutSidenav">
    <?php require_once('views/admin/vps/sidebar.php');?>
    <link rel="stylesheet" href="../../public/xterm/dist/xterm.css"/>
    <script src="../../public/xterm/dist/xterm.js"></script>
    <script src="../../public/xterm/dist/addons/fit/fit.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>
    <script>
      var socket;
      $(document).ready(function() {
        var terminalContainer = $("#terminal-container")[0];
        var term = new Terminal({ cursorBlink: true });
        term.open(terminalContainer);
        term.fit();

        socket = io.connect('https://terminal.winserver.ne.jp/', {query:{ host: '<?= $webip ?>',username:'<?= $webvm_username ?>',password:'<?= $webpass ?>' }});
        socket.on("connect", function() {

          // Browser -> Backend
          term.on("data", function(data) {
            //console.log(data);
            //alert("Not allowd to write. Please don't remove this alert without permission of Ankit or Samir sir. It will be a problem for server'");
            socket.emit("data", data);
          });

          // Backend -> Browser
          socket.on("data", function(data) {
            term.write(data);
          });

          socket.on("disconnect", function() {
            term.write("\r\n*** Disconnected from backend***\r\n");
          });
        });
      });
    </script>
    <style>
      h1 {
        text-align: center;
      }

      #terminal-container {
        width: 100%;
        height: 900px;
        display: inline-block;
        padding: 2px;
      }

      .function {
        display: inline-block;
        float: right;
      }

      #terminal-container .terminal {
        background-color: #111;
        color: #fafafa;
        padding: 2px;
      }

      #terminal-container .terminal:focus .terminal-cursor {
        background-color: #fafafa;
      }
    </style>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                <?php require_once('views/admin/vps/title.php') ?>
                <?php require_once('views/admin/vps/various/subtitle.php') ?>
                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="contract" id='terminal-container' style="height: 500px;"
                        gourl="/admin/vps/various?setting=firewall&tab=firewall&act=terminal&webid=<?=$webid?>">

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
    
  

<?php endif; ?>
<?php require_once("views/admin/vps/footer.php"); ?>