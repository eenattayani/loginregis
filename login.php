<?php
session_start();

if (isset($_SESSION["login"])) {
    echo '
    <script>
    alert("Anda telah keluar!");        
    </script>
    '; 
}

session_destroy();

// $_SESSION["login"] = false;
// $_SESSION["user"] = "";

include "dbconn.php";

$tujuan = "index.php";

if (isset($_GET["ke"])) {
    $tujuan = $_GET["ke"];
}

if ( isset($_POST["login"]) )
{
    $email = $_POST["email"];
    $pass = $_POST["pass"]; 

    // cek data admin
    $queryAdm = "SELECT * FROM tbuser";
    $resultAdm = mysqli_query($connection, $queryAdm);

    while ($rowAdm = mysqli_fetch_assoc($resultAdm)) {
        if ( $email === $rowAdm["username"] && $pass === $rowAdm["password"] ) {
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["user"] = $rowAdm["nama_user"];
            $_SESSION["admin"] = true;
            header("location:admin-page/dashboard.php");
            exit;
        }
    }

    // cek data pelanggan
    $query = "SELECT * FROM tbpelanggan";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    

    while($row = mysqli_fetch_assoc($result)) {
           
        
        if ( $email === $row["email_pelanggan"] && $pass === $row["password"] ) {
            session_start();                        
            $_SESSION["login"] = true;
            $_SESSION["iduser"] = $row["id_pelanggan"];
            $_SESSION["user"] = $row["nama_pelanggan"];
            $_SESSION["emailuser"] = $row["email_pelanggan"];
            $_SESSION["alamatuser"] = $row["alamat_pelanggan"];
            $_SESSION["nohp"] = $row["no_hp"];
            echo '
            <script>
            alert("Login Berhasil!");    
            location.replace("'. $tujuan .'");
            </script>
            '; 

            exit;
        }
    }              
    
    echo '
        <script>
        alert("Login Gagal!");    
        location.replace("login.php?ke=' . $tujuan . '");
        </script>
    ';    

    exit;
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <title>HB - LOGIN</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <form method="POST" action="">
                <h1>Login</h1>
                <hr>
                <p>Hoki Beauty</p>                
                <label for="">Email</label>
                <input type="text" id="email" name="email" placeholder="myemail@gmail.com" required autofocus>
                <label for="">Password</label>
                <input type="password" id="pass" name="pass" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>
                    <td>Tidak Punya Akun?
                    <a href="regis.php" style="color: red;">SignUp</a>
                    </td>
                </p>
            </form>
        </div>
        <div class="right">
            <a href="index.php"><img src="img/logo.png" alt="logo"></a>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>