<?php
//0.  SESSION開始！
session_start();

//1.  DB接続します
include("funcs.php"); //外部のファイルを読み込む

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//２．データ登録SQL作成
$pdo = db_conn(); //読み込んだファイルの中のdb_connを実行する
$sql = "SELECT * FROM iki";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //true or false

//３．データ表示
$values = ""; 
if($status==false) {
    sql_error($stmt);
}

//全データ取得
$values = $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Yusei+Magic&family=Zen+Kaku+Gothic+New&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <title>IKI - 会員登録ありがとう</title>
</head>
<body>
    <div>
        <img src="./img/00_logo_white.png" id="logo">
    </div>

    <div>
        <p><?=$_SESSION["name"]?>さん、こんにちは！</p>
        <p>会員登録ありがとうございました！</p>
        <p style="color: #c74838;">あなたの会員番号は「<?=$_SESSION["lid"]?>」です。</p>
        <p>今後「IKI」にログインする際に使いますので、<br>忘れないようにメモしてくださいね！<br></p>
        <p>それでは、永瀬廉とIKIる日々を楽しんでください！</p>
    </div>
    
    <div>
        <a href="login.php" id="login"><button id="btn_login">ログイン</button></a>
    </div>

</body>
</html>