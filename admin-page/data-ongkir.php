<?php

include "adm-config.php";
include "../dbconn.php";


// cek button submit
if (isset($_POST["btn"])) {
    
    $id = $_POST["fid-wilayah"];
    $nama = $_POST["fnama-wilayah"];
    $ongkir = $_POST["fongkir"];

    if ($_POST["btn"] === "tambah") {

        $queryTambah = "INSERT INTO tbongkir VALUES ('','$nama','$ongkir')";
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
        $queryUbah = "UPDATE tbongkir SET nama_wilayah = '$nama' , ongkos = '$ongkir' WHERE id_wilayah = '$id'";
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
        $queryHapus = "DELETE FROM tbongkir WHERE id_wilayah = '$id'";
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


// ambil data dari tabel tbongkir
$query = "SELECT * FROM tbongkir ORDER BY id_wilayah";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

// var_dump($result);

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Biaya Pengiriman</title>

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
                <li><a href="data-ongkir.php"><button class="active">Data Ongkir</button></a></li>
                <li><a href="data-keranjang.php"><button>Keranjang</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Biaya Pengiriman</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Wilayah</th>
                            <th>Nama Wilayah</th>                       
                            <th>Biaya Kirim</th>                       
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="3"> == Tidak ada data ==</td>
                        </tr>
                    <?php    
                        } else {                    
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                
                                echo "
                                <tr onclick=\"pilihBaris(". $r .")\">
                                    <td id=\"id$r\">" . $row["id_wilayah"] . "</td>
                                    <td id=\"nama$r\">" . $row["nama_wilayah"] . "</td>                                
                                    <td id=\"ongkir$r\">" . $row["ongkos"] . "</td>                                
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
                <form method="POST" action="">
                    <div class="part-input">
                        <div class="left">
                            <label for="fid-wilayah">Id Wilayah</label>
                            <input type="text" name="fid-wilayah" id="fid-wilayah" oninput="inputData()" placeholder="id wilayah" required>
                            <label for="fnama-wilayah">Wilayah</label>
                            <input type="text" name="fnama-wilayah" id="fnama-wilayah" oninput="inputData()" placeholder="wilayah" required>
                            <label for="fnama-wilayah">Biaya Kirim</label>
                            <input type="number" name="fongkir" id="fongkir" oninput="inputData()" placeholder="biaya kirim" required>
                        </div>
                        <div class="right">                            

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

<!-- <script src="../js/script-kategori.js"></script> -->
<script>
    const inputId = document.querySelector("#fid-wilayah");
    const inputNama = document.querySelector("#fnama-wilayah");
    const inputOngkir = document.querySelector("#fongkir");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");
    const btnHapus = document.querySelector("#btnhapus");
    const btnUbah = document.querySelector("#btnubah");

    btnSimpan.disabled = true;
    btnSimpan.classList.add("disabled");
    btnBatal.disabled = true;
    btnBatal.classList.add("disabled");
    btnHapus.disabled = true;
    btnHapus.classList.add("disabled");
    btnUbah.disabled = true;
    btnUbah.classList.add("disabled");

    inputId.readOnly = true;

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolNama = document.querySelector("#nama" + row).innerHTML;
        const kolOngkir = document.querySelector("#ongkir" + row).innerHTML;

        
        inputId.value = kolId;
        inputNama.value = kolNama;
        inputOngkir.value = kolOngkir;
        inputId.readOnly = true;
        inputNama.readOnly = true;
        inputOngkir.readOnly = true;

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
        inputNama.readOnly = false;
        inputOngkir.readOnly = false;
        
        inputNama.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

    function batal() {
        inputId.readOnly = false;
        inputId.value = "";
        inputNama.readOnly = false;
        inputNama.value = "";
        inputOngkir.readOnly = false;
        inputOngkir.value = "";
        
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

    if (inputId.value !== "" || inputNama.value !== "") {
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