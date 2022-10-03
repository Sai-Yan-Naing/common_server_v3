function change_mail_text(change) {
  $("#change_mail_text").text(change);
}
$(document).ready(function () {
  allValidate();
});

function allValidate() {
  $(function () {
    // ip validate
    $.validator.addMethod(
      "ip",
      function (value) {
        var split = value.split(".");
        if (split.length != 4) return false;

        for (var i = 0; i < split.length; i++) {
          var s = split[i];
          if (s.length == 0 || isNaN(s) || s < 0 || s > 255) return false;
        }
        return true;
      },
      "無効なIPアドレスです"
    );

    // for  domain validate
    $.validator.addMethod(
      "domain",
      function (value) {
        var regex =
          /^([a-zA-Z0-9_.+-])+(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(value);
      },
      "無効なドメインです"
    );

    $.validator.addMethod(
      "jpdomain",
      function (value) {
        if (value.substr(value.length - 3) == ".jp")
          $("#authcode-error").remove();
        return true;
      },
      "Jp domain"
    );

    // japanse character validate
    // var regex = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g
    // allow special character
    $.validator.addMethod(
      "numberalphabet",
      function (value) {
        var regex = /^[! A-Za-z0-9_@./#&+-]*$/;
        if (regex.test(value)) {
          return true;
        }
      },
      "半角英数字のみを入力してください"
    );

    // allow special character
    $.validator.addMethod(
      "onlynumberalphabet",
      function (value) {
        var regex = /^[A-Za-z0-9]*$/;
        if (regex.test(value)) {
          return true;
        }
      },
      "半角英数字のみを入力してください"
    );

    $.validator.addMethod(
      "nowhitespace",
      function (value, element) {
        return !/\s/.test(value);
      },
      "スペースは使用できません"
    );

    // allow underscroll (@), ( _ ) and dash (-)
    // var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    $.validator.addMethod(
      "nospecialchar",
      function (value) {
        var regex = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]+/;
        if (!regex.test(value)) {
          return true;
        }
      },
      "特殊文字は使用できません"
    );

    // allow !#$%&'()*+-./:;<=>?@[]^_`{|}~
    $.validator.addMethod(
      "allowspecialchar1",
      function (value) {
        // var regex = /^[A-Za-z0-9!#$%&'()*+-./:;<=>?@[]^_`{|}~]*$/;
        
        var regex = /^[! A-Za-z0-9_@.#&+-]*$/;
        if (regex.test(value)) {
          return true;
        }
      },
      "特殊文字は使用できません"
    );

    // allow !#$%&'()*+-./:;<=>?@[]^_`{|}~
    // for mail user
    // $.validator.addMethod(
    //   "allowspecialchar2",
    //   function (value) {
    //     // var regex = /^[A-Za-z0-9!#$%&'()*+-./:;<=>?@[]^_`{|}~]*$/;
    //     //\ / : ? " < > | @ % * $ & -
    //     // var regex = /^[ A-Za-z0-9_./#&+-]*$/;
    //     // var regex = /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/g;
    //     var regex1 = /^[a-zA-Z0-9/:?"<>|@%*$&-]+$/g;
    //     var regex = /^[a-zA-Z0-9]+$/g;
    //     // var regex = /^[A-Za-z0-9\/:?"<>|@%*$&-]*$/;

    //     test = regex1.test(value);
    //     var gg = typeof test
    //     // if (regex1.test(value)===true) {
    //       // return regex1.test(value);
    //     // }

    //     console.log(test)
    //     console.log(gg)
    //     return false;
    //   },
    //   "特殊文字は使用できませんaa"
    // );
$.validator.addMethod(
      "allowspecialchar2",
      function (value) {
        // var regex = /^[A-Za-z0-9!#$%&'()*+-./:;<=>?@[]^_`{|}~]*$/;
        
        var regex = /[\\/:?"<>|@%*$&-]/;
        if (!regex.test(value)) {
          return true;
        }else return false;
      },
      "特殊文字は使用できません"
    );
    
    $.validator.addMethod(
      "allowspecialchar3",
      function (value) {
        // var regex = /^[A-Za-z0-9!#$%&'()*+-./:;<=>?@[]^_`{|}~]*$/;
        
        var regex = /^((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])|(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[^a-zA-Z0-9])|(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[^a-zA-Z0-9])|(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^a-zA-Z0-9])).{8,30}$/
        if (regex.test(value)) {
          return true;
        }
      },
      "英大文字・英小文字・数字・記号のうち3種類を含む必要があります"
    );

    // allow specail char (-_!#^~)
    $.validator.addMethod(
      "allowspecialchar",
      function (value) {
        var regex = /[@$%&*()+\=\[\]{};':"\\|,.<>\/?]+/;
        // var regex = /[-_!#^~]+/;
        if (!regex.test(value)) {
          return true;
        }
      },
      "特殊文字は使用できません"
    );

    // allow specail char (-_.)
    $.validator.addMethod(
      "allowspecialchar5",
      function (value) {
        var regex = /[!#@$%&*()+\=\[\]{};':"\\|,<>\/?^~]+/;
        var regex1 = /^[! A-Za-z0-9_@./#&+-]*$/;
        // var regex = /[-_!#^~]+/;
        if (!regex.test(value) && regex1.test(value)) {
          return true;
        }
      },
      "1～20文字、半角英数小文字と_-.のみ利用可能です"
    );
    $.validator.addMethod(
      "noallowfullwidth",
      function (value) {
        var regex = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g
        // var regex = /^[A-Za-z0-9-_~!@#$%^&*+=`|\(){}[\]:;"'<>,.?/]*$/;
        
        // var regex = /^[ A-Za-z0-9_./#&+-]*$/;
        if (!regex.test(value)) {
          return true;
        }
      },
      "半角英数字のみを入力してください"
    );

    // allow (~!@#$%^&*_-+=`|\(){}[]:;"'<>,.?/)
    //-_~!@#$%^&*+=`|\(){}[\]:;"'<>,.?/
    // $.validator.addMethod(
    //   "allowspecialchar4",
    //   function (value) {
    //     var regex = /[A-Za-z0-9-_~!@#$%^&*+=`|\(){}[\]:;"'<>,.?/]+/;
    //     // var regex = /[-_!#^~]+/;
    //     if (!regex.test(value)) {
    //       return true;
    //     }
    //   },
    //   "特殊文字は使用できません"
    // );

    $.validator.addMethod(
      "alreadyexist",
      function (value, element) {
        $("#" + $(element).attr("id") + "-error").remove();
        let result = false;
        $url = document.URL.split("/");
        $url = $url[0] + "//" + $url[2];
        $ext='';
        $permission = $('#user_permission');
        if($permission.data('permission')=='adminshare')
        {
          $ext='?webper=admin&webid='+$permission.data('webid');
        }else if($permission.data('permission')=='admin')
        {
          $("#" + $(element).attr("id") + "-error").remove();
          if($('#web_server').val()==''){
            return true;
          }
          $('#user_permission').data('webser',$('#web_server').val())
          $ext='?webper=admin&webser='+$permission.data('webser');
        }else if($permission.data('permission')=='share')
        {
          $ext='?webper=share';
        }
        // if($(element).attr("remark")=='error_file')
        // {
        //   $webid=$(element).attr("webid");
        //   $ext='?webid='+$webid;
        // }
        // sessionStorage.setItem("result", false);
        // console.log($url + "saiyanaing");
        var $ajax = $.ajax({
          type: "POST",
          url: $url + "/validate"+$ext,
          async: false,
          dataType: "JSON",
          beforeSend: function () {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="text-primary">' +
                "Loading......</label>"
            );
          },
          data: {
            table: $(element).attr("table"),
            column: $(element).attr("column"),
            checker: value,
            remark: $(element).attr("remark"),
          },
        });
        $("#" + $(element).attr("id") + "-error").remove();
        $done = $ajax.done(function (data) {
          $("#" + $(element).attr("id") + "-error").remove();
          console.log(data.status + "back end");
          // return;
          if (data["status"]) {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="error">' +
                $(element).val() +
                " を取得することができません。別の名前を指定してください。</label>"
            );
            result = false;
          } else {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="text-success">' +
                $(element).val() +
                " を取得することができます。</label>"
            );
            result = true;
          }
        });
        $fail = $ajax.fail(function () {
          $("#" + $(element).attr("id") + "-error").remove();
          $(element).after(
            '<span id="' +
              $(element).attr("id") +
              '-error" class="error">Internal server error</span>'
          );
          result = false;
        });
        // console.log(result + " result");
        return result;
      },
      ""
    );


    $.validator.addMethod(
      "noalreadyexist",
      function (value, element) {
        $("#" + $(element).attr("id") + "-error").remove();
        let result = false;
        $url = document.URL.split("/");
        $url = $url[0] + "//" + $url[2];
        $ext='';
        if($(element).attr("remark")=='error_file')
        {
          $webid=$(element).attr("webid");
          $ext='?webid='+$webid;
        }
        // sessionStorage.setItem("result", false);
        // console.log($url + "saiyanaing");
        var $ajax = $.ajax({
          type: "POST",
          url: $url + "/validate"+$ext,
          async: false,
          dataType: "JSON",
          beforeSend: function () {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="error">' +
                "Loading......</label>"
            );
          },
          data: {
            table: $(element).attr("table"),
            column: $(element).attr("column"),
            checker: value,
            remark: $(element).attr("remark"),
          },
        });
        $("#" + $(element).attr("id") + "-error").remove();
        $done = $ajax.done(function (data) {
          $("#" + $(element).attr("id") + "-error").remove();
          console.log(data.status + "back end");
          if (data["status"]) {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="error">' +
                " 有効なURLを入力してください</label>"
            );
            result = false;
          } else {
            $(element).after(
              '<label id="' +
                $(element).attr("id") +
                '-error" class="text-success">' +
                $(element).val() +
                " を取得することができます。</label>"
            );
            result = true;
          }
        });
        $fail = $ajax.fail(function () {
          $(element).after(
            '<span id="' +
              $(element).attr("id") +
              '-error" class="error">Internal server error</span>'
          );
          result = false;
        });
        // console.log(result + " result");
        return result;
      },
      ""
    );

    // for add multiple domain
    $("form[id='add_multiple_domain']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      focusout: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
      },
      rules: {
        web_server: {
          required: true,
        },
        domain: {
          required: true,
          domain: true,
          alreadyexist: true,
          onkeyup: false,
        },
        web_dir: {
          required: true,
          minlength: 8,
          maxlength: 20,
        },
        ftp_user: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          // nospecialchar: true,
          allowspecialchar5: true,
          minlength: 1,
          maxlength: 20,
          alreadyexist: true,
          onkeyup: false,
        },
        password: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
      },
      // Specify validation error messages
      messages: {
        web_server: {
          required: "Web Serverを入力してください",
        },
        domain: {
          required: "ドメイン名を入力してください",
        },
        web_dir: {
          required: "Please enter  web directory",
          minlength: "8～20文字、半角英数字記号",
          maxlength: "8～20文字、半角英数字記号",
        },
        ftp_user: {
          required: "FTPユーザー名を入力してください",
          minlength: "ユーザー名は20文字以内にしてください",
          maxlength: "ユーザー名は20文字以内にしてください",
        },
        password: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        // return false;
        
        // form.submit();
        $gourl = "admin/multiple_domain?act=validatecap";
        $exceedwebcap = '容量がいっぱいになっているため、サイトの追加ができません。サイトデータを削除いただき追加を行ってください。';
        if(exceedwebcap($gourl))
        {
          document.getElementById("display_dialog").innerHTML = $('#exceedwebcap_dialog').html();
          $('#exceedwebcap').html($exceedwebcap)
        }else{
          loading();
          form.submit()
        }
      },
    });

    

    // end multiple domain
    // for add Contact Us Form
    $("form[id='contactus_form']").validate({
      rules: {
        name: {
          required: true,
          // allowspecialchar3: true,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
        },
        subject: {
          required: true,
          minlength: 1,
        },
        message: {
          required: true,
          minlength: 1,
        },
      },
      // Specify validation error messages
      messages: {
        name: {
          required: "名前を入力してください",
        },
        email: {
          required: "メールアドレスを入力してください",
          minlength: "有効なメールアドレスを入力してください",
          email:'有効なメールアドレスを入力してください'
        },
        phone: {
          required: "Please enter phone number",
          minlength: "Phone number must be at least 1 characters long",
        },
        subject: {
          required: "Please enter subject",
          minlength: "Subject must be at least 1 characters long",
        },
        message: {
          required: "お問合せ内容を入力してください",
          minlength: "問い合わせ内容を入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end Contact Us Form

    // for add app_install_form
    $("form[id='app_install_form']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      focusout: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
      },
      rules: {
        url: {
          required: true,
          url: true,
        },
        site_name: {
          required: true,
        },
        username: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 4,
          maxlength: 50,
        },
        email: {
          required: true,
        },
        password: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
        db_name: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 60,
          onkeyup: false,
        },
        db_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 32,
          onkeyup: false,
        },
        db_pass: {
          required: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
      },
      // Specify validation error messages
      messages: {
        url: {
          required: "URLを入力してください",
          url: "Please enter valid URL",
        },
        site_name: {
          required: "サイト名を入力してください",
        },
        username: {
          required: "ユーザー名を入力してください",
          minlength: "4～50文字、半角英数字と_-.@",
          maxlength: "4～50文字、半角英数字と_-.@",
        },
        email: {
          required: "メールアドレスを入力してください",
          email:"有効なメールアドレスを入力してください"
        },
        password: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
        db_name: {
          required: "データベース名を入力してください",
          minlength: "1～64文字、半角英数字記号",
          maxlength: "1～64文字、半角英数字記号",
        },
        db_user: {
          required: "ユーザー名を入力してください",
          minlength: "1～32文字、半角英数字記号",
          maxlength: "1～32文字、半角英数字記号",
        },
        db_pass: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        // loading();
        // form.submit();
        $app = $("input[name='app']:checked").val();
        $version = $("input[name='app-version']:checked").val();
        $phpv = $('#webphp').data('version');
        
        if (checkappdb()=='ok') {
            $('#dbexist').val('exist');
          }else if(checkappdb()=='doesnotmatch'){
            $('#checkappdb').removeClass("d-none");
            return;
          }else{
            // return;
            $('#checkdblimit').addClass("d-none");
            if (checkdblimit()) {
              $('#checkdblimit').removeClass("d-none");
                return;
              }
              // return;
            $('#dbexist').val('new');
          }

          $('#checkappdb').addClass("d-none");
          $gourl = "/admin/share/server?setting=site&tab=app_install&act=validatecap";
          $exceedwebcap = '容量がいっぱいになっているため、アプリケーションの追加ができません。サイトデータを削除いただき追加を行ってください。';
        // return;
        $("#incompat_Cancel").click(function () {
                        $("#incompat_dialog").modal("hide");
                        $("#common_dialog").modal("show");
                        $("#common_dialog").css({'overflow-y':'auto'})
                    });
        // if(exceedwebcap($gourl))
        //       {
        //         document.getElementById("display_dialog").innerHTML = $('#exceedwebcap_dialog').html();
        //         $('#exceedwebcap').html($exceedwebcap)
        //       }else{

                if($app=='EC-CUBE' && ($version=='eccube3' && $phpv=='v5.6.37'))
                  {
                    document.getElementById("incompatdisplay_dialog").innerHTML = '現在のPHPがEC-CUBE3.0の対応バージョンではないため、5.6.xに変更します。';
                    $("#common_dialog").modal("hide");
                    $("#incompat_dialog").modal("show");
                    $("#incompat_Confirm").click(function () {
                        $("#incompat_dialog").modal("hide");
                        $("#app_install_form").attr("data-send", "ready");
                        loading();
                        form.submit()
                    });

                  }else if($app=='EC-CUBE' && $version=='eccube-4.1' && ( $phpv=='v5.6.37' || $phpv=='v7.2.9' || $phpv=='v7.3.0')){
                    document.getElementById("incompatdisplay_dialog").innerHTML = '現在のPHPがEC-CUBE4.1の対応バージョンではないため、7.4.xに変更します。';
                    $("#common_dialog").modal("hide");
                    $("#incompat_dialog").modal("show");
                    $("#incompat_Confirm").click(function () {
                        $("#incompat_dialog").modal("hide");
                        $("#app_install_form").attr("data-send", "ready");
                        loading();
                        form.submit()
                    });
                  }else{
                    loading();
                    form.submit()
                  }
                
              // }
        
          
        
      },
    });
