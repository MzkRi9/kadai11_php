<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値を受け取る
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM iki WHERE lid=:lid AND life_flg=0"); 
//ikiというtableの中に、lidという人はいますか。0は有効会員なのでログインしてOK、1は退会した人なのでログインNG
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()


//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["name"]      = $val['name'];
  $_SESSION["lid"]       = $val['lid'];
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["postcode"]  = $val['postcode'];
  $_SESSION["address"]   = $val['address'];
  $_SESSION["tel"]       = $val['tel'];
  $_SESSION["email"]     = $val['email'];

  //Login成功時（zone.phpへ）
  redirect("space.php");

}else{
  //Login失敗時(login.phpへ)
  redirect("login.php");

}


exit();


