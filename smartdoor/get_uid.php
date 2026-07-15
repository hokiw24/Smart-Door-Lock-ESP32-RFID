<?php

include 'koneksi.php';

$query = mysqli_query(
$conn,
"SELECT uid FROM temp_uid ORDER BY id DESC LIMIT 1"
);

$data = mysqli_fetch_assoc($query);

if($data){

    echo $data['uid'];

}

else{

    echo "";

}

?>