<?php
date_default_timezone_set("Asia/Jakarta");

include "adm-config.php";
include "../dbconn.php";

if ( isset($_POST["cetak"]) ) {
    $isiLaporan = $_POST["isi-tabel-laporan"];

    $ketWaktu = $_POST["cetak"];

    $title = "nota-penjualan.pdf";

    $isiNota = '

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
        <title>HB Admin - Data Laporan</title>

        <link rel="stylesheet" href="../css/style-nota.css">
        
    </head>
    <body class="cetak-nota">
        <header class="kop">
            <div class="kop-logo">        
                    <img src="img/logo-hb.png" alt="HB">            
            </div>  
            <div class="kop-text">
                <h1>Laporan Penjualan</h1>
                <p>Jl. Dwikora no. 19 Blok B, Pulau Tayan Utara<br>Hp. 082251072261</p>
            </div>      
        </header>

        <section class="content">        
            <div class="main data">
                <div class="tabel-data penjualan">                
                    <div class="ket">                
                        <span class="tanggal">';
                        $isiNota .= $ketWaktu;
            $isiNota .= '</span>
                    </div>

                    <table>';
        $isiNota .= $isiLaporan;
        $isiNota .= '
                     
                    </table>

                    <div class="ttd">
                        <p class="admin">Admin</p>
                        <br><br><br>
                        <p>Verdy</p>                    
                    </div>
                </div>            
            </div>
        </section>
    </body>
    </html>
    ';

    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P","","","","","15","15","15","15","","","","","","","","","","","","A4");
    $mpdf->WriteHTML($isiNota);
    $mpdf->Output($title, 'I');
    
} else {

$arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$arrHari = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];

$hari = date("l");
$tanggal = date("d");
$bulan = $arrBulan[intval(date("m")) - 1];
$tahun = date("Y");


// $query = "SELECT * FROM tbkeranjang WHERE status_beli='selesai' ORDER BY id_penjualan DESC";
$query = "SELECT tbpenjualan.tanggal, tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang INNER JOIN tbpenjualan ON tbkeranjang.id_penjualan = tbpenjualan.id_penjualan WHERE tbkeranjang.status_beli='selesai'" ;
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

$arrayResult = array();
$arrayResult[] = $result;


$tanggalPilih = "$tanggal $bulan $tahun";
$pertanggal = $tanggalPilih;

$showDate = true;

$ketWaktu = "tanggal/bulan/tahun";

