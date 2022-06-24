<?php require_once('views/admin/share/header.php'); ?>
<div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <!-- start -->
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="manual">
                                                <li style="background-color: #09CAE3;"><a href="#setting1" class="msetting" style="color:white"><span class="mr-2">1.</span> 共用コントロールパネル</a></li>
                                                <li><a href="#setting2" class="msetting"><span class="mr-2">2.</span>サーバー設定</a></li>
                                                <li><a href="#setting3" class="msetting"><span class="mr-2">2.1</span> WordPress・EC-CUBEの設定</a></li>
                                                <li><a href="#setting4" class="msetting"><span class="mr-2">2.2</span>基本設定</a></li>
                                                <li><a href="#setting5" class="msetting"><span class="mr-2">2.3</span>応用設定</a></li>
                                                <li><a href="#setting6" class="msetting"><span class="mr-2">2.4</span>SSL設定</a></li>
                                                <li><a href="#setting7" class="msetting"><span class="mr-2">2.5</span>WAF設定</a></li>
                                                <li><a href="#setting8" class="msetting"><span class="mr-2">2.6</span>ディレクトリアクセス制限設定</a></li>
                                                <li><a href="#setting9" class="msetting"><span class="mr-2">2.7</span>IPアクセス制限設定</a></li>
                                                <li><a href="#setting10" class="msetting"><span class="mr-2">2.8</span>データベース設定</a></li>
                                                <li><a href="#setting11" class="msetting"><span class="mr-2">2.9</span>FTPユーザー設定</a></li>
                                                <li><a href="#setting12" class="msetting"><span class="mr-2">2.10</span>ファイルマネージャー操作</a></li>
                                                <li><a href="#setting13" class="msetting"><span class="mr-2">3.</span>メール設定</a></li>
                                                <li><a href="#setting14" class="msetting"><span class="mr-2">4.</span>各種設定</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div id="setting1" class="cmanual" style="display: block;">
                                                <h1>Winserverコントロールパネル</h1>
                                                <p>Winserver共用コントロールパネルは、ご利用のサーバーの設定、メール設定等を行うことのできる管理パネルです。</p>
                                                <img src="/img/manual/share_control_panel.PNG" alt="共用コントロールパネル画面">
                                                <h2>サーバー設定</h2>
                                                <p>ご利用のサーバーの各種設定ができます。</p>
                                                <p>アプリケーションの追加、サイトセキュリティの設定、データベースの追加、FTPユーザーの追加・編集、ファイル管理が可能です。</p>
                                                <h2>メール設定</h2>
                                                <p>メールアドレスの登録・確認および接続情報の確認ができます。</p>
                                                <h2>各種設定</h2>
                                                <p>ご利用のサーバー情報の確認、バックアップの設定ができます。</p>
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
                                            <div id="setting2" class="cmanual">
                                                <h1>サーバー設定</h1>
                                                <p>ご利用のサーバーの各種設定ができます。</p>
                                                <img src="/img/manual/share_control_panel.PNG" alt="サーバー設定">
                                                <h2>サイト設定</h2>
                                                <p>Wordpress/EC-CUBEのインストール、エラーページ・BASIC認証の設定が行えます。</p>
                                                <p>web.configの設定、PHP、ASP.NETのバージョンの切り替えもこちらから可能です。</p>
                                                <h2>サイトセキュリティー</h2>
                                                <p>無料SSLの登録、有料SSLの確認、WAFの設定、ディレクトリアクセス制限・IPアクセス制限の設定が可能です。</p>
                                                <h2>データベース</h2>
                                                <p>MYSQL、MSSQL、MARIADB各種データベースの追加、管理が可能です。</p>
                                                <h2>FTP</h2>
                                                <p>FTPユーザーの追加、管理が可能です。</p>
                                                <h2>ファイルマネージャー</h2>
                                                <p>ご利用のサーバー上のファイル・ディレクトリの管理が行えます。</p>
                                                <p>ファイルの直接編集も可能です。</p>
                                            </div>
                                            <div id="setting3" class="cmanual">
                                                <h1>サイト設定|アプリケーションインストール</h1>
                                                <p>WordPress、EC-CUBEのインストールが可能です。</p>
                                                <p>「アプリケーション追加」を押下すると下図ポップアップが表示されます。</p>
                                                <p>必要事項を入力して「インストール」を押下してください。</p>
                                                <img src="/img/manual/app_install.PNG" alt="アプリケーションインストール">
                                                <h2>アプリケーション</h2>
                                                <p>WordPressとEC-CUBEのいずれかを選択してください。</p>
                                                <h3>バージョン</h3>
                                                <p>インストールしたいアプリケーションのバージョンを選択してください。</p>
                                                <h3>URL</h3>
                                                <p>作成したいサイトのURLを入力してください。</p>
                                                <h3>サイト名</h3>
                                                <p>作成したいサイト名を入力してください。</p>
                                                <h3>ユーザー名</h3>
                                                <p>アプリケーションのユーザー名を4～50文字で入力してください。</p>
                                                <p>半角英数字と「.(ドット)」「-(ハイフン)」「_(アンダーバー)」「@(アットマーク)」のみ利用可能です。</p>
                                                <h3>メールアドレス</h3>
                                                <p>メールアドレスを入力してください。</p>
                                                <p>利用可能なメールアドレスであることを確認してください。</p>
                                                <h3>パスワード</h3>
                                                <p>アプリケーションのパスワードを8～30文字で入力してください。</p>
                                                <p>半角英数字記号のみ利用可能です。</p>
                                                <h2>データベース</h2>
                                                <p>インストールするアプリケーションで使用するデータベースの必要事項を入力してください。</p>
                                                <p>全ての項目で半角英数字記号のみ利用可能です。</p>
                                                <h3>データベース名</h3>
                                                <p>インストールするアプリケーションで使用したいデータベース名を入力してください。</p>
                                                <h3>ユーザー名</h3>
                                                <p>データベースのユーザー名を入力してください。</p>
                                                <h3>パスワード</h3>
                                                <p>データベースのパスワードを 8～30文字で入力してください。</p>
                                            </div>
                                            <div id="setting4" class="cmanual">
                                                <h1>サイト設定|基本設定</h1>
                                                <p>エラーページ・ベーシック認証の設定ができます。</p>
                                                <img src="/img/manual/basic_setting.PNG" alt="基本設定">
                                                <h2>エラーページ</h2>
                                                <p>「エラーページ追加」を押下するとエラーページの設定追加が可能です。</p>
                                                <img src="/img/manual/errorpage_add.PNG" alt="エラーページ追加">
                                                <h3>ステータスコード</h3>
                                                <p>エラーページを設定したいHTTPステータスコードを入力してください。</p>
                                                <p>3桁の半角数字のみ利用可能です。</p>
                                                <h3>URL指定</h3>
                                                <p>設定したいエラーページのURLを指定してください。</p>
                                                <p>指定箇所のディレクトリにエラーページ用のファイルがあることを確認してください。</p>
                                                <h3>利用設定</h3>
                                                <p>エラーページ一覧の「利用設定」列から、編集、ON/OFFの切り替え、削除が可能です。</p>
                                                <p>エラーページ一覧に追加されていても利用設定がOFFになっていると適用されませんのでご注意ください。</p>
                                                <h2>BASIC認証</h2>
                                                <p>「BASIC認証追加」を押下してBASIC認証を追加したいディレクトリの設定追加が可能です。</p>
                                                <img src="/img/manual/basic_auth_add.PNG" alt="BASIC認証追加">
                                                <p>ディレクトリ名を入力して「作成」を押下してください。</p>
                                                <p>作成したBASIC認証設定は、赤いゴミ箱マークを押下することで削除可能です。</p>
                                                <h3>ユーザー追加</h3>
                                                <p>「ユーザー追加」を押下してユーザー名とパスワードを入力して「作成」を押下して、BASIC認証の認証ユーザー作成を行ってください。</p>
                                                <img src="/img/manual/basic_auth_user_add.PNG" alt="BASIC認証ユーザー追加">
                                                <h3>ユーザー名</h3>
                                                <p>希望の認証ユーザー名を1～20文字で入力してください。</p>
                                                <p>半角英数字と「'(シングルクォート)」「.(ドット)」「-(ハイフン)」「_(アンダーバー)」「!(エクスクラメーションマーク)」「#(井桁)」「^(ハット)」「~(チルダ)」のみ利用可能です。</p>
                                                <h3>パスワード</h3>
                                                <p>希望のパスワードを6-127文字で入力してください。</p>
                                                <p>パスワードは英大文字、英小文字、数字、記号の4種類のうち3種類を含んでいる必要があります。</p>
                                                <p>また、ユーザー名を含むパスワードは設定いただけません。</p>
                                                <p>各ユーザーの「パスワード変更」列の「編集」を押下するとパスワードの変更、「削除」を押下するとユーザーの削除が可能です。</p>
                                            </div>
                                            <div id="setting5" class="cmanual">
                                                <h1>サイト設定|応用設定</h1>
                                                <p>ご利用のサーバーの各種設定ができます。</p>
                                                <img src="/img/manual/advanced_setting.PNG" alt="応用設定">
                                                <h2>Web.config設定</h2>
                                                <p>web.configの設定が可能です。</p>
                                                <p>弊社共用サーバーのサービスはIISを利用しているため.htaccessでの設定は出来ません。</p>
                                                <p>リダイレクト設定等もweb.configに記述してください。</p>
                                                <h2>PHP設定</h2>
                                                <p>PHPのバージョンの変更および.user.iniの記載が可能です。</p>
                                                <p>.user.iniの反映にはお時間がかかる場合がございます。</p>
                                                <p>お待ちいただいても設定が反映されない場合は、アプリケーションプールとサイトの再起動を行ってください。</p>
                                                <h2>ASP.NET設定</h2>
                                                <p>ASP.NETのバージョンの変更が可能です。</p>
                                            </div>
                                            <div id="setting6" class="cmanual">
                                                <h1>サイトセキュリティー|SSL</h1>
                                                <p>無料SSLの登録およびお申込み済みの有料SSLの種別、有効期限の閲覧が可能です。</p>
                                                <img src="/img/manual/ssl_setting.PNG" alt="SSL設定">
                                                <h2>無料SSL設定</h2>
                                                <p>コモンネーム、都道府県、市区町村、組織名を入力してください。</p>
                                                <h3>コモンネーム</h3>
                                                <p>実際に接続するURLのFQDNを入力してください。</p>
                                                <p>半角英数字と「.(ドット)」「-(ハイフン)」が利用可能です。</p>
                                                <h3>都道府県</h3>
                                                <p>申請組織の本店所在地の都道府県名を入力してください。</p>
                                                <h3>市区町村</h3>
                                                <p>申請組織の本店所在地の市区町村名を入力してください。</p>
                                                <h3>組織名</h3>
                                                <p>申請組織の商号を入力してください。</p>
                                                <p>コモンネーム以外の項目は、半角英数字と「'(シングルクォート)」「.(ドット)」「-(ハイフン)」「 (半角スペース)」「,(コンマ)」「:(コロン)」「=(イコール)」が利用可能です。</p>
                                                <h2>有料SSL設定</h2>
                                                <p>お申込み済みの有料SSLの種別と有効期限の閲覧が可能です。</p>
                                            </div>
                                            <div id="setting7" class="cmanual">
                                                <h1>サイトセキュリティー|WAF</h1>
                                                <p>WEBアプリケーションファイアウォールの設定が可能です。</p>
                                                <img src="/img/manual/waf_setting.PNG" alt="WAF設定">
                                                <h2>利用設定</h2>
                                                <p>WAFの起動・停止を操作可能です。</p>
                                                <p>WAFを利用したい場合は起動状態にしてください。</p>
                                                <p>ご覧いただける動作履歴は最大1か月分となります。</p>
                                                <h2>表示切替</h2>
                                                <p>表示切替を起動しておくとブロックしたもののみご覧いただけます。</p>
                                                <p>表示切替を停止しておくと、全履歴がご覧いただけます。</p>
                                            </div>
                                            <div id="setting8" class="cmanual">
                                                <h1>サイトセキュリティー|ディレクトリアクセス</h1>
                                                <p>ルートディレクトリ配下のディレクトリと、そのディレクトリに対してアクセス権を持ったユーザーを作成することができます。</p>
                                                <img src="/img/manual/directory_access_control.PNG" alt="ディレクトリアクセス制限">
                                                <h2>ディレクトリアクセス制限追加</h2>
                                                <p>「ディレクトリ追加」を押下すると、ディレクトリアクセス制限の追加が可能です。</p>
                                                <img src="/img/manual/directory_access_control_add.PNG" alt="ディレクトリアクセス制限追加">
                                                <p>ディレクトリ名、ユーザー名とそのパスワードを入力して、「作成」を押下してください。</p>
                                                <h3>ディレクトリ名</h3>
                                                <p>作成希望のディレクトリ名またはアクセス権を持ったユーザーを作成したい既存のディレクトリを入力してください。</p>
                                                <h3>ユーザー名</h3>
                                                <p>作成希望のユーザー名を1～20文字で入力してください。</p>
                                                <p>半角英数字と「'(シングルクォート)」「.(ドット)」「-(ハイフン)」「_(アンダーバー)」「!(エクスクラメーションマーク)」「#(井桁)」「^(ハット)」「~(チルダ)」のみ利用可能です。</p>
                                                <h3>パスワード</h3>
                                                <p>希望のパスワードを6-127文字で入力してください。</p>
                                                <p>パスワードは英大文字、英小文字、数字、記号の4種類のうち3種類を含んでいる必要があります。</p>
                                                <p>また、ユーザー名を含むパスワードは設定いただけません。</p>
                                                <h2>パスワード変更</h2>
                                                <p>各項目の「操作」列にある「編集」を押下すると、パスワードの編集が可能です。</p>
                                                <p>変更を行った場合は、ポップアップ下部の「保存」を押下して変更内容を保存してください。</p>
                                                <h2>ディレクトリアクセス制限削除</h2>
                                                <p>各項目の「操作」列にある「削除」を押下すると、ディレクトリアクセス制限の削除が可能です。</p>
                                                <p>ディレクトリと対象ユーザーの両方が削除されるため、削除対象のディレクトリ間違いがないか確認して、「削除」を押下してください。</p>
                                            </div>
                                            <div id="setting9" class="cmanual">
                                                <h1>サイトセキュリティー|IPアクセス制限</h1>
                                                <p>IPアドレスをブラックリストに登録することで、サイトへのアクセスを制限することができます。</p>
                                                <img src="/img/manual/ip_access_control.PNG" alt="IPアクセス制限">
                                                <h2>IPアクセス制限追加</h2>
                                                <p>「ブラックリストに追加」を押下すると、IPアドレスのブラックリストへの追加が可能です。</p>
                                                <img src="/img/manual/ip_access_control_add.PNG" alt="IPアクセス制限追加">
                                                <p>アクセスを制限したいIPアドレスを入力して「追加」を押下してください。</p>
                                                <p>IPv4アドレスのみ入力可能です。CIDR表記は利用できません。</p>
                                                <h2>IPアクセス制限解除</h2>
                                                <p>ブラックリスト上の各IPの「操作」列の「削除」を押下すると、IPアドレスのアクセス制限解除が可能です。</p>
                                                <p>ブラックリストからの削除対象のIPに間違いがないか確認して、「削除」を押下してください。</p>
                                            </div>
                                            <div id="setting10" class="cmanual">
                                                <h1>データベース</h1>
                                                <p>データベースの追加・削除・パスワードの変更が可能です。</p>
                                                <img src="/img/manual/database_info.PNG" alt="データベース">
                                                <h2>データベース追加</h2>
                                                <p>「データベース追加」を押下すると、データベースの追加が可能です。</p>
                                                <img src="/img/manual/database_add.PNG" alt="データベース追加">
                                                <p>データベース種別、データベース名、ユーザー名、パスワードを入力して「作成」を押下してください。</p>
                                                <p>データベース名、ユーザー名、パスワードはいずれも半角英数字記号のみ利用可能です。</p>
                                                <p>追加したデータベースは、データベース種別ごとに各タブに表示されます。</p>
                                                <h3>データベース種別</h3>
                                                <p>MYSQL, MSSQL, MARIADBのうち、ご希望のものを選択してください。</p>
                                                <h3>データベース名</h3>
                                                <p>作成希望のデータベース名を1～64文字で入力してください。</p>
                                                <h3>ユーザー名</h3>
                                                <p>希望のユーザー名を1～32文字で入力してください。</p>
                                                <h3>パスワード</h3>
                                                <p>希望のパスワードを8～30文字で入力してください。</p>
                                                <h2>データベース削除</h2>
                                                <p>各データベースの「編集」列の「削除」を押下すると、データベースの削除が可能です。</p>
                                                <p>削除対象のデータベースに間違いがないか確認して、「削除」を押下してください。</p>
                                                <h2>パスワード変更</h2>
                                                <p>各データベースの「編集」列の「編集」を押下すると、パスワードの変更が可能です。</p>
                                                <p>希望のパスワードを入力し、「パスワード変更」を押下してください。</p>
                                                <h2>データベース管理</h2>
                                                <p>各種データベース追加ボタンの右のリンクを押下すると、MYSQLとMARIADBはブラウザでデータベース管理が行えるphpMyAdminが別タブで開きます。</p>
                                                <p>MSSQLについてはマネジメントスタジオのダウンロードページが別タブで開きます。</p>
                                            </div>
                                            <div id="setting11" class="cmanual">
                                                <h1>FTP</h1>
                                                <p>FTPユーザーの追加・編集・削除が可能です。</p>
                                                <img src="/img/manual/ftp_info.PNG" alt="FTPユーザー管理">
                                                <h2>FTPユーザー追加</h2>
                                                <p>「FTPユーザー追加」を押下すると、FTPユーザーの追加が可能です。</p>
                                                <img src="/img/manual/ftp_user_add.PNG" alt="FTPユーザー追加">
                                                <p>作成希望のFTPユーザー名とそのパスワード、該当ユーザーの権限を入力して、「作成」を押下してください。</p>
                                                <h3>FTPユーザー</h3>
                                                <p>作成希望のユーザー名を1～20文字で入力してください。</p>
                                                <p>半角英数字と「'(シングルクォート)」「.(ドット)」「-(ハイフン)」「_(アンダーバー)」「!(エクスクラメーションマーク)」「#(井桁)」「^(ハット)」「~(チルダ)」のみ利用可能です。</p>
                                                <h3>パスワード</h3>
                                                <p>希望のパスワードを6-127文字で入力してください。</p>
                                                <p>パスワードは英大文字、英小文字、数字、記号の4種類のうち3種類を含んでいる必要があります。</p>
                                                <p>また、FTPユーザー名を含むパスワードは設定いただけません。</p>
                                                <h3>接続許可ディレクトリ</h3>
                                                <p>作成するユーザーに付与する権限を選択してください。</p>
                                                <h2>FTPユーザー編集</h2>
                                                <p>各ユーザーの「操作」列にある「編集」を押下すると、ユーザーのパスワードおよび権限の編集が可能です。</p>
                                                <p>変更を行った場合は、ポップアップ下部の「変更」を押下して変更内容を保存してください。</p>
                                                <h2>FTPユーザー削除</h2>
                                                <p>各ユーザーの「操作」列にある「削除」を押下すると、ユーザーの削除が可能です。</p>
                                                <p>削除対象のユーザーに間違いがないか確認して、「削除」を押下してください。</p>
                                            </div>
                                            <div id="setting12" class="cmanual">
                                                <h1>ファイルマネージャー</h1>
                                                <p>ご利用のサーバー上のファイル・ディレクトリの管理ができます。</p>
                                                <img src="/img/manual/filemanager.PNG" alt="ファイルマネージャー">
                                                <h2>ファイルアップロード</h2>
                                                <p>図内①のボタンを押下すると、ファイルアップロードのポップアップが表示されます。</p>
                                                <img src="/img/manual/filemanager_upload.PNG" alt="ファイルアップロード">
                                                <p>緑の枠内にアップロードしたいファイルをドラッグ＆ドロップしてください。</p>
                                                <p>「保存」を押下すると、現在開いているディレクトリ内にファイルのアップロードができます。</p>
                                                <h2>ファイル・ディレクトリの新規作成</h2>
                                                <h3>ファイルの新規作成</h3>
                                                <p>図内③のボタンを押下すると、新規ファイル作成のポップアップが表示されます。</p>
                                                <img src="/img/manual/filemanager_file.PNG" alt="ファイル作成">
                                                <p>作成したいファイル名を入力して「保存」を押下してください。ファイル名は拡張子まで入力してください。</p>
                                                <h3>ディレクトリの新規作成</h3>
                                                <p>図内②のボタンを押下すると、新規ディレクトリ作成のポップアップが表示されます。</p>
                                                <img src="/img/manual/filemanager_directory.PNG" alt="ディレクトリ作成">
                                                <p>作成したいディレクトリ名を入力して「保存」を押下してください。</p>
                                                <h2>ファイルの編集</h2>
                                                <p>編集したいファイルをクリックすると下図のような編集画面が表示されます。</p>
                                                <img src="/img/manual/filemanager_file_edit.PNG" alt="ファイル編集">
                                                <p>内容を編集後、左上の「保存」を押下してください。</p>
                                                <h2>ファイル・ディレクトリ名の編集</h2>
                                                <p>名前を編集したいファイル・ディレクトリの「作業」列にある「名前変更」を押下すると編集のポップアップが表示されます。</p>
                                                <p>内容を編集後、「保存」を押下してください。</p>
                                                <h2>ファイル・ディレクトリの圧縮/解凍</h2>
                                                <h3>ファイル・ディレクトリの圧縮</h3>
                                                <p>ファイル・ディレクトリの「作業」列にある「圧縮」を押下するとディレクトリ圧縮のポップアップが表示されます。</p>
                                                <p>希望のzipファイル名を記入して、「保存」を押下してください。</p>
                                                <h3>ファイル・ディレクトリの解凍</h3>
                                                <p>zipファイルの「作業」列にある「解凍」を押下するとzipファイル解凍のポップアップが表示されます。</p>
                                                <p>解凍したいzipファイル名を記入して、「保存」を押下してください。</p>
                                                <h2>ファイルのダウンロード</h2>
                                                <p>ファイルの「作業」列にある下向き矢印のダウンロードボタンを押下するとローカルに該当ファイルがダウンロードされます。</p>
                                                <h2>ファイル・ディレクトリの削除</h2>
                                                <p>ファイル・ディレクトリの「作業」列にある「削除」を押下すると削除確認確認のポップアップが表示されます。</p>
                                                <p>削除するファイル・ディレクトリ名に間違いがないか確認し、「削除」を押下してください。</p>
                                            </div>
                                            <div id="setting13" class="cmanual">
                                                <h1>メール設定</h1>
                                                <p>メールアドレスの登録・確認および接続情報の確認ができます。</p>
                                                <h2>メール設定</h2>
                                                <p>メールアドレスの登録、登録済みのメールアドレスの確認、メールアドレスのパスワードの編集、メールアドレスの削除ができます。</p>
                                                <h3>メールアドレス追加</h3>
                                                <p>「メールアドレス追加」を押下すると下図のようなポップアップが表示されます。</p>
                                                <img src="/img/manual/mail_add.PNG" alt="メールアドレス追加画面">
                                                <p>作成希望のメールアドレスのメールアカウント名とそのパスワードをそれぞれ1～30文字、8～30文字で入力してください。</p>
                                                <p>メールアカウント名は＠の前の部分になります。半角英数字と「.(ドット)」「-(ハイフン)」「_(アンダーバー)」のみ利用可能です。</p>
                                                <p>最初または最後が記号のメールアカウント名および2文字以上記号が連続するメールアカウント名は利用できません。</p>
                                                <p>パスワードは半角英数字記号のみ利用可能です。</p>
                                                <p>「作成」を押下すると、登録済みのメールアドレス一覧に作成したメールアドレスが追加されます。</p>
                                                <h3>登録済みメールアドレスの確認</h3>
                                                <p>メール設定画面を開くと、登録済みのメールアドレスとそのパスワードが一覧で確認できます。</p>
                                                <img src="/img/manual/mail_setting.PNG" alt="メール設定画面">
                                                <h3>パスワードの編集</h3>
                                                <p>各メールアドレスの「操作」列にある「編集」ボタンを押下すると、パスワードの編集が可能です。</p>
                                                <p>希望のパスワードを入力して「変更」を押下してください。</p>
                                                <p>パスワードは8～30文字で、半角英数字記号のみ利用可能です。</p>
                                                <p>「変更」を押下後、該当のメールアドレスのパスワードが変更後のものになっているか確認してください。</p>
                                                <p>※パスワードの変更後は、ご利用のメールクライアントにも変更内容を反映してください。</p>
                                                <h3>メールアドレス削除</h3>
                                                <p>登録済みのメールアドレスが不要になった場合は、削除を行ってください。</p>
                                                <p>各メールアドレスの「操作」列にある「削除」ボタンを押下すると、メールアドレスの削除が可能です。</p>
                                                <p>削除対象のメールアドレスに間違いないか確認して「削除」ボタンを押下してください。</p>
                                                <h2>メール接続情報</h2>
                                                <p>メールクライアント等の設定時に必要な情報が記載されています。</p>
                                                <p>接続情報を誤って入力すると、サーバー側でロックがかかる可能性があるため、ご注意ください。</p>
                                                <h2>WEBメール</h2>
                                                <p>WEBメールの画面が別タブで開きます。</p>
                                                <p>サーバーのメールデータの削除や、管理者アカウントでのユーザー管理を行う際にご利用ください。</p>
                                            </div>
                                            <div id="setting14" class="cmanual">
                                                <h1>各種設定</h1>
                                                <p>ご利用のサーバー情報の確認、バックアップの設定が可能です。</p>
                                                <h2>ご契約情報</h2>
                                                <p>ご利用のサーバーの情報が確認できます。</p>
                                                <img src="/img/manual/contract_info.PNG" alt="ご契約情報">
                                                <h3>接続サーバー</h3>
                                                <p>接続先のサーバーのIPアドレスが表示されます。</p>
                                                <h3>ステータス</h3>
                                                <p>WEBサイトのステータスが表示されます。右のボタンで起動・停止の操作が可能です。</p>
                                                <h3>アプリケーションプール</h3>
                                                <p>サイトのアプリケーションプールのステータスが表示されます。右のボタンで起動・停止の操作が可能です。</p>
                                                <h3>使用ディスク容量</h3>
                                                <p>現在使用しているディスク容量が表示されます。</p>
                                                <h3>DNS</h3>
                                                <p>登録済みのDNS情報が表示されます。</p>
                                                <h2>自動バックアップ</h2>
                                                <p>バックアップの設定および実施ができます。</p>
                                                <p>バックアップは1世代のみ可能です。</p>
                                                <img src="/img/manual/backup.PNG" alt="バックアップ設定">
                                                <h3>自動バックアップ</h3>
                                                <p>自動バックアップの起動・停止が可能です。</p>
                                                <p>自動バックアップは1日1回実施されます。</p>
                                                <h3>手動バックアップ</h3>
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