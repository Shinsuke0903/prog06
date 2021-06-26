<?php
// データベースのユーザー名とパスワードを変数に保存する
require_once '../db_config.php';
// form.htmlから送られてくる値を変数に置き換える
// 文字列の項目を変数に代入する
$store = $_POST['store'];
$menu = $_POST['menu'];
$other = $_POST['other'];
$detail = $_POST['detail'];
// 数値型に変換して変数に代入する
$gram = (int) $_POST['gram'];
try{
// データベースに接続する
$dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
// PDO実行時のエラーモードを設定
$dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// データベースにSQLをセットする
$sql = "INSERT INTO gohan (store, menu, gram, other, detail) VALUE (?, ?, ?, ?, ?)";
$stmt = $dbh->prepare($sql);
// プレースホルダーの値を指定する
$stmt->bindValue(1, $store, PDO::PARAM_STR);
$stmt->bindValue(2, $menu, PDO::PARAM_STR);
$stmt->bindValue(3, $gram, PDO::PARAM_INT);
$stmt->bindValue(4, $other, PDO::PARAM_STR);
$stmt->bindValue(5, $detail, PDO::PARAM_STR);
// 指定したSQLを実行する
$stmt->execute();
//  データベースとの接続を終了する
$dbh = null;
// 画面にメッセージを表示する
echo "お問い合わせ内容の登録が完了しました。<br>";
echo "<a href='../mypage.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
    die();

}