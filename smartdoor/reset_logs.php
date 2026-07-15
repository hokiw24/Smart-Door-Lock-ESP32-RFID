<?php

include 'koneksi.php';

mysqli_query(
$conn,
"DELETE FROM logs"
);

header("Location: logs.php");

?>