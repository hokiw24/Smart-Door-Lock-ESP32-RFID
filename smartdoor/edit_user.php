<?php

include 'koneksi.php';

$id = $_POST['id'];

$nama = $_POST['nama'];

$uid = $_POST['uid'];

mysqli_query(
$conn,

"UPDATE users SET

nama='$nama',
uid='$uid'

WHERE id='$id'"

);

header("Location: users.php");

?>