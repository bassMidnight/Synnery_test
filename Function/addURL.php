<?php 
    include('functions.php');
    $insertData = new DB_con();
    //------------ QRCODE ---------------//
    require_once '../phpqrcode/qrlib.php';
    $path = '../images/';
    $qrcode = $path.time().".png";
    $qrimage = time().".png";

    if(isset($_POST['full_URL']) && filter_var($_POST['full_URL'], FILTER_VALIDATE_URL)){
        
        $fetchData = new DB_con();
        $full_URL = $_POST['full_URL'];
        $ran_url;
        
        do {
            $ran_url = substr(md5(microtime()), rand(0, 26), 5);
            $fetchData_sql = $fetchData->fetchShortURL($ran_url);
        } while ($fetchData_sql->num_rows > 0);

        $insert_sql = $insertData->addURL($ran_url, $full_URL);
        if ($insert_sql) {
            // --------------- Call QR Function ----------------- //
            generate_QR($domain, $insertData, $qrcode, $ran_url, $qrimage);

            echo "<script>alert('Generate short success.');</script>";
            goIndex();
        }else{
            echo "<script>alert('Generate short fail.');</script>";
            goIndex();
        }
        echo "<script>alert('Generate short fail.');</script>";
        goIndex();
    }else {
        echo "<script>alert('Generate short fail.');</script>";
        goIndex();
    }

    function goIndex()
    {
        echo "<script>window.location.href='../'</script>";
    }

    function generate_QR($domain, $insertData, $qrcode, $qrtext, $qrimage)
    {   
        QRcode :: png($domain.$qrtext, $qrcode, 'H', 4, 4);
        $insertQR_sql = $insertData->addQR($qrtext, $qrimage);
        if($insertQR_sql)
        {
            echo "<script>alert('Generate QRCode success.');</script>";
        }else{
            echo "<script>alert('Generate QRCode fail.');</script>";
        }
    }
?>