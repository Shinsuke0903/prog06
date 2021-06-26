<?php
// データベースのユーザー名とパスワードを変数に保存する
require_once 'db_config.php';
// form.htmlから送られてくる値を変数に置き換える--------------------------------
// 文字列の項目を変数に代入する
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
// 数値型に変換して変数に代入する
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try{
// データベースに接続する------------------------------------------------------
$dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user, $pass);
// PDO実行時のエラーモードを設定
$dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// データベースにSQLをセットする-----------------------------------------------
$sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto) VALUE (?, ?, ?, ?, ?)";
$stmt = $dbh->prepare($sql);
// プレースホルダーの値を指定する
$stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
$stmt->bindValue(2, $category, PDO::PARAM_INT);
$stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
$stmt->bindValue(4, $budget, PDO::PARAM_INT);
$stmt->bindValue(5, $howto, PDO::PARAM_STR);
// 指定したSQLを実行する
$stmt->execute();
//  データベースとの接続を終了する
$dbh = null;
// 画面にメッセージを表示する
echo "レシピの登録が完了しました。<br>";
echo "<a href='index.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
    die();

}