<?php

/**
 * 広告枠作成画面
 * GETとPOSTで処理をわける
 */
require "AdDB.php";
use VC\AdDB as AdDB;
$AdDB = new AdDB\AdDB();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>広告枠作成画面</title>
  </head>
  <body>
    <div>
      <h2>広告枠作成画面</h2>
      <table>
        <form method="post" action="insertSpace.php">
          <tr>
            <th>広告ID</th>
            <td>
              <select name="adId">
              <?php
              $adList = $AdDB->adList();
              foreach ( $adList as $row ) {
              ?>
                <option value="<?php echo $row['OID']?>"><?php echo $row['OID']?></option>
              <?php
              }
              ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>ASID</th>
            <td>
              <select name="asId">
              <?php
              $asList = $AdDB->asList();
              foreach ( $asList as $row ) {
              ?>
                <option value="<?php echo $row['OID']?>"><?php echo $row['OID']?></option>
              <?php
              }
              ?>
              </select>
            </td>
            <td><input type="submit" value="登録"/></td>
          </tr>
        </form>
      </table>
    </div>
    <div>
      <h2>広告枠一覧</h2>
    <?php
    $list = $AdDB->adSpaceList();
    foreach($list as $row) {
    ?>
      <table class='list' border='1'>
      <tr>
        <th>広告枠ID</th>
        <th>有効</th>
        <th>広告ID</th>
        <th>ASID</th>
        <th>追加日</th>
        <th>更新日</th>
      </tr>
      <?php
          echo '<tr>';
          foreach($row as $data){
            echo '<td>'.$data.'</td>';
          }
          echo '<tr>';
          echo '<tr><th>広告コード</th><th colspan=5>';
          echo '<textarea cols="110" readonly><div id="ad" value="pid='.$row["OID"].'&sid='.$row["ASID"].'"><script type="text/javascript" src="apiRequest.js"></script></div></textarea>';
          echo '</th></table>';
          echo '<br />';
        }
      ?>
    </div>
    <div>
      <ul>
        <li><a href="index.php">広告配信test画面</a></li>
      </ul>
    </div>
  <body>
</html>