<?php
// รวมไฟล์การเชื่อมต่อฐานข้อมูลที่มีอยู่แล้ว
include_once 'connect.php';

// รับค่าทิศทางจาก POST request
$direction = isset($_POST['direction']) ? $_POST['direction'] : '';

if (!empty($direction)) {
    // เตรียมและดำเนินการคำสั่ง SQL
    $stmt = mysqli_prepare($connect, "INSERT INTO commands (direction, timestamp) VALUES (?, NOW())");
    mysqli_stmt_bind_param($stmt, "s", $direction);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    // ส่งผลลัพธ์กลับเป็น JSON
    echo json_encode(["status" => "success"]);
} else {
    // ส่งข้อความผิดพลาดถ้าไม่มีทิศทาง
    echo json_encode(["status" => "error", "message" => "No direction provided"]);
}
?>