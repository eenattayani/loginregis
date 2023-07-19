<?php

include 'dbconn.php';

if (isset($_POST['regis'])) {
      
    $lastNoPel = mysqli_query($connection, "SELECT no_urut FROM tbpelanggan ORDER BY no_urut DESC LIMIT 1");
    $newNoPel = $lastNoPel + 1;
    if ( $newNoPel < 10 ) { $newNoPelString = "PL00" . (string) $newNoPel; }
    elseif ( $newNoPel < 100 ) { $newNoPelString = "PL0" . (string) $newNoPel; }
    else { $newNoPelString = "PL" . (string) $newNoPel; }
    
    // Mengambil data dari form
    $id = $newNoPelString;
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $password = $_POST['password'];


    // Menyimpan data ke database
    $query = "INSERT INTO tbpelanggan (id_pelanggan, nama_pelanggan, email_pelanggan, alamat_pelanggan, no_hp, password) VALUES ('$id','$nama', '$email', '$alamat', '$nohp','$password')";
    $result = mysqli_query($connection, $query);

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