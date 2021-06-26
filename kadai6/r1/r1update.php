<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>リウエスト内容</title>
</head>
<body>
    <h1>リクエスト内容の一覧</h1>
    <a href="request.html">お問い合わせ内容の新規登録</a>
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
    if (empty($_POST['id'])) throw new Exception('ID不正');
    // 得た値を数値に変換
    $id = (int) $_POST['id'];
    // データベースの接続
    $dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
    // PDO実行時のエラーモードを設定
    $dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // UPDATEのSQLを入力する
    $sql = "UPDATE gohan SET store = ?, menu = ?, gram = ?, other = ?, detail = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    // プレースホルダの値を指定して、データべースの操作を実行する
    $stmt->bindValue(1, $store, PDO::PARAM_STR);
    $stmt->bindValue(2, $menu, PDO::PARAM_INT);
    $stmt->bindValue(3, $gram, PDO::PARAM_INT);
    $stmt->bindValue(4, $other, PDO::PARAM_INT);
    $stmt->bindValue(5, $detail, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    // 画面にメッセージを表示する
    echo "ID: " . htmlspecialchars($id,ENT_QUOTES, 'UTF-8') . "お問い合わせ内容の更新が完了しました。<br>";
    echo "<a href='r1index.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    // htmlspecialchars→悪意のある値の入力を防ぐ
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    // 命令を中止させる
    die();
}
?>
</body>
</html>