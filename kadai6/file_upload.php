<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Refresh" content="3;URL=mypage.php">
    <title>投稿中</title>
</head>
<body>
    <style>
          .girl{
      text-align: center;
      margin-top: 50px;
    }
    </style>
    
<?php

require_once "./dbc.php";
// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;
// キャプションの取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

// キャプションのバリデーション
// 未入力
if(empty($caption)){
    array_push($err_msgs, 'キャプションを入力して下さい');
    echo '<br>';
}
//140文字か
if(strlen($caption) > 140){
    array_push($err_msgs, 'キャプションは140文字以内で入力して下さい');
    echo '<br>';
}
//ファイルのバリデーション
//ファイルサイズが1MB未満か
if($filesize > 10480576 || $file_err == 2){
    array_push($err_msgs, 'ファイルサイズは1MB未満にして下さい。') ;
    echo '<br>';
}
//拡張は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array(strtolower($file_ext),$allow_ext)){
    echo '画像ファイルを添付して下さい';
    echo '<br>';
}
if(count($err_msgs) === 0){
//ファイルはあるかどうか
if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path, $save_path)){
       
        //DBに保存(ファイル名、ファイルパス、キャプション)
        $result = fileSave($filename, $save_path, $caption);
        if($result){
            echo 'データべースに保存しました！';
        }
        else{
            echo 'データべースへの保存が失敗しました！';
        }
    }else{
        echo 'ファイルが保存出来ませんでした';
    }
    echo '<br>';
}else{
    echo 'ファイルが選択されていません';
    echo '<br>';
}
}else{
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}

?>
<a href="./mypage.php">戻る</a>

<div class="girl">
        <img src="imgs/10.png" alt="" width="500" height="500">
    </div>
    
    
</body>
</html>
