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
    // 受け取ったidのレコードを取得して配列する
    $sql = "SELECT * FROM logins WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    // 指定したSQLを実行する
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //  データベースとの接続を終了する
    $dbh = null;
    // 画面にメッセージを表示する
    echo "お問い合わせ内容の登録が完了しました。<br>";
    echo "<a href='g1index.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>リクエスト</title>
</head>
<body>
    <!-- データの送信方法と送信先を入力する -->
    リクエスト内容の送信<br>
    <form method="post" action="g1update.php">
        <!-- 会社名、テキストのフォームに入力した項目を表示する -->
        名前：<input type="text" name= "nameone" value="<?php
        echo htmlspecialchars($result['nameone'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- 氏名、テキストのフォームに入力した項目を表示する -->
        メールアドレス：<input type="text" name= "mail" value="<?php
        echo htmlspecialchars($result['mail'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- 電話番号、テキストのフォームに入力した項目を表示する -->
        パスワード：<input type="text" name= "pass" value="<?php
        echo htmlspecialchars($result['pass'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <br>        
    </form>
</body>
</html>
