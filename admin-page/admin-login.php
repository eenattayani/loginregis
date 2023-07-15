<?php
session_start();
session_destroy();

include "../dbconn.php";

if ( isset($_POST["login"]) )
{
    $query = "SELECT * FROM tbuser";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    $username = $_POST["username"];
    $pass = $_POST["pass"]; 

    echo $username;
    echo "<br>";
    echo $pass;

    while($row = mysqli_fetch_assoc($result)) {         
        
        if ( $username === $row["username"] && $pass === $row["password"] ) {
            session_start();                        
            $_SESSION["login"] = true;
            $_SESSION["user"] = $row["nama_user"];
            echo '
            <script>
            alert("Login Berhasil!");    
            location.replace("dashboard.php");
            </script>
            '; 
        }
    }              
    
    echo '
    <script>
    alert("Login Gagal!");    
    location.replace("admin-login.php");
    </script>
';    
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/style.css">
    <title>HB - LOGIN</title>
</head>

<body>
    <div class="container login-admin">
        <div class="login">
            <form method="POST" action="">
                <h1>Login Admin</h1>
                <hr>
                <p>Hoki Beauty</p>                
                <label for="">Username</label>
                <input type="text" id="username" name="username" placeholder="username" required autofocus>
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
            <a href="index.php"><img src="../img/logo.png" alt="logo"></a>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>