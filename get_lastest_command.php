<?php
// รวมไฟล์การเชื่อมต่อฐานข้อมูลที่มีอยู่แล้ว
include_once 'connect.php';

// ดึงคำสั่งล่าสุด
$sql = "SELECT direction, timestamp FROM commands ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    // มีคำสั่ง ส่งกลับเป็น JSON
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    // ไม่มีคำสั่ง
    echo json_encode(["status" => "no_commands"]);
}
?>