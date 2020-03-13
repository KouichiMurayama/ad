<?php
namespace VC\AdDB;

class AdDB {

    public function __construct() {
        $host = "localhost";
        $user = 'root';
        $pass = 'root';
        $dbname = "VCAD";

        $this->con = mysqli_connect($host, $user, $pass, $dbname);
        if ( mysqli_connect_errno() ) {
            // 終了条件をパターンごとにわける？
            error_log("データベースに接続失敗". mysqli_connect_error() . "\n");
            return 1;
        }
    }

    public function __destruct() {
        if ( mysqli_connect_errno() ) {
        } else {
            mysqli_close($this->con);
        }
    }

    /**
     * 広告情報取得(API用)
     * return array
     */
    public function fetchAd( $pid ) {
        $stmt = $this->con->stmt_init();
        $query = 'SELECT * FROM AD_SPACE, AD WHERE AD_SPACE.OID = ? AND AD.OID = AD_SPACE.ADID';
        $stmt->prepare($query);
        $stmt->bind_param("i", $pid);
        $stmt->execute(); 
        $result = $stmt->get_result();
        foreach ( $result as $row ) {
            $org_data[] = $row;
        }
        $data = $org_data[0];
        // 画像出力の際に必要なMIME
        $MIMETypes = array(
            'png' => 'image/png',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif'
          );
        $data["MIME"] = $MIMETypes[$data["EXTENSION"]];
        // 出力のためのbase64エンコード
        $data["IMG_DATA"] = base64_encode($data['IMG_DATA']);
        $stmt->close();

        return $data;
    }
    /**
     * 広告スペース作成
     */
    public function insertAdSpace( $formData ) {
        $stmt = $this->con->stmt_init();
        $query = "INSERT INTO AD_SPACE VALUES(null, 'Y', ?, ?, now(), now())";
        $stmt->prepare($query);
        $stmt->bind_param("ii", $formData["adId"], $formData["asId"]);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $stmt->close();

        return;
    }
    /**
     * 広告作成
     */
    public function insertAd( $formData ) {
        $stmt = $this->con->stmt_init();
        $query = "INSERT INTO AD VALUES(null, 'Y', ?, ?, ?, ?, ?, ?, now(), now())";
        $stmt->prepare($query);
        $stmt->bind_param("isssss", $formData["ecId"], $formData["adName"], $formData["adUrl"], $formData["fileName"], $formData["extension"], $formData["raw_data"]);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $stmt->close();

        return;
    }
    /**
     * 広告一覧取得（広告入稿画面）
     */
    public function adList() {
        $query = "SELECT * FROM AD";
        if ( $result = mysqli_query( $this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        }

        return $data;
    }
    public function imgList() {
        $query = "SELECT IMG_DATA FROM AD";
        if ( $result = mysqli_query( $this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
        }

        return $data;
    }
    /**
     * 広告枠一覧取得（広告枠作成画面)
     */
    public function adSpaceList() {
        $query = "SELECT * FROM AD_SPACE";
        if ( $result = mysqli_query($this->con, $query) ) {
            foreach ( $result as $row ) {
                $data[] = $row;
            }
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
        }

        return $data;
    }
}