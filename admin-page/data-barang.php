<?php 

include "../dbconn.php";

// cek button submit
if (isset($_POST["btn"])) {
    
    $id = $_POST["fid-barang"];
    $kategori = $_POST["fid-kategori"];
    $nama = $_POST["fnama-barang"];
    $harga = $_POST["fharga"];
    $stok = $_POST["fstok"];
    $satuan = $_POST["fsatuan"];

    if ($_POST["btn"] === "tambah") {

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
        
        $queryTambah = "INSERT INTO tbbarang (id_barang, id_kategori, nama_barang, harga_barang, stok_barang, satuan) VALUES ('$id','$kategori','$nama','$harga','$stok','$satuan')";
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
        $queryUbah = "UPDATE tbbarang SET id_kategori = '$kategori', nama_barang = '$nama', harga_barang = '$harga', stok_barang = '$stok', satuan = '$satuan' WHERE id_barang = '$id'";
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
else if ( $newIdBarang < 100 ) { $newIdBarangString = "IB00" . (string) $newIdBarang; }
else if ( $newIdBarang < 1000 ) { $newIdBarangString = "IB0" . (string) $newIdBarang; }
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
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
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
                            <th>Harga Barang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
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
                                    <td id=\"harga$r\">" . $row["harga_barang"] . "</td>                                
                                    <td id=\"stok$r\">" . $row["stok_barang"] . "</td>                                
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
                            <label for="fgambar-barang">Gambar</label>
                            <input type="file" name="fgambar-barang" id="fgambar-barang" accept="image/png">
                            <img id="img" src="" alt="" hidden>
                        </div>
                        <div class="right">
                            <label for="fharga">Harga</label>
                            <input type="text" name="fharga" id="fharga" oninput="inputData()" placeholder="harga" required>
                            <label for="fstok">Stok</label>
                            <input type="text" name="fstok" id="fstok" oninput="inputData()" placeholder="stok" required>
                            <label for="fsatuan">Satuan</label>
                            <input type="text" name="fsatuan" id="fsatuan" oninput="inputData()" placeholder="satuan" required>
                        </div>
                    </div>
                    <div class="part-action">
                        <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button>
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button type="submit" name="btn" id="btnhapus"  onclick="return confirm('Yakin Hapus Data?')" value="hapus">Hapus</button>
                        <button type="button" name="btn" id="btncari"   value="cari">Cari</button>
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>
                        <button class="keluar">Keluar</button>
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
    const gambar = document.querySelector("#img");
    const inputHarga = document.querySelector("#fharga");
    const inputStok = document.querySelector("#fstok");
    const inputSatuan = document.querySelector("#fsatuan");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");
    const btnHapus = document.querySelector("#btnhapus");
    const btnCari = document.querySelector("#btncari");
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
    btnCari.disabled = true;
    btnCari.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");

    inputGambar.addEventListener('change', function (event) {
        gambar.src = "";
    });    

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolKategori = document.querySelector("#kategori" + row).innerHTML;
        const kolNama = document.querySelector("#nama" + row).innerHTML;
        const kolHarga = document.querySelector("#harga" + row).innerHTML;
        const kolStok = document.querySelector("#stok" + row).innerHTML;
        const kolSatuan = document.querySelector("#satuan" + row).innerHTML;

        gambar.removeAttribute("hidden");
        gambar.src = "produk_upload/" + kolId + ".png";
        
        inputId.value = kolId;        
        inputKategori.value = kolKategori;
        inputNama.value = kolNama;
        inputHarga.value = kolHarga;
        inputStok.value = kolStok;
        inputSatuan.value = kolSatuan;
        inputId.readOnly = true;
        inputKategori.readOnly = true;
        inputNama.readOnly = true;
        inputHarga.readOnly = true;
        inputStok.readOnly = true;
        inputSatuan.readOnly = true;

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
        inputHarga.readOnly = false;
        inputSatuan.readOnly = false;
        inputSatuan.readOnly = false;

        inputNama.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

    function batal() {
        gambar.hidden = true;
        gambar.src = "";
        
        inputId.value = lastIdBarang;
        inputKategori.readOnly = false;
        inputNama.readOnly = false;
        inputNama.value = "";
        inputHarga.readOnly = false;
        inputHarga.value = "";
        inputStok.readOnly = false;
        inputStok.value = "";
        inputSatuan.readOnly = false;
        inputSatuan.value = "";

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

        if (inputId.value !== "" || inputNama.value !== "" || inputEmail.value !== "" || inputPass.value !== "" || inputTelp.value !== "" || inputAlamat.value !== "") {
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