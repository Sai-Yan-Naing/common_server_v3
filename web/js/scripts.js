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
            alert("file must be csv file");
            return false;
        }
})

$(document).on('click','.common_dialog',function () {
    $('#common_dialog').children().removeClass('modal-dialog-scrollable')
})


$(document).on("change", "#upload_csv", function (e) {
    if ($("#upload_csv").val() == '') {
        $('.ps_absolute').html('ファイルをドラッグ＆ドロップしてください');
        $('.ps_absolute').next().css({'height':200})
        $('.ps_absolute').removeClass('align-items-baseline')
        $('#common_dialog').children().removeClass('modal-dialog-scrollable')
        return false;
    }

    $('.ps_absolute').addClass('align-items-baseline')
  var regex = /([ a-zA-Z0-9!@#$%^&*()_+-=,.?])+(.csv)$/;
        if (!regex.test($("#upload_csv").val().toLowerCase())) {
            alert("file must be csv file");
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
        for (i = 0; i < lines.length; ++i)
        {
            if (lines[i].length == 0) {
                continue;
            }
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
                $tr +='<tr>';
                $td ='';
                for (var k = 0; k < lines[i].length; k++) {
                    $td +='<td>'+lines[i][k]+'</td>';
                }
                $tr += $td +'</tr>';
            }
        }
        $tableend = $tablestart+ $thead + $tbody  + $tr+'</tbody></table>';
        $('.ps_absolute').html($tableend);
    $height = $('.modal-body').height()
    $('.ps_absolute').next().css({'height':$height + 10})
    };
    reader.readAsText(e.target.files.item(0));
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
