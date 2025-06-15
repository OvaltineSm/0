<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
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
          max-width: 90%;
          width: 400px;
          margin: 20px;
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

        @media (max-width: 576px) {
          .form-container {
            padding: 24px 16px;
            max-width: 95%;
            width: 95%;
            margin: 10px;
          }
        }
    </style>
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