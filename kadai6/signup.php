<?php
require_once 'db_config.php';
//データベースへ接続、テーブルがない場合は作成
try {
  $pdh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
  $pdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdh->exec("create table if not exists logins(
      id int not null auto_increment primary key,
      email varchar(255),
      password varchar(255),
      created timestamp not null default current_timestamp
    )");
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//POSTのValidate。
if (!$mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}
//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['passone'])) {
  $password = password_hash($_POST['passone'], PASSWORD_DEFAULT);
} else {
  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
  return false;
}
//登録処理
try {
  $name = $_POST['nameone'];
  $mail = $_POST['mail'];
  $password= $_POST['passone'];
  $stmt = $pdh->prepare("INSERT INTO logins (nameone ,mail, passone) value(?, ?, ?)");
  $stmt->execute([$name, $mail, $password]);
  echo '登録完了';
  echo "<a href='index.html'>トップページへ戻る</a>";

} catch (\Exception $e) {
  echo '登録済みのメールアドレスです。';
  echo "<a href='index.html'>トップページへ戻る</a>";
}

// // データベースのユーザー名とパスワードを変数に保存する
// require_once '/Applications/MAMP/db_config.php';
// // form.htmlから送られてくる値を変数に置き換える
// // 文字列の項目を変数に代入する
// $nameone = $_POST['nameone'];
// $mail = $_POST['mail'];
// $pass = $_POST['pass'];
// try{
// // データベースに接続する
// $dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
// // PDO実行時のエラーモードを設定
// $dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// // データベースにSQLをセットする
// $sql = "INSERT INTO logins (nameone, mail, pass) VALUE (?, ?, ?)";
// $stmt = $dbh->prepare($sql);
// // プレースホルダーの値を指定する
// $stmt->bindValue(1, $nameone, PDO::PARAM_STR);
// $stmt->bindValue(2, $mail, PDO::PARAM_STR);
// $stmt->bindValue(3, $pass, PDO::PARAM_STR);
// // 指定したSQLを実行する
// $stmt->execute();
// //  データベースとの接続を終了する
// $dbh = null;
// // 画面にメッセージを表示する
// echo "お問い合わせ内容の登録が完了しました。<br>";
// echo "<a href='index.html'>トップページへ戻る</a>";
// }catch (Exception $e) {
//     echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
//     die();
// }