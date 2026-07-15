<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Data User RFID</title>

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

    .table-header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }

    table{
      width:100%;
      border-collapse:collapse;
    }

    th, td{
      padding:16px;
      text-align:left;
      border-bottom:1px solid #1f2937;
    }

    th{
      color:#94a3b8;
    }

    .btn{
      background:#2563eb;
      color:white;
      border:none;
      padding:12px 18px;
      border-radius:10px;
      cursor:pointer;
    }

    .popup{
      position:fixed;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background:rgba(0,0,0,0.5);
      display:none;
      justify-content:center;
      align-items:center;
    }

    .popup-content{
      background:#111827;
      padding:30px;
      border-radius:20px;
      width:400px;
      border:1px solid #1f2937;
    }

    .popup-content h2{
      margin-bottom:20px;
    }

    .popup-content input{
      width:100%;
      padding:12px;
      margin-top:8px;
      margin-bottom:20px;
      border:none;
      border-radius:10px;
      background:#1f2937;
      color:white;
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

    <a href="users.php" class="active">
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

  <div class="table-box">

    <div class="table-header">

      <div>

        <h1>Data User RFID</h1>

        <p style="color:#94a3b8;margin-top:5px;">
          Daftar kartu RFID yang terdaftar
        </p>

      </div>

      <button class="btn"
      onclick="window.location.href='tambah.php'">

        <i class="fa-solid fa-plus"></i>
        Tambah User

      </button>

    </div>



    <table>

      <thead>

        <tr>

          <th>No</th>
          <th>Nama</th>
          <th>UID RFID</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Aksi</th>

        </tr>

      </thead>

      <tbody>

<?php

$no = 1;

$query = mysqli_query(
$conn,
"SELECT * FROM users ORDER BY id DESC"
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

<button

onclick="openEditPopup(

'<?php echo $data['id']; ?>',

'<?php echo $data['nama']; ?>',

'<?php echo $data['uid']; ?>'

)"

style="
background:#eab308;
color:black;
border:none;
padding:8px 14px;
border-radius:8px;
cursor:pointer;
margin-right:8px;
">

<i class="fa-solid fa-pen"></i>
Edit

</button>



<button

onclick="openDeletePopup(
'<?php echo $data['id']; ?>'
)"

style="
background:#dc2626;
color:white;
border:none;
padding:8px 14px;
border-radius:8px;
cursor:pointer;
">

<i class="fa-solid fa-trash"></i>
Hapus

</button>

  </td>

</tr>

<?php } ?>

      </tbody>

    </table>

  </div>

</div>



<!-- POPUP EDIT -->

<div id="editPopup" class="popup">

  <div class="popup-content">

    <h2>Edit User RFID</h2>

    <form action="edit_user.php" method="POST">

      <input
      type="hidden"
      id="edit_id"
      name="id">

      <label>Nama User</label>

      <input
      type="text"
      id="edit_nama"
      name="nama"
      required>

      <label>UID RFID</label>

      <input
      type="text"
      id="edit_uid"
      name="uid"
      required>

      <div style="display:flex;justify-content:flex-end;gap:10px;">

        <button
        type="button"
        onclick="closeEditPopup()"
        style="
        background:#374151;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        cursor:pointer;
        ">

          Batal

        </button>

        <button
        type="submit"
        style="
        background:#2563eb;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        cursor:pointer;
        ">

          Simpan

        </button>

      </div>

    </form>

  </div>

</div>



<!-- POPUP DELETE -->

<div id="deletePopup" class="popup">

  <div class="popup-content">

    <h2>Hapus User RFID?</h2>

    <p style="color:#94a3b8;margin-bottom:25px;">
      Data user akan dihapus permanen.
    </p>

    <form action="hapus_user.php" method="POST">

      <input
      type="hidden"
      id="delete_id"
      name="id">

      <div style="display:flex;justify-content:flex-end;gap:10px;">

        <button
        type="button"
        onclick="closeDeletePopup()"
        style="
        background:#374151;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        cursor:pointer;
        ">

          Batal

        </button>

        <button
        type="submit"
        style="
        background:#dc2626;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        cursor:pointer;
        ">

          Hapus

        </button>

      </div>

    </form>

  </div>

</div>



<script>

function openEditPopup(id,nama,uid){

  document.getElementById(
  "editPopup"
  ).style.display = "flex";

  document.getElementById(
  "edit_id"
  ).value = id;

  document.getElementById(
  "edit_nama"
  ).value = nama;

  document.getElementById(
  "edit_uid"
  ).value = uid;

}

function closeEditPopup(){

  document.getElementById(
  "editPopup"
  ).style.display = "none";

}

function openDeletePopup(id){

  document.getElementById(
  "deletePopup"
  ).style.display = "flex";

  document.getElementById(
  "delete_id"
  ).value = id;

}

function closeDeletePopup(){

  document.getElementById(
  "deletePopup"
  ).style.display = "none";

}

</script>

</body>
</html>