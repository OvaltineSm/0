<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัคร</title>
</head>
<body>
    <h1>ลงทะเบียน</h1>
    <form action="process-register.php" method="post">
        <div>
            <input name= "username_account" type="text" placeholder="ชื่อผู้ใช้" required>
        </div>
        <div>
            <input name= "email_account" type="email" placeholder="อีเมล" required>  
        </div>
        <div>
            <input name= "password_account1" type="password" placeholder="รหัสผ่าน" required>
        </div>
        <div>
            <input name= "password_account2" type="password" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <div>
            <button type="submit">สร้างบัญชี</button>
            <a href="form-login.php">มีบัญชีแล้วใช่ไหม</a>
    </form>
</body>
</html>