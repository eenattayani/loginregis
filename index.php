<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>HOKI BEAUTY</title>
    
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container center">   
        <div class="right">
            <a href="index.php"><img src="img/logo.png" alt=""></a>
        </div>
        <p>
            <?php
                if (isset($_SESSION["login"])){
                    echo "Selamat Datang <strong>" . $_SESSION["user"] . "</strong> di Hoki Beauty!";
                }
            ?>
        </p>             
        <?php if (isset($_SESSION["login"])) { ?>
            <a href="login.php"><button>Logout</button></a>
        <?php    
        } else {
        ?>
            <a href="regis.php"><button>Registrasi</button></a>
            <a href="login.php"><button>Login</button></a>
        <?php
        }
        ?>

        <a href="tampildata.php"><button>Data Pelanggan</button></a>
    </div>

    <script>
        
    </script>
</body>
</html>