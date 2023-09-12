<?php
session_start();

$pesanError = "";

if (isset($_GET["errorstok"])) {
    // echo '
    //     <script>
    //         alert("Stok Barang ' . $_GET["errorstok"] . ' tidak mencukupi!");            
    //     </script>
    // ';

    $pesanError = "=== Stok Barang " . $_GET["errorstok"] . " tidak mencukupi ===";
}

if (!isset($_SESSION["iduser"])) {
    
    echo '
        <script>
            alert("Silahkan Login dahulu!");
            location.replace("login.php");
        </script>
    ';

    exit;
}

$link_wishlist = "wishlist.php";
$link_account = "myorders.php";
$link_cart = "myorders.php";

include "dbconn.php";

$idPelanggan = $_SESSION["iduser"];

if (isset($_POST["keranjang"])) {
    // jika idpelanggan ditemukan, maka ubah stok saja
    // jika idpelanggan tidak ada, maka tambah data baru
        
    $idBarang = $_POST["id-barang"];
    $statusBeli = "keranjang";
    $jlhProduct = $_POST["product-jlh"];
    $hargaBarang = $_POST["harga-barang"];
    
    // panggil tabel keranjang dengan id pelanggan
    $query = "SELECT * FROM tbkeranjang WHERE id_pelanggan='$idPelanggan' AND id_barang ='$idBarang' AND status_beli='keranjang'";
    $result = mysqli_query($connection, $query);


    if ( $result->num_rows === 0 ) {
        $queryTambah = "INSERT INTO tbkeranjang (id_pelanggan, id_barang, status_beli, jlh_barang, harga_satuan, check_status) VALUES ('$idPelanggan','$idBarang','$statusBeli','$jlhProduct','$hargaBarang','1')";
        $resultTambah = mysqli_query($connection, $queryTambah);

        if ($resultTambah) {
            echo '
            <script>
                alert("berhasil menambah keranjang!");
                location.replace("kategori.php");
            </script>
            ';

            exit;
        } else {
            echo '
            <script>
                alert("GAGAL menambah keranjang!");
            </script>
            ';
        }
    } else {
        $row = mysqli_fetch_assoc($result);
        $jlh_lama = $row["jlh_barang"];

        $jlh_baru = $jlh_lama + $jlhProduct;
        $queryUbah = "UPDATE tbkeranjang SET jlh_barang = '$jlh_baru' WHERE id_pelanggan = '$idPelanggan' AND id_barang = '$idBarang' AND status_beli='keranjang'";
        $resultUbah = mysqli_query($connection, $queryUbah);

        if ($resultUbah) {
            echo '
            <script>
                alert("berhasil menambah keranjang!");   
                location.replace("kategori.php");             
            </script>
            ';

            exit;
        } else {
            echo '
            <script>
                alert("GAGAL menambah keranjang!");
            </script>
            ';
        }
    }

} elseif (isset($_POST["beli"])) {    
    
    $idBarang = $_POST["id-barang"];
    $statusBeli = "keranjang";
    $jlhProduct = $_POST["product-jlh"];
    $hargaBarang = $_POST["harga-barang"];
    
    // panggil tabel keranjang dengan id pelanggan
    $query = "SELECT * FROM tbkeranjang WHERE id_pelanggan='$idPelanggan' AND id_barang ='$idBarang' AND status_beli='keranjang'";
    $result = mysqli_query($connection, $query);

    if ( $result->num_rows === 0 ) {
        $queryTambah = "INSERT INTO tbkeranjang (id_pelanggan, id_barang, status_beli, jlh_barang, harga_satuan, check_status) VALUES ('$idPelanggan','$idBarang','$statusBeli','$jlhProduct','$hargaBarang','1')";
        $resultTambah = mysqli_query($connection, $queryTambah);       
    }

} elseif (isset($_POST["hapus"])) {
    $idBarang = $_POST["hapus"];

    $query = "DELETE FROM tbkeranjang WHERE id_pelanggan='$idPelanggan' AND id_barang ='$idBarang' AND status_beli='keranjang'";
    $result = mysqli_query($connection, $query);

} elseif (isset($_POST["tambah"])) {
    $idBarang = $_POST["tambah"];
    $jlh = $_POST["product-jlh"];
    $jlh = $jlh + 1;

    $queryUbah = "UPDATE tbkeranjang SET jlh_barang = '$jlh' WHERE id_pelanggan = '$idPelanggan' AND id_barang = '$idBarang' AND status_beli='keranjang'";
    $resultUbah = mysqli_query($connection, $queryUbah);

} elseif (isset($_POST["kurang"])) {
    $idBarang = $_POST["kurang"];
    $jlh = $_POST["product-jlh"];
    $jlh = $jlh - 1;
    if ($jlh < 1) {
        $jlh = 1;
    }

    $queryUbah = "UPDATE tbkeranjang SET jlh_barang = '$jlh' WHERE id_pelanggan = '$idPelanggan' AND id_barang = '$idBarang' AND status_beli='keranjang'";
    $resultUbah = mysqli_query($connection, $queryUbah);

}

