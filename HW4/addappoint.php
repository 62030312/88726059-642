<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    //$aid = $_POST['aid'];
    $anum = $_POST['anum'];
    $ati = $_POST['ati'];
    $astd= $_POST['astd'];
    $atd = $_POST['atd'];
    $ast = $_POST['ast'];
    $afn = $_POST['afn'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO documents (id, doc_num, doc_title, doc_start_date	, doc_to_date, doc_status, doc_file_name )
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issssss",$aid, $anum, $ati, $astd, $atd, $ast ,$afn);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: appoint.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>addappoint</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1><a href='appoint.php'><span class='glyphicon glyphicon-arrow-left'></span></a> | เพิ่มคำสั่งการแต่งตั้ง</h1>
        <form action="addappoint.php" method="post">
            <!-- <div class="form-group">
                <label for="aid">รหัส</label>
                <input type="text" class="form-control" name="aid" id="aid">
            </div> -->
            <div class="form-group">
                <label for="anum">เลขที่คำสั่ง</label>
                <input type="text" class="form-control" name="anum" id="anum">
            </div>
            <div class="form-group">
                <label for="ati">ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="ati" id="ati">
            </div>
            <div class="form-group">
                <label for="astd">วันที่เริ่มต้นคำสั่ง</label>
                <input type="date" class="form-control" name="astd" id="astd">
            </div>
            <div class="form-group">
                <label for="atd">วันสิ้นสุด</label>
                <input type="date" class="form-control" name="atd" id="atd">
            </div>
            <div class="form-group">
                <label for="ast">สถานะ</label>
                <input type="text" class="form-control" name="ast" id="ast">
            </div>
            <div class="form-group">
                <label for="afn">ชื่อไฟล์เอกสาร</label>
                <input type="text" class="form-control" name="afn" id="afn">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>