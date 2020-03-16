<?php

$db = "/var/www/html/vc/bdb.db";

$id = dba_open($db, "n", "db4");

if($id) {
    $date = getdate();
    $key = $date["seconds"]."key";
    $value = $date["minutes"]."Value";

    dba_insert($key, $value, $id);
} else {
    error_log( "BDBオープンエラー", 0);
}

dba_close($id);
