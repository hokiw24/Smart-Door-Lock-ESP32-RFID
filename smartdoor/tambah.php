<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Tambah Kartu RFID</title>

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

    .card{
      background:#111827;
      padding:30px;
      border-radius:20px;
      border:1px solid #1f2937;
      max-width:700px;
      box-shadow:0 0 15px rgba(0,0,0,0.3);
    }

    .card h1{
      margin-bottom:10px;
    }

    .card p{
      color:#94a3b8;
      margin-bottom:30px;
    }

    input{
      width:100%;
      padding:14px;
      margin-top:10px;
      margin-bottom:25px;
      border:none;
      border-radius:12px;
      background:#1f2937;
      color:white;
      font-size:15px;
    }

    .info{
      background:#0f172a;
      border:1px dashed #2563eb;
      padding:18px;
      border-radius:12px;
      line-height:1.8;
      color:#94a3b8;
      margin-bottom:25px;
    }

    button{
      background:#2563eb;
      color:white;
      border:none;
      padding:14px 20px;
      border-radius:12px;
      cursor:pointer;
      font-size:15px;
      transition:0.3s;
    }

    button:hover{
      background:#1d4ed8;
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

      <a href="tambah.php" class="active">
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

    <form class="card"
    action="simpan_user.php"
    method="POST">

      <h1>Tambah Kartu RFID</h1>

      <p>
        Tambahkan kartu RFID baru ke sistem smart door lock.
      </p>



      <label>Nama User</label>

      <input
      type="text"
      name="nama"
      placeholder="Masukkan nama user"
      required>



      <label>UID RFID</label>

      <input
      type="text"
      id="uid"
      name="uid"
      placeholder="Masukkan UID RFID"
      required>



      <div class="info">

        • Masukkan UID RFID secara manual<br>

        • Contoh UID : 59727<br>

        • Data akan disimpan ke database MySQL

      </div>



      <button type="submit">

        <i class="fa-solid fa-plus"></i>
        Simpan Kartu

      </button>

    </form>

  </div>

</body>
</html>