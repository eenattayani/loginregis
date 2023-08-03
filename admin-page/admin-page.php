<?php 

include "adm-config.php";
include "../dbconn.php";

// cek button submit
if (isset($_POST["btn"])) {
    
    $id = $_POST["fid-user"];
    $username = $_POST["fusername"];
    $pass = $_POST["fpass-user"];
    $nama = $_POST["fnama-user"];    

    if ($_POST["btn"] === "tambah") {
        
        $query = "INSERT INTO tbuser (id_user, username, password, nama_user) VALUES ('$id','$username','$pass','$nama')";
        $result = mysqli_query($connection, $query);

        if ($result) {
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
        mysqli_free_result($result);
    } else if ($_POST["btn"] === "simpan") {
        $query = "UPDATE tbuser SET username = '$username', password = '$pass', nama_user = '$nama' WHERE id_user = '$id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
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
        mysqli_free_result($result);
    } else if  ($_POST["btn"] === "hapus") {
        $query = "DELETE FROM tbuser WHERE id_user = '$id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
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
        mysqli_free_result($result);
    }

}

// ambil data dari tabel tbuser
$query = "SELECT * FROM tbuser";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

// mysqli_free_result($result);

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Data Pelanggan</title>

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
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><button class="btn-logout">Logout</button></li>
            </ul>
        </div>

        <div class="main data">
            <div class="tabel-data">
                <h1>Data Pelanggan</h1>
                <table>
                    <thead>
                        <tr>                            
                            <th>Id User</th>
                            <th>Username</th>                                                        
                            <th>Password</th>                            
                            <th>Nama User</th>                                                        
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
                                    <td id=\"id$r\">" . $row["id_user"] . "</td>
                                    <td id=\"username$r\">" . $row["username"] . "</td>                                
                                    <td id=\"pass$r\">" . $row["password"] . "</td>                                
                                    <td id=\"nama$r\">" . $row["nama_user"] . "</td>                                                                    
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
                            <label for="fid-user">Id User</label>
                            <input type="text" name="fid-user" id="fid-user" oninput="inputData()" placeholder="id user" required>
                            <label for="fusername">Username</label>
                            <input type="text" name="fusername" id="fusername" oninput="inputData()" placeholder="username" required>
                            <label for="fpass-user">Password</label>
                            <input type="text" name="fpass-user" id="fpass-user" oninput="inputData()" placeholder="password" required>
                            <label for="fnama-user">Nama</label>
                            <input type="text" name="fnama-user" id="fnama-user" oninput="inputData()" placeholder="nama" required>
                        </div>
                        <div class="right">                            
                            
                        </div>
                    </div>
                    <div class="part-action">
                        <button type="submit" name="btn" id="btntambah" value="tambah">Tambah</button>
                        <button type="submit" name="btn" id="btnsimpan" value="simpan">Simpan</button>
                        <button type="button" name="btn" id="btnbatal"  onclick="batal()">Batal</button>
                        <button hidden type="submit" name="btn" id="btnhapus"  onclick="return confirm('Yakin Hapus Data?')" value="hapus">Hapus</button>
                        <button type="button" name="btn" id="btncari"   value="cari">Cari</button>
                        <button type="button" name="btn" id="btnubah"   onclick="ubah()">Ubah</button>
                        <button class="keluar">Keluar</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

<script>
    const inputId = document.querySelector("#fid-user");
    const inputUsername = document.querySelector("#fusername");
    const inputPass = document.querySelector("#fpass-user");
    const inputNama = document.querySelector("#fnama-user");

    const btnTambah = document.querySelector("#btntambah");
    const btnSimpan = document.querySelector("#btnsimpan");
    const btnBatal = document.querySelector("#btnbatal");
    const btnHapus = document.querySelector("#btnhapus");
    const btnCari = document.querySelector("#btncari");
    const btnUbah = document.querySelector("#btnubah");

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

    function pilihBaris(row) {
        const kolId = document.querySelector("#id" + row).innerHTML;
        const kolUsername = document.querySelector("#username" + row).innerHTML;
        const kolPass = document.querySelector("#pass" + row).innerHTML;
        const kolNama = document.querySelector("#nama" + row).innerHTML;
        
        
        inputId.value = kolId;
        inputUsername.value = kolUsername;
        inputPass.value = kolPass;
        inputNama.value = kolNama;
        
        inputId.readOnly = true;
        inputUsername.readOnly = true;
        inputPass.readOnly = true;
        inputNama.readOnly = true;
        
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
        inputUsername.readOnly = false;
        inputPass.readOnly = false;
        inputNama.readOnly = false;
    
        inputUsername.focus();

        btnSimpan.disabled = false;
        btnSimpan.classList.remove("disabled");
        btnHapus.disabled = true;
        btnHapus.classList.add("disabled");
    }

    function batal() {
        inputId.readOnly = false;
        inputId.value = "";
        inputUsername.readOnly = false;
        inputUsername.value = "";
        inputPass.readOnly = false;
        inputPass.value = "";
        inputNama.readOnly = false;
        inputNama.value = "";    

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

        if (inputId.value !== "" || inputUsername.value !== "" || inputPass.value !== "" || inputNama.value !== "") {
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