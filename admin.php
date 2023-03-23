<?php 
    include('Function/functions.php');
    $fecthData = new DB_con;
    if(isset($_REQUEST) && !empty($_REQUEST)){
        foreach ($_REQUEST as $key => $value) {
            $id = $_REQUEST[$key];
            $deleteURL_sql = $fecthData->deleteShortURL_ID($id);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
        }

    </style>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
    <div class="center">
        <h1>ตารางแสดง URL ทั้งหมด</h1>
        <table class="table table-striped">
            <tr >
                <th>short URL</th>
                <th>full URL</th>
                <th>clicked</th>
                <th>Delete</th>
            </tr>
            <?php
            $fecthURLtable = $fecthData->fetchAllURL();
            while ($data = mysqli_fetch_array($fecthURLtable)) {
            ?>
            <tr>
                <td>
                    <a href="http://localhost/Short_URL/JigsawGroups_test/<?= $data['su_short'] ?>" target="_blank">
                    <?= $data['su_short'] ?>
                    </a>
                </td>
                <td>
                    <?php 
                    if (strlen($data['su_full']) > 35) {
                        echo substr($data['su_full'], 0, 35)."...";
                    }else{
                        echo $data['su_full'];
                    }
                    ?>
                </td>
                <td><?= $data['su_clicked']?></td>
                <td><form action="" method="get">
                    <input type="hidden" name="id" value="<?= $data['su_id']?>">
                    <button class="fa-solid fa-trash" style="color: #ff0000;"></button></form></td>
            </tr>
            <?php } ?>
        </table>
        <a href="http://localhost/Short_URL/JigsawGroups_test/"><button type="button" class="btn btn-success">กลับสู่หน้าหลัก</button></a>
        
    </div>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
    <script src="https://kit.fontawesome.com/9f4bd1ad40.js" crossorigin="anonymous"></script>
</body>
</html>