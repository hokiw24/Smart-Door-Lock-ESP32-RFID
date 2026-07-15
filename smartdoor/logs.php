<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log Akses RFID</title>
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

    .table-box{
      background:#111827;
      padding:25px;
      border-radius:20px;
      border:1px solid #1f2937;
    }

    table{
      width:100%;
      border-collapse:collapse;
      margin-top:20px;
    }

    th, td{
      padding:16px;
      border-bottom:1px solid #1f2937;
      text-align:left;
    }

    th{
      color:#94a3b8;
    }

    .accepted{
      background:#14532d;
      color:#86efac;
      padding:6px 12px;
      border-radius:20px;
      display:inline-block;
    }

    .rejected{
      background:#7f1d1d;
      color:#fca5a5;
      padding:6px 12px;
      border-radius:20px;
      display:inline-block;
    }
  </style>
</head>
<body>

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

    <a href="logs.php" class="active">
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

<div class="main">

  <div class="table-box">
    <h1>Log Akses RFID</h1>
    <p style="color:#94a3b8;margin-top:5px;">
      Histori akses masuk pengguna RFID
    </p>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>UID RFID</th>
          <th>Tanggal Daftar</th>
          <th>Jam</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>

<?php

include 'koneksi.php';

$no = 1;

$query = mysqli_query(
$conn,
"SELECT * FROM logs ORDER BY id DESC"
);

while($data = mysqli_fetch_assoc($query)){

?>

<tr>

  <td><?php echo $no++; ?></td>

  <td><?php echo $data['nama']; ?></td>

  <td><?php echo $data['uid']; ?></td>

  <td><?php echo $data['tanggal']; ?></td>

  <td><?php echo $data['jam']; ?></td>

  <td>

<?php if($data['status']=="Diterima"){ ?>

<span class="accepted">
  Diterima
</span>

<?php } else { ?>

<span class="rejected">
  Ditolak
</span>

<?php } ?>

  </td>

</tr>

<?php } ?>

</tbody>
    </table>

  </div>

</div>

  <!-- POPUP EDIT USER -->
  <div style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#111827;padding:30px;border-radius:20px;border:1px solid #1f2937;width:400px;box-shadow:0 0 30px rgba(0,0,0,0.5);display:none;" id="editPopup">

    <h2 style="margin-bottom:20px;">Edit User RFID</h2>

    <label>Nama User</label>
    <input type="text" value="Hoki" style="width:100%;padding:12px;margin-top:8px;margin-bottom:20px;border:none;border-radius:10px;background:#1f2937;color:white;">

    <label>UID RFID</label>
    <input type="text" value="A1 B2 C3 D4" style="width:100%;padding:12px;margin-top:8px;margin-bottom:20px;border:none;border-radius:10px;background:#1f2937;color:white;">

    <div style="display:flex;justify-content:flex-end;gap:10px;">
      <button style="background:#374151;color:white;border:none;padding:10px 18px;border-radius:10px;cursor:pointer;">
        Batal
      </button>

      <button style="background:#2563eb;color:white;border:none;padding:10px 18px;border-radius:10px;cursor:pointer;">
        Simpan
      </button>
    </div>
  </div>


  <!-- POPUP HAPUS USER -->
  <div style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#111827;padding:30px;border-radius:20px;border:1px solid #1f2937;width:380px;box-shadow:0 0 30px rgba(0,0,0,0.5);display:none;" id="deletePopup">

    <div style="text-align:center;">
      <i class="fa-solid fa-triangle-exclamation" style="font-size:50px;color:#f87171;margin-bottom:20px;"></i>

      <h2>Hapus User RFID?</h2>

      <p style="color:#94a3b8;margin-top:10px;line-height:1.7;">
        Data user dan UID RFID akan dihapus dari sistem.
      </p>

      <div style="display:flex;justify-content:center;gap:15px;margin-top:25px;">

        <button style="background:#374151;color:white;border:none;padding:12px 20px;border-radius:10px;cursor:pointer;">
          Batal
        </button>

        <button style="background:#dc2626;color:white;border:none;padding:12px 20px;border-radius:10px;cursor:pointer;">
          Hapus
        </button>

      </div>
    </div>
  </div>

  <script>

    function openEditPopup(){
      document.getElementById('editPopup').style.display = 'block';
    }

    function openDeletePopup(){
      document.getElementById('deletePopup').style.display = 'block';
    }

    function closeEditPopup(){
      document.getElementById('editPopup').style.display = 'none';
    }

    function closeDeletePopup(){
      document.getElementById('deletePopup').style.display = 'none';
    }

  </script>

</body>
</html>