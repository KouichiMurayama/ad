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

// ここで遷移させる
header('Location: '.$link);