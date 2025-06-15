<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>เข้าสู่ระบบ</h2>
        <form action="process-login.php" method="POST">
            <div class="form-group">
                <label for="email_account">อีเมล</label>
                <input id="email_account" name="email_account" type="email" placeholder="อีเมล" required>
            </div>
            <div class="form-group">
                <label for="password_account">รหัสผ่าน</label>
                <input id="password_account" name="password_account" type="password" placeholder="รหัสผ่าน" required>
            </div>
            <button type="submit" class="button">เข้าสู่ระบบ</button>
            <div class="form-footer">
                <a href="form-register.php">สมัครสมาชิก</a>
            </div>
        </form>
    </div>
</body>
</html>