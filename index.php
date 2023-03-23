<?php 
    include('Function/functions.php');
    $fecthData = new DB_con;
    if (isset($_GET) && !empty($_GET)) {
        foreach ($_GET as $key => $value) {
            $u = $fecthData->dbcon->real_escape_string($key);
            $new_url = str_replace('/', '', $u);
        }

        $fecthURL_sql = $fecthData->fetchShortURL($new_url);
        if($fecthURL_sql->num_rows > 0){
            $full_url = mysqli_fetch_assoc($fecthURL_sql);
            $counting_sql = $fecthData->URLcounting($new_url);
            header("Location:".$full_url['su_full']);
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short URL Gennerator </title>
    <style>
        .center {
            margin: auto;
            width: 70%;
            padding: 10px;
        }

    </style>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="center">
        <h1>Gennerate Short URL</h1>
        <div class="mb-3">
            <form action="Function/addURL.php" method="post">
                <div class="mb-3 row"> 
                    <label for="full_URL" class="form-label">ระบุ URL</label>
                    <input type="text" name="full_URL" class="form-control" placeholder="ระบุ URL">
                </div>
                <div class="mb-3">
                    <input type="submit" value="สร้าง Short URL" class="btn btn-primary mb-3">
                    <input type="reset" value="ยกเลิก" class="btn btn-secondary mb-3">
                </div>
            </form>
        </div>
        <table class="table table-striped">
            <tr >
                <th>short URL</th>
                <th>full URL</th>
                <th>Detail</th>
            </tr>
            <?php
            $fecthURLtable = $fecthData->fetchAllURL();
            while ($data = mysqli_fetch_array($fecthURLtable)) {
            ?>
            <tr>
                <td>
                    <a href="<?php echo $domain.$data['su_short'] ?>" target="_blank">
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
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QRModal<?= $data['su_id']?>">
                        แสดงรายละเอียด
                    </button>
                </td>
            </tr>
            <?php } ?>
        </table>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#adminModal">
        เข้าสู่หน้าผู้ดูแล
        </button>
    </div>

    <div class="modal" tabindex="-1" id="adminModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เข้าสู่หน้าผู้ดูแล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="ใส่รหัสผ่าน" id="adminPassword" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button class="btn btn-primary" onclick="addminPage()">ยืนยัน</button>
            </div>
            </div>
        </div>
    </div>

    <?php
    $fecthURLtable = $fecthData->fetchAllQR();
    while ($QR_data = mysqli_fetch_array($fecthURLtable)) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="QRModal<?= $QR_data['qr_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูล QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?php echo 'images/'.$QR_data['qr_image']?>" alt="">
                <p>ลิ้งค์ : <a href="<?php echo $QR_data['qr_text']?>" target="_blank"><?php echo $domain.$QR_data['qr_text']?></a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <script>
        function addminPage(){
            let password = document.getElementById("adminPassword").value;
            if (password === "admin") {
                window.location.href = "admin.php";
            }else{
                alert('รหสัผ่านผิด');
                window.location.href = "";
            }
            
        }
    </script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
</body>
</html>