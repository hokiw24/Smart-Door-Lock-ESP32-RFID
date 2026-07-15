<?php

$esp32 = "ONLINE";
$rfid = "CONNECTED";
$database = "ACTIVE";
$servo = "READY";

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Pengaturan Sistem</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:'Segoe UI', sans-serif;
    }

    body{
      background:#0f172a;
      color:white;
      display:flex;
    }

    .sidebar{
      width:260px;
      height:100vh;
      background:#111827;
      padding:25px;
      position:fixed;
      border-right:1px solid #1f2937;
    }

    .logo{
      font-size:28px;
      font-weight:bold;
      margin-bottom:40px;
      color:#60a5fa;
    }

    .menu a{
      display:flex;
      align-items:center;
      gap:12px;
      text-decoration:none;
      color:#cbd5e1;
      padding:14px;
      margin-bottom:12px;
      border-radius:12px;
      transition:0.3s;
    }

    .menu a:hover,
    .menu .active{
      background:#2563eb;
      color:white;
    }

    .main{
      margin-left:260px;
      width:calc(100% - 260px);
      padding:30px;
    }

    .title{
      margin-bottom:30px;
    }

    .title h1{
      font-size:36px;
      margin-bottom:8px;
    }

    .title p{
      color:#94a3b8;
    }

    .grid{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
      gap:25px;
    }

    .card{
      background:#111827;
      border:1px solid #1f2937;
      border-radius:20px;
      padding:25px;
      box-shadow:0 0 15px rgba(0,0,0,0.3);
    }

    .card h2{
      margin-bottom:20px;
      font-size:22px;
    }

    .status-item{
      display:flex;
      justify-content:space-between;
      margin-bottom:18px;
      padding-bottom:12px;
      border-bottom:1px solid #1f2937;
    }

    .online{
      color:#4ade80;
      font-weight:bold;
    }

    input{
      width:100%;
      padding:14px;
      margin-top:10px;
      margin-bottom:20px;
      border:none;
      border-radius:12px;
      background:#1f2937;
      color:white;
      font-size:15px;
    }

    button{
      background:#2563eb;
      color:white;
      border:none;
      padding:14px 20px;
      border-radius:12px;
      cursor:pointer;
      transition:0.3s;
      margin-right:10px;
      margin-top:10px;
    }

    button:hover{
      background:#1d4ed8;
    }

    .danger{
      background:#dc2626;
    }

    .danger:hover{
      background:#b91c1c;
    }

    .info{
      color:#94a3b8;
      line-height:1.8;
      margin-top:10px;
    }

  </style>

</head>

<body>



  <!-- SIDEBAR -->

  <div class="sidebar">

    <div class="logo">
      <i class="fa-solid fa-shield-halved"></i>
      SmartDoor
    </div>

    <div class="menu">

      <a href="index.php">
        <i class="fa-solid fa-chart-line"></i>
        Dashboard
      </a>

      <a href="users.php">
        <i class="fa-solid fa-users"></i>
        Data User RFID
      </a>

      <a href="logs.php">
        <i class="fa-solid fa-clock-rotate-left"></i>
        Log Akses
      </a>

      <a href="tambah.php">
        <i class="fa-solid fa-id-card"></i>
        Tambah Kartu
      </a>

      <a href="pengaturan.php" class="active">
        <i class="fa-solid fa-gear"></i>
        Pengaturan
      </a>

    </div>

  </div>



  <!-- MAIN -->

  <div class="main">

    <div class="title">

      <h1>Pengaturan Sistem</h1>

      <p>
        Konfigurasi Smart Door Lock RFID berbasis ESP32
      </p>

    </div>



    <div class="grid">

      <!-- STATUS DEVICE -->

      <div class="card">

        <h2>
          <i class="fa-solid fa-microchip"></i>
          Status Device
        </h2>

        <div class="status-item">
          <span>ESP32</span>
          <span class="online">
            <?php echo $esp32; ?>
          </span>
        </div>

        <div class="status-item">
          <span>RFID RC522</span>
          <span class="online">
            <?php echo $rfid; ?>
          </span>
        </div>

        <div class="status-item">
          <span>Database MySQL</span>
          <span class="online">
            <?php echo $database; ?>
          </span>
        </div>

        <div class="status-item">
          <span>Servo Door Lock</span>
          <span class="online">
            <?php echo $servo; ?>
          </span>
        </div>

      </div>



      <!-- PENGATURAN PINTU -->

      <div class="card">

        <h2>
          <i class="fa-solid fa-lock"></i>
          Pengaturan Pintu
        </h2>

        <label>Durasi Unlock Pintu</label>

        <input type="text" value="3 Detik">

        <label>Status Auto Lock</label>

        <input type="text" value="Aktif">

        <button>
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Pengaturan
        </button>

      </div>



      <!-- WIFI ESP32 -->

      <div class="card">

        <h2>
          <i class="fa-solid fa-wifi"></i>
          Koneksi WiFi ESP32
        </h2>

        <label>SSID WiFi</label>

        <input type="text" value="ehok">

        <label>IP Address ESP32</label>

        <input type="text" value="10.124.123.145">

        <button>
          <i class="fa-solid fa-wifi"></i>
          Update WiFi
        </button>

      </div>



      <!-- SYSTEM CONTROL -->

      <div class="card">

        <h2>
          <i class="fa-solid fa-screwdriver-wrench"></i>
          System Control
        </h2>

        <div class="info">

          • Restart sistem ESP32<br>

          • Reset histori log akses RFID<br>

          • Sinkronisasi database smart door

        </div>

        <button>
          <i class="fa-solid fa-rotate-right"></i>
          Restart ESP32
        </button>

        <button
        class="danger"
        onclick="resetLogs()">

          <i class="fa-solid fa-trash"></i>
          Reset Logs

        </button>

      </div>

    </div>

  </div>



  <!-- SCRIPT -->

  <script>

    function resetLogs(){

      if(confirm(
      "Yakin ingin menghapus semua log akses?"
      )){

        window.location.href =
        "reset_logs.php";

      }

    }

  </script>

</body>
</html>