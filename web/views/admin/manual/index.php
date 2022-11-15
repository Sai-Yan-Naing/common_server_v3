<?php require_once('views/admin/header.php');?>
<div id="layoutSidenav">
<?php require_once('views/admin/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main class="main-page">
            <div class="container-fluid px-4">
                    <?php require_once('views/admin/title.php') ?>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="manual">
                                        <li style="background-color: #09CAE3;"><a href="#controlpanel" class="msetting" style="color:white;"><span class="mr-2">1.</span>Winserverコントロールパネル</a></li>
                                        <li><a href="#serversetting" class="msetting"><span class="mr-2">2.</span>共用サーバー設定</a></li>
                                        <li><a href="#domainadd" class="msetting"><span class="mr-2">2.1</span>マルチドメイン追加</a></li>
                                        <li><a href="#domainsetting" class="msetting"><span class="mr-2">2.2</span> ドメイン取得/移管</a></li>
                                        <li><a href="#dnsinfo" class="msetting"><span class="mr-2">2.3</span>DNS情報</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-9">
                                        <div id="controlpanel" class="cmanual" style="display: block;">
                                        <h1>Winserverコントロールパネル</h1>
                                            <p>Winserverコントロールパネルは、Winserverをお使いのお客様のサーバー設定、ご契約情報の確認などを行うための管理パネルです。</p>
                                            <p>各契約を展開いただくことで設定いただいたマルチドメインについてそれぞれサーバーやサイトの起動停止、プランの変更や各種申請もこちらから行うことができます。</p>
                                            <img src="/img/manual/control_panel.png" alt="コントロールパネル画面">
                                            <h2>サーバー設定</h2>
                                            <p>サイトの起動・停止、各種設定を行うことができます。</p>
                                            <h2>ご契約情報</h2>
                                            <p>別タブにて弊社マイページが開きます。ご契約状況の確認が可能です。</p>
                                            <h2>マニュアル</h2>
                                            <p>本マニュアルページに遷移します。</p>
                                            <h2>お問合せ</h2>
                                            <p>Winserverサポート窓口への問い合わせができます。</p>
                                            <p>「お問合せ」を押下すると、下図のような画面に遷移します。</p>
                                            <img src="/img/manual/inquiry.png" alt="お問合せ画面">
                                            <h3>名前</h3>
                                            <p>お客様のお名前を入力してください。</p>
                                            <h3>電話</h3>
                                            <p>お電話番号を入力してください。</p>
                                            <h3>メールアドレス</h3>
                                            <p>メールアドレスを入力してください。</p>
                                            <p>ご契約内容等に関するお問合せはご登録アドレスのみ承っております。</p>
                                            <h3>お問合せ内容</h3>
                                            <p>お問合せ内容を入力してください。</p>
                                            <p>「送信」を押下すると問い合わせが完了します。</p>
                                            <p>土日祝日を除く1営業日以内に記載いただいたメールアドレスにご連絡いたします。</p>
                                    </div>
                                    <div id="serversetting" class="cmanual">
                                    <h1>サーバー設定</h1>
                                        <p>サーバー設定ではサイトおよびアプリケーションプールの起動・停止、各種設定を行うことができます。</p>
                                        <p>ご利用のマルチドメイン、DB、メールアドレスの数および各ドメインの使用容量もこちらの画面で確認できます。</p>
                                        <img src="/img/manual/control_panel.png" alt="コントロールパネル画面">
                                        <h2>マルチドメイン追加</h2>
                                        <p>マルチドメインの追加が可能です。</p>
                                        <p>追加可能なドメインの数は、ご契約プランごとに異なります。</p>
                                        <h2>ドメイン取得/移管</h2>
                                        <p>ドメイン取得、移管の申請を行うことができます。</p>
                                        <h2>DNS情報</h2>
                                        <p>現在のDNS情報の確認と、レコードの追加・編集・削除申請を行うことができます。</p>
                                        <p>5件目以降のレコードの追加は、1レコードにつき110円/月のオプション料金が加算されます。</p>
                                    </div>
                                    <div id="domainadd" class="cmanual">
                                    <h1>マルチドメイン追加</h1>
                                        <p>マルチドメインの追加を行うことができます。</p>
                                        <img src="/img/manual/add_domain.png" alt="マルチドメイン追加画面">
                                        <h2>追加作業</h2>
                                        <p>主契約ドメイン、追加ドメイン、FTPユーザー名、パスワードを入力して「作成」を押下してください。</p>
                                        <h3>主契約ドメイン</h3>
                                        <p>マルチドメインを追加する主契約ドメインを選択してください。</p>
                                        <p>データベース数が上限に達している主契約ドメインは選択いただけません。</p>
                                        <h3>追加ドメイン</h3>
                                        <p>作成希望のドメイン名を入力してください。</p>
                                        <h3>FTPユーザー名</h3>
                                        <p>追加するドメインに接続可能なFTPユーザーを作成します。</p>
                                        <p>作成希望のFTPユーザー名を1～20文字で入力してください。</p>
                                        <p>半角英数字と「_(アンダーバー)」「-(ハイフン)」「.(ドット)」のみ利用可能です。</p>
                                        <h3>パスワード</h3>
                                        <p>希望のパスワードを8～30文字で入力してください。</p>
                                        <p>パスワードは英大文字、英小文字、数字、記号の4種類のうち3種類を含んでいる必要があります。</p>
                                        <p>また、FTPユーザー名を含むパスワードは設定いただけません。</p>
                                    </div>
                                    <div id="domainsetting" class="cmanual">
                                    <h1>ドメイン取得・ドメイン移管</h1>
                                        <p>ドメインの取得および移管の申請を行うことができます。</p>
                                        <img src="/img/manual/domain.png" alt="ドメイン取得・移管画面">
                                        <h2>ドメイン取得</h2>
                                        <p>取得希望のドメイン名を入力して「取得申請」を押下してください。</p>
                                        <p>取得申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からのご案内をお待ちください。</p>
                                        <h2>ドメイン移管（他社から弊社に移管）</h2>
                                        <p>他社から弊社に移管希望のドメイン名とAuthCodeを入力して「申請」を押下してください。</p>
                                        <p>JPドメインの場合は、AuthCodeは不要です。</p>
                                        <p>移管申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からのご案内をお待ちください。</p>
                                        <h2>ドメイン取得（弊社から他社に移管）</h2>
                                        <p>弊社から他社に希望のドメイン名を入力して「他社移管申請」を押下してください。</p>
                                        <p>移管申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からのご案内をお待ちください。</p>
                                    </div>
                                    <div id="dnsinfo" class="cmanual">
                                    <h1>DNS情報</h1>
                                        <p>登録済のDNS情報の確認、変更申請、追加申請、削除申請を行うことが出来ます。</p>
                                        <img src="/img/manual/dnsinfo.PNG" alt="DNS情報画面">
                                        <h2>レコード追加</h2>
                                        <p>「レコード追加」を押下すると、次のレコード追加のポップアップが表示されます。</p>
                                        <img src="/img/manual/dns_add.PNG" alt="DNS追加画面">
                                        <p>追加したいレコードのタイプを選択し、ホスト名とIPまたはドメインを入力して「作成」を押下してください。</p>
                                        <p>レコードが5件目以降の場合は1レコードにつき別途追加費用が110円/月かかります。</p>
                                        <p>追加申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からの作業完了のご連絡をお待ちください。</p>
                                        <h2>レコード編集</h2>
                                        <p>各レコードの右側の「編集」を押下すると、次のレコード編集画面が表示されます。</p>
                                        <img src="/img/manual/dns_edit.PNG" alt="レコード編集画面">
                                        <p>ホスト名とIPまたはドメインを編集して「作成」を押下してください。</p>
                                        <p>編集申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からの作業完了のご連絡をお待ちください。</p>
                                        <h2>レコード削除</h2>
                                        <p>各レコードの右側の「削除」を押下すると、次のレコード削除確認のポップアップが表示されます。</p>
                                        <img src="/img/manual/dns_delete.PNG" alt="レコード削除確認画面">
                                        <p>削除したいレコードであることを確認して「削除」を押下してください。</p>
                                        <p>削除申請が完了すると申請完了のポップアップが表示されます。</p>
                                        <p>弊社からの作業完了のご連絡をお待ちください。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
    </div>
</div>
<style>
    h1 {
      padding: .5em .75em;
      background-color: #f6f6f6;
      border-left: 6px solid #ccc;
      font-size: 32px;
    }
    h2 {
      padding-bottom: .5em;
      border-bottom: 1px solid #ccc;
      font-size: 24px;
    }
    h3 {
      font-size: 18px;
      font-weight:bold;
    }
</style>
<script>
    //  $(document).on('click','.msetting',function(){
    //     $id = $(this).attr("href");
    //     $('html, body').animate({
    //                 scrollTop: $($id).offset().top - 100
    //             });
    //  })
     
     $(document).on('click','.msetting',function(){
        $id = $(this).attr("href");
        $('.cmanual').css({'display':'none'})
        $($id).css({'display':'block'})
        $('html, body').animate({
                    scrollTop: $($id).offset().top - 100
                });
        $('.msetting').parent().css({'background-color':'white'});
        $('.msetting').css({'color':'#007bff'})
        $(this).parent().css({'background-color':'#09CAE3'});
        $(this).css({'color':'white'})
     })
</script>