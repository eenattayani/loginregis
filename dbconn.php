<?php
    // $servername = 'localhost'; 
    // $username = 'root'; 
    // $password = ''; 
    // $database = 'dbhokibeauty'; 

    $servername = 'localhost'; 
    $username = 'u420165457_root'; 
    $password = '>:zkpzavG8'; 
    $database = 'u420165457_dbhokibeauty'; 

    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
      die("Koneksi database gagal: ".mysqli_connect_error());
    }

    // echo "koneksi berhasil";

    // pass db hostinger: >:zkpzavG8
?>