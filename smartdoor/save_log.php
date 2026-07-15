<?php

include 'koneksi.php';

$uid = $_POST['uid'];

date_default_timezone_set("Asia/Jakarta");

$tanggal = date("Y-m-d");

$jam = date("H:i:s");



// CEK UID

$query = mysqli_query(
$conn,
"SELECT * FROM users WHERE uid='$uid'"
);



// JIKA UID TERDAFTAR

if(mysqli_num_rows($query) > 0){

    $data = mysqli_fetch_assoc($query);

    $nama = $data['nama'];

    $status = "Diterima";

}



// JIKA UID TIDAK TERDAFTAR

else{

    $nama = "Unknown";

    $status = "Ditolak";

}



// SIMPAN LOG

mysqli_query(

$conn,

"INSERT INTO logs
(nama, uid, tanggal, jam, status)

VALUES

('$nama','$uid','$tanggal','$jam','$status')"

);



// RESPONSE KE ESP32

if($status == "Diterima"){

    echo "valid";

}

else{

    echo "invalid";

}

?>