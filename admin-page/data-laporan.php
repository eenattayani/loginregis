<?php

include "../dbconn.php";

$query = "SELECT * FROM tbkeranjang WHERE status_beli='selesai' ORDER BY id_penjualan DESC";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Laporan</title>

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
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button class="active">Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data penjualan">
                <h1>Laporan Penjualan</h1>
                <div class="ket">
                    <span class="admin">Admin : Verdy</span>
                    <span class="tanggal">Senin, 3 Juli 2023</span>
                </div>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Penjualan</th>
                            <th>Id Pelanggan</th>                            
                            <th>Id Barang</th>                            
                            <th>Nama Barang</th>                                                                                         
                            <th>Qty</th>                               
                            <th>Harga Satuan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="7"> == Belum ada data penjualan == </td>
                        </tr>
                    <?php
                    } else {
                        $r = 1;
                        while($row = mysqli_fetch_assoc($result)) {                           
                            echo "
                            <tr id=\"baris$r\" onclick=\"pilihBaris(". $r .")\">
                                <td id=\"id$r\">" . $row["id_penjualan"] . "</td>                             
                                <td id=\"pelanggan$r\">" . $row["id_pelanggan"] . "</td>                                
                                <td id=\"idbarang$r\">" . $row["id_barang"] . "</td>                               
                                <td id=\"namabarang$r\">" . $row["id_barang"] . "</td>                               
                                <td id=\"qty$r\">" . $row["jlh_barang"] . "</td>                               
                                <td id=\"harga$r\">" . $row["harga_satuan"] . "</td>                               
                            </tr>
                            ";
                            $r++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="form-input penjualan">
                <form action="">                    
                    <div class="part-action">
                        <button>Tanggal</button>
                        <button>Bulan</button>
                        <button>Tahun</button>
                        
                        <button class="keluar">Cetak</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

</body>
</html>