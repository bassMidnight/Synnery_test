<?php 
    if (isset($_GET['u'])) {
        # code...
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
</head>
<body>
    <h1 class="center">Gennerate Short URL</h1>
    <form class="center" action="Function/addURL.php" method="post">
        <label for="full_URL">ใส่ URL</label>
        <input type="text" name="full_URL" id="">
        <input type="submit" value="สร้าง Short URL">
        <input type="reset" value="ยกเลิก">
    </form>
    <a href=""></a>
</body>
</html>