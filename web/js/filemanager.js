$(document).on("click", ".folder_click", function () {
  // loading();
  $foldername = $(this).attr("foldername");
  $this = $(this);
  $filepath = $foldername.split("/");
  $_path = "";
  $webid = $this.attr("webid");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $gourl = $this.attr("gourl");
  $url = $url + $gourl;
  $result = $.ajax({
    type: "POST",
    url: $url,
    // async:false,
     beforeSend: function(){
     loading();
   },
   complete: function(){
     stoploading();
   },
    data: { foldername: $foldername },
  });
  $done = $result.done(function (data) {
    document.getElementById("changebody").innerHTML = data;
    $path =
      '<li class="nav-item">' +
      '<a class="nav-link folder_click text-white" foldername="' +
      $_path +
      '"  style="padding: 5px 0; cursor:pointer;"  gourl="' +
      $gourl +
      '" webid="'+$webid+'">Home</a>' +
      "</li>";
      $filepath = $filepath.filter(e => e !== '')
    if ($foldername !== "" && $foldername !== null) {
      // alert(1)
      for (var i = 0; i <= $filepath.length - 1; i++) {
        // $_path+='/'+$filepath[i];
        if ($_path != "") {
          $_path += "/" + $filepath[i];
        } else {
          $_path += $filepath[i];
        }
        $path +=
          '<li class="nav-item">' +
          '<a class="nav-link folder_click text-white" foldername="' +
          $_path +
          '" style="padding: 5px 0; cursor:pointer;" gourl="' +
          $gourl +
          '" webid="'+$webid+'"><i class="ml-2 mr-2 fa fa-chevron-right" aria-hidden="true"></i>' +
          $filepath[i] +
          "</a>" +
          "</li>";
      }
    }
    $("#dir_path").html($path);
    $("#common_path").attr("path", $foldername);
    $(".download_file").each(function (i, obj) {
      $temp = $(this).attr("href");
      $(this).attr("href", $temp + "&common_path=" + $_path);
    });
  });
  // stoploading();
  // alert('done')
});

$(document).on("click", ".common_dialog_fm", function () {
  $gourl = $(this).attr("gourl");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2] + $gourl;
  $uniquename = $(this).attr("uniquename");
  $action = $(this).attr("action");
  $.ajax({
    type: "POST",
    url: $url,
    success: function (data) {
      document.getElementById("display_dialog").innerHTML = data;
      if ($action == "rename") {
        $("#rename").val($uniquename);
        $("#old").val($uniquename);
      } else if ($action == "delete") {
        $("#delete_name").text($uniquename);
        $("#delete_name").prev("input").val($uniquename);
      } else if ($action == "zip") {
        $("input[name='zip']").val($uniquename);
      }
      allValidate();
    },
  });
});
$(document).on("change", "#upload_", function () {
  var file = $("#upload_")[0].files[0].name;
  $(".ps_absolute").text(file);
});

$(document).on("click", ".open_file", function () {
  $file_name = $(this).attr("file_name");
  var extension = $file_name.substr($file_name.lastIndexOf(".") + 1);
  var fileExtension = [
    "html",
    "css",
    "php",
    "js",
    "txt",
    "config",
    "sql",
    "ini",
  ];
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $gourl = $(this).attr("gourl");
  $url = $url + $gourl;
  $common_path = $("#common_path").attr("path");
  if (fileExtension.indexOf(extension) > -1) {
    $.ajax({
      type: "POST",
      url: $url,
      data: {
        file_name: $file_name,
        common_path: $common_path,
        action: "open_file",
      },
      success: function (data) {
        document.getElementById("display_dialog").innerHTML = data;
      },
    });
  } else {
    alert("This file is unsupported format.");
  }
});

$(document).on("click", "#save_file", function () {
  $text_editor_open = $("#text_editor_open").val();
  $openfile_name = $(this).attr("file_name");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $gourl = $(this).attr("gourl");
  $url = $url + $gourl;
  $common_path = $("#common_path").attr("path");

  $.ajax({
    type: "POST",
    url: $url,
    data: {
      text_editor_open: $text_editor_open,
      openfile_name: $openfile_name,
      common_path: $common_path,
      action: "save_file",
    },
    success: function (data) {
      alert("successfull saved");
    },
  });
});

$(document).on("submit", "#fm_fun", function () {
  $gourl = $(this).attr("action");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2] + $gourl;
  //   $uniquename = $(this).attr("uniquename");
  $this = $(this);
  $common_path = $("#common_path").attr("path");
  $formdata = new FormData(this);
  $formdata.append("common_path", $common_path);
  console.log($url);
  console.log($formdata);
  if ($(this).attr("fun") == "upload") {
    if ($("#upload_").val() == "" || $("#upload_").val() == null) {
      alert("Empty File cannot upload");
      return false;
    }
    $size = $("#upload_")[0].files[0].size;
    if ($size > 2097152) {
      alert("File size is greater than 2MB");
      return false;
    }
  }
  if ($("input[type=text]").val() == "" || $("input[type=text]") == null) {
    alert("Invalid Format");
    return false;
  }
  if ($(this).attr("fun") == "file") {
    $ext = /\.[0-9a-z]+$/i;
    if (!$ext.test($(this).children("input[file]").val())) {
      alert("Please Enter file extension");
      return false;
    }
  }

  $.ajax({
    type: "POST",
    url: $url,
    data: $formdata,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $("#common_dialog").modal("hide");
     loading();
      //   alert("error");
      //   return false;
      // $("#err").fadeOut();
    },
   complete: function(){
     stoploading();
   },
    success: function (data) {
      document.getElementById("changebody").innerHTML = data;
      $(".download_file").each(function (i, obj) {
        $temp = $(this).attr("href");
        $(this).attr("href", $temp + "&common_path=" + $common_path);
      });
    },
  });
  return false;
});
