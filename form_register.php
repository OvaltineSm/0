<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัคร</title>
    <style>
    body {
      background: #f4f6fb;
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: #fff;
      max-width: 90%; /* ปรับเป็น % */
      width: 400px; /* กำหนดความกว้าง */
      margin: 20px; /* ลด margin */
      padding: 32px 24px;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #2d3a4b;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: #2d3a4b;
      font-weight: 500;
    }

    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="email"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d9e6;
      border-radius: 6px;
      font-size: 16px;
      background: #f8fafc;
      transition: border 0.2s;
      box-sizing: border-box;
    }

    .form-group input:focus {
      border-color: #4f8cff;
      outline: none;
    }

    .button {
      width: 100%;
      padding: 12px;
      background: #4f8cff;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
      margin-top: 8px;
    }

    .button:hover {
      background: #2563eb;
    }

    .form-footer {
      text-align: center;
      margin-top: 18px;
      color: #6b7280;
      font-size: 14px;
    }

    /* Media query สำหรับหน้าจอขนาดเล็ก */
    @media (max-width: 576px) {
      .form-container {
        padding: 24px 16px; /* ลด padding */
        max-width: 95%; /* ขยายความกว้าง */
        width: 95%; /* ให้ปรับตามขนาดหน้าจอ */
        margin: 10px; /* ชิดขอบน้อยลง */
      }
    }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>ลงทะเบียน</h2>
        <form action="process_register.php" method="post">
            <div class="form-group">
                <input name="username_account" type="text" placeholder="ชื่อผู้ใช้" required>
            </div>
            <div class="form-group">
                <input name="email_account" type="email" placeholder="อีเมล" required>  
            </div>
            <div class="form-group">
                <input name="password_account1" type="password" placeholder="รหัสผ่าน" required>
            </div>
            <div class="form-group">
                <input name="password_account2" type="password" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
            <button type="submit" class="button">สร้างบัญชี</button>
            <div class="form-footer">
                <a href="form_login.php">มีบัญชีแล้วใช่ไหม</a>
            </div>
        </form>
    </div>
</body>
</html>