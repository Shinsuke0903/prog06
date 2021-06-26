<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 3秒後に移動する -->
  <!-- <meta http-equiv="Refresh" content="3;URL=mypage.php"> -->
  <title>ログイン中</title>
</head>
<body>
  <style>
    .restaurant{
      text-align: center;
      margin-top: 50px;
    }
  </style>
<?php
session_start();
require_once 'db_config.php';
$mail = $_POST['mail'];
$passone = $_POST['passone'];
try {
  $pdh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
} catch (PDOException $e) {
  $msg = $e->getMessage();
}
$stmt = $pdh->prepare('SELECT * from logins where mail = :mail');
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if ($_POST['passone'] == $member['passone']) {
  //DBのユーザー情報をセッションに保存
  $_SESSION['id'] = $member['id'];
  $_SESSION['nameone'] = $member['nameone'];
  $_SESSION['mail'] = $member['mail'];
  $_SESSION['passone'] = $member['passone'];
 
  echo '<br>';
  echo 'ログインしました。';
  echo '<br>';
  echo '<p></p>';
  echo '<a href="mypage.php">マイページへ</a>';
} else {
  echo 'メールアドレスもしくはパスワードが間違っています。';
  echo '<a href="index.html">戻る</a>';
}
?>
  <div class="restaurant">
    <img src="imgs/11.png" alt="" width="500" height="500" >
  </div>
</body>
</html>