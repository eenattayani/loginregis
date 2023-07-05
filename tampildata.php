<?php
    include "dbconn.php";


    // Tampilkan data dari tabel pelanggan
    $query = "SELECT * FROM tbpelanggan";
    $result = mysqli_query($connection, $query);

    
    if ($result) {
    //   echo "Query berhasil";
    } else {
    //   echo "Query gagal: ".mysqli_error($connection);
    }
    
    mysqli_close($connection);
    
    // echo"<br>";    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <title>HB - DATA PELANGGAN</title>
</head>

<body>
    <div class="container tampil-data">        
            
        <h3>Data Pelanggan</h3>
        <hr class="garis-data">
        <br>
        <table>  
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>ALAMAT</th>
                    <th>NO HP</th>
                    <th>PASSWORD</th>
                </tr>  
            </thead>   
            <tbody>
            
            <?php           
                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>" . $row["id_pelanggan"] . "</td>
                        <td>" . $row["nama_pelanggan"] . "</td>
                        <td>" . $row["email_pelanggan"] . "</td>
                        <td>" . $row["alamat_pelanggan"] . "</td>
                        <td>" . $row["no_hp"] . "</td>
                        <td>" . $row["password"] . "</td>
                    </tr>
                    ";
                }                        
            ?>

            </tbody>                                   

        </table>

        <a href="index.php"><button>Home</button></a>
                        
    </div>
</body>
</html>