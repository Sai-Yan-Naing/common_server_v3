<html>
    <head>
        <?php header("Content-Type: text/html; charset=UTF-8"); ?>
    </head>
    <body>
        <p>以下の内容で問い合わせが入っております。</p>
        <p>お問い合わせの内容を確認の上、１営業日以内に返信してください。</p>
        <p>お問合せ内容</p>
        <p>$message</p>
        <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
        <br>
        <p>契約ID： $contractID</p>
        <p>担当者様名: $webadminName</p>
        <p>メールアドレス: $email</p>
        <p>電話番号: $phone</p>

        <p>$today</p>
    </body>
</html>