<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Pelanggan</title>

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
                <li><a href="data-pelanggan.php"><button class="active">Data Pelanggan</button></a></li>
                <li><a href="data-supplier.php"><button>Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Pelanggan</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Pelanggan</th>
                            <th>Nama</th>                            
                            <th>Email</th>                            
                            <th>Password</th>                            
                            <th>No HP</th>                            
                            <th>Alamat</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PL001</td>
                            <td>Verdy</td>                            
                            <td>verdy@gmail.com</td>                            
                            <td>Password</td>                            
                            <td>081245632145</td>                            
                            <td>Pulau Tayan Utara</td>                            
                        </tr>
                        <tr>
                            <td>PL002</td>
                            <td>Yori</td>                            
                            <td>yori@gmail.com</td>                            
                            <td>inipass</td>                            
                            <td>08521478966</td>                            
                            <td>Pontianak</td>                             
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-input">
                <form action="POST">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-pelanggan">Id Pelanggan</label>
                            <input type="text" name="fid-pelanggan" id="fid-pelanggan">
                            <label for="fnama-pelanggan">Nama</label>
                            <input type="text" name="fnama-pelanggan" id="fnama-pelanggan">
                            <label for="femail-pelanggan">Email</label>
                            <input type="text" name="femail-pelanggan" id="femail-pelanggan">
                        </div>
                        <div class="right">                            
                            <label for="fpass-pelanggan">Password</label>
                            <input type="text" name="fpass-pelanggan" id="fpass-pelanggan">
                            <label for="fhp-pelanggan">No HP</label>
                            <input type="text" name="fhp-pelanggan" id="fhp-pelanggan">
                            <label for="falamat-pelanggan">Alamat</label>
                            <input type="text" name="falamat-pelanggan" id="falamat-pelanggan">
                        </div>
                    </div>
                    <div class="part-action">
                        <button>Tambah</button>
                        <button>Simpan</button>
                        <button>Batal</button>
                        <button>Hapus</button>
                        <button>Cari</button>
                        <button>Ubah</button>
                        <button class="keluar">Keluar</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

</body>
</html>