<?php

include 'koneksi.php';

$uid = $_POST['uid'];

mysqli_query(
$conn,
"INSERT INTO temp_uid(uid)
VALUES('$uid')"
);

echo "success";

?>