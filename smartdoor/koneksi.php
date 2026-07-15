<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "smartdoor_db"
);

if(!$conn){
    die("Koneksi gagal");
}

?>