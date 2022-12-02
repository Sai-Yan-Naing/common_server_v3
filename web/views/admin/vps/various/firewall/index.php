<?php require_once('views/admin/vps/header.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
if($web_os=='windows'):
$query = "SELECT * FROM db_ftp WHERE domain='$webdomain'";
$getAllRow=$commons->getAllRow($query);
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
                                        <h6>Firewall</h6>
                                        <h6>RemoteDesktop</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                ポート
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdp&webid=<?=$webid?>" id="change_rdp" method="post">
                                                <input type="text" required class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdp&webid=<?=$webid?>" id="change_rdpd" method="post">
                                                <input type="hidden" class="form-control" name="port" value="3389">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdpd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdip&webid=<?=$webid?>" id="change_rdip" method="post">
                                                <input type="text" required class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_rdip&webid=<?=$webid?>" id="change_rdipd" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_rdipd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            ※ポートの変更及び、デフォルトに戻した場合、再起動を実施します。
                                        </div>
                                        <h6>WEBアクセス</h6>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                ポート
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdp&webid=<?=$webid?>" id="change_httprdp" method="post">
                                                <input type="text" required class="form-control" name="port">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdp">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdp&webid=<?=$webid?>" id="change_httprdpd" method="post">
                                                <input type="hidden" class="form-control" name="port" value="80">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdpd">デフォルトに戻す</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                IP接続制限
                                            </div>
                                            <div class="col-sm-3">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdip&webid=<?=$webid?>" id="change_httprdip" method="post">
                                                <input type="text" required class="form-control" name="ip">
                                            </form>
                                            </div>
                                            <div class="col-sm-2">
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdip">変更</button>
                                            </div>
                                            <div class="col-sm-2">
                                            <form onsubmit="loading()" action="/admin/vps/various?setting=firewall&tab=firewall&act=confirm&action=change_httprdip&webid=<?=$webid?>" id="change_httprdipd" method="post">
                                                <input type="hidden" class="form-control" name="ip" value="any">
                                            </form>
                                            <button  type="submit" class="btn btn-sm btn-outline-info vpsrebtn" form="change_httprdipd">デフォルトに戻す</button>
                                            </div>
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
            <div id="layoutSidenav_content">
                <main class="main-page">
                        <div class="container-fluid px-4">
                                <?php require_once('views/admin/vps/title.php') ?>
                                <?php require_once('views/admin/vps/various/subtitle.php') ?>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <div class="contract" id='terminal' style="height: 500px;" gourl="/admin/vps/various?setting=firewall&tab=firewall&act=terminal&webid=<?=$webid?>">
                                        
                                    </div>
                                </div>
                        </div>
                </main>
            </div>
    </div>

    <script>
//     $(function() {
//     $('#terminal').terminal(function(command, term) {
//         $gourl = $(this).attr('gourl');
//         $url = document.URL.split("/");
//         $url = $url[0] + "//" + $url[2];
//         $url = $url + $gourl;
//         term.pause();
//         $.post($url, {command: command}).then(function(response) {
//             term.echo(response).resume();
//         });
//     }, {
//         greetings: 'Welcome to Winserver'
//     });
// });
<!-- <script> -->
        var resizeInterval;
        var wSocket = new WebSocket("ws://202.218.224.21:8065");
        // Terminal.applyAddon(attach);  // Apply the `attach` addon
        // Terminal.applyAddon(fit);  //Apply the `fit` addon
        const attachAddon = new AttachAddon.AttachAddon(wSocket);
        const fitAddon = new FitAddon.FitAddon();
        var term = new Terminal({
				  cols: 80,
				  rows: 24
        });
        term.loadAddon(attachAddon); // Apply the `attach` addon
        term.loadAddon(fitAddon); //Apply the `fit` addon
        term.open(document.getElementById('terminal'));      
        document.getElementById("terminal").style.visibility="visible";
        wSocket.onopen = function (event) {
          console.log("Socket Open");
          var dataSend = {"auth":
                            {
                            "server":'',
                            "port":'',
                            "user":'',
                            "password":'',
                            "key": false
                            }
                          };
           wSocket.send(JSON.stringify(dataSend));

         fitAddon.fit();
          term.focus();
        };
        document.getElementById("terminal").style.visibility="visible";
          

        wSocket.onerror = function (event){
          // term.detach(wSocket);
          console.log("Socket close");
        }  
//         term.onKey((key, data) => {
//           var dataSend = {"data":{"data":data}};
//           wSocket.send(JSON.stringify(dataSend));
//           console.log(data)
//           //Xtermjs with attach dont print zero, so i force. Need to fix it :(
//           if (data=="0"){
//             term.write(data);
//           }
// });   
var curr_line = '';
var entries = [];
var currPos = 0;
var pos = 0;

wSocket.onmessage = msg => {
  if(curr_line=== '\x1B[A' || curr_line=== '\x1B[B'){
    curr_line=msg.data;
  }
       
      };
term.onKey(function(key) {
  console.log(term)
  const printable = !key.altKey && !key.altGraphKey && !key.ctrlKey && !key.metaKey &&
    !(key.key === ' ' && term._core.buffer.x < 6);
  if (key.key === '\r') { // Enter key
    // if (curr_line.replace(/^\s+|\s+$/g, '').length != 0) { // Check if string is all whitespace
      curr_line.replace(/^\s+|\s+$/g, '')
      entries.push(curr_line);
      // console.log(curr_line);
      // return;
      currPos = entries.length - 1;
      for(var i=0;i<curr_line.length;i++)
      {
        term.write("\b \b");
      }
      var dataSend = {"data":{"data":curr_line}};
          wSocket.send(JSON.stringify(dataSend));
          // console.log(dataSend)
          fitAddon.fit();
          term.focus();
    // } else {
    //   term.write('\n\33[2K\r\u001b[32m~$>> \u001b[37m');
    // }
    curr_line = '';
  } else if (key.key === '\x7F') { // Backspace\
  // term.write('\x1b[D'); 
    // if (term._core.buffer.x > 5) {
      // curr_line = curr_line.slice(0, term._core.buffer.x - 6) + curr_line.slice(term._core.buffer.x - 5);
      // pos = curr_line.length - term._core.buffer.x + 6;
      // console.log(curr_line)
      if (curr_line) {
        curr_line.replace(/^\s+|\s+$/g, '')
            curr_line = curr_line.slice(0, curr_line.length - 1);
            term.write("\b \b");
          }
      // term.write('\33[2K\r\u001b[32m~$>> \u001b[37m' + curr_line);
      // term.write('\033['.concat(pos.toString()).concat('D')); //term.write('\033[<N>D');
      // if (term._core.buffer.x == 5 || term._core.buffer.x == curr_line.length + 6) {
      //   term.write('\033[1C')
      // }
    // }
  } else if (key.key === '\x1B[A') { // Up arrow
    curr_line ="\x1B[A";
    var dataSend = {"data":{"data":curr_line}};
          wSocket.send(JSON.stringify(dataSend));
          console.log(dataSend)
          fitAddon.fit();
          term.focus();
          curr_line = "";
    // if (entries.length > 0) {
    //   if (currPos > 0) {
    //     currPos -= 1;
    //   }
    //   curr_line = entries[currPos];
    //   term.write('\33[2K\r\u001b[32m~$>> \u001b[37m' + curr_line);
    // }
  } else if (key.key === '\x1B[B') { // Down arrow
    currPos += 1;
    curr_line ="\x1B[B";
    var dataSend = {"data":{"data":curr_line}};
          wSocket.send(JSON.stringify(dataSend));
          console.log(dataSend)
          fitAddon.fit();
          term.focus();
          curr_line = "";
    // if (currPos === entries.length || entries.length === 0) {
    //   currPos -= 1;
    //   curr_line = '';
    //   term.write('\33[2K\r\u001b[32m~$>> \u001b[37m');
    // } else {
    //   curr_line = entries[currPos];
    //   term.write('\33[2K\r\u001b[32m~$>> \u001b[37m' + curr_line);

    // }
  }
   else if (key.key=="\x03"){// ctrl+c
    curr_line ="\x03";
      // term.write(curr_line);
              var dataSend = {"data":{"data":curr_line}};
          wSocket.send(JSON.stringify(dataSend));
          console.log(dataSend)
          fitAddon.fit();
          term.focus();
          curr_line = "";
 }
   else if (key.key=="\x16"){ //ctrl + v
    navigator.clipboard.readText()
              .then(text => {
                term.write(text);
              })
      // term.write(curr_line);
 }
   else if (key.key=="\x1B[3~"){ //delete key
      // if (curr_line) {
      //       curr_line = curr_line.slice(0, curr_line.length - 1);
            term.write(" ");
          // }
 }
//    else if (key.key=="\x1B[D"){ //backward arrow key
//     //  if (curr_line) {
//             // curr_line = curr_line.slice(0, curr_line.length - 1);
//             term.write("\x1B[3~");
//           // }
//  }
//    else if (key.key=="\x1B[C"){ //forward arrow key
//     if (curr_line) {
//       term.write("");
//     }
//  }
  else if (printable && !(key.key === '\x1B[C' && term._core.buffer.x > curr_line.length + 4)) {
    if (key.key != '\x1B[D' && key.key != '\x1B[C') {
      var input = key.key;
      if (key.key == '\t') { // Tab
        input = "    ";
      }
      curr_line += input;
      term.write(input);
      // pos = curr_line.length - term._core.buffer.x + 4;
      // curr_line = [curr_line.slice(0, term._core.buffer.x - 5), input, curr_line.slice(term._core.buffer.x - 5)].join('');
      // term.write('\33[2K\r\u001b[32m~$>> \u001b[37m' + curr_line);
      // term.write('\033['.concat(pos.toString()).concat('D')); //term.write('\033[<N>D');
    } 
    else {
      term.write(key.key);
    }
  }
});
//         var input = "";
// term.onData((data) =>  {
//           //Xtermjs with attach dont print zero, so i force. Need to fix it :(
//             // var code = '';
//             var code = data.charCodeAt(0);
//             // if (code == 13) { // CR
//             //   term.write("\r\nYou typed: '" + input + "'\r\n");
//             //   term.write("~$ ");
//             //   input = "";
//             // } else if ( code == 8) { // Control
//             //   input.slice(0, -1);
//             //   term.write(data);
//             // } else { // Visible
//             //   term.write(data);
//             //   input += data;
//             // }
//             if (code == 127) {
//           // Backspace
//           // console.log('backspace')
//           // if (input) {
//           //   input = input.slice(0, input.length - 1);
//             term.write("\b \b");
//           // }
//             }
//             if (data=='\x03'){
//               term.write(data);
//               var dataSend = {"data":{"data":input}};
//           wSocket.send(JSON.stringify(dataSend));
//           // console.log(dataSend)
//           fitAddon.fit();
//           term.focus();
//           input = "";
//           }else if (code!=13){
//             input += data
//             term.write(data);
//           }else{
//           var dataSend = {"data":{"data":input}};
//           wSocket.send(JSON.stringify(dataSend));
//           // console.log(dataSend)
//           fitAddon.fit();
//           term.focus();
//           input = ""
//           // term.write("\r\x1B[K");
//           }

//         })

        term.onResize(function (evt) {
          wSocket.send(JSON.stringify({
            "resize": {
              "rows": evt.rows,
              "cols": evt.cols
            }
          }));
        })
        
        // ConnectServer();
        //Execute resize with a timeout
        // window.onresize = function() {
        //   clearTimeout(resizeInterval);
        //   resizeInterval = setTimeout(resize, 400);
        // }
        // Recalculates the terminal Columns / Rows and sends new size to SSH server + xtermjs
        function resize() {
          if (term) {
           fitAddon.fit()
          }
        }
      </script>
//   </script>

<?php endif; ?>
 <?php require_once("views/admin/vps/footer.php"); ?>

