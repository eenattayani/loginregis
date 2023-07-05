<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Supplier</title>

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
                <li><a href="data-supplier.php"><button class="active">Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Supplier</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Supplier</th>
                            <th>Nama</th>                            
                            <th>No Telp</th>                            
                            <th>Alamat</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SP001</td>
                            <td>Adi</td>                            
                            <td>081245631123</td>                            
                            <td>Pontianak</td>                            
                        </tr>
                        <tr>
                            <td>SP002</td>
                            <td>Bayu</td>                            
                            <td>08124567890</td>                            
                            <td>Jakarta</td>                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-input">
                <form action="POST">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-supplier">Id Supplier</label>
                            <input type="text" name="fid-supplier" id="fid-supplier">
                            <label for="fnama-supplier">Supplier</label>
                            <input type="text" name="fnama-supplier" id="fnama-supplier">
                        </div>
                        <div class="right">                            
                            <label for="ftelp-supplier">No Telp</label>
                            <input type="text" name="ftelp-supplier" id="ftelp-supplier">
                            <label for="falamat-supplier">Alamat</label>
                            <input type="text" name="falamat-supplier" id="falamat-supplier">
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