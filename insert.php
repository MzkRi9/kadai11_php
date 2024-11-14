<?php
//1. POSTデータ取得
$name     = $_POST["name"];
$lpw      = $_POST["lpw"];
$postcode = $_POST["postcode"];
$address  = $_POST["address"];
$tel      = $_POST["tel"];
$email    = $_POST["email"];

//2. DB接続します
include("funcs.php"); //外部ファイル読み込み
$pdo = db_conn();

//３．データ登録SQL作成
// 最大のlidを取得して新しい番号を作成
$query = "SELECT MAX(lid) AS max_lid FROM iki";
$stmt = $pdo->query($query);
$row = $stmt->fetch();
$maxLid = intval($row['max_lid']);
$newLid = str_pad($maxLid + 1, 8, "0", STR_PAD_LEFT);

//INSERT文準備
$sql = "INSERT INTO iki(name,lid,lpw,postcode,address,tel,email)VALUES(:name,:lid,:lpw,:postcode,:address,:tel,:email);";
$stmt = $pdo->prepare($sql);

//各パラメータ
$stmt->bindValue(':name',     $name,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid',      $newLid,   PDO::PARAM_STR);
$stmt->bindValue(':lpw',      password_hash($_POST['lpw'], PASSWORD_DEFAULT), PDO::PARAM_STR);
$stmt->bindValue(':postcode', $postcode, PDO::PARAM_STR);
$stmt->bindValue(':address',  $address,  PDO::PARAM_STR);
$stmt->bindValue(':tel',      $tel,      PDO::PARAM_STR);
$stmt->bindValue(':email',    $email,    PDO::PARAM_STR);
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．thanks.phpへリダイレクト
  header("Location: thanks.php");
  exit();
}
?>