if (isset($_POST["cari"])) {
    if ($_POST["cari"] === "daily") {
        $showDate = false;

        $pertanggal = $_POST["fpertanggal"];   
        
        $tanggalPilih = $pertanggal;
        $partTanggalPilih = explode("-" , $tanggalPilih);
        $tanggal = $partTanggalPilih[2];
        $bulan = $arrBulan[(int)$partTanggalPilih[1]-1];
        $tahun = $partTanggalPilih[0];

        $ketWaktu = "Tanggal: $tanggal $bulan $tahun";

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
    } elseif ($_POST["cari"] === "monthly") {
        $showDate = true;

        $perbulan = $_POST["fperbulan"];
        $perbulanTahun = $_POST["fperbulan-tahun"];

        $tanggal = "Bulan: ";
        $bulan = $arrBulan[(int)$perbulan-1];
        $tahun = $perbulanTahun;

        $ketWaktu = "Bulan: $bulan $tahun";

        $resultPerbulan = mysqli_query($connection, "SELECT * FROM tbpenjualan WHERE DATE_FORMAT(tanggal, '%m') ='$perbulan' AND YEAR(tanggal) = '$perbulanTahun'");

        if ($resultPerbulan->num_rows === 0) {
            $arrayResult = array();        
        } else {
            $arrayResult = array();

            while($rowPerbulan = mysqli_fetch_assoc($resultPerbulan)){            
                $result = mysqli_query($connection, "SELECT tbpenjualan.tanggal, tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang INNER JOIN tbpenjualan ON tbkeranjang.id_penjualan = tbpenjualan.id_penjualan WHERE tbkeranjang.id_penjualan='$rowPerbulan[id_penjualan]'");
                
                $arrayResult[] = $result;
            }
        }
    } elseif ($_POST["cari"] === "yearly") {
        $showDate = true;
        
        $pertahun = $_POST["fpertahun"];   
          
        $tanggal = "Tahun: ";
        $bulan = "";
        $tahun = $pertahun;

        $ketWaktu = "Tahun: $pertahun";   

        $resultPertahun = mysqli_query($connection, "SELECT * FROM tbpenjualan WHERE YEAR(tanggal) = '$pertahun'");

        if ($resultPertahun->num_rows === 0) {
            $arrayResult = array();        
        } else {
            $arrayResult = array();

            while($rowPertahun = mysqli_fetch_assoc($resultPertahun)){            
                $result = mysqli_query($connection, "SELECT tbpenjualan.tanggal, tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang INNER JOIN tbpenjualan ON tbkeranjang.id_penjualan = tbpenjualan.id_penjualan WHERE tbkeranjang.id_penjualan='$rowPertahun[id_penjualan]'");
                
                $arrayResult[] = $result;
            }
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
                <table id="tabel-laporan">
                    <thead>
                        <tr>                            
                        <?php 
                        if ( $showDate ) {                                                         
                            echo" <th>Tanggal</th> ";
                        } 
                        ?>
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
                            <td colspan="6"> == Belum ada data penjualan == </td>
                        </tr>
                    <?php
                    } else {
                        foreach ($arrayResult as $result) {                                                 
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                                       
                                echo "
                                <tr id=\"baris$r\" onclick=\"pilihBaris(". $r .")\"> ";
                            if ($showDate) {
                              echo "<td id=\"tgl$r\">" . $row["tanggal"] . "</td>  ";                            
                            }
                            echo "  <td id=\"id$r\">" . $row["id_penjualan"] . "</td>                             
                                    <td id=\"pelanggan$r\">" . $row["id_pelanggan"] . "</td>                                                                                            
                                    <td id=\"idbarang$r\">" . $row["id_barang"] . "</td>                               
                                    <td id=\"namabarang$r\">" . $row["nama_barang"] . "</td>                               
                                    <td class=\"qty\" id=\"qty$r\">" . $row["jlh_barang"] . "</td>                               
                                    <td class=\"harga-satuan\">" . $row["harga_satuan"] . "</td>                               
                                </tr>
                                ";
                                $r++;
                            }                        
                        }
                        if (isset($_POST["cari"])) {
                            $colspan = 5;
                            if ( $_POST["cari"] !== "daily" ) {
                                $colspan = 6;
                            }
                            echo "
                            <tr class=\"total\">
                                <td colspan=\"$colspan\">Total</td>
                                <td id=\"total\">5000.000</td>
                            </tr>
                             ";                            
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
                                <option value="2023" selected>2023</option>
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
                                <option value="2023" selected>2023</option>
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
                        <input type="hidden" id="isi-tabel-laporan" name="isi-tabel-laporan" value="isi laporan">
                        <button type="button" id="harian">Harian</button>
                        <button type="button" id="bulanan">Bulanan</button>
                        <button type="button" id="tahunan">Tahunan</button>                        
                        <button type="submit" id="btn-cetak" name="cetak" value="<?=$ketWaktu;?>" class="keluar">Cetak</button>
                        <button type="submit" id="btn-cari-day" name="cari" value="daily" class="cari"><i class='bx bx-search-alt'></i> Cari</button>
                        <button type="submit" id="btn-cari-month" name="cari" value="monthly" class="cari"><i class='bx bx-search-alt'></i> Cari</button>
                        <button type="submit" id="btn-cari-year" name="cari" value="yearly" class="cari"><i class='bx bx-search-alt'></i> Cari</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
<script>
    const btnHarian = document.querySelector("#harian");
    const btnBulanan = document.querySelector("#bulanan");
    const btnTahunan = document.querySelector("#tahunan");
    
    const btnCetak = document.querySelector("#btn-cetak");

    const inputHarian = document.querySelectorAll(".input-harian");
    const inputBulanan = document.querySelectorAll(".input-bulanan");
    const inputTahunan = document.querySelectorAll(".input-tahunan");

    const btnDaily = document.querySelector("#btn-cari-day");
    const btnMonthly = document.querySelector("#btn-cari-month");
    const btnYearly = document.querySelector("#btn-cari-year");

    const colTotal = document.querySelector("#total");

    const qty = document.querySelectorAll(".qty");
    const hargaSatuan = document.querySelectorAll(".harga-satuan");

    const tabelLaporan = document.querySelector("#tabel-laporan");
    const isiTabelLaporan = document.querySelector("#isi-tabel-laporan");
        

    let hargaTotal = 0;    
    for (let i = 0; i < hargaSatuan.length; i++) {
        let value = Number(hargaSatuan[i].textContent) * Number(qty[i].textContent);
        if (!isNaN(value)) {
            hargaTotal += value;
        }
    }
    

    if (colTotal) {        
        colTotal.innerHTML = hargaTotal;
        console.info(colTotal.innerHTML);
    }

    isiTabelLaporan.value = tabelLaporan.innerHTML;
    console.info(isiTabelLaporan.value);

    // btnCetak.disabled = true;
    // btnCetak.classList.add("disabled");

    btnDaily.disabled = true;
    btnDaily.classList.add("disabled");
    btnMonthly.hidden = true;    
    btnYearly.hidden = true;    

    inputHarian[1].addEventListener('change', ()=>{
      btnDaily.disabled = false;
      btnDaily.classList.remove("disabled");
    });

    btnHarian.addEventListener('click', () => {        
        inputHarian[0].hidden = false;
        inputHarian[1].hidden = false;
        inputBulanan[0].hidden = true;
        inputBulanan[1].hidden = true;
        inputBulanan[2].hidden = true;
        inputTahunan[0].hidden = true;
        inputTahunan[1].hidden = true;

        btnDaily.hidden = false;
        btnMonthly.hidden = true;        
        btnYearly.hidden = true;
    });

    btnBulanan.addEventListener('click', () => {        
        inputBulanan[0].hidden = false;
        inputBulanan[1].hidden = false;
        inputBulanan[2].hidden = false;
        inputHarian[0].hidden = true;
        inputHarian[1].hidden = true;
        inputTahunan[0].hidden = true;
        inputTahunan[1].hidden = true;

        btnDaily.hidden = true;
        btnMonthly.hidden = false;        
        btnYearly.hidden = true;
    });

    btnTahunan.addEventListener('click', () => {
        inputTahunan[0].hidden = false;
        inputTahunan[1].hidden = false;
        inputHarian[0].hidden = true;
        inputHarian[1].hidden = true;
        inputBulanan[0].hidden = true;
        inputBulanan[1].hidden = true;
        inputBulanan[2].hidden = true;
        
        btnDaily.hidden = true;
        btnMonthly.hidden = true;        
        btnYearly.hidden = false;

    });

    function pilihBaris(row){
        console.info("baris: ", row);
    }
</script>
</body>
</html>

<?php 
}
?>