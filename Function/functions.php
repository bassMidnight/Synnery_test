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
            $result = mysqli_query($this->dbcon, "SELECT * FROM tb_shorturl WHERE su_short = '$short_URL'");
            return $result;
        }

        function fetchAllURL()
        {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tb_shorturl");
            return $result;
        }

    }

?>