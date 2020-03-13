<?php
require "AdDB.php";
use VC\AdDB as AdDB;

/**
 * 広告枠作成(Insert)処理
 */
if ( isset($_POST['adId']) && isset($_POST['asId']) ) {
    if ( (int)$_POST['adId'] && (int)$_POST['adId'] ) {
        $formData['adId'] = (int)$_POST['adId'];
        $formData['asId'] = (int)$_POST['asId'];
    } else {
        //  値エラー
        return 1;
    }
} else {
    // nullエラー
    return 1;
}

$AdDB = new AdDB\AdDB();
$AdDB->insertAdSpace($formData);

header('Location: adSpace.php');
exit;
