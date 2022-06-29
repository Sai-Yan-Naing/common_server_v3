/*!
    * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

$(document).on('submit','#email_import',function () {
    if ($("#upload_csv").val() == "" || $("#upload_csv").val() == null) {
      alert("Empty File cannot upload");
      return false;
    }
    var regex = /([ a-zA-Z0-9!@#$%^&*()_+-=,.?])+(.csv)$/;
        if (!regex.test($("#upload_csv").val().toLowerCase())) {
            alert("アップロードいただいたCSVが要件を満たしておりません。要件詳細はマニュアルをご覧ください。");
            return false;
        }
        console.log($('#importerror').val())
        if ($('#importerror').val()=='true') {
            alert('アップロードいただいたCSVが要件を満たしておりません。要件詳細はマニュアルをご覧ください。');
            return false;
        }
})

$(document).on('click','.common_dialog',function () {
    $('#common_dialog').children().removeClass('modal-dialog-scrollable')
})

function csvformaterror(){
    $('.ps_absolute').html('ファイルをドラッグ＆ドロップしてください');
        $('.ps_absolute').next().css({'height':200})
        $('.ps_absolute').removeClass('align-items-baseline')
        $('#common_dialog').children().removeClass('modal-dialog-scrollable')
        $("#upload_csv").val('')
}

$(document).on("change", "#upload_csv", function (e) {
    $haserror = false;
    if ($("#upload_csv").val() == '') {
        csvformaterror()
        return false;
    }

    $('.ps_absolute').addClass('align-items-baseline')
  var regex = /([ a-zA-Z0-9!@#$%^&*()_+-=,.?])+(.csv)$/;
        if (!regex.test($("#upload_csv").val().toLowerCase())) {
            csvformaterror()
            alert("アップロードいただいたCSVが要件を満たしておりません。要件詳細はマニュアルをご覧ください。");
            return false;
        }
    if (e.target.files != undefined) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#common_dialog').children().addClass('modal-dialog-scrollable')
        $('.ps_absolute').html('')
        $tablestart = '<table class="table table-borderless">'
        $thead ='<thead><tr>';
        $tbody = '<tbody>';
        $tr = '';
        $th ='';
        var csv = e.target.result;
        var lines = $.csv.toArrays(csv);
        // if (lines.length > 1) {
        //         alert('Empty csv file')
        //         csvformaterror()
        //         return false;
        //     }
        var index =0;
        for (k=0; k<lines.length; ++k){

            if(lines[k][0]=='No' && lines[k][1]=='Mail User' && lines[k][2]=='Password')
            {
                break;
            }
            delete lines[k]
        } 
        lines = lines.filter(val => val)
        console.log(lines)
        for (i = 0; i < lines.length; ++i)// remove empty array
        {
            if (lines[i].length > 3) {
                csvformaterror()
                alert('アップロードいただいたCSVが要件を満たしておりません。要件詳細はマニュアルをご覧ください。')
                return false;
            } 

           if (lines[i][0] == '') {
                delete lines[i]
            } 
        }
        lines = lines.filter(val => val)
        for (i = 0; i < lines.length; ++i)
        {
            
            //console.log(lines[i].split(',')[0])
            // lines[i] = lines[i].replace(/"/g, '');
            // var row = lines[i].split(',')
            // console.log(row[0])
            if (i == 0) {
                for (var j = 0; j < lines[i].length; j++) {
                    $th +='<th>'+lines[i][j]+'</th>';
                }
                $thead += $th +'</tr></thead>';
                
            }else{

                $error = '';
                
                $tr +='<tr>';
                $td ='';
                for (var k = 0; k < lines[i].length; k++) {
                    if (k == 1) {
                        // console.log(/^[A-Za-z0-9_./#&+-]*$/.test(lines[i][1]))
                        $error = '';
                        if (/[ \\/:?"<>|@%*$&-]/.test(lines[i][k])) {
                            $haserror = true;
                            $error = 'error';
                        }
                        
                    }
                    //(/\s/.test(lines[i][k]) && regex.test(lines[i][2]))|| 
                    if (k == 2) {
                        $error = '';
                        var regex1 = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g
                        var regex = /^((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])|(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[^a-zA-Z0-9])|(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[^a-zA-Z0-9])|(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^a-zA-Z0-9])).{8,30}$/;
                        console.log(regex1.test(lines[i][2]) + 'test')
                        // console.log(regex.test(lines[i][2]) + 'test')
                        // if (/\s/.test(lines[i][k]) || regex.test(lines[i][2]) || (lines[i][2].length<8 || lines[i][2].length> 30)) {
                        //     $error = 'error';
                        //     $haserror = true;
                        // }
                        if (/\s/.test(lines[i][k]) || regex1.test(lines[i][2]) || !regex.test(lines[i][2])) {
                            $error = 'error';
                            $haserror = true;
                        }
                    }

                    $td +='<td class="'+$error+'">'+lines[i][k]+'</td>';
                    
                }
                $tr += $td +'</tr>';
            }
        }
        $('#importerror').val($haserror);
        $tableend = $tablestart+ $thead + $tbody  + $tr+'</tbody></table>';
        $('.ps_absolute').html($tableend);
    $height = $('.modal-body').height()
    $('.ps_absolute').next().css({'height':$height + 10})
    };
        reader.readAsText(e.target.files.item(0) , 'Shift-JIS');
    }
    return false;
});

  $(document).on('click',".toggle-password",function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
window.addEventListener('resize', () => {
  $.each($(".tbtoggle-password"), function( index, value ) {
        var div = $(this).parent().parent();
      if (div.attr("toggle") == "text") {
        var height = div.children().children().height();
        div.children().css({'height':height})
    } else {
      var height = div.children().children().next().height();
        div.children().css({'height':height})
    }
    });
})
  $(document).ready(function(){
    $.each($(".tbtoggle-password"), function( index, value ) {
        var div = $(this).parent().parent();
      $(this).parent().prev().children().addClass('d-none')
      $(this).parent().prev().children().next().removeClass('d-none')
      // $(this).parent().prev().css({'position':'absolute','width':serventy,'word-break':'break-all'})
      var height = div.children().children().next().height();
        // var width = $(this).prev().width();
      //   var tdheight = td.height();
        div.children().css({'height':height})
    });
  })

  $(document).on('click',".tbtoggle-password",function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var td = $(this).parent().parent().parent();
    var div = $(this).parent().parent();
    var total = td.width();
    var serventy = ((total/100) * 70).toFixed(3);
    // console.log(total)
    console.log(div.attr("toggle"))
    // td.css({'height':'auto'})
    console.log($(this).parent().prev().children().attr("class"))
    if (div.attr("toggle") == "star") {
      div.attr("toggle", "text");

      $(this).parent().prev().children().removeClass('d-none')
      $(this).parent().prev().children().next().addClass('d-none')
      // $(this).parent().prev().prev().css({'position':'absolute','width':serventy,'word-break':'break-all'})
      var height = div.children().children().height();
        // var width = $(this).prev().prev().width();
      //   var tdheight = td.height();
        div.children().css({'height':height})
    } else {
      div.attr("toggle", "star");
      $(this).parent().prev().children().addClass('d-none')
      $(this).parent().prev().children().next().removeClass('d-none')
      // $(this).parent().prev().css({'position':'absolute','width':serventy,'word-break':'break-all'})
      var height = div.children().children().next().height();
        // var width = $(this).prev().width();
      //   var tdheight = td.height();
        div.children().css({'height':height})
    }
  });
