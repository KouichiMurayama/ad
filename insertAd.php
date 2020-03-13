<?php
require "AdDB.php";
use VC\AdDB as AdDB;
/**
 * 広告枠作成(Insert)処理
 */
if ( isset($_POST['ecId']) && isset($_POST['adName']) && isset($_POST['adUrl']) ) {
    if ( (int)$_POST['ecId'] ) {
        $formData['ecId'] = (int)$_POST['ecId'];
    } else {
        echo 'ECID不正';

        return 1;
    }

    $formData['adName'] = $_POST['adName'];
    $formData['adUrl'] = $_POST['adUrl'];
} else {
    // nullエラー
    echo 'nullエラー';

    return 1;
}

switch ( $_FILES['adImg']['error'] ) {
    case UPLOAD_ERR_OK: // OK
        break;
    case UPLOAD_ERR_NO_FILE:   // 未選択
        throw new RuntimeException('ファイルが選択されていません', 400);
    case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
        throw new RuntimeException('ファイルサイズが大きすぎます', 400);
    default:
        throw new RuntimeException('その他のエラーが発生しました', 500);
}

// 画像情報取得
$tmp = pathinfo($_FILES["adImg"]["name"]);
// 拡張子取得
$extension = $tmp["extension"];

// 拡張子チェック
if ( $extension === "jpg" || $extension === "jpeg" || $extension === "JPG" || $extension === "JPEG" ) {
    $extension = "jpeg";
} elseif ( $extension === "png" || $extension === "PNG" ) {
    $extension = "png";
} elseif ( $extension === "gif" || $extension === "GIF" ) {
    $extension = "gif";
} else {
    echo '非対応ファイル';
    exit;
}
$formData["extension"] = $extension;

$date = getdate();
$fileName = $_FILES["adImg"]["tmp_name"].$date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
$fileName = hash("sha256", $fileName);
$formData["fileName"] = $fileName;
// 画像をバイナリ化
$raw_data = file_get_contents($_FILES['adImg']['tmp_name']);
$formData["raw_data"] = $raw_data;

$AdDB = new AdDB\AdDB();
$AdDB->insertAd($formData);

header('Location: ad.php');
exit;