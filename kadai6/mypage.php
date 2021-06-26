<?php
require_once "./dbc.php";
$files = getAllFile();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>マイページ</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/sample1.css">
    <link rel="stylesheet" href="./css/upload.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- ヘッダーを書いていく -->
    <header>
      <h1>mystagram</h1>
    </header>
    <main>
      <!-- 全体の作成 -->
      <div class="top-wrapper">
        <!-- 上部左の設定 -->
        <div class="items">
          <!-- プロフィール写真の設定 -->
          <div class="prof">
            <div class="prof-image">
              <img src="imgs/101.jpeg" alt="" class="prof-image1">
            </div>
            <p>Shinsuke</p>
          </div>
          <!-- ご飯のリクエストのボタン -->
          <div class="design">
            <div class="request">
                <a href="r1/request.html" class="btn-gradation" id="analysis">ご飯の量をリクエスト</a>
            </div>
          </div>
          <!-- 画像投稿 -->
          <div class="chart"> 
            <div class="chart1">
              <h1>食べたものを記録しよう!</h1>
            </div>
               <!-- 複数のものを送ることができるmultipart/form-data -->
            <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
              <div class="serial">
                <div class="file-up">
                <label id="label1" for="menuimg">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    ＋
                    <input id="menuimg" name="img" type="file" accept="image/*" style="display:none;"/>
                </label>
                </div>
                <div class="caption">
                    <textarea
                    name="caption"
                    placeholder="キャプション（140文字以下）"
                    id="caption"
                    ></textarea>
                </div>
              </div>
                <div class="submit">
                    <label id="label2" for="send">
                        Go!!
                        <input type="submit" value="送信" class="btn" id="send" style="display:none;" />
                    </label>
                </div>
            </form>
          </div>
          <!-- 足を診る -->
          <div class="foot">
            <p>足を診る!</p>
            <div class="foot1">
              <img src="./imgs/foot.png" alt="" width="120" height="150">
            </div>
          </div>
        </div>
        <!-- メニューの画像作成 -->
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
    </div> 
    </main>
    <!-- フッターの作成 -->
    <footer>
      <p class="last">copyrights 2021 Metalife All RIghts Reserved.</p>
    </footer>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!--   
      <script src="js/jquery-2.1.3.min.js"></script>
      <script src="js/action.js"></script>
    JQuery -->
      <!-- JQuery -->
      <!--** 以下Firebase **-->
      <!-- The core Firebase JS SDK is always required and must be listed first -->
      <!-- 6.6.1に該当する箇所はfirebaseのバージョンですので更新されるたびに随時変わります🤗    8.6.2に変える必要がある -->
      <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      
      <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#config-web-app -->
      <script src="js/syokugo1.js"></script>
      <!-- /MapArea -->
      <!-- jQuery&GoogleMapsAPI -->
      <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
      <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Ah09rxoHoMfDGlwhs8hKdsf6iKTzh81JHzQo9mU3AzIvpWSzVRT9R4mchbwbxRhB'
        async defer></script>
      <script src="js/BmapQuery.js"></script>
  </body>
</html>