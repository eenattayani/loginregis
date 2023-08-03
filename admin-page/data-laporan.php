<?php
date_default_timezone_set("Asia/Jakarta");

include "adm-config.php";
include "../dbconn.php";

$arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$arrHari = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];

$hari = date("l");
$tanggal = date("d");
$bulan = $arrBulan[intval(date("m")) - 1];
$tahun = date("Y");


// $query = "SELECT * FROM tbkeranjang WHERE status_beli='selesai' ORDER BY id_penjualan DESC";
$query = "SELECT tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang WHERE tbkeranjang.status_beli='selesai'" ;
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

$arrayResult = array();
$arrayResult[] = $result;


$tanggalPilih = "$tanggal $bulan $tahun";
$pertanggal = $tanggalPilih;

if (isset($_POST["btn"])) {
    $pertanggal = $_POST["fpertanggal"];   
    
    $tanggalPilih = $pertanggal;
    $partTanggalPilih = explode("-" , $tanggalPilih);
    $tanggal = $partTanggalPilih[2];
    $bulan = $arrBulan[(int)$partTanggalPilih[1]-1];
    $tahun = $partTanggalPilih[0];




    $resultPertanggal = mysqli_query($connection, "SELECT * FROM tbpenjualan WHERE tanggal='$pertanggal'");
    
    if ($resultPertanggal->num_rows === 0) {
        $arrayResult = array();        
    } else {
        $arrayResult = array();

        while($rowPertanggal = mysqli_fetch_assoc($resultPertanggal)){            
            $result = mysqli_query($connection, "SELECT tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang WHERE tbkeranjang.id_penjualan='$rowPertanggal[id_penjualan]'");
            
            $arrayResult[] = $result;
        }
    }
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
                <li><a href="data-ongkir.php"><button>Data Ongkir</button></a></li>
                <li><a href="data-keranjang.php"><button>Keranjang</button></a></li>
                <li><a href="data-laporan.php"><button class="active">Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data penjualan">
                <h1>Laporan Penjualan</h1>
                <div class="ket">
                    <span class="admin">Admin : Verdy</span>
                    <span class="tanggal"><?php echo "$tanggal $bulan $tahun";?></span>
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
                    if ( empty($arrayResult) ) {
                    ?>
                        <tr>
                            <td colspan="7"> == Belum ada data penjualan == </td>
                        </tr>
                    <?php
                    } else {
                        foreach ($arrayResult as $result) {                                                 
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                                       
                                echo "
                                <tr id=\"baris$r\" onclick=\"pilihBaris(". $r .")\">
                                    <td id=\"id$r\">" . $row["id_penjualan"] . "</td>                             
                                    <td id=\"pelanggan$r\">" . $row["id_pelanggan"] . "</td>                                                                                            
                                    <td id=\"idbarang$r\">" . $row["id_barang"] . "</td>                               
                                    <td id=\"namabarang$r\">" . $row["nama_barang"] . "</td>                               
                                    <td id=\"qty$r\">" . $row["jlh_barang"] . "</td>                               
                                    <td id=\"harga$r\">" . $row["harga_satuan"] . "</td>                               
                                </tr>
                                ";
                                $r++;
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="form-input penjualan">
                <form action="" method="POST">      
                    <div class="part-input">
                        <div class="left">
                            <label class="input-harian" for="fpertanggal">Laporan Harian</label>
                            <input class="input-harian" type="date" name="fpertanggal" id="fpertanggal">
                            <label class="input-bulanan" for="fperbulan" hidden>Laporan Bulanan</label>
                            <select class="input-bulanan" type="date" name="fperbulan" id="fperbulan" hidden>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <select class="input-bulanan" name="fperbulan-tahun" id="fperbulan-tahun" hidden>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                            <label class="input-tahunan" for="fpertahun" hidden>Laporan Tahunan</label>
                            <select class="input-tahunan" name="fpertahun" id="fpertahun" hidden>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>

                        </div>
                        <div class="right"></div>
                    </div>              
                    <div class="part-action">
                        <!-- <button type="submit" name="btn" value="pertanggal">Tanggal</button> -->
                        <button type="button" id="harian">Harian</button>
                        <button type="button" id="bulanan">Bulanan</button>
                        <button type="button" id="tahunan">Tahunan</button>                        
                        <button class="keluar">Cetak</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
<script>
    const btnHarian = document.querySelector("#harian");
    const btnBulanan = document.querySelector("#bulanan");
    const btnTahunan = document.querySelector("#tahunan");

    const inputHarian = document.querySelectorAll(".input-harian");
    const inputBulanan = document.querySelectorAll(".input-bulanan");
    const inputTahunan = document.querySelectorAll(".input-tahunan");

    btnHarian.addEventListener('click', () => {        
        inputHarian[0].hidden = false;
        inputHarian[1].hidden = false;
        inputBulanan[0].hidden = true;
        inputBulanan[1].hidden = true;
        inputBulanan[2].hidden = true;
        inputTahunan[0].hidden = true;
        inputTahunan[1].hidden = true;
    });

    btnBulanan.addEventListener('click', () => {        
        inputBulanan[0].hidden = false;
        inputBulanan[1].hidden = false;
        inputBulanan[2].hidden = false;
        inputHarian[0].hidden = true;
        inputHarian[1].hidden = true;
        inputTahunan[0].hidden = true;
        inputTahunan[1].hidden = true;
    });

    btnTahunan.addEventListener('click', () => {
        inputTahunan[0].hidden = false;
        inputTahunan[1].hidden = false;
        inputHarian[0].hidden = true;
        inputHarian[1].hidden = true;
        inputBulanan[0].hidden = true;
        inputBulanan[1].hidden = true;
        inputBulanan[2].hidden = true;
        

    });
</script>
</body>
</html>