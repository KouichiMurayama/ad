<?php
require "AdDB.php";
use VC\AdDB as AdDB;
/**
 * 取得したIDから対応した広告情報を返す
 * json形式
 */
// phpinfo();
$pid;
// IDの取得 IDがない場合は終了
if( isset($_GET['pid']) && $_GET['pid'] != 0 ) {
    $pid = $_GET['pid'];
} else {
    exit;
}

$AdDB = new AdDB\AdDB();
// IDをもとにDBから広告情報を取得
$data = $AdDB->fetchAd($pid);

header('Access-Control-Allow-Origin:*');
echo json_encode($data);