<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dpad Realtime Report (Holdable)</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6fb;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .dpad-container {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .dpad-row {
      display: flex;
      justify-content: center;
    }
    .dpad-btn {
      width: 60px;
      height: 60px;
      margin: 5px;
      background: #4f8cff;
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      user-select: none;
      display: flex; /* เพิ่ม */
      justify-content: center; /* เพิ่ม */
      align-items: center; /* เพิ่ม */
    }
    .dpad-btn:active {
      background: #2563eb;
    }
    .report-container {
      margin-top: 32px;
      width: 320px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      padding: 16px;
      /* ไม่ต้อง fixed */
    }
    .report-title {
      font-weight: bold;
      margin-bottom: 8px;
      color: #2d3a4b;
    }
    .report-log {
      font-size: 16px;
      color: #333;
      height: 160px; /* fix ความสูง */
      overflow-y: auto;
      background: #f8fafc;
      border-radius: 6px;
      padding: 8px;
    }
    @media (max-width: 576px) {
      .report-container {
        width: 95%;
        padding: 12px;
      }
      .dpad-btn {
        width: 60px;
        height: 60px;
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
  <div class="dpad-container">
    <div class="dpad-row">
      <button class="dpad-btn" data-dir="up">▲</button>
    </div>
    <div class="dpad-row">
      <button class="dpad-btn" data-dir="left">◀</button>
      <button class="dpad-btn" data-dir="down">▼</button>
      <button class="dpad-btn" data-dir="right">▶</button>
    </div>
  </div>
  <div class="report-container">
    <div class="report-title">Realtime Report</div>
    <div class="report-log" id="reportLog"></div>
  </div>
  <div><a href="form-login.php">กลับไปยังหน้า Login</a></div>
  <script>
    const reportLog = document.getElementById('reportLog');
    function addLog(direction) {
      const now = new Date();
      const time = now.toLocaleTimeString();
      const text = `[${time}] กดปุ่ม: ${direction}`;
      reportLog.innerHTML = text + '<br>' + reportLog.innerHTML;
    }

    // Map direction to text
    function getDirText(dir) {
      switch(dir) {
        case 'up': return 'ขึ้น (UP)';
        case 'down': return 'ลง (DOWN)';
        case 'left': return 'ซ้าย (LEFT)';
        case 'right': return 'ขวา (RIGHT)';
        default: return dir;
      }
    }

    // กดค้าง
    document.querySelectorAll('.dpad-btn').forEach(btn => {
      let intervalId = null;

      const start = () => {
        const dir = btn.getAttribute('data-dir');
        addLog(getDirText(dir));
        intervalId = setInterval(() => {
          addLog(getDirText(dir));
        }, 200);
      };

      const stop = () => {
        clearInterval(intervalId);
        intervalId = null;
      };

      // Mouse events
      btn.addEventListener('mousedown', start);
      btn.addEventListener('mouseup', stop);
      btn.addEventListener('mouseleave', stop);

      // Touch events (มือถือ)
      btn.addEventListener('touchstart', (e) => {
        e.preventDefault();
        start();
      });
      btn.addEventListener('touchend', stop);
      btn.addEventListener('touchcancel', stop);
    });
  </script>
</body>
</html>