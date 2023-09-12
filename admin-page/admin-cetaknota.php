<?php
date_default_timezone_set("Asia/Jakarta");

// include "adm-config.php";
// include "../dbconn.php";

// $arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
// $arrHari = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];

// $hari = date("l");
// $tanggal = date("d");
// $bulan = $arrBulan[intval(date("m")) - 1];
// $tahun = date("Y");


// // $query = "SELECT * FROM tbkeranjang WHERE status_beli='selesai' ORDER BY id_penjualan DESC";
// $query = "SELECT tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang WHERE tbkeranjang.status_beli='selesai'" ;
// $result = mysqli_query($connection, $query);

// if (!$result) {
//     echo "Query gagal: ".mysqli_error($connection);    
// }

// $arrayResult = array();
// $arrayResult[] = $result;


// $tanggalPilih = "$tanggal $bulan $tahun";
// $pertanggal = $tanggalPilih;

// if (isset($_POST["btn"])) {
//     $pertanggal = $_POST["fpertanggal"];   
    
//     $tanggalPilih = $pertanggal;
//     $partTanggalPilih = explode("-" , $tanggalPilih);
//     $tanggal = $partTanggalPilih[2];
//     $bulan = $arrBulan[(int)$partTanggalPilih[1]-1];
//     $tahun = $partTanggalPilih[0];




//     $resultPertanggal = mysqli_query($connection, "SELECT * FROM tbpenjualan WHERE tanggal='$pertanggal'");
    
//     if ($resultPertanggal->num_rows === 0) {
//         $arrayResult = array();        
//     } else {
//         $arrayResult = array();

//         while($rowPertanggal = mysqli_fetch_assoc($resultPertanggal)){            
//             $result = mysqli_query($connection, "SELECT tbkeranjang.id_penjualan, tbkeranjang.id_pelanggan, tbkeranjang.id_barang, tbbarang.nama_barang, tbkeranjang.jlh_barang, tbkeranjang.harga_satuan FROM tbkeranjang INNER JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang WHERE tbkeranjang.id_penjualan='$rowPertanggal[id_penjualan]'");
            
//             $arrayResult[] = $result;
//         }
//     }
// }


// mysqli_close($connection);


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
                    <span class="tanggal">3 Agustus 2023</span>
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
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr>
                          <td>001</td>
                          <td>PL-001</td>
                          <td>ATK-001</td>
                          <td>Kalkulator</td>
                          <td>2</td>
                          <td>Rp 48.000</td>
                      </tr>                                         
                      <tr class="total-harga">
                        <td colspan="5">Total</td>
                        <td>Rp 1000.000</td>
                      </tr>
                    </tbody>
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

?>