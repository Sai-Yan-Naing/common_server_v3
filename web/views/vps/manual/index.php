<?php require_once('views/vps/header.php'); ?>
<div id="layoutSidenav">
        <?php require_once('views/vps/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/vps/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="manual">
                                                <li style="background-color: #09CAE3;"><a href="#setting1" class="msetting" style="color:white"><span class="mr-2">1.</span> VPSコントロールパネル</a></li>
                                                <li><a href="#setting2" class="msetting"><span class="mr-2">2.</span> サーバー設定</a></li>
                                                <li><a href="#setting3" class="msetting"><span class="mr-2">3.</span>各種設定</a></li>
                                                <li><a href="#setting4" class="msetting"><span class="mr-2">3.1</span>Firewall設定</a></li>
                                                <li><a href="#setting5" class="msetting"><span class="mr-2">3.2</span> 負荷状況確認</a></li>
                                                <li><a href="#setting6" class="msetting"><span class="mr-2">3.3</span>オプション追加</a></li>
                                                <li><a href="#setting7" class="msetting"><span class="mr-2">3.4</span>簡単インストール</a></li>
                                                <li><a href="#setting8" class="msetting"><span class="mr-2">3.5</span>バックアップ</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div id="setting1" class="cmanual" style="display: block;">
                                            <h1>Winserverコントロールパネル</h1>
                                                <p>Winserver VPSコントロールパネルは、ご利用のサーバーのプラン変更依頼、各種設定等を行うことのできる管理パネルです。</p>
                                                <img src="/img/vpsmanual/vps_control_panel.PNG" alt="VPSコントロールパネル画面">
                                                <h2>サーバー設定</h2>
                                                <p>サーバーの電源オフオン、ログインパスワードの変更、プラン変更依頼およびOS初期化の依頼ができます。</p>
                                                <h2>各種設定</h2>
                                                <p>ご利用のサーバーのFirewallの設定、負荷状況の確認、オプションの追加、簡単インストール、バックアップの設定ができます。</p>
                                                <h2>マニュアル</h2>
                                                <p>本マニュアルページに遷移します。</p>
                                                <h2>お問合せ</h2>
                                                <p>Winserverサポート窓口への問い合わせができます。</p>
                                                <p>「お問合せ」を押下すると、下図のような画面に遷移します。</p>
                                                <img src="/img/vpsmanual/inquiry.png" alt="お問合せ画面">
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
                                            <div id="setting2" class="cmanual" style="display: none;">
                                            <h1>サーバー設定</h1>
                                                <p>サーバーの電源オフオン、ログインパスワードの変更、プラン変更依頼およびOS初期化の依頼ができます。</p>
                                                <img src="/img/vpsmanual/vps_control_panel.PNG" alt="サーバー設定">
                                                <h2>Server Status</h2>
                                                <p>電源オフオンの操作が可能です。</p>
                                                <p>電源操作を続けて行う場合は、ページの再読み込みを行ってから操作を行ってください。</p>
                                                <p>こちらのページからの電源操作は、コンピュータの電源スイッチのオン・オフに相当します。</p>
                                                <p>起動中のプログラムのデータ等の逸失の恐れがございますので、リモートデスクトップ接続による管理ができなくなった場合などに、リスクをご理解の上ご利用ください。</p>
                                                <p>電源操作を行ってもサーバーへの反映が確認出来ない場合は、お手数ですが「お問合せ」よりご連絡をお願い致します。</p>
                                                <h2>接続情報</h2>
                                                <p>ご利用のサーバーのグローバルIPアドレス、管理者IDの確認が可能です。</p>
                                                <p>ご契約のVPSにわかりやすい名前をつけるためのネームタグの設定もこちらから行っていただけます。</p>
                                                <p>また、表示されている管理者IDのパスワードの変更も可能です。</p>
                                                <p>パスワードは英大文字、英小文字、数字、記号の4種類のうち3種類を含んでいる必要があります。</p>
                                                <h2>基本設定</h2>
                                                <p>現在の契約内容の確認が可能です。</p>
                                                <p>プラン変更およびOS初期化のご依頼もこちらから行っていただけます。</p>
                                            </div>
                                            <div id="setting3" class="cmanual" style="display: none;">
                                            <h1>各種設定</h1>
                                            <p>ご利用のサーバーの各種設定、オプションの追加依頼、簡単インストール、バックアップができます。</p>
                                            <img src="/img/vpsmanual/vps_multisetting.png" alt="各種設定">
                                            <h2>Server Status</h2>
                                            <p>電源オフオンの操作が可能です。</p>
                                            <p>電源操作を続けて行う場合は、ページの再読み込みを行ってから操作を行ってください。</p>
                                            <p>こちらのページからの電源操作は、コンピュータの電源スイッチのオン・オフに相当します。</p>
                                            <p>起動中のプログラムのデータ等の逸失の恐れがございますので、リモートデスクトップ接続による管理ができなくなった場合などに、リスクをご理解の上ご利用ください。</p>
                                            <p>電源操作を行ってもサーバーへの反映が確認出来ない場合は、お手数ですが「お問合せ」よりご連絡をお願い致します。</p>
                                            <h2>Firewall設定</h2>
                                            <p>リモートデスクトップ接続とWEBアクセスについて、ファイアウォールの設定が可能です。</p>
                                            <h2>負荷状況確認</h2>
                                            <p>現在のサーバーの負荷状況の大まかな確認が可能です。</p>
                                            <p>サーバー内からの詳細な負荷状況の確認方法は、「負荷状況確認」のマニュアルにてご案内しております。</p>
                                            <h2>簡単インストール</h2>
                                            <p>IISおよびSQL Server Expressのインストールが可能です。</p>
                                            <h2>オプション追加</h2>
                                            <p>オプション追加のお申込みが可能です。</p>
                                            <h2>バックアップ</h2>
                                            <p>バックアップの設定が可能です。</p>
                                            <p>ご利用のプラン内容により、バックアップ機能がないものもございます。</p>
                                            </div>
                                            <div id="setting4" class="cmanual" style="display: none;">
                                            <h1>Filewall設定|各種設定</h1>
                                                <p>リモートデスクトップ接続とWEBアクセスについて、ファイアウォールの設定ができます。</p>
                                                <img src="/img/vpsmanual/vps_firewall.PNG" alt="firewall設定">
                                                <h2>リモートデスクトップ接続</h2>
                                                <p>リモートデスクトップ接続時のポート番号と、接続元のIPの制限が可能です。</p>
                                                <p>設定を誤るとリモートデスクトップ接続が出来なくなることがございます。</p>
                                                <p>Firewall設定後サーバーへの接続が出来なくなった場合は、「デフォルトに戻す」を押下して制限を無効にして接続をお試しください。</p>
                                                <h2>WEBアクセス</h2>
                                                <p>WEBアクセスのポート番号と、接続元のIPの制限が可能です。</p>
                                            </div>
                                            <div id="setting5" class="cmanual" style="display: none;">
                                            <h1>負荷状況確認|各種設定</h1>
                                                <p>現在のサーバーの負荷状況の大まかな確認ができます。</p>
                                                <img src="/img/vpsmanual/vps_server_load.PNG" alt="負荷状況確認">
                                                <h2>CPU</h2>
                                                <p>CPUの使用率。一時的な処理で使用率が高くなることもございます。</p>
                                                <h2>メモリ</h2>
                                                <p>メモリの使用率。常時逼迫していてVPSの操作感に問題がある場合は、メモリ追加をご検討ください。</p>
                                                <h2>ディスク読み書き</h2>
                                                <p>他のディスク読み書き処理が終わるのを待っている処理の数。平均10以下であれば問題ございません。</p>
                                            </div>
                                            
                                            <div id="setting6" class="cmanual" style="display: none;">
                                            <h1>オプション追加|各種設定</h1>
                                            <p>各種オプション追加のお申込みができます。</p>
                                            <h2>スペックオプション</h2>
                                            <img src="/img/vpsmanual/vps_spec_option.PNG" alt="スペックオプション">
                                            <p>メモリ、コア数、ディスク容量、IPアドレス、仮想スイッチの追加お申込みが可能です。</p>
                                            <p>ディスク容量につきましては、追加後の途中解約が出来かねますのでご注意ください。</p>
                                            <h2>有償ライセンスオプション</h2>
                                            <img src="/img/vpsmanual/vps_license_option.PNG" alt="有償ライセンスオプション">
                                            <p>OFFICE, セキュリティソフト, SSL証明書につきましては、ご希望のものをご選択ください。</p>
                                            <p>お客様保持のOffice製品のインストールにつきましては、SA付きライセンスのもの以外はMicrosoftライセンス違反となりますのでご注意ください。</p>
                                            </div>
                                            <div id="setting7" class="cmanual" style="display: none;">
                                            <h1>簡単インストール|各種設定</h1>
                                            <p>IISおよびSQL Server Expressのインストールが出来ます。</p>
                                            <img src="/img/vpsmanual/vps_kantan_install.PNG" alt="簡単インストール">
                                            <h2>IISインストール</h2>
                                            <p>ボタン押下後、ご契約のサーバーにデフォルトの構成にてIISが自動インストールされます。</p>
                                            <h2>SQL Server Express Edition</h2>
                                            <p>ボタン押下後、サーバー内のCドライブ直下に「sqlserver」というフォルダが作成されます。</p>
                                            <p>該当フォルダ内の選択したバージョン名のフォルダ(2016, 2017, 2019のいずれか)がございます。</p>
                                            <p>該当フォルダ内の「SQLEXPR_(バージョン名)」のフォルダにある「SETUP」をダブルクリックしてSQL Serverのセットアップを行ってください。</p>
                                            </div>
                                            <div id="setting8" class="cmanual" style="display: none;">
                                            <h1>バックアップ</h1>
                                            <p>バックアップの設定および実施ができます。</p>
                                            <p>バックアップは1世代のみ可能です。</p>
                                            <p>（ご利用のプラン内容により、バックアップ機能がないものもございます。）</p>
                                            <img src="/img/vpsmanual/vps_backup.PNG" alt="バックアップ設定">
                                            <h2>自動バックアップ</h2>
                                            <p>自動バックアップの起動・停止が可能です。</p>
                                            <p>自動バックアップは1日1回実施されます。</p>
                                            <h2>手動バックアップ</h2>
                                            <p>「バックアップを実施」を押下すると確認のポップアップが表示されます。「実施」を押下するとバックアップが可能です。</p>
                                            <p>バックアップの実施にはお時間がかかりますので、「実施」押下後はしばらくお待ちください。</p>
                                            <p>バックアップは1世代のみとなりますので、データがある状態でバックアップを実施すると、新しいデータのみが残ります。</p>
                                            <p>「リストア」を押下するとサーバーをバックアップ時の状態に復旧することが可能です。</p>
                                            <p>「削除」を押下するとバックアップデータを削除することが可能です。</p>
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