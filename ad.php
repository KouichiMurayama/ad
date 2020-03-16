<?php
/**
 * 広告入稿画面
 * GETとPOSTで処理をわける
 */
require "AdDB.php";
use VC\AdDB as AdDB;
$AdDB = new AdDB\AdDB();
?>
<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
  <head>
    <title>広告入稿画面</title>
  </head>
  <body>
    <div>
      <h2>広告入稿画面</h2>
      <table>
        <form method="post" enctype="multipart/form-data" action="insertAd.php">
          <tr>
            <th>ECサイトID</th>
            <td>
              <select name="ecId">
              <?php
              $ecList = $AdDB->ecList();
              foreach ( $ecList as $row ) {
              ?>
                <option value="<?php echo $row['OID']?>"><?php echo $row['OID']?></option>
              <?php
              }
              ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>広告名</th>
            <td><input type="text" name="adName" /></td>
          <tr>
          <tr>
            <th>広告URL</th>
            <td><input type="text" name="adUrl" /></td>
          </tr>
          <tr>
            <th>広告画像</th>
            <td><input type="file" name="adImg" /></td>
          </tr>
          <tr>
            <th></th>
            <td><input type="submit" /></td>
          </tr>
        </form>
      </table>
    </div>
    <div>
      <h2>広告一覧</h2>
      <table class='list' border='1'>
      <tr>
        <th>広告ID</th>
        <th>有効</th>
        <th>ECサイトID</th>
        <th>広告名</th>
        <th>広告URL</th>
        <th>広告画像名</th>
        <th>画像拡張子</th>
        <th>追加日</th>
        <th>更新日</th>
        <th>画像プレビュー</th>
      </tr>
      <?php
      $list = $AdDB->adList();
      $MIMETypes = array(
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif'
      );
      foreach($list as $row) {
        $img = base64_encode($row['IMG_DATA']);
        $mine = $MIMETypes[$row["EXTENSION"]];
        echo '<tr>';
          echo '<td>'.$row["OID"].'</td>';
          echo '<td>'.$row["ACTIVE_FLAG"].'</td>';
          echo '<td>'.$row["ECID"].'</td>';
          echo '<td>'.$row["NAME"].'</td>';
          echo '<td>'.$row["URL"].'</td>';
          echo '<td>'.$row["IMG_NAME"].'</td>';
          echo '<td>'.$row["EXTENSION"].'</td>';
          echo '<td>'.$row["INS_DATE"].'</td>';
          echo '<td>'.$row["UPD_DATE"].'</td>';
          echo '<td><img width="100" src="data:' .$mine. ';base64,'. $img . '"/></td>';
        echo '</tr>';
      }
      ?>
      </table>
    </div>
    <div>
      <ul>
        <li><a href="index.php">広告配信test画面</a></li>
      </ul>
    </div>
  <body>
</html>