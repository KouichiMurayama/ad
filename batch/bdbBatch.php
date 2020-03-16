<?php
require "/var/www/html/vc/AdDB.php";
use VC\AdDB as AdDB;

$db = "/var/www/html/vc/bdb.db";
$id = dba_open($db, "n", "db4");
if($id) {

    // 広告全件取得
    $AdDB = new AdDB\AdDB();
    $data = $AdDB->fetchAd();

    // MIME判定用
    $MIMETypes = array(
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif'
        );

    foreach ( $data as $key => $value ) {
        $value["MIME"] = $MIMETypes[$value["EXTENSION"]];
        $value["IMG_DATA"] = base64_encode($value['IMG_DATA']);
        // valueのみjsonエンコード
        $org_data[$value["OID"]] = json_encode($value);

    }

    foreach ($org_data as $key => $value) {
        dba_replace($key, $value, $id);
    }

    dba_close($id);
} else {
    error_log( "BDBオープンエラー", 0);
}
