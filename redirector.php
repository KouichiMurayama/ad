<?php
/**
 * 広告遷移リダイレクター
 * クリックログとクッキーを焼き、遷移先へリダイレクトさせる
 */
// ログファイル名
$filename = "/var/www/html/vc/logs/click_log";

// リダイレクターが受け取っているパラメーターは以下
$pId = $_GET["pid"];
$asId = $_GET["asid"];
$adId = $_GET["adid"];
$url = $_GET["url"];

// クリックログ用のデータ取得
$datetime = date("Y/m/d H:i:s"); 
$ip = $_SERVER['REMOTE_ADDR'];
$referer = $_SERVER['HTTP_REFERER'];
$uri = $_SERVER['REQUEST_URI'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$method = $_SERVER['REQUEST_METHOD'];

$log = "\n---------------------------------".
    "\ndate:".$datetime . " ip:". $ip . " method:" . $method.
    "\nto:". $url. 
    "\nadinfo:pid=" . $pId . ",asid=". $asId . ",adid=" . $adId . ",desturl=" . $url .
    "\nuri:". $uri.
    "\nreferer:". $referer.
    "\nua:". $ua;

// クッキー情報作成
$cookieName = "ad";
$cookieValue = $pId . '&ref=' . $referer . '$ua=' . $ua;
// (クッキー名,value, expire, ディレクトリ, ドメイン, セキュア接続のみ, HTTPのみの接続)
// 43200秒 30日くらい 
setcookie($cookieName, $cookieValue);

//ログ書き込み
$fp = fopen($filename, "a");
fputs($fp, $log);
fclose($fp);

// URLへ遷移
header('Location: '.$url);