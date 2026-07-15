<?php

include "koneksi.php";

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE uid='$uid'"
);

if(mysqli_num_rows($query) > 0){

    $data = mysqli_fetch_assoc($query);

    mysqli_query(
        $conn,
        "INSERT INTO logs(uid, hasil)
        VALUES('$uid', 'diterima')"
    );

    echo json_encode([
        "status" => "valid",
        "nama" => $data['nama']
    ]);

}else{

    mysqli_query(
        $conn,
        "INSERT INTO logs(uid, hasil)
        VALUES('$uid', 'ditolak')"
    );

    echo json_encode([
        "status" => "invalid"
    ]);
}

?>