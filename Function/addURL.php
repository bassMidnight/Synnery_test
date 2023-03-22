<?php 
    include('functions.php');
    if(isset($_POST['full_URL']) && filter_var($_POST['full_URL'], FILTER_VALIDATE_URL)){
        
        $fetchData = new DB_con();
        $full_URL = $_POST['full_URL'];
        $ran_url;
        
        do {
            $ran_url = substr(md5(microtime()), rand(0, 26), 5);
            $fetchData_sql = $fetchData->fetchShortURL($ran_url);
        } while ($fetchData_sql->num_rows > 0);

        $insertData = new DB_con();
        $insert_sql = $insertData->addURL($ran_url, $full_URL);
        if ($insert_sql) {
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
?>