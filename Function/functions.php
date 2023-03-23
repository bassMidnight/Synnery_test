<?php 
    //session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'db_shorturl');
    
    class DB_con {

        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            mysqli_set_charset($conn, "utf8");
            $this->dbcon = $conn;
            

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL : " . mysqli_connect_error();
            }
            return($this->dbcon);
        }

        

        function addURL($short_URL, $full_URL)
        {
            $result = mysqli_query($this->dbcon, "INSERT INTO tb_shorturl(su_short, su_full) VALUES('$short_URL', '$full_URL')");
            return $result;
        }

        function fetchShortURL_ID($id)
        {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tb_shorturl WHERE su_id = '$id'");
            return $result;
        }

        function fetchShortURL($short_URL)
        {
            $result = mysqli_query($this->dbcon, "SELECT su_full FROM tb_shorturl WHERE su_short = '$short_URL'");
            return $result;
        }

        function fetchAllURL()
        {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tb_shorturl");
            return $result;
        }

        function URLcounting($short_url)
        {
            $result = mysqli_query($this->dbcon, "SELECT su_clicked FROM tb_shorturl WHERE su_short = '$short_url'");
            $resultcount = mysqli_fetch_assoc($result);
            print_r($resultcount['su_clicked']);
            $count = $resultcount['su_clicked'];
            $count += 1;

            $result = mysqli_query($this->dbcon, "UPDATE tb_shorturl SET su_clicked = $count WHERE su_short = '$short_url'");
            return $result;
        }

        function deleteShortURL_ID($id)
        {
            $result = mysqli_query($this->dbcon, "DELETE FROM tb_shorturl WHERE su_id = '$id'");
            return $result;
        }

        public function fetchAllQR()
        {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tb_qrcode");
            return $result;
        }

        public function addQR($qrtext, $qrimage)
        {
            $result = mysqli_query($this->dbcon, "INSERT INTO tb_qrcode(qr_text, qr_image) VALUES('$qrtext', '$qrimage')");
            return $result;
        }

    }

?>