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
      "Cannot enter white space"
    );

    // allow underscroll ( _ ) and dash (-)
    // var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    $.validator.addMethod(
      "nospecialchar",
      function (value) {
        var regex = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]+/;
        if (!regex.test(value)) {
          return true;
        }
      },
      "Cannot enter special character"
    );

    $.validator.addMethod(
      "alreadyexist",
      function (value, element) {
        $("#" + $(element).attr("id") + "-error").remove();
        let result = false;
        $url = document.URL.split("/");
        $url = $url[0] + "//" + $url[2];
        // sessionStorage.setItem("result", false);
        // console.log($url + "saiyanaing");
        var $ajax = $.ajax({
          type: "POST",
          url: $url + "/validate",
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
          $(element).after(
            '<span id="' +
              $(element).attr("id") +
              '-error" class="error">Internal server error</span>'
          );
          result = false;
        });
        console.log(result + " result");
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
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 255,
          alreadyexist: true,
          onkeyup: false,
        },
        password: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },
      // Specify validation error messages
      messages: {
        domain: {
          required: "Please enter ドメイン名",
        },
        web_dir: {
          required: "Please enter  web directory",
          minlength: "8～20文字、半角英数字記号",
          maxlength: "8～20文字、半角英数字記号",
        },
        ftp_user: {
          required: "Please enter FTP user",
          minlength: "1～255文字、半角英数小文字と_-.@",
          maxlength: "1～255文字、半角英数小文字と_-.@",
        },
        password: {
          required: "Please enter password",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
        },
      },
      submitHandler: function (form) {
        // return false;
        loading();
        form.submit();
      },
    });

    // end multiple domain
    // for add Contact Us Form
    $("form[id='contactus_form']").validate({
      rules: {
        name: {
          required: true,
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
          minlength: "Message must be at least 1 characters long",
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
          minlength: 1,
          maxlength: 255,
        },
        email: {
          required: true,
        },
        password: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
        db_name: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 5,
          maxlength: 70,
          alreadyexist: true,
          onkeyup: false,
        },
        db_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 5,
          maxlength: 70,
          alreadyexist: true,
          onkeyup: false,
        },
        db_pass: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },
      // Specify validation error messages
      messages: {
        url: {
          required: "Please enter URL",
          url: "Please enter valid URL",
        },
        site_name: {
          required: "Please enter  サイト名",
        },
        username: {
          required: "Please enter ユーザー名",
          minlength: "1～255文字、半角英数小文字と_-.@",
        },
        email: {
          required: "Please enter メールアドレス",
          email:"有効なエラーコードを入力してください"
        },
        password: {
          required: "Please enter password",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
        },
        db_name: {
          required: "Please enter データベース名",
          minlength: "5～70文字、半角英数字記号",
          maxlength: "5～70文字、半角英数字記号",
        },
        db_user: {
          required: "Please enter ユーザー名",
          minlength: "5～70文字、半角英数字記号",
          maxlength: "5～70文字、半角英数字記号",
        },
        db_pass: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

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
          nospecialchar: true,
        },
        ftp_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 14,
          alreadyexist: true,
          onkeyup: false,
        },
        ftp_pass: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },
      messages: {
        dir_path: {
          required: "Please enter ディレクトリ",
        },
        ftp_user: {
          required: "Please enter  ユーザー名",
          minlength: "1-14文字、半角英数字",
          maxlength: "1-14文字、半角英数字",
        },
        ftp_pass: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
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
          required: "Please enter IP Address",
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
          required: "Please enter コモンネーム", 
        },
        prefecture: {
          required: "Please enter 都道府県（Ｓ）", 
        },
        municipality: {
          required: "Please enter 市区町村（Ｌ）", 
        },
        organization: {
          required: "Please enter 組織名（Ｏ）",
        },
        department: {
          required: "Please enter 部署名（ＯＵ）",
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
          minlength: 4,
          maxlength: 20,
          alreadyexist: true,
          onkeyup: false,
        },
        db_user: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 4,
          maxlength: 20,
          alreadyexist: true,
          onkeyup: false,
        },
        db_pass: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },
      // Specify validation error messages
      messages: {
        db_name: {
          required: "Please enter データベース名",
          minlength: "4～20文字、半角英数字記号",
          maxlength: "4～20文字、半角英数字記号",
        },
        db_user: {
          required: "Please enter ユーザー名",
          minlength: "4～20文字、半角英数字記号",
          maxlength: "4～20文字、半角英数字記号",
        },
        db_pass: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
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
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          minlength: 1,
          maxlength: 14,
          alreadyexist: true,
          onkeyup: false,
        },
        ftp_pass: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
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
          required: "Please enter  ユーザー名",
          minlength: "1-14文字、半角英数字",
          maxlength: "1-14文字、半角英数字",
        },
        ftp_pass: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
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
      rules: {
        email: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          nospecialchar: true,
          alreadyexist: true,
        },
        mail_pass_word: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },

      errorPlacement: function (error, element) {
        if (element.attr("name") == "email") {
          error.insertAfter($("#email_error"));
        } else {
          error.insertAfter($("#mail_pass_word_error"));
        }
      },
      messages: {
        email: {
          required: "Please enter メールアドレス",
        },
        mail_pass_word: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数字記号",
          maxlength: "8～70文字、半角英数字記号",
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
        },
        target: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
        },
      },

      // Specify validation error messages
      messages: {
        sub: {
          required: "Please enter ホスト名",
        },
        target: {
          required: "Please enter IP/ドメイン",
          minlength: "IP/ドメインは8文字以上にしてください",
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
          nospecialchar: true,
        },
        bass_pass: {
          required: true,
          numberalphabet: true,
          nowhitespace: true,
          minlength: 8,
          maxlength: 70,
        },
      },

      // Specify validation error messages
      messages: {
        bass_user: {
          required: "Please enter ユーザー名",
        },
        bass_pass: {
          required: "Please enter パスワード",
          minlength: "8～70文字、半角英数記号の組み合わせ",
          maxlength: "8～70文字、半角英数記号の組み合わせ",
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
    //             required: "Please enter ドメイン名",
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
          required: "Please enter ドメイン名",
        },
        authcode: {
          required: "Please enter AuthCode",
          minlength: "AuthCode must be between 4 and 16 characters long",
          maxlength: "AuthCode must be between 4 and 16 characters long",
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
          required: "Please enter ドメイン名",
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
          required: "Please enter directory",
        },
      },
      submitHandler: function (form) {
        loading();
        form.submit();
      },
    });

    // for add bass_dir_create
    $("form[id='error_create']").validate({
      rules: {
        status_code: {
          required: true,
          number: true,
        },
        url_spec: {
          required: true,
          nowhitespace:true,
        },
      },

      // Specify validation error messages
      messages: {
        status_code: {
          required: "Please enter status code",
          number: "有効なエラーコードを入力してください"
        },
        url_spec: {
          required: "有効なURLを入力してください",
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
