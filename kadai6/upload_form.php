<?php
require_once "./dbc.php";
$files = getAllFile();
?>

<!-- ①フォームの説明 -->
<!-- ②$_FILEの確認 -->
<!-- ③バリデーション -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/upload.css">
  </head>
  <body>
  <!-- 複数のものを送ることができるmultipart/form-data -->
    <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
      <div class="file-up">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input name="img" type="file" accept="image/*" />
      </div>
      <div>
        <textarea
          name="caption"
          placeholder="キャプション（140文字以下）"
          id="caption"
        ></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="送信" class="btn" />
      </div>
    </form>
    <div class="menus">
      <?php foreach($files as $file):?>
        <div class="menu">
          <div class="menu-image">
            <img src="<?php echo "{$file ['file_path']}" ?>" id="photo" alt="">
          </div>
          <div class="comment">
            <p><?php echo h("{$file ['description']}"); ?></p>
          </div>
        </div>
      <?php endforeach;?>
    </div>
  </body>
</html>
