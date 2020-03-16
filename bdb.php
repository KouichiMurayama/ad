<?php
namespace VC\Bdb;

class Bdb
{
    public function __construct()
    {
        $db = "bdb.db";
        $this->id = dba_open($db, "r", "db4");
        if (!$this->id) {
            echo "dba_open failed\n";
            exit;
        }
    }

    public function __destruct()
    {

    }

    /**
     * keyに対応するvalueを返す
     */
    function fetchValue($key)
    {
        if ( dba_exists($key, $this->id) ){
            $value = dba_fetch($key, $this->id);

            dba_close($this->id);

            return $value;
        } else {
            // TODO: keyが存在しない場合のエラー処理
            exit;
        }
    }
}
