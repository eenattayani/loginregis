<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Penjualan</title>

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
                <li><a href="data-penjualan.php"><button class="active">Data Penjualan</button></a></li>
                <li><a href="data-pelanggan.php"><button>Data Pelanggan</button></a></li>
                <li><a href="data-supplier.php"><button>Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Penjualan</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Tanggal</th>
                            <th>No Penjualan</th>                            
                            <th>Id Pelanggan</th>                            
                            <th>Id Barang</th>                            
                            <th>Nama Barang</th>                            
                            <th>Qty</th>                            
                            <th>Satuan</th>                            
                            <th>Harga Barang</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5-7-2023</td>
                            <td>PJ001</td>                            
                            <td>PL001</td>                            
                            <td>0001</td>                            
                            <td>Clear Men Sport</td>                            
                            <td>1</td>                            
                            <td>Pcs</td>                            
                            <td>43.000</td>                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-input">
                <form action="POST">
                    <div class="part-input">
                        <div class="left">
                            <label for="fno-penjualan">No Penjualan</label>
                            <input type="text" name="fno-penjualan" id="fno-penjualan">
                            <label for="fid-pelanggan">Id Pelanggan</label>
                            <input type="text" name="fid-pelanggan" id="fid-pelanggan">
                            <label for="fnama-barang">Nama Barang</label>
                            <input type="text" name="fnama-barang" id="fnama-barang">
                        </div>
                        <div class="right">                            
                            <label for="fharga-barang">Harga Barang</label>
                            <input type="text" name="fharga-barang" id="fharga-barang">
                            <label for="fqty">Qty</label>
                            <input type="text" name="fqty" id="fqty">
                            <label for="fsatuan">Satuan</label>
                            <input type="text" name="fsatuan" id="fsatuan">
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