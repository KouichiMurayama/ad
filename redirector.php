<?php
/**
 * 広告遷移リダイレクター
 */

/**
 * TODO
 * cookie
 * apatche_note
 * アクセスログ(クリックされた広告枠IDとかを残す)
 */
$link =  $_GET["link"];
echo $_GET["link"];
setcookie("testCookie", "cookieValue", 43200);
echo $_COOKIE["testCookie"];

// ここで遷移させる
// header('Location: '.$link);