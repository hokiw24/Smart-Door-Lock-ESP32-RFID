<?php

include 'koneksi.php';

date_default_timezone_set("Asia/Jakarta");

$nama = $_POST['nama'];
$uid = $_POST['uid'];

$tanggal = date("Y-m-d");
$jam = date("H:i:s");

mysqli_query(
$conn,

"INSERT INTO users
(nama,uid,tanggal,jam)

VALUES

('$nama','$uid','$tanggal','$jam')"

);

header("Location: users.php");

?>