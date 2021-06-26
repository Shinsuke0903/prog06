<?php
// データベースのユーザー名とパスワードを変数に保存する
require_once '../db_config.php';
// 例外処理
// 通常動作
try{
// データベースに接続する
$dbh = new PDO('mysql:host=localhost;dbname=db3;charset=utf8', $user, $pass);
// PDO実行時のエラーモードを設定
$dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// データベースの操作を入力する
// ①SQL文の準備(テーブル「gohan」の内容を全て抜き出すSQL文)
$sql = "SELECT * FROM gohan";
// ②SQL文の実行結果を変数に代入
$stmt = $dbh->query($sql);
// ③SQL文の結果の取り出し(fetchAll:配列として全て取り出す、FETCH_ASSOC:カラム名をつける)
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// テーブルに表示する
// \nは改行
echo "<table>\n";
// 表の一行目の指定
echo "<tr>\n";
echo "<th>店名</th><th>メニュー</th><th>グラム</th>\n";
echo "</tr>\n";
// 表の中身の表示
// $rowには1行分の全てのデータが入っている。
foreach ($result as $row) {
    echo "<tr>\n";
    echo "<td>" . htmlspecialchars($row['store'],ENT_QUOTES, 'UTF-8') . "</td>\n"; //店名、htmlspecialchars:セキュリティ対策、ENT_QUOTES:JSなどで悪意あるコードが実行される可能性を減らせる
    echo "<td>" . htmlspecialchars($row['menu'],ENT_QUOTES, 'UTF-8') . "</td>\n"; //メニュー
    echo "<td>" . htmlspecialchars($row['gram'],ENT_QUOTES, 'UTF-8') . "</td>\n"; //グラム数
    // レシピの詳細、変更、削除へのリンクを設定する
    echo "<td>\n";
    echo "<a href=r1detail.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'). ">詳細</a>\n";
    echo "<a href=r1edit.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'). ">変更</a>\n";
    echo "<a href=r1delete.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'). ">削除</a>\n";
    echo "</td>\n";
    echo "</tr>\n";
}
echo "</tr>\n";
//  データベースとの接続を終了する
$dbh = null;
}
// 例外処理
// Exception→全てのエラーに対応できる
catch (Exception $e) {
    // htmlspecialchars→悪意のある値の入力を防ぐ
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    // 命令を中止させる
    die();
}
?>