<?php

include 'dbconn.php';

if (isset($_POST['regis'])) {
      

    // Mengambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $password = $_POST['password'];


    // Menyimpan data ke database
    $query = "INSERT INTO tbpelanggan (id_pelanggan, nama_pelanggan, email_pelanggan, alamat_pelanggan, no_hp, password) VALUES ('','$nama', '$email', '$alamat', '$nohp','$password')";
    $result = mysqli_query($connection, $query);

    // if ($result) {
    //   echo "Registrasi berhasil";
    // } else {
    //   echo "Registrasi gagal: ".mysqli_error($connection);
    // }

    mysqli_close($connection);
    echo "regis berhasil";
    echo '
    <script>
      alert("Registrasi Berhasil! Silahkan Login!");    
      location.replace("login.php");
    </script>
    ';    

} else {
  echo '<script>alert("gagal registrasi!");</script>';  
}





?>