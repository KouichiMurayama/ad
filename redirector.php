<?php
/**
 * 広告遷移リダイレクター
 */

$link =  $_GET["link"];
echo $_GET["link"];

// ここで遷移させる
header('Location: '.$link);