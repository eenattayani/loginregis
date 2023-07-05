<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <title>HB - REGISTRASI</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <form method="POST" action="koneksi.php">
                <h1>Registrasi</h1>
                <hr>
                <p>Hoki Beauty</p>
                <label for="">Nama</label>
                <input type="text" name="nama" placeholder="Nama Lengkap" required autofocus>
                <label for="">Email</label>
                <input type="text" name="email" placeholder="example@gmail.com" required>
                <label for="">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat Lengkap" required>
                <label for="">NoHp</label>
                <input type="text" name="nohp" placeholder="08xxxxxxxx" required>
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="regis">Registrasi</button>
                <p>
                    <td>Punya Akun?
                    <a href="login.php" style="color: red;">SignIn</a>
                    </td>
                </p>
            </form>
        </div>
        <div class="right">
            <a href="index.php"><img src="img/logo.png" alt="logo"></a>
            <!-- <img src="logo.png" alt=""> -->
        </div>
    </div>
</body>
</html>