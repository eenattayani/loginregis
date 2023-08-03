<?php

include "adm-config.php";
include "../dbconn.php";



if (isset($_POST["btn"])) {   

    if ( isset($_POST["fid-supplier"]) ) {        
        $idSupplier = $_POST["fid-supplier"];
    }
    $idBarang = $_POST["fhideid-barang"];
    $namaBarang = $_POST["fnama-barang"];
    $tanggal = $_POST["ftanggal-beli"];
    $harga = $_POST["fharga-barang"];
    $qty = $_POST["fqty"];
    $satuan = $_POST["fsatuan"];

    if ($_POST["btn"] === "tambah") {
        
        $t=time();    
        $idPembelian = $t;

        // ambil stok barang dari tabel barang
        $queryStok = "SELECT * FROM tbbarang WHERE id_barang = '$idBarang'";
        $resultStok = mysqli_query($connection, $queryStok);          
        $rowStokLama = mysqli_fetch_assoc($resultStok);
        $stokLama = $rowStokLama["stok"];
        $stokBaru = $stokLama + $qty;       
                        
        // tambah data tabel pembelian
        $queryTambah = "INSERT INTO tbpembelian (id_pembelian, id_supplier, id_barang, nama_barang, harga_barang, satuan, qty, tanggal_beli) VALUES ('$idPembelian','$idSupplier','$idBarang','$namaBarang','$harga','$satuan','$qty','$tanggal')";
        $resultTambah = mysqli_query($connection, $queryTambah);

        // tambah stok tabel barang
        $queryStok = "UPDATE tbbarang SET stok = '$stokBaru' WHERE id_barang = '$idBarang'";
        $resultStok = mysqli_query($connection, $queryStok);

        if ($resultTambah) {
            echo '
            <script>
                alert("berhasil menambah data!");
            </script>
            ';
        } else {
            echo '
            <script>
                alert("GAGAL menambah data!");
            </script>
            ';
        }
    } else if ($_POST["btn"] === "simpan") {
        
        $idPembelian = $_POST["fid-pembelian"];

        // ambil stok pada tabel pembelian
        $queryStokBeli = "SELECT qty FROM tbpembelian WHERE id_pembelian='$idPembelian'";
        $resultStokBeli = mysqli_query($connection,$queryStokBeli);
        $rowStokBeli = mysqli_fetch_assoc($resultStokBeli);
        $stokBeli = $rowStokBeli["qty"];

        // ambil stok pada tabel barang
        $queryStokBarang = "SELECT stok FROM tbbarang WHERE id_barang='$idBarang'";
        $resultStokBarang = mysqli_query($connection,$queryStokBarang);
        $rowStokBarang = mysqli_fetch_assoc($resultStokBarang);
        $stokBarang = $rowStokBarang["stok"];

        // stok barang dikurangi stok beli kemudian ditambahkan lagi
        $stokAwal = $stokBarang - $stokBeli;
        $stokBaru = $stokAwal + $qty;
        
        $queryUbah = "UPDATE tbpembelian SET id_supplier = '$idSupplier', id_barang = '$idBarang', nama_barang = '$namaBarang', harga_barang = '$harga', satuan = '$satuan', qty = $qty, tanggal_beli = '$tanggal' WHERE id_pembelian = '$idPembelian'";
        $resultUbah = mysqli_query($connection, $queryUbah);       
        
        // tambah stok tabel barang
        $queryStok = "UPDATE tbbarang SET stok = '$stokBaru' WHERE id_barang = '$idBarang'";
        $resultStok = mysqli_query($connection, $queryStok);

        if ($resultUbah) {
            echo '
            <script>
                alert("berhasil mengubah data!");
            </script>
            ';
        } else {
            echo '
            <script>
                alert("GAGAL mengubah data!");
            </script>
            ';
        }
    } else if  ($_POST["btn"] === "hapus") {
        $idPembelian = $_POST["fid-pembelian"];

        // ambil stok pada tabel pembelian
        $queryStokBeli = "SELECT qty FROM tbpembelian WHERE id_pembelian='$idPembelian'";
        $resultStokBeli = mysqli_query($connection,$queryStokBeli);
        $rowStokBeli = mysqli_fetch_assoc($resultStokBeli);
        $stokBeli = $rowStokBeli["qty"];

        // ambil stok pada tabel barang
        $queryStokBarang = "SELECT stok FROM tbbarang WHERE id_barang='$idBarang'";
        $resultStokBarang = mysqli_query($connection,$queryStokBarang);
        $rowStokBarang = mysqli_fetch_assoc($resultStokBarang);
        $stokBarang = $rowStokBarang["stok"];

        // stok barang dikurangi stok beli
        $stokAwal = $stokBarang - $stokBeli; 
        if ( $stokAwal < 0) { $stokAwal = 0;}       

        // tambah stok tabel barang
        $queryStok = "UPDATE tbbarang SET stok = '$stokAwal' WHERE id_barang = '$idBarang'";
        $resultStok = mysqli_query($connection, $queryStok);

        // hapus pada tabel pembelian
        $queryHapus = "DELETE FROM tbpembelian WHERE id_pembelian = '$idPembelian'";
        $resultHapus = mysqli_query($connection, $queryHapus);

        if ($resultHapus) {
            echo '
            <script>
                alert("berhasil menghapus data!");
            </script>
            ';
        } else {
            echo '
            <script>
                alert("GAGAL menghapus data!");
            </script>
            ';
        }
    }

}

