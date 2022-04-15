<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $aid = $_POST['aid'];
    $anum = $_POST['anum'];
    $ati = $_POST['ati'];
    $astd= $_POST['astd'];
    $atd = $_POST['atd'];
    $ast = $_POST['ast'];
    $afn = $_POST['afn'];
    

    $sql = "UPDATE documents
            SET doc_num = ?,
                doc_title = ?,
                doc_start_date = ?,
                doc_to_date = ?,
                doc_status = ?, 
                doc_file_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssi", $anum, $ati, $astd, $atd, $ast ,$afn ,$aid);
    $stmt->execute();

    header("location: appoint.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>editappoint</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1><a href='appoint.php'><span class='glyphicon glyphicon-arrow-left'></span></a> | แก้ไขการแต่งตั้ง </h1>
        <form action="editappoint.php" method="post">
       <!-- <div class="form-group">
                <label for="aid">id</label>
                <input type="int" class="form-control" name="aid" id="aid" value="<?php echo $row->id;?>">
            </div>  -->
            <div class="form-group">
                <label for="anum">เลขที่คำสั่ง</label>
                <input type="text" class="form-control" name="anum" id="anum" value="<?php echo $row->doc_num;?>">
            </div>
            <div class="form-group">
                <label for="ati">ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="ati" id="ati" value="<?php echo $row->doc_title;?>">
            </div>
            <div class="form-group">
                <label for="astd">วันที่เริ่มต้นคำสั่ง</label>
                <input type="date" class="form-control" name="astd" id="astd" value="<?php echo $row->doc_start_date;?>">
            </div>
            <div class="form-group">
                <label for="atd">วันสิ้นสุด</label>
                <input type="date" class="form-control" name="atd" id="atd" value="<?php echo $row->doc_to_date;?>">
            </div>
            <div class="form-group">
                <label for="ast">สถานะ</label>
                <input type="text" class="form-control" name="ast" id="ast" value="<?php echo $row->doc_status;?>">
            </div>
            <div class="form-group">
                <label for="afn">ชื่อไฟล์เอกสาร</label>
                <input type="text" class="form-control" name="afn" id="afn" value="<?php echo $row->doc_file_name;?>">
            </div>
            <input type="hidden" name="aid" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>