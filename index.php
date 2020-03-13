<?php
/**
 * ・広告入稿画面開発 ・広告枠作成画面開発 ・広告配信
 */
// phpinfo();
?>
<!-- html -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>広告配信test画面</title>
  </head>
  <body>
    <!-- content -->
    <div>
      <h1>広告配信テスト画面</h1>
      <div id="ad" value="pid=400&sid=1">
        <script type="text/javascript" src="apiRequest.js"></script>
      </div>
      <!-- 別画面リンク -->
      <h2>広告管理</h2>
      <ul>
        <li><a href="ad.php">広告入稿画面</a></li>
        <li><a href="adSpace.php">広告枠作成画面</a></li>
        <li><a href="#">AS EC作成画面</a></li>
      </ul>
      <!-- ここまで -->
    </div>
    <!-- contentここまで -->
  </body>
</html>