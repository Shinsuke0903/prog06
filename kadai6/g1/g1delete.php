<?php
// データベースのユーザー名とパスワードを変数に保存する
require_once '../db_config.php';
try{
    //URLのIDを受け取る:$_GET['id']
    // もしIDの値が空ならエラーを表示する
    if (empty($_GET['id'])) throw new Exception('ID不正');
    // 得た値を数値に変換
    $id = (int) $_GET['id'];
    // データベースの接続
    $dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
    // PDO実行時のエラーモードを設定
    $dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // プレースホルダーを設定してSQL文を入力
    $sql = "DELETE FROM logins WHERE id = ?";
    // 設定したSQLをPDOで利用するように入力
    $stmt = $dbh->prepare($sql);
    // プレースホルダーの?に入る数字を設定する
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    // セットしたSQLを実行して値を受けとる
    $stmt->execute();
    //  データベースとの接続を終了する
    $dbh = null;
    // 画面にメッセージを表示する
    echo "ID: " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "の削除が完了しました。";
    // 例外処理
// Exception→全てのエラーに対応できる
// 画面にメッセージを表示する
echo "<br>";
echo "<a href='g1index.php'>トップページへ戻る</a>";
}
catch (Exception $e) {
    // htmlspecialchars→悪意のある値の入力を防ぐ
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    // 命令を中止させる
    die();
}
?>