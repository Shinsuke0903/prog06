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
    $sql = "SELECT * FROM gohan WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    // 指定したSQLを実行する
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //  データベースとの接続を終了する
    $dbh = null;
    // 画面にメッセージを表示する
    echo "お問い合わせ内容の登録が完了しました。<br>";
    echo "<a href='r1index.php'>トップページへ戻る</a>";
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
    <form method="post" action="update.php">
        <!-- 会社名、テキストのフォームに入力した項目を表示する -->
        店名：<input type="text" name= "store" value="<?php
        echo htmlspecialchars($result['store'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- 氏名、テキストのフォームに入力した項目を表示する -->
        メニュー：<input type="text" name= "menu" value="<?php
        echo htmlspecialchars($result['menu'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- 電話番号、テキストのフォームに入力した項目を表示する -->
        グラム：<input type="text" name= "gram" value="<?php
        echo htmlspecialchars($result['gram'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- メールアドレス、テキストのフォームに入力した項目を表示する -->
        他のおかず：<input type="text" name= "other" value="<?php
        echo htmlspecialchars($result['other'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        <!-- お問い合わせ内容、テキストエリアのフォームに入力した項目を表示する -->
        お問い合わせ内容：
        <textarea name="detail" id="" cols="40" rows="4" maxlength="150"<?php echo
        htmlspecialchars($result['detail'], ENT_QUOTES, 'UTF-8')?>></textarea>
        <br>        
    </form>
</body>
</html>