//** ambil id supplier **/
$querySupplier = "SELECT * FROM tbsupplier";
$resultSupplier = mysqli_query($connection, $querySupplier);

// ** ambil data barang **/
$queryBarang = "SELECT * FROM tbbarang";
$resultBarang = mysqli_query($connection, $queryBarang);


$query = "SELECT * FROM tbpembelian ORDER BY id_pembelian DESC";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: " . mysqli_error($connection);
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
    <title>HB Admin - Data Pembelian</title>

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
                <li><a href="data-pembelian.php"><button class="active">Data Pembelian</button></a></li>
                <li><a href="data-penjualan.php"><button>Data Penjualan</button></a></li>
                <li><a href="data-pelanggan.php"><button>Data Pelanggan</button></a></li>
                <li><a href="data-supplier.php"><button>Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-ongkir.php"><button>Data Ongkir</button></a></li>
                <li><a href="data-keranjang.php"><button>Keranjang</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Pembelian</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Pembelian</th>
                            <th>Tanggal</th>                            
                            <th>Id Supplier</th>                            
                            <th>Id Barang</th>                            
                            <th>Nama Barang</th>                            
                            <th>Harga Barang</th>                            
                            <th>Qty</th>                            
                            <th>Satuan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="8"> == Belum ada data pembelian ==</td>
                        </tr>
                    <?php    
                        } else {                    
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                
                                echo "
                                <tr onclick=\"pilihBaris(". $r .")\">
                                    <td id=\"idbeli$r\">" . $row["id_pembelian"] . "</td>
                                    <td id=\"tanggal$r\">" . $row["tanggal_beli"] . "</td>
                                    <td id=\"idsupplier$r\">" . $row["id_supplier"] . "</td>                                
                                    <td id=\"idbarang$r\">" . $row["id_barang"] . "</td>                               
                                    <td id=\"namabarang$r\">" . $row["nama_barang"] . "</td>                               
                                    <td id=\"harga$r\">" . $row["harga_barang"] . "</td>                               
                                    <td id=\"qty$r\">" . $row["qty"] . "</td>                               
                                    <td id=\"satuan$r\">" . $row["satuan"] . "</td>                               
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
                            <label for="fid-pembelian">Id Pembelian</label>
                            <input type="text" name="fid-pembelian" id="fid-pembelian">
                            <label for="fid-supplier">Id Supplier</label>
                            <select name="fid-supplier" id="fid-supplier">
                            <?php
                                if ($resultSupplier->num_rows === 0) {
                            ?>
                                <option value="none">tambahkan supplier dahulu</option>

                            <?php
                                } else {
                                $rk = 1;
                                    while($rowSupplier = mysqli_fetch_assoc($resultSupplier)) {
                                        echo "                                        
                                            <option value=\"". $rowSupplier["id_supplier"]."\">". $rowSupplier["id_supplier"] . " - " . $rowSupplier["nama_supplier"] ."</option>                                            
                                        ";
                                        $rk++;
                                    }
                                }
                            ?>                                
                            </select>
                            <!-- <input type="text" name="fid-supplier" id="fid-supplier"> -->
                            <label for="fid-barang">Barang</label>
                            <select name="fid-barang" id="fid-barang">
                            <?php
                                if ($resultBarang->num_rows === 0) {
                            ?>
                                <option value="none">tambahkan Barang dahulu</option>

                            <?php
                                } else {
                                $rb = 1;
                                    while($rowBarang = mysqli_fetch_assoc($resultBarang)) {
                                        echo "                                        
                                            <option value=\"". $rowBarang["id_barang"]."\">". $rowBarang["id_barang"] . " - " . $rowBarang["nama_barang"] ."</option>                                            
                                        ";
                                        $rb++;
                                    }
                                }
                            ?>
                            </select>
                            <input type="hidden" name="fhideid-barang" id="fhideid-barang">
                            <!-- <label for="fnama-barang">Nama Barang</label> -->
                            <input type="hidden" name="fnama-barang" id="fnama-barang">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="ftanggal-beli" id="ftanggal-beli" required>
                        </div>
                        <div class="right">                            
                            <label for="fharga-barang">Harga Barang</label>
                            <input type="number" name="fharga-barang" id="fharga-barang" required>
                            <label for="fqty">Qty</label>
                            <input type="text" name="fqty" id="fqty" required>
                            <label for="fsatuan">Satuan</label>
                            <input type="text" name="fsatuan" id="fsatuan" required>
                            
                        </div>
                    </div>
                    <div class="part-action">
                        <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button>
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button type="submit" name="btn" id="btnhapus"  onclick="return confirm('Yakin Hapus Data?')" value="hapus">Hapus</button>                        
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>                       
                    </div>
                </form>
            </div>

        </div>
    </section>

<script>
    const inputId = document.querySelector("#fid-pembelian");
    const inputIdSupplier = document.querySelector("#fid-supplier");
    const inputIdBarang = document.querySelector("#fid-barang");
    const inputNamaBarang = document.querySelector("#fnama-barang");
    const inputHarga = document.querySelector("#fharga-barang");
    const inputQty = document.querySelector("#fqty");
    const inputSatuan = document.querySelector("#fsatuan");
    const inputTanggal = document.querySelector("#ftanggal-beli");

    const inputHideIdBarang = document.querySelector("#fhideid-barang");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");      
    const btnHapus = document.querySelector("#btnhapus");
    const btnUbah = document.querySelector("#btnubah");

    const myTableRows = document.querySelectorAll("#myTable tr");
      
    inputId.readOnly = true;
    inputNamaBarang.readOnly = true;

    inputHideIdBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[0];        
    inputNamaBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[1];

    btnSimpan.disabled = true;
    btnSimpan.classList.add("disabled");
    btnBatal.disabled = true;
    btnBatal.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");
    btnHapus.disabled = true;
    btnHapus.classList.add("disabled");
   

    inputIdBarang.addEventListener("change", ()=>{
        inputHideIdBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[0];        
        inputNamaBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[1];                
    });

    function pilihBaris(row) {
        const kolId = document.querySelector("#idbeli" + row).innerHTML;
        const kolIdSupplier = document.querySelector("#idsupplier" + row).innerHTML;
        const kolIdBarang = document.querySelector("#idbarang" + row).innerHTML;
        const kolNamaBarang = document.querySelector("#namabarang" + row).innerHTML;
        const kolHarga = document.querySelector("#harga" + row).innerHTML;
        const kolQty = document.querySelector("#qty" + row).innerHTML;
        const kolSatuan = document.querySelector("#satuan" + row).innerHTML;
        const kolTanggal = document.querySelector("#tanggal" + row).innerHTML;
        
        myTableRows.forEach((baris, index) => {
            if ( index === row ) {
                baris.style.background = 'lightgray';
            } else {
                baris.style.background = 'white';
            }
        });    
                
        inputIdSupplier.disabled = true;
        inputIdBarang.disabled = true;        
        inputHarga.readOnly = true;
        inputQty.readOnly = true;
        inputSatuan.readOnly = true;    
        inputTanggal.readOnly = true;
        
        inputId.value = kolId;
        inputIdSupplier.value = kolIdSupplier;
        inputIdBarang.value = kolIdBarang;
        inputNamaBarang.value = kolNamaBarang;
        inputHarga.value = kolHarga;
        inputQty.value = kolQty;
        inputSatuan.value = kolSatuan;
        inputTanggal.value = kolTanggal;    
        
        inputHideIdBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[0];        
        inputNamaBarang.value = inputIdBarang.options[inputIdBarang.selectedIndex].textContent.split(" - ")[1];                
                
        btnTambah.disabled = true;
        btnTambah.classList.add("disabled");
        btnUbah.disabled = false;
        btnUbah.classList.remove("disabled");        
        btnBatal.disabled = false;
        btnBatal.classList.remove("disabled");
        btnSimpan.disabled = true;
        btnSimpan.classList.add("disabled");
        btnHapus.disabled = false;
        btnHapus.classList.remove("disabled");

        console.log(inputIdSupplier.value);        
        console.log(inputIdBarang.value);        
    }

    function ubah() {     
       inputIdSupplier.disabled = false;
       inputHarga.readOnly = false;
       inputQty.readOnly = false;
       inputSatuan.readOnly = false;
       inputTanggal.readOnly = false;

       inputNamaBarang.focus();

       btnSimpan.disabled = false;
       btnSimpan.classList.remove("disabled");        
    }

    function batal() {                             
       inputHarga.readOnly = false;
       inputQty.readOnly = false;
       inputSatuan.readOnly = false;
       inputTanggal.readOnly = false;   
       inputIdSupplier.disabled = false;    
       inputIdBarang.disabled = false;    
        
        inputId.value = "";
        inputHarga.value = "";
        inputQty.value = "";
        inputSatuan.value = "";
        inputTanggal.value = "";

        inputHarga.focus();

        btnUbah.disabled = true;
        btnUbah.classList.add("disabled");
        // btnBatal.disabled = true;
        // btnBatal.classList.add("disabled");
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