<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        $db_name = "ren_playlist";
        $db_id = "root";
        $db_pw = ""; //XAMPPは空白、MAMPPはroot。
        $db_host = "localhost";
        //$pdo = new PDO('mysql:dbname=ren_playlist;charset=utf8;host=localhost','root','');
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB_CONECT:'.$e->getMessage()); 
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//SessionCheck(スケルトン)
function sschk(){
    //issetはセットしている場合で!を追加したらセットしていない場合になる。||はandです
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
      exit("Login Error");
    }else{
      session_regenerate_id(true); //SESSION KEYを入れ替える
      $_SESSION["chk_ssid"] = session_id();
    }
  }