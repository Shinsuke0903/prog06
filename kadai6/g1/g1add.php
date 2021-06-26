<?php
require_once '../db_config.php';
// form.htmlから送られてくる値を変数に置き換える
// 文字列の項目を変数に代入する
$nameone = $_POST['nameone'];
$mail = $_POST['mail'];
$pass = $_POST['pass'];
try{
// データベースに接続する
$dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
// PDO実行時のエラーモードを設定
$dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// データベースにSQLをセットする
$sql = "INSERT INTO logins (nameone, mail, pass) VALUE (?, ?, ?)";
$stmt = $dbh->prepare($sql);
// プレースホルダーの値を指定する
$stmt->bindValue(1, $nameone, PDO::PARAM_STR);
$stmt->bindValue(2, $mail, PDO::PARAM_STR);
$stmt->bindValue(3, $pass, PDO::PARAM_STR);
// 指定したSQLを実行する
$stmt->execute();
//  データベースとの接続を終了する
$dbh = null;
// 画面にメッセージを表示する
echo "お問い合わせ内容の登録が完了しました。<br>";
echo "<a href='../index.html'>トップページへ戻る</a>";
}catch (Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
    die();

}