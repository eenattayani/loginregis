<?php

// include "../dbconn.php";

// // ambil data dari tabel tbkategori
// $query = "SELECT * FROM tbkategori";
// $result = mysqli_query($connection, $query);

// if (!$result) {
//     echo "Query gagal: ".mysqli_error($connection);    
// }

// if (isset($_POST["btntambah"])) {
//     // echo "button tambah ditekan:" . $_POST["btntambah"];
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Kategori</title>

    <link rel="stylesheet" href="../css/style-admin.css">
    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="#">
                <img src="img/logo-hb.png" alt="HB">
            </a>
            <p>Administrator</p>
        </div>

        <div class="admin-side">
            <div class="admin">
                <h3>Richard Verdy</h3>
                <p>Admin</p>
            </div>

            <img src="img/admin-1.png" alt="">
        </div>
    </header>

    <hr>

    <section class="content">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.php"><button>Dashboard</button></a></li>
                <li><a href="data-barang.php"><button>Data Barang</button></a></li>
                <li><a href="data-pembelian.php"><button>Data Pembelian</button></a></li>
                <li><a href="data-penjualan.php"><button>Data Penjualan</button></a></li>
                <li><a href="data-pelanggan.php"><button>Data Pelanggan</button></a></li>
                <li><a href="data-supplier.php"><button>Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button class="active">Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Kategori</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Kategori</th>
                            <th>Kategori</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>AK003</td>
                            <td>Aksesoris</td>                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-input">
                <form method="POST" action="">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-kategori">Id Kategori</label>
                            <input type="text" name="fid-kategori" id="fid-kategori">
                            <label for="fnama-kategori">Kategori</label>
                            <input type="text" name="fnama-kategori" id="fnama-kategori">
                        </div>
                        <div class="right">                            

                        </div>
                    </div>
                    <div class="part-action">
                        <button type="submit" name="btntambah" value="tambah">Tambah</button>
                        <button type="submit" name="btntambah" value="simpan">Simpan</button>
                        <button type="submit" name="btnbatal">Batal</button>
                        <button type="submit" name="btnhapus">Hapus</button>
                        <button type="submit" name="btncari">Cari</button>
                        <button type="submit" name="btnubah">Ubah</button>
                        <button class="keluar">Keluar</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

</body>
</html>