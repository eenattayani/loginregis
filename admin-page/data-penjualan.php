<?php

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


$query = "SELECT * FROM tbpenjualan ORDER BY id_penjualan DESC";
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
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Penjualan</h1>
                <table id="myTable">
                    <thead>
                        <tr>                            
                            <th>Id Penjualan</th>                            
                            <th>Tanggal</th>
                            <th>Id Pelanggan</th>                            
                            <th>Harga Subtotal</th>                            
                            <th>Harga Ongkir</th>                            
                            <th>Harga Total</th>                            
                            <th>Status Penjualan</th>                            
                            <th>Ekspedisi</th>                            
                            <th>No Resi</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="9"> == Belum ada data penjualan == </td>
                        </tr>
                    <?php
                    } else {
                        $r = 1;
                        while($row = mysqli_fetch_assoc($result)) {                                
                            echo "
                            <tr id=\"baris$r\" onclick=\"pilihBaris(". $r .")\">
                                <td id=\"id$r\">" . $row["id_penjualan"] . "</td>
                                <td id=\"tanggal$r\">" . $row["tanggal"] . "</td>                                
                                <td id=\"pelanggan$r\">" . $row["id_pelanggan"] . "</td>                                
                                <td id=\"subtotal$r\">" . $row["harga_subtotal"] . "</td>                               
                                <td id=\"ongkir$r\">" . $row["harga_ongkir"] . "</td>                               
                                <td id=\"total$r\">" . $row["harga_total"] . "</td>                               
                                <td id=\"status$r\">" . $row["status_penjualan"] . "</td>                               
                                <td id=\"ekspedisi$r\">" . $row["ekspedisi"] . "</td>                               
                                <td id=\"noresi$r\">" . $row["no_resi"] . "</td>                               
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
                            <label for="fharga-subtotal">Harga Subtotal</label>
                            <input type="text" name="fharga-subtotal" id="fharga-subtotal">
                            <label for="fharga-ongkir">Harga Ongkir</label>
                            <input type="text" name="fharga-ongkir" id="fharga-ongkir">
                            <label for="ftotal-harga">Total Bayar</label>
                            <input type="text" name="ftotal-harga" id="ftotal-harga">
                            <label for="fekspedisi">Ekspedisi</label>
                            <input type="text" name="fekspedisi" id="fekspedisi">
                            <label for="fno-resi">No Resi</label>
                            <input type="text" name="fno-resi" id="fno-resi">
                        </div>
                        <div class="right">                            
                            <label for="ftanggal">Tanggal</label>
                            <input type="text" name="ftanggal" id="ftanggal">
                            <label for="fstatus-order">Status Penjualan</label>
                            <input type="text" name="fstatus-order" id="fstatus-order">
                            <label for="fqty">Bukti Pembayaran</label>
                            <img id="bukti-trf" name="bukti-trf" src="" alt="">
                        </div>
                    </div>
                    <div class="part-action">
                        <!-- <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button> -->
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>
                        <button type="submit" name="btn" id="btnconfirm" value="konfirmasi">Konfirmasi</button>                        
                    </div>
                </form>
            </div>

        </div>
    </section>

<script>
    const inputId = document.querySelector("#fid-penjualan");
    const inputIdPlg = document.querySelector("#fid-pelanggan");
    const inputSubtotal = document.querySelector("#fharga-subtotal");
    const inputOngkir = document.querySelector("#fharga-ongkir");
    const inputTotal = document.querySelector("#ftotal-harga");
    const inputEkspedisi = document.querySelector("#fekspedisi");
    const inputNoresi = document.querySelector("#fno-resi");
    const inputTanggal = document.querySelector("#ftanggal");
    const inputStatus = document.querySelector("#fstatus-order");    
    const gambar = document.querySelector("#bukti-trf");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");      
    const btnUbah = document.querySelector("#btnubah");
    const btnKonfirmasi = document.querySelector("#btnconfirm");

    const myTableRows = document.querySelectorAll("#myTable tr");

    inputId.readOnly = true;
    inputIdPlg.readOnly = true;
    inputSubtotal.readOnly = true;
    inputOngkir.readOnly = true;
    inputTotal.readOnly = true;
    inputEkspedisi.readOnly = true;
    inputNoresi.readOnly = true;
    inputTanggal.readOnly = true;
    inputStatus.readOnly = true;

    btnSimpan.disabled = true;
    btnSimpan.classList.add("disabled");
    btnBatal.disabled = true;
    btnBatal.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");
    btnKonfirmasi.disabled = true;
    btnKonfirmasi.classList.add("disabled");

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolIdPlg = document.querySelector("#pelanggan" + row).innerHTML;
        const kolTanggal = document.querySelector("#tanggal" + row).innerHTML;
        const kolSubtotal = document.querySelector("#subtotal" + row).innerHTML;
        const kolOngkir = document.querySelector("#ongkir" + row).innerHTML;
        const kolTotal = document.querySelector("#total" + row).innerHTML;
        const kolStatus = document.querySelector("#status" + row).innerHTML;
        const kolEkspedisi = document.querySelector("#ekspedisi" + row).innerHTML;
        const kolNoresi = document.querySelector("#noresi" + row).innerHTML;

        myTableRows.forEach((baris, index) => {
            if ( index === row ) {
                baris.style.background = 'lightgray';
            } else {
                baris.style.background = 'white';
            }
        });        

        // gambar.removeAttribute("hidden");
        gambar.src = "bukti_transfer/" + kolId + ".png";
        
        inputId.value = kolId;
        inputIdPlg.value = kolIdPlg;
        inputSubtotal.value = kolSubtotal;
        inputOngkir.value = kolOngkir;
        inputTotal.value = kolTotal;
        inputEkspedisi.value = kolEkspedisi;
        inputNoresi.value = kolNoresi;
        inputTanggal.value = kolTanggal;
        inputStatus.value = kolStatus;   
        
        if (inputStatus.value === 'dikemas') {
            btnKonfirmasi.disabled = false;
            btnKonfirmasi.classList.remove("disabled");
            inputStatus.classList.add("red");
        } else {
            btnKonfirmasi.disabled = true;
            btnKonfirmasi.classList.add("disabled");
            inputStatus.classList.remove("red");
        }

        btnUbah.disabled = false;
        btnUbah.classList.remove("disabled");        
        btnBatal.disabled = false;
        btnBatal.classList.remove("disabled");
        btnSimpan.disabled = true;
        btnSimpan.classList.add("disabled");
    }

    function ubah() {
       inputEkspedisi.readOnly = false;
       inputNoresi.readOnly = false;

       inputEkspedisi.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");        
    }

    function batal() {
        gambar.hidden = true;
        gambar.src = "";
        
        
        inputKategori.readOnly = false;
        inputNama.readOnly = false;
        inputHargaBeli.readOnly = false;
        inputHargaJual.readOnly = false;
        
        inputId.value = lastIdBarang;
        inputHargaBeli.value = "";
        inputHargaJual.value = "";
        inputNama.value = "";

        inputNama.focus();

        btnUbah.disabled = true;
        btnUbah.classList.add("disabled");
        btnBatal.disabled = true;
        btnBatal.classList.add("disabled");
        btnSimpan.disabled = true;
        btnSimpan.classList.add("disabled");
        btnTambah.disabled = false;
        btnTambah.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

</script>

</body>
</html>