<?php

include "adm-config.php";
include "../dbconn.php";


if (isset($_POST["btn"])) {
    
    $id = $_POST["fid-penjualan"];
    $ekspedisi = $_POST["fekspedisi"];
    $noresi = $_POST["fno-resi"];
    
    $status = 'dikirim';

    if ($_POST["btn"] === "simpan") {
        $queryUbah = "UPDATE tbpenjualan SET ekspedisi = '$ekspedisi', no_resi = '$noresi' WHERE id_penjualan = '$id'";
        $resultUbah = mysqli_query($connection, $queryUbah);
       
    } elseif  ($_POST["btn"] === "konfirmasi") {
        $queryConfirm = "UPDATE tbpenjualan SET status_penjualan = '$status' WHERE id_penjualan = '$id'";
        $resultConfirm = mysqli_query($connection, $queryConfirm);     

        $queryConfirm = "UPDATE tbkeranjang SET status_beli = '$status' WHERE id_penjualan = '$id'";
        $resultConfirm = mysqli_query($connection, $queryConfirm);  
        
        if ($resultConfirm) {
            echo '
            <script>
                alert("pembayaran diterima!");
            </script>
            ';
        } else {
            echo '
            <script>
                alert("GAGAL konfirmasi!");
            </script>
            ';
        }
    }

}


$query = "SELECT * FROM tbkeranjang ORDER BY id_keranjang DESC";
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
    <title>HB Admin - Data Keranjang</title>

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
                <li><a href="data-keranjang.php"><button class="active">Keranjang</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Keranjang / Wishlist</h1>
                <table id="myTable">
                    <thead>
                        <tr>                            
                            <th>Id Penjualan</th>                            
                            <th>Id Pelanggan</th>                            
                            <th>Id Barang</th>
                            <th>Harga</th>                            
                            <th>Jumlah</th>                            
                            <th>Status Beli</th>                            
                            <th>Alamat Tujuan</th>                                                                                   
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
                                <td id=\"barang$r\">" . $row["id_barang"] . "</td>                                
                                <td id=\"harga$r\">" . $row["harga_satuan"] . "</td>                               
                                <td id=\"jlh$r\">" . $row["jlh_barang"] . "</td>                               
                                <td id=\"status$r\">" . $row["status_beli"] . "</td>                               
                                <td id=\"alamat$r\">" . $row["alamat_tujuan"] . "</td>                                                               
                            </tr>
                            ";
                            $r++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="form-input">
                <form action="" method="POST">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-penjualan">Id Penjualan</label>
                            <input type="text" name="fid-penjualan" id="fid-penjualan">
                            <label for="fid-pelanggan">Id Pelanggan</label>
                            <input type="text" name="fid-pelanggan" id="fid-pelanggan">
                            <label for="fid-barang">Id Barang</label>
                            <input type="text" name="fid-barang" id="fid-barang">
                            <label for="fharga-barang">Harga Barang</label>
                            <input type="text" name="fharga-barang" id="fharga-barang">
                            <label for="fjlh-barang">Jumlah</label>
                            <input type="text" name="fjlh-barang" id="fjlh-barang">                            
                        </div>
                        <div class="right">                            
                            <label for="fstatus">Status</label>
                            <input type="text" name="fstatus" id="fstatus">
                            <label for="falamat">Alamat</label>
                            <input type="text" name="falamat" id="falamat">
                        </div>
                    </div>
                    <div class="part-action">
                        <!-- <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button> -->
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>
                        <!-- <button type="submit" name="btn" id="btnconfirm" value="konfirmasi">Konfirmasi</button>                         -->
                    </div>
                </form>
            </div>

        </div>
    </section>

<script>
    const inputId = document.querySelector("#fid-penjualan");
    const inputIdPlg = document.querySelector("#fid-pelanggan");
    const inputIdBrg = document.querySelector("#fid-barang");
    const inputHarga = document.querySelector("#fharga-barang");
    const inputJumlah = document.querySelector("#fjlh-barang");
    const inputStatus = document.querySelector("#fstatus");
    const inputAlamat = document.querySelector("#falamat");    
    
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");      
    const btnUbah = document.querySelector("#btnubah");

    const myTableRows = document.querySelectorAll("#myTable tr");

    inputId.readOnly = true;
    inputIdPlg.readOnly = true;
    inputIdBrg.readOnly = true;
    inputHarga.readOnly = true;
    inputJumlah.readOnly = true;
    inputStatus.readOnly = true;
    inputAlamat.readOnly = true;
    
    btnSimpan.disabled = true;
    btnSimpan.classList.add("disabled");
    btnBatal.disabled = true;
    btnBatal.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");
    
    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolIdPlg = document.querySelector("#pelanggan" + row).innerHTML;
        const kolIdBrg = document.querySelector("#barang" + row).innerHTML;
        const kolHarga = document.querySelector("#harga" + row).innerHTML;
        const kolJumlah = document.querySelector("#jlh" + row).innerHTML;
        const kolStatus = document.querySelector("#status" + row).innerHTML;
        const kolAlamat = document.querySelector("#alamat" + row).innerHTML;        

        myTableRows.forEach((baris, index) => {
            if ( index === row ) {
                baris.style.background = 'lightgray';
            } else {
                baris.style.background = 'white';
            }
        });        

        
        inputId.value = kolId;
        inputIdPlg.value = kolIdPlg;
        inputIdBrg.value = kolIdBrg;
        inputHarga.value = kolHarga;
        inputJumlah.value = kolJumlah;
        inputStatus.value = kolStatus;
        inputAlamat.value = kolAlamat;         
        
       
        btnUbah.disabled = false;
        btnUbah.classList.remove("disabled");        
        btnBatal.disabled = false;
        btnBatal.classList.remove("disabled");
        btnSimpan.disabled = true;
        btnSimpan.classList.add("disabled");
    }

    function ubah() {
        
    }

    function batal() {
        
        
    }

</script>

</body>
</html>