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
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/info.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Yusei+Magic&family=Zen+Kaku+Gothic+New&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <title>iki - info</title>
</head>
<body>
    <header>
        <div id="icon"><img src="./img/00_icon.jpg" style="height: 40px; border-radius:50%;"></div>
        <div id="logo"><img src="./img/00_logo_white.png" style="height: 70px;"></div>
        <div id="alert"><img src="./img/00_alert_white.png" style="height: 25px; "></div>
    </header>

    <!-- ここは元々表示されている内容 -->
    <main>
        <div id="menu">
            <div id="viewWay">
                <img id="day_image" src="./img/02_info/08_day_white.png">
                <img id="week_image" src="./img/02_info/09_week_gray.png">
                <img id="month_image" src="./img/02_info/10_month_gray.png">
            </div>
            <div id="add">
                <img id="toggle-mode" src="./img/02_info/light_white.png">
                <img id="add_image" src="./img/02_info/add_white.png">
            </div>
        </div>

        <hr size="0.5">

        <div id="post-view"></div>
    </main>

    <!-- ここからはポップアップの設定 -->
    <div class="popup">
        <div id="closePopup" style="text-align: right; margin: 15px;"><img src="./img/02_info/close_white.png" style="width: 20px;"></div>
        <div class="popupContent">
            <input type="date"   id="date-input" style="margin-right: 15px; margin-top: 5px; width: 120px;">
            <input type="number" id="start-hour" name="start-hour" style="margin: 5px; width: 25px;"> :
            <input type="number" id="start-min"  name="start-min" style="margin: 5px; width: 25px;"> - 
            <input type="number" id="end-hour"   name="end-hour" style="margin: 5px; width: 25px;"> :
            <input type="number" id="end-min"    name="end-min" style="margin-left: 5px; width: 25px;">
        </div>
        <div>
            <textarea id="newTitle" overflow: aoto; placeholder="概要（10文字以内）"></textarea>
            <select name="new-label" id="new-label" size="1" required style="text-align: left;">
                <option value="" disabled selected>ラベル</option>
                <option value="テレビ">テレビ</option>
                <option value="映画">映画</option>
                <option value="音楽">音楽</option>
                <option value="公演">公演</option>
                <option value="雑誌">雑誌</option>
                <option value="CM">CM</option>
                <option value="グッズ">グッズ</option>
                <option value="SNS">SNS</option>
                <option value="遭遇">遭遇</option>
            </select>
        </div>
        <div>
            <textarea id="new-post" overflow: aoto; placeholder="140文字以内で情報詳細を追加"></textarea>
        </div>
        <div style="text-align: right;">
            <button id="save">投稿</button>
        </div>
    </div>

    <footer>
        <ul>
            <li><a href="space.php"><img id="space_image" src="./img/01_space_gray.png" style="height: 25px;"></a></li>
            <li><img id="daily_image" src="./img/02_daily_white.png" style="height: 30px;"></li>
            <li><img id="fun_image" src="./img/03_fun_gray.png" style="height: 25px;"></li>
            <li><img id="ticket_image" src="./img/04_ticket_gray.png" style="height: 25px;"></li>
            <li><img id="shop_image" src="./img/05_shop_gray.png" style="height: 25px;"></li>
        </ul>
    </footer>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="./js/info_firebase.js"></script>
    <script src="./js/info_script.js"></script> -->

</body>