function checkappdb()
{
  $db_name = $('#db_name').val();
  $db_user = $('#db_user').val();
  $db_pass = $('#db_pass').val();
  let result = '';
      $url = document.URL.split("/");
      $url = $url[0] + "//" + $url[2];
      $ext='';
      $permission = $('#user_permission');
      if($permission.data('permission')=='adminshare')
      {
        $ext='?webper=admin&webid='+$permission.data('webid');
      }else if($permission.data('permission')=='admin')
      {
        $ext='?webper=admin&webser='+$permission.data('webser');
      }else if($permission.data('permission')=='share')
      {
        $ext='?webper=share';
      }
  var $ajax = $.ajax({
          type: "POST",
          url: $url + "/validate"+$ext,
          async: false,
          dataType: "JSON",
          data: {
            db_name: $db_name,
            db_user: $db_user,
            db_pass: $db_pass,
            remark: 'checkappdb',
          },
        });
        // $("#" + $(element).attr("id") + "-error").remove();
        $done = $ajax.done(function (data) {
            result = data["status"];
        });
        return result;
}
function checkdblimit()
{
  let result = '';
      $url = document.URL.split("/");
      $url = $url[0] + "//" + $url[2];
      $ext='';
      $permission = $('#user_permission');
      if($permission.data('permission')=='adminshare')
      {
        $ext='?webper=admin&webid='+$permission.data('webid');
      }else if($permission.data('permission')=='admin')
      {
        $ext='?webper=admin&webser='+$permission.data('webser');
      }else if($permission.data('permission')=='share')
      {
        $ext='?webper=share';
      }
  var $ajax = $.ajax({
          type: "POST",
          url: $url + "/validate"+$ext,
          async: false,
          dataType: "JSON",
          data: {
            remark: 'checkdblimit',
          },
        });
        // $("#" + $(element).attr("id") + "-error").remove();
        $done = $ajax.done(function (data) {
          console.log(data)
            result = data["status"];
        });
        return result;
}
    // end app_install_form

    // for add dir_path_create
    $("form[id='dir_path_create']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      rules: {
        dir_path: {
          required: true,
          nowhitespace: true,
          allowspecialchar: true,
        },
        ftp_user: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          allowspecialchar5: true,
          minlength: 1,
          maxlength: 20,
          alreadyexist: true,
          onkeyup: false,
        },
        ftp_pass: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
      },
      messages: {
        dir_path: {
          required: "ディレクトリ名を入力してください",
        },
        ftp_user: {
          required: "ユーザー名を入力してください",
          minlength: "ユーザー名は20文字以内にしてください",
          maxlength: "ユーザー名は20文字以内にしてください",
        },
        ftp_pass: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end dir_path_create

    $("form[id='blockip_create']").validate({
      rules: {
        block_ip: {
          required: true,
          ip: true,
        },
      },
      messages: {
        block_ip: {
          required: "IPアドレスを入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end blockip_create
    // for ssl
 $("form[id='free-ssl']").validate({
      rules: {
        name: {
          required: true,
          numberalphabet: true,
        },
        prefecture: {
          required: true,
          numberalphabet: true,
        },
        municipality: {
          required: true,
          numberalphabet: true,
        },
        organization: {
          required: true,
          numberalphabet: true,
        },
        department: {
          required: true,
          numberalphabet: true,
        },
      },
      messages: {
        name: {
          required: "コモンネームを入力してください", 
        },
        prefecture: {
          required: "都道府県を入力してください", 
        },
        municipality: {
          required: "市区町村を入力してください", 
        },
        organization: {
          required: "組織名を入力してください",
        },
        department: {
          required: "部署名を入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });
    // for ssl
    // for add database_create
    $("form[id='database_create']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      rules: {
        db_name: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 60,
          alreadyexist: true,
          onkeyup: false,
        },
        db_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 32,
          alreadyexist: true,
          onkeyup: false,
        },
        db_pass: {
          required: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
      },
      // Specify validation error messages
      messages: {
        db_name: {
          required: "データベース名を入力してください",
          minlength: "1～60文字、半角英数字記号",
          maxlength: "1～60文字、半角英数字記号",
        },
        db_user: {
          required: "ユーザー名を入力してください",
          minlength: "1～32文字、半角英数字記号",
          maxlength: "1～32文字、半角英数字記号",
        },
        db_pass: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end database_create

    // for add ftp_create
    $("form[id='ftp_create']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      focusout: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
      },
      rules: {
        ftp_user: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          // nospecialchar: true,
          allowspecialchar5:true,
          minlength: 1,
          maxlength: 20,
          alreadyexist: true,
          onkeyup: false,
        },
        ftp_pass: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
        "permission[]": {
          required: true,
        },
      },
      errorPlacement: function (error, element) {
        if (element.is(":checkbox")) {
          error.insertAfter($("#permission_error"));
        } else {
          error.insertAfter(element);
        }
      },
      messages: {
        ftp_user: {
          required: "ユーザー名を入力してください",
          minlength: "ユーザー名は20文字以内にしてください",
          maxlength: "ユーザー名は20文字以内にしてください",
        },
        ftp_pass: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
        "permission[]": {
          required: "いずれかの権限を選択してください。",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end ftp_create

    // for add email_create
    $("form[id='email_create']").validate({
      onkeyup: function (element) {
        $("#" + element.id + "-error").remove();
        var element_id = $(element).attr("id");
        if (this.settings.rules[element_id].onkeyup !== false) {
          $.validator.defaults.onkeyup.apply(this, arguments);
        }
      },
      focusout: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
      },

      rules: {
        email: {
          required: true,
          allowspecialchar2: true,
          nowhitespace: true,
          // nospecialchar: true,
          minlength: 1,
          maxlength: 30,
          alreadyexist: true,
          onkeyup: false,
        },
        mail_pass_word: {
          required: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3: true,
        },
      },

      // errorPlacement: function (error, element) {
      //   if (element.attr("name") == "email") {
      //     error.insertAfter($("#email_error"));
      //   } else {
      //     error.insertAfter($("#mail_pass_word_error"));
      //   }
      // },
      messages: {
        email: {
          onlynumberalphabet: '特殊文字は使用できません',
          required: "メールアドレスを入力してください",
          minlength: "1～30文字、半角英数字記号",
          maxlength: "1～30文字、半角英数字記号",
        },
        mail_pass_word: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end email_create
    // $.validator.addMethod('ip', function(value) {
    //     var split = value.split('.');
    //     if (split.length != 4)
    //         return false;

    //     for (var i = 0; i < split.length; i++) {
    //         var s = split[i];
    //         if (s.length == 0 || isNaN(s) || s < 0 || s > 255)
    //             return false;
    //     }
    //     return true;
    // }, 'Invalid IP address');
    // $("#common_dialog").modal("show");
// $('#display_dialog').html('<div class="modal-body text-center">レコードが５件目以降の場合は別途追加費用1レコードにつき110円/月かかりますがよろしいですか？</div>'+
//         '<div class="modal-footer d-flex justify-content-center">'+
//         '<button type="button" class="btn btn-outline-info btn-sm" id="btn_Confirm">OK</button>'+
//         '<button type="button" class="btn btn-outline-info btn-sm" data-dismiss="modal">キャンセル</button></div>');
    // for add dns_create
    $("form[id='dns_create']").validate({
      rules: {
        sub: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          maxlength: 14,
        },
        target: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          maxlength: 30,
          minlength: 8,
        },
      },

      // Specify validation error messages
      messages: {
        sub: {
          required: "ホスト名を入力してください",
          maxlength: "ホスト名は14文字以内にしてください",
        },
        target: {
          required: "IP/ドメインを入力してください",
          maxlength: "8～30文字、半角英数字記号",
          minlength: "8～30文字、半角英数字記号",
        },
      },
      submitHandler: function (form) {
            // alert($url)
        // 
        if(dnsexceed5($url))
        {
          finalConfirm(form);
        }else{
          form.submit();
        }
        // form.submit();
      },
    });
    function finalConfirm(form) {
                if ($("#dns_create").attr("data-send") !== "ready") {
                    $("#common_dialog").modal("hide");
                    $("#excommon_dialog").modal("show");
                    $("#btn_Confirm").click(function () {
                        $("#excommon_dialog").modal("hide");
                        $("#dns_create").attr("data-send", "ready");
                        form.submit();
                    });
                }
            }
    // end dns_create

    // for add basic_adduser_create
    $("form[id='basic_adduser_create']").validate({
      rules: {
        bass_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          allowspecialchar: true,
          maxlength: 20,
          minlength: 1
        },
        bass_pass: {
          required: true,
          // numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 30,
          noallowfullwidth: true,
          allowspecialchar3:true,

        },
      },

      // Specify validation error messages
      messages: {
        bass_user: {
          required: "ユーザー名を入力してください",
          maxlength: "ユーザー名は20文字以内にしてください",
          minlength: "ユーザー名は20文字以内にしてください",
        },
        bass_pass: {
          required: "パスワードを入力してください",
          minlength: "パスワードは8文字以上にしてください",
          maxlength: "パスワードは30文字以内にしてください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end basic_adduser_create
    // for add serach_domain_fm
    // $("form[id='search_domain_fm']").validate({
    //     rules: {
    //         domain: {
    //             required: true
    //         }
    //     },

    //     // Specify validation error messages
    //     messages: {
    //         domain: {
    //             required: "ドメイン名を入力してください",
    //         }
    //     },
    //     submitHandler: function(form) {
    //         form.submiddt();
    //     }
    // });

    // end serach_domain_fm
    // for add domian_transfer_tous
    $("form[id='domian_transfer_tous']").validate({
      rules: {
        domain: {
          required: true,
          domain: true,
          jpdomain: true,
        },
        authcode: {
          required: {
            depends: function (element) {
              return (
                $("#usdomain")
                  .val()
                  .substr($("#usdomain").val().length - 3) != ".jp"
              );
            },
          },
          nowhitespace: true,
          onlynumberalphabet: true,
          minlength: 4,
          maxlength: 16,
        },
      },

      // Specify validation error messages
      messages: {
        domain: {
          required: "ドメイン名を入力してください",
        },
        authcode: {
          required: "AuthCodeを入力してください",
          minlength: "AuthCodeは4～16文字以内で入力してください",
          maxlength: "AuthCodeは4～16文字以内で入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end domian_transfer_tous

    // for add domian_transfer_to_other
    $("form[id='domian_transfer_to_other']").validate({
      rules: {
        domain: {
          required: true,
          domain: true,
        },
      },

      // Specify validation error messages
      messages: {
        domain: {
          required: "ドメイン名を入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end domian_transfer_to_other

    // for add bass_dir_create
    $("form[id='bass_dir_create']").validate({
      rules: {
        bass_dir: {
          required: true,
          nowhitespace: true,
          nospecialchar: true,
        },
      },

      // Specify validation error messages
      messages: {
        bass_dir: {
          required: "対象ディレクトリを入力してください",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // for add bass_dir_create
    $("form[id='error_create']").validate({
      onkeyup: function (element) {
        $("#" + $(element).attr("id") + "-error").remove();
      },
      rules: {
        status_code: {
          required: true,
          number: true,
          minlength: 3,
          maxlength: 3,
        },
        url_spec: {
          required: true,
          nowhitespace:true,
          minlength: 8,
          maxlength: 30,
          // noalreadyexist: true,
        },
      },

      // Specify validation error messages
      messages: {
        status_code: {
          required: "ステータスコードを入力してください",
          number: "有効なエラーコードを入力してください",
          minlength: "ステータスコードは3文字以内にしてください",
          maxlength: "ステータスコードは3文字以内にしてください",
        },
        url_spec: {
          required: "有効なURLを入力してください",
          minlength: "8～30文字、半角英数字記号",
          maxlength: "8～30文字、半角英数字記号",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // end bass_dir_create
  });
}