// panggil tabel keranjang dengan id pelanggan
$query = "SELECT * FROM tbkeranjang WHERE id_pelanggan ='$idPelanggan' AND status_beli='keranjang'";
$result = mysqli_query($connection, $query);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Wishlist</title>

    <link rel="stylesheet" href="css/style.css">

    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-wishlist">
     <header>        
        <a href="#" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="home.php" >Home</a>
            <a href="kategori.php">Category</a>
            <a href="#" >About</a>
        </nav>
        <div class="search-bar">
            <div class="search-icon">
                <i class='bx bx-search'></i>
            </div>
            <div class="search-input">
                <input type="text" name="search" id="search" class="search-input" placeholder="Search">
            </div>
        </div>
        <div class="icon-bar">
            <a href="<?=$link_wishlist;?>"><button class="active-btn"><i class='bx bx-heart' ></i></button></a>
            <a href="<?=$link_account;?>"><button><i class='bx bx-user' ></i></button></a>
            <a href="<?=$link_cart;?>"><button><i class='bx bx-cart'></i></button></a>
            <?php 
                if (isset($_SESSION["user"])) {
            ?>        
                    <a href="<?=$link_cart;?>"><span><i>Hello <?=$_SESSION["user"];?> ! </i></span></a>
            <?php        
                }
            ?>
        </div>
    </header>

    <section class="content-wishlist">
        <div class="content-path">
            <p>Home <i class='bx bxs-chevron-right'></i> My Account <i class='bx bxs-chevron-right'></i> <span>Wishlist</span></p>
        </div>
        
        <div class="content-main">

            <div class="sidebar-summary">
                <h2>Hello <?=$_SESSION["user"];?></h2>
                <ul>
                    <li><i class='bx bx-shopping-bag'></i><a href="myorders.php">My orders</a></li>
                    <li class="active"><i class='bx bx-heart' ></i><a href="wishlist.php">Wishlist</a></li>
                    <li><i class='bx bx-user' ></i><a href="#">My info</a></li>
                    <li><i class='bx bx-log-in-circle'></i><a href="login.php">Sign out</a></li>
                </ul>
            </div>

            <div class="wishlist-detail">                
                <h2>Wishlist</h2>
                <p><i><?=$pesanError;?></i></p>
                <?php 
                    $checkoutState = true;
                    if ( $result->num_rows === 0 ) {
                        echo "<p>Data Keranjang Kosong</p>";
                        $checkoutState = false;
                    } else {
                        $rp = 1;
                        while($row = mysqli_fetch_assoc($result)) {   
                ?>               
                        <form action="" method="POST">
                            <div class="list-wishlist">                                
                                <div class="img-nama">
                                    <div class="checkbox">
                                        <input type="checkbox" name="check-status" value="<?=$row["id_barang"]. "&" .$row["id_pelanggan"];?>" <?php if ( $row["check_status"] === '1' ) { echo "checked"; }?> onchange="checkUncheck(event)">
                                        <!-- <input type="checkbox" value="12" onchange="checkUncheck(event)"> -->
                                    </div>
                                    <div class="img"><img src="admin-page/produk_upload/<?=$row["id_barang"];?>.png" alt=""></div>
                                    <div class="nama-qty">
                                        <span class="nama"><?=$row["id_barang"];?></span>
                                        <div class="qty">
                                            <span>Qty : </span>
                                            <div class="box-qty">
                                                <button type="submit" name="kurang" value="<?=$row["id_barang"];?>">-</button>
                                                <input type="text" name="product-jlh" id="product-jlh" value="<?=$row["jlh_barang"];?>" maxlength="4">
                                                <button type="submit" name="tambah" value="<?=$row["id_barang"];?>">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="harga">
                                    <span>Rp <?=$row["harga_satuan"];?></span>
                                </div>
                                <div class="btn-hapus">
                                    <button type="submit" name="hapus" value="<?=$row["id_barang"];?>"><i class='bx bx-trash'></i></button>
                                </div>
                            </div>                                                  
                        </form>                            
                <?php            
                        $rp++;    
                        } 
                    }
                ?>

                <form action="checkout.php" method="POST">
                    <div class="btn-checkout">
                        <button type="submit" name="checkout" value="<?=$row["id_barang"];?>" <?php if (!$checkoutState){echo "disabled";}?>> Checkout <i class='bx bx-check-circle'></i></button>
                    </div>
                </form>
                            
            </div>

            
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>

    <script>       
        
        function checkUncheck(event){
            const value = event.target.value;            
            let statusChecked = 1;
            
            // console.log(value);
            // console.log(event.target.checked);

            if (event.target.checked) {
                statusChecked = 1;
            } else {
                statusChecked = 0;
            }

            const idBarang = value.split("&")[0];
            const idPelanggan = value.split("&")[1];

            // console.log("id barang: " , idBarang );
            // console.log("id pelanggan: " , idPelanggan );

            ubahStatusCheck(idBarang, idPelanggan, statusChecked);
        }

        function ubahStatusCheck(idBarang, idPelanggan, statusChecked) {            
            let ajaxRequest = new XMLHttpRequest();            
            ajaxRequest.onreadystatechange = function () {                
                if (ajaxRequest.readyState == 4) {
                    let responTeks = ajaxRequest.responseText;

                    // alert(`responnya: ${responTeks}`);                        
                    // if (responTeks == "0") {
                    //     alert(`Pengiriman gagal, perangkat tidak terhubung!`);                        
                    // } else if (responTeks == "1") {
                    //     alert(`Pengiriman berhasil!`);
                    // }
                }
            };

            ajaxRequest.open("POST", "wishlist-query.php", true);
            ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajaxRequest.send(`idbarang=${idBarang}&idpelanggan=${idPelanggan}&state=${statusChecked}`);
        }
    </script>    
</body>
</html>
 

