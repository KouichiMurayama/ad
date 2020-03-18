<?php
namespace VC\AdDB;

class AdDB {

    public function __construct() {
        $host = "localhost";
        $user = 'root';
        $pass = 'root';
        $dbname = "VCAD";

        $this->con = mysqli_connect($host, $user, $pass, $dbname);
        if ( !mysqli_connect_errno() ) {
            // TODO:データベース接続失敗時エラー
            error_log("database connect error". mysqli_connect_error() . "\n");
            echo "データベースに接続できませんでした";
            return;
        }

        return;
    }

    public function __destruct() {
        if ( !mysqli_connect_errno() ) {
            mysqli_close($this->con);
        }

        return;
    }

    /**
     * 広告情報全件取得
     * return array
     */
    public function fetchAd()
    {
        $query = 'SELECT AD_SPACE.OID, AD_SPACE.ASID, AD_SPACE.ADID, AD.URL, AD.IMG_NAME, AD.EXTENSION, AD.IMG_DATA FROM AD_SPACE, AD WHERE AD.OID = AD_SPACE.ADID';
        if ( $result = mysqli_query($this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }

            return $data;
        } else {
            error_log("database fetchAd() error". mysqli_connect_error() . "\n");
            exit;
        }
    }
    /**
     * 広告スペース作成
     */
    public function insertAdSpace( $formData )
    {
        try {
            $stmt = $this->con->stmt_init();
            $query = "INSERT INTO AD_SPACE VALUES(null, 'Y', ?, ?, now(), now())";
            $stmt->prepare($query);
            $stmt->bind_param("ii", $formData["adId"], $formData["asId"]);
            $stmt->execute(); 
            $result = $stmt->get_result();
            $stmt->close();

            return;
        } catch(Exception $e) {
            error_log($e->getMessage());
            exit;
        }
    }
    /**
     * 広告作成
     */
    public function insertAd( $formData )
    {
        try {
            $stmt = $this->con->stmt_init();
            $query = "INSERT INTO AD VALUES(null, 'Y', ?, ?, ?, ?, ?, ?, now(), now())";
            $stmt->prepare($query);
            $stmt->bind_param("isssss", $formData["ecId"], $formData["adName"], $formData["adUrl"], $formData["fileName"], $formData["extension"], $formData["raw_data"]);
            $stmt->execute(); 
            $result = $stmt->get_result();
            $stmt->close();

            return;
        } catch(Exception $e) {
            error_log($e->getMessage());
            exit;
        }
    }
    /**
     * 広告一覧取得（広告入稿画面）
     */
    public function adList()
    {
        $query = "SELECT * FROM AD";
        if ( $result = mysqli_query( $this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        } else {
            error_log("database adList() error");
            exit;
        }

        return $data;
    }

    /**
     * 
     */
    public function imgList()
    {
        $query = "SELECT IMG_DATA FROM AD";
        if ( $result = mysqli_query( $this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        } else {
            error_log("database imgList() error");
            exit;
        }

        return $data;
    }

    /**
     * 広告枠一覧取得（広告枠作成画面)
     */
    public function adSpaceList()
    {
        $query = "SELECT * FROM AD_SPACE";
        if ( $result = mysqli_query($this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        } else {
            error_log("database adSpaceList() error");
            exit;
        }

        return $data;
    }

    /**
     * ECサイト一覧取得(フォーム用)
     */
    public function ecList() {
        $query = "SELECT OID FROM EC_SITE";
        if ( $result = mysqli_query($this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        } else {
            error_log("database ecList() error");
            exit;
        }

        return $data;
    }

    /**
     * ASサイト一覧取得(フォーム用)
     */
    public function asList() {
        $query = "SELECT OID FROM AFFIL_SITE";
        if ( $result = mysqli_query($this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        } else {
            error_log("database asList() error");
            exit;
        }

        return $data;
    }
}