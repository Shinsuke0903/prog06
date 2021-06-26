<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レシピの一覧</title>
</head>
<body>
    <h1>レシピの一覧</h1>
    <a href="form.html">レシピの新規登録</a>
<?php
// データベースのユーザー名とパスワードを変数に保存する
require_once 'db_config.php';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
// 数値型に変換して変数に代入する
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try{
    if (empty($_POST['id'])) throw new Exception('ID不正');
    // 得た値を数値に変換
    $id = (int) $_POST['id'];
    // データベースの接続
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user, $pass);
    // PDO実行時のエラーモードを設定
    $dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // UPDATEのSQLを入力する
    $sql = "UPDATE recipes SET recipe_name = ?, category = ?, difficulty = ?, budget = ?, howto = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    // プレースホルダの値を指定して、データべースの操作を実行する
    $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $budget, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    // 画面にメッセージを表示する
    echo "ID: " . htmlspecialchars($id,ENT_QUOTES, 'UTF-8') . "レシピの更新が完了しました。<br>";
    echo "<a href='index.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    // htmlspecialchars→悪意のある値の入力を防ぐ
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    // 命令を中止させる
    die();
}
?>


</body>
</html>