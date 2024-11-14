<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Yusei+Magic&family=Zen+Kaku+Gothic+New&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <title>IKI - 会員登録</title>
</head>
<body>
    <div>
        <img src="./img/00_logo_white.png" id="logo">
    </div>

    <h4>新規会員登録</h4>
    <form action="insert.php" method="POST">    
        <table>
            <tr>
                <td align="right" class="item">氏名</td>
                <td align="left"><input type="text" name="name" ></td>
            </tr>
            <tr>
                <td align="right" class="item">パスワード</td>
                <td align="left"><input type="password" name="lpw"></td>
            </tr>
            <tr>
                <td align="right" class="item">郵便番号</td>
                <td align="left"><input type="text" name="postcode"></td>
            </tr>
            <tr>
                <td align="right" class="item">住所</td>
                <td align="left"><input type="text" name="address"></td>
            </tr>
            <tr>
                <td align="right" class="item">携帯番号</td>
                <td align="left"><input type="tel" name="tel"></td>
            </tr>
            <tr>
                <td align="right" class="item">メール</td>
                <td align="left"><input type="email" name="email"></td>
            </tr>
        </table>
        <div>
            <button type="submit" id="btn_signup">登録</button>
        </div>
        <div>
            <a href="login.php" id="login">ログインページに戻る</a>
        </div>
    </form>

    <footer>
        <div style="height: 30px;"></div>
    </footer>

</body>
</html>