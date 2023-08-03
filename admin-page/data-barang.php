<?php 

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include "adm-config.php";
include "../dbconn.php";

// cek button submit
if (isset($_POST["btn"])) {

    $id = $_POST["fid-barang"];
    $kategori = $_POST["fid-kategori"];
    $nama = $_POST["fnama-barang"];
    $harga_beli = $_POST["fharga-beli"];
    $harga_jual = $_POST["fharga-jual"];

    // cek apakah nama_barang sudah tersedia sebelumnya
    $query = "SELECT * FROM tbbarang";
    $result = mysqli_query($connection, $query);
   


    if ($_POST["btn"] === "tambah") {
        
        if ( $result->num_rows !== 0 ) {      
            while($rowNamaBarang = mysqli_fetch_assoc($result)){
                if ( strtolower($rowNamaBarang["nama_barang"]) === strtolower($nama) ) {
                    echo '
                    <script>
                        alert("Nama Barang Sudah Tersedia!");
                        location.replace("data-barang.php");
                    </script>
                ';
                exit;
                }
            }
        }

        // proses upload gambar
        $error = $_FILES["fgambar-barang"]["error"];

        if ($error === 0) {
            // pindahkan file folder produk_upload
            $namaFolder = "produk_upload";
            $tmp = $_FILES["fgambar-barang"]["tmp_name"];
            // $namaFile = $_FILES["fgambar-barang"]["name"];
            $namaFile = $id . ".png";
            
            if (move_uploaded_file($tmp, "$namaFolder/$namaFile")) {
                $pesanError = "File sukses diupload";
            } else {
                $pesanError = "File gagal diupload";
            }
        } else {
            $pesanError = "File gagal diupload";
        }
        
        $queryTambah = "INSERT INTO tbbarang (id_barang, id_kategori, nama_barang, harga_beli, harga_jual) VALUES ('$id','$kategori','$nama','$harga_beli','$harga_jual')";
        $resultTambah = mysqli_query($connection, $queryTambah);

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
        // if (isset($_POST["fgambar-barang"])) {       
            // proses upload gambar
            $error = $_FILES["fgambar-barang"]["error"];

            if ($error === 0) {
                // pindahkan file folder produk_upload
                $namaFolder = "produk_upload";
                $tmp = $_FILES["fgambar-barang"]["tmp_name"];
                // $namaFile = $_FILES["fgambar-barang"]["name"];
                $namaFile = $id . ".png";
                
                if (move_uploaded_file($tmp, "$namaFolder/$namaFile")) {
                    $pesanError = "File sukses diupload";
                } else {
                    $pesanError = "File gagal diupload";
                }
            } else {
                $pesanError = "File gagal diupload";
            }
        // }

        $queryUbah = "UPDATE tbbarang SET id_kategori = '$kategori', nama_barang = '$nama', harga_beli = '$harga_beli', harga_jual = '$harga_jual' WHERE id_barang = '$id'";
        $resultUbah = mysqli_query($connection, $queryUbah);        

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
        $queryHapus = "DELETE FROM tbbarang WHERE id_barang = '$id'";
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


//** ambil id kategori **/
$queryKategori = "SELECT * FROM tbkategori";
$resultKategori = mysqli_query($connection, $queryKategori);

//** ambil data dari tabel tbbarang **/
$query = "SELECT * FROM tbbarang";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

//** ambil nilai terakhir ID BARANG **/

$lastIdBarang = 0;
while($rowId = mysqli_fetch_assoc($result)) {                                
    // ubah string ke integer untuk mencari nilai terbesar  
    $idBarang = (int)substr($rowId["id_barang"] , 2);

    if ( $idBarang > $lastIdBarang ) {        
        $lastIdBarang = $idBarang;
    }     
} 

// kembalikan nilai integer ke string
$newIdBarang = $lastIdBarang + 1;
if ( $newIdBarang < 10 )       { $newIdBarangString = "IB000" . (string) $newIdBarang;} 
elseif ( $newIdBarang < 100 ) { $newIdBarangString = "IB00" . (string) $newIdBarang; }
elseif ( $newIdBarang < 1000 ) { $newIdBarangString = "IB0" . (string) $newIdBarang; }
else { $newIdBarangString = "IB" . (string) $newIdBarang; }


mysqli_free_result($result);

$query = "SELECT * FROM tbbarang";
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
    <title>HB Admin - Data Barang</title>

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
                <li><a href="data-barang.php"><button class="active">Data Barang</button></a></li>
                <li><a href="data-pembelian.php"><button>Data Pembelian</button></a></li>
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
                <h1>Data Barang</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Id Barang</th>
                            <th>Id Kategori</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="6"> == Tidak ada data ==</td>
                        </tr>
                    <?php    
                        } else {                    
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                
                                echo "
                                <tr onclick=\"pilihBaris(". $r .")\">
                                    <td id=\"id$r\">" . $row["id_barang"] . "</td>
                                    <td id=\"kategori$r\">" . $row["id_kategori"] . "</td>                                
                                    <td id=\"nama$r\">" . $row["nama_barang"] . "</td>                               
                                    <td id=\"hargabeli$r\">" . $row["harga_beli"] . "</td>                               
                                    <td id=\"hargajual$r\">" . $row["harga_jual"] . "</td>                               
                                    <td id=\"stok$r\">" . $row["stok"] . "</td>                               
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
                <!-- <?php if (!empty($pesanError)) {echo "<p>$pesanError</p>";} ?> -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-barang">Id Barang</label>
                            <input type="hidden" id="fid-hidden" value="<?=$newIdBarangString;?>">
                            <input type="text" name="fid-barang" id="fid-barang" oninput="inputData()" placeholder="id barang" required value="<?=$newIdBarangString;?>">
                            <label for="fid-kategori">Id Kategori</label>                            
                            <select name="fid-kategori" id="fid-kategori">
                            <?php
                                if ($resultKategori->num_rows === 0) {
                            ?>
                                <option value="none">tambahkan kategori dahulu</option>

                            <?php
                                } else {
                                $rk = 1;
                                    while($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                        echo "                                        
                                            <option value=\"". $rowKategori["id_kategori"]."\">". $rowKategori["nama_kategori"] ."</option>                                            
                                        ";
                                        $rk++;
                                    }
                                }
                            ?>                                
                            </select>
                            <label for="fnama-barang">Nama Barang</label>
                            <input type="text" name="fnama-barang" id="fnama-barang" oninput="inputData()" placeholder="nama barang" required>
                            
                        </div>
                        <div class="right">
                            <label for="fharga-beli">Harga Beli</label>
                            <input type="text" name="fharga-beli" id="fharga-beli" oninput="inputData()" placeholder="harga beli" required>
                            <label for="fharga-jual">Harga Jual</label>
                            <input type="text" name="fharga-jual" id="fharga-jual" oninput="inputData()" placeholder="harga jual" required>
                            <label for="fgambar-barang">Gambar</label>
                            <input type="file" name="fgambar-barang" id="fgambar-barang" accept="image/png">
                            <img id="img" src="" alt="" hidden>
                        </div>
                    </div>
                    <div class="part-action">
                        <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button>
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button type="submit" name="btn" id="btnhapus"  onclick="return confirm('Yakin Hapus Data?')" value="hapus">Hapus</button>                        
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>
                        <!-- <button class="keluar">Keluar</button> -->
                    </div>
                </form>
            </div>

        </div>
    </section>

<script>
    const inputIdHidden = document.querySelector("#fid-hidden");

    const inputId = document.querySelector("#fid-barang");
    const inputKategori = document.querySelector("#fid-kategori");
    const inputNama = document.querySelector("#fnama-barang");
    const inputGambar = document.querySelector("#fgambar-barang");
    const inputHargaBeli = document.querySelector("#fharga-beli");
    const inputHargaJual = document.querySelector("#fharga-jual");
    const gambar = document.querySelector("#img");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");
    const btnHapus = document.querySelector("#btnhapus");    
    const btnUbah = document.querySelector("#btnubah");

    const lastIdBarang = inputIdHidden.value;
    console.log(lastIdBarang);

    inputId.readOnly = true;

    btnSimpan.disabled = true;
    btnSimpan.classList.add("disabled");
    btnBatal.disabled = true;
    btnBatal.classList.add("disabled");
    btnHapus.disabled = true;
    btnHapus.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");

    inputGambar.addEventListener('change', function (event) {
        gambar.src = "";
    });    

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolKategori = document.querySelector("#kategori" + row).innerHTML;
        const kolNama = document.querySelector("#nama" + row).innerHTML;
        const kolHargaBeli = document.querySelector("#hargabeli" + row).innerHTML;
        const kolHargaJual = document.querySelector("#hargajual" + row).innerHTML;

        gambar.removeAttribute("hidden");
        gambar.src = "produk_upload/" + kolId + ".png";
        
        inputId.value = kolId;        
        inputKategori.value = kolKategori;
        inputNama.value = kolNama;        
        inputHargaBeli.value = kolHargaBeli;        
        inputHargaJual.value = kolHargaJual; 

        inputId.readOnly = true;
        inputKategori.readOnly = true;
        inputNama.readOnly = true;
        inputHargaBeli.readOnly = true;
        inputHargaJual.readOnly = true;
        inputGambar.readOnly = true;

        btnUbah.disabled = false;
        btnUbah.classList.remove("disabled");
        btnHapus.disabled = false;
        btnHapus.classList.remove("disabled");
        btnTambah.disabled = true;
        btnTambah.classList.add("disabled");
        btnBatal.disabled = false;
        btnBatal.classList.remove("disabled");
        btnSimpan.disabled = true;
        btnSimpan.classList.add("disabled");
    }

    function ubah() {
        inputKategori.readOnly = false;
        inputNama.readOnly = false;
        inputHargaBeli.readOnly = false;
        inputHargaJual.readOnly = false;
        inputGambar.readOnly = false;

        inputNama.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

    function batal() {
        gambar.hidden = true;
        gambar.src = "";
        
        
        inputKategori.readOnly = false;
        inputNama.readOnly = false;
        inputHargaBeli.readOnly = false;
        inputHargaJual.readOnly = false;
        inputGambar.readOnly = false;
        
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

    function inputData() {
        console.log("ubah data");

        if (inputId.value !== "" || inputNama.value !== "" || inputKategori.value !== "" || inputHargaBeli.value !== "" || inputHargaJual.value !== "") {
            btnBatal.disabled = false;
            btnBatal.classList.remove("disabled");

            return;
            console.log("hapus data");
        }

        btnBatal.disabled = true;
        btnBatal.classList.add("disabled");
    }
</script>
</body>
</html>