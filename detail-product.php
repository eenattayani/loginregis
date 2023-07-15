<?php
$namaBarang ="Barangnya";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    
    include "dbconn.php";
    $query = "SELECT * FROM tbbarang WHERE id_barang='$id'";
    $result = mysqli_query($connection, $query);

    $data = mysqli_fetch_assoc($result);

    $idBarang = $data["id_barang"];
    $namaBarang = $data["nama_barang"];
    $hargaBarang = $data["harga_barang"];

    
    if (!$result) {
        echo "Query gagal: ".mysqli_error($connection);    
    }

    
    mysqli_close($connection);
} else {
    header("location:kategori.php");
}

$link_wishlist = "login.php?ke=detail-product.php?id=$id";
$link_account = "login.php?ke=detail-product.php?id=$id";
$link_cart = "login.php?ke=detail-product.php?id=$id";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Detail product</title>

    <link rel="stylesheet" href="css/style.css">

    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-detail-product">
    <header>        
        <a href="#" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="home.php" >Home</a>
            <a href="kategori.php">Category</a>
            <a href="#">About</a>
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
            <a href="<?=$link_wishlist;?>"><button><i class='bx bx-heart' ></i></button></a>
            <a href="<?=$link_account;?>"><button><i class='bx bx-user' ></i></button></a>
            <a href="<?=$link_cart;?>"><button><i class='bx bx-cart'></i></button></a>
        </div>
    </header>

    <section class="content-detail-product">
        <div class="product-img">
            <img src="admin-page/produk_upload/<?=$idBarang;?>.png" alt="">
        </div>

        <div class="product-desc">
            <div class="product-link">
                <p>Home / Category / Kecantikan</p>
            </div>
            <div class="product-name">
                <h2><?=$namaBarang;?></h2>
            </div>
            <div class="product-price">
                <h4>Rp <?=$hargaBarang;?></h4>
            </div>
            <div class="product-description">
                <h4>Deskripsi Produk</h4>
                <p>Produk ini memiliki sangat banyak kegunaan dalam kehidupan sehari-hari manusia untuk menunjang berbagai aktivitas yang beragam di masyarakat. </p>
            </div>
            <div class="product-action">
                <form action="checkout.php" method="post">
                    <div class="input">
                        <input type="hidden" name="id-barang" value="<?=$idBarang;?>">
                        <input type="hidden" name="harga-barang" value="<?=$hargaBarang;?>">
                        <div class="box-jlh">
                            <label for="product-jlh">Banyaknya</label>
                            <div>
                                <span onclick="kurangSubtotal()">-</span>
                                <input type="text" name="product-jlh" id="product-jlh" value="1" onchange="ubahSubtotal()">
                                <span onclick="tambahSubtotal()">+</span>
                            </div>
                        </div>
                        <div class="box-subtotal">
                            <label for="subtotal">Subtotal</label>                    
                            <input type="text" name="subtotal" id="subtotal" value="Rp <?=$hargaBarang;?>">
                        </div>
                    </div>
                    <div class="action">
                        <button type="submit" name="beli" class="keranjang">+ Keranjang</button>
                        <button type="submit" name="beli" class="beli">Beli</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <footer class="footer-detail-product">
        <p>Copyright &copy 2023</p>
    </footer>

<script src="js/script-product.js"></script>
</body>
</html>