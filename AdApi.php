<?php
namespace VC\AdApi;

require "bdb.php";
use VC\Bdb as Bdb;

// IDの取得 IDがない場合は終了
if( isset($_GET['pid']) && $_GET['pid'] != 0 ) {
    $pid = $_GET['pid'];
} else {
    // pidが取得できない場合のエラー
    exit;
}

$bdb = new Bdb\Bdb();
// TODO: 値を取得できない場合のエラー
$json = $bdb->fetchValue($pid);

header('content-type: application/json; charset=utf-8');
echo $json;
