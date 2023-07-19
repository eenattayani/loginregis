<?php 

include "../dbconn.php";

// cek button submit
if (isset($_POST["btn"])) {
    
    $id = $_POST["fid-supplier"];
    $nama = $_POST["fnama-supplier"];
    $telp = $_POST["ftelp-supplier"];
    $alamat = $_POST["falamat-supplier"];

    if ($_POST["btn"] === "tambah") {
        
        $queryTambah = "INSERT INTO tbsupplier (id_supplier, nama_supplier, no_telpon_supplier, alamat_supplier) VALUES ('$id','$nama','$telp','$alamat')";
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
        $queryUbah = "UPDATE tbsupplier SET nama_supplier = '$nama', no_telpon_supplier = '$telp', alamat_supplier = '$alamat' WHERE id_supplier = '$id'";
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
        $queryHapus = "DELETE FROM tbsupplier WHERE id_supplier = '$id'";
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

// ambil data dari tabel tbsupplier
$query = "SELECT * FROM tbsupplier";
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
    <title>HB Admin - Data Supplier</title>

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
                <li><a href="data-supplier.php"><button class="active">Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Supplier</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id Supplier</th>
                            <th>Nama</th>                            
                            <th>No Telp</th>                            
                            <th>Alamat</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ( $result->num_rows === 0 ) {
                    ?>
                        <tr>
                            <td colspan="4"> == Tidak ada data ==</td>
                        </tr>
                    <?php    
                        } else {                    
                            $r = 1;
                            while($row = mysqli_fetch_assoc($result)) {                                
                                echo "
                                <tr onclick=\"pilihBaris(". $r .")\">
                                    <td id=\"id$r\">" . $row["id_supplier"] . "</td>
                                    <td id=\"nama$r\">" . $row["nama_supplier"] . "</td>                                
                                    <td id=\"telp$r\">" . $row["no_telpon_supplier"] . "</td>                                
                                    <td id=\"alamat$r\">" . $row["alamat_supplier"] . "</td>                                
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
                            <label for="fid-supplier">Id Supplier</label>
                            <input type="text" name="fid-supplier" id="fid-supplier" oninput="inputData()" placeholder="id supplier" required>
                            <label for="fnama-supplier">Supplier</label>
                            <input type="text" name="fnama-supplier" id="fnama-supplier" oninput="inputData()" placeholder="nama supplier" required>
                        </div>
                        <div class="right">                            
                            <label for="ftelp-supplier">No Telp</label>
                            <input type="text" name="ftelp-supplier" id="ftelp-supplier" oninput="inputData()" placeholder="nomor telepon" required>
                            <label for="falamat-supplier">Alamat</label>
                            <input type="text" name="falamat-supplier" id="falamat-supplier" oninput="inputData()" placeholder="alamat" required>
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
    const inputId = document.querySelector("#fid-supplier");
    const inputNama = document.querySelector("#fnama-supplier");
    const inputTelp = document.querySelector("#ftelp-supplier");
    const inputAlamat = document.querySelector("#falamat-supplier");

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

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolNama = document.querySelector("#nama" + row).innerHTML;
        const kolTelp = document.querySelector("#telp" + row).innerHTML;
        const kolAlamat = document.querySelector("#alamat" + row).innerHTML;

        // console.log("barisnya: " + row + kolId + " dan " + kolNama);
        inputId.value = kolId;
        inputNama.value = kolNama;
        inputTelp.value = kolTelp;
        inputAlamat.value = kolAlamat;
        inputId.readOnly = true;
        inputNama.readOnly = true;
        inputTelp.readOnly = true;
        inputAlamat.readOnly = true;

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
        inputTelp.readOnly = false;
        inputAlamat.readOnly = false;

        inputNama.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

    function batal() {
        inputNama.readOnly = false;
        inputNama.value = "";
        inputId.readOnly = false;
        inputId.value = "";
        inputTelp.readOnly = false;
        inputTelp.value = "";
        inputAlamat.readOnly = false;
        inputAlamat.value = "";

        inputId.focus();

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

        if (inputId.value !== "" || inputNama.value !== "" || inputTelp.value !== "" || inputAlamat.value !== "") {
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