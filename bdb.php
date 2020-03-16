<?php
class Bdb
{
    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function getAdData()
    {

    }

}
$db = "bdb.db";
$id = dba_open($db, "n", "db4");

$key;
$value;

if (!$id) {
    echo "dba_open failed\n";
    exit;
}
dba_insert(1, "testvalue1", $id);
dba_insert(2, "testvalue2", $id);
dba_insert(3, "testvalue3", $id);
dba_insert(4, "testvalue4", $id);

// dba_replace("key", "This is an example!", $id);

if (dba_exists(2, $id)) {
    echo dba_fetch(2,$id);
    dba_delete(2, $id);
}

dba_close($id);

function bdbInsert()
{
    echo "test";

}
