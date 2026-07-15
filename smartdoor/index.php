<?php

include 'koneksi.php';



// TOTAL USER RFID

$total_user = mysqli_num_rows(

mysqli_query(
$conn,
"SELECT * FROM users"

)

);



// TOTAL LOG AKSES

$total_akses = mysqli_num_rows(

mysqli_query(
$conn,
"SELECT * FROM logs"

)

);



// TOTAL DITERIMA

$total_diterima = mysqli_num_rows(

mysqli_query(
$conn,
"SELECT * FROM logs
WHERE status='Diterima'"

)

);



// TOTAL DITOLAK

$total_ditolak = mysqli_num_rows(

mysqli_query(
$conn,
"SELECT * FROM logs
WHERE status='Ditolak'"

)

);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Smart Door Dashboard</title>

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
      left:0;
      top:0;
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

    .topbar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:30px;
    }

    .topbar h1{
      font-size:32px;
    }

    .status{
      background:#14532d;
      color:#86efac;
      padding:10px 18px;
      border-radius:12px;
      border:1px solid #22c55e;
    }

    .cards{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
      gap:20px;
      margin-bottom:30px;
    }

    .card{
      background:#111827;
      padding:25px;
      border-radius:20px;
      border:1px solid #1f2937;
      box-shadow:0 0 15px rgba(0,0,0,0.3);
    }

    .card h3{
      color:#94a3b8;
      margin-bottom:15px;
      font-size:16px;
    }

    .card p{
      font-size:42px;
      font-weight:bold;
    }

    .table-box{
      background:#111827;
      padding:25px;
      border-radius:20px;
      border:1px solid #1f2937;
      box-shadow:0 0 15px rgba(0,0,0,0.3);
    }

    .table-header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }

    .btn{
      background:#2563eb;
      color:white;
      padding:12px 18px;
      border:none;
      border-radius:10px;
      cursor:pointer;
      transition:0.3s;
    }

    .btn:hover{
      background:#1d4ed8;
    }

    .footer{
      position:fixed;
      bottom:10px;
      right:20px;
      color:#94a3b8;
      font-size:14px;
      text-align:right;
      line-height:1.7;
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

    <a href="index.php" class="active">
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

    <a href="pengaturan.php">
      <i class="fa-solid fa-gear"></i>
      Pengaturan
    </a>

  </div>

</div>



<!-- MAIN -->

<div class="main">

  <!-- TOPBAR -->

  <div class="topbar">

    <div>

      <h1>Dashboard Smart Door Lock</h1>

      <p style="color:#94a3b8;margin-top:5px;">
        Monitoring akses RFID berbasis ESP32
      </p>

    </div>

    <div class="status">

      <i class="fa-solid fa-circle"></i>
      System Online

    </div>

  </div>



  <!-- CARDS -->

  <div class="cards">

    <div class="card">

      <h3>Total User RFID</h3>

      <p style="color:#60a5fa;">
        <?php echo $total_user; ?>
      </p>

    </div>



    <div class="card">

      <h3>Akses Hari Ini</h3>

      <p style="color:#facc15;">
        <?php echo $total_akses; ?>
      </p>

    </div>



    <div class="card">

      <h3>Akses Diterima</h3>

      <p style="color:#4ade80;">
        <?php echo $total_diterima; ?>
      </p>

    </div>



    <div class="card">

      <h3>Akses Ditolak</h3>

      <p style="color:#f87171;">
        <?php echo $total_ditolak; ?>
      </p>

    </div>

  </div>



  <!-- INFORMASI SISTEM -->

  <div class="table-box">

    <div class="table-header">

      <div>

        <h2>Informasi Sistem</h2>

        <p style="color:#94a3b8;margin-top:5px;">
          Sistem Smart Door Lock berbasis RFID dan ESP32 sedang aktif.
        </p>

      </div>

      <button class="btn">

        <i class="fa-solid fa-shield"></i>
        Monitoring Aktif

      </button>

    </div>



    <div style="margin-top:20px;line-height:2;color:#cbd5e1;">

      <p>• Sistem terhubung dengan ESP32 dan RFID RC522</p>

      <p>• Database user RFID tersimpan pada MySQL</p>

      <p>• Dashboard digunakan untuk monitoring akses pintu</p>

      <p>• Servo digunakan sebagai aktuator pengunci pintu</p>

    </div>

  </div>

</div>


</body>
</html>