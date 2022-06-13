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
  var ext = $("input#upload_csv").val().split(".").pop().toLowerCase();
    if($.inArray(ext, ["csv"]) == -1) {
    alert('Upload CSV');
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
        var lines = e.target.result.split('\n');
        lines = lines.filter(item => item);
        for (i = 0; i < lines.length; ++i)
        {
            //console.log(lines[i].split(',')[0])
            lines[i] = lines[i].replace(/"/g, '');
            var row = lines[i].split(',')
            // console.log(row[0])
            if (i == 0) {
                for (var j = 0; j < row.length; j++) {
                    $th +='<th>'+row[j]+'</th>';
                }
                $thead += $th +'</tr></thead>';
                
            }else{
                $tr +='<tr>';
                $td ='';
                for (var k = 0; k < row.length; k++) {
                    $td +='<td>'+row[k]+'</td>';
                }
                $tr += $td +'</tr>';
            }
        }
        $tableend = $tablestart+ $thead + $tbody  + $tr+'</tbody></table>';
        $('.ps_absolute').html($tableend);
    $height = $('.ps_absolute').find('table').height()
    $('.ps_absolute').next().css({'height':$height + 10})
    };
    reader.readAsText(e.target.files.item(0));
    }
    
    return false;
});
