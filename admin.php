<?php 
	error_reporting(0);
    include('Function/functions.php');
    $fecthData = new DB_con;
    if(isset($_REQUEST) && !empty($_REQUEST)){
        foreach ($_REQUEST as $key => $value) {
            $short = $_REQUEST[$key];
			$deleteImage_sql = $fecthData->fetchQRimage_short($short);
			$deleteImage_target = mysqli_fetch_assoc($deleteImage_sql);
			echo $deleteImage_target['qr_image'];
			unlink("images/".$deleteImage_target['qr_image']);
            $deleteURL_sql = $fecthData->deleteShortURL_ID($short);
			$deleteQR_sql = $fecthData->deleteQR_ID($short);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
	<link rel="icon" type="image/x-icon" href="knight.ico">
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
        <h1>ตารางแสดง URL ทั้งหมด</h1>
        <table class="table table-striped">
            <tr >
                <th>short URL</th>
                <th>full URL</th>
                <th>clicked</th>
				<th>create date</th>
				<th>Detail</th>
                <th>Delete</th>
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
                <td><?= $data['su_clicked']?></td>
				<td><?= $data['su_time']?></td>
				<td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QRModal<?= $data['su_id']?>">
							แสดงรายละเอียด
                    </button>
                </td>
                <td><form action="" method="get">
                    <input type="hidden" name="short" value="<?= $data['su_short']?>">
                    <button class="fa-solid fa-trash" style="color: #ff0000;"></button></form>
				</td>
				
            </tr>
            <?php } ?>
        </table>
        <a href="<?= $domain ?>"><button type="button" class="btn btn-success">กลับสู่หน้าหลัก</button></a>
        
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
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
    <script src="https://kit.fontawesome.com/9f4bd1ad40.js" crossorigin="anonymous"></script>
</body>
</html>