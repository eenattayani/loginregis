<?php
session_start();

include "dbconn.php";

$query = "SELECT * FROM tbbarang";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Query gagal: ".mysqli_error($connection);    
}

mysqli_close($connection);

// while ($row = mysqli_fetch_assoc($result)) {
    
// }

$link_wishlist = "login.php?ke=kategori.php";
$link_account = "login.php?ke=kategori.php";
$link_cart = "login.php?ke=kategori.php";

if (isset($_SESSION["login"])) {
    
    if ( $_SESSION["login"] === true ) {
        $link_wishlist = "wishlist.php";
        $link_account = "myorders.php";
        $link_cart = "myorders.php";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Kategori</title>

    <link rel="stylesheet" href="css/style.css">

    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-kategori">
    <header>        
        <a href="home.php" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="home.php" >Home</a>
            <a href="kategori.php" class="active">Category</a>
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
            <?php 
                if (isset($_SESSION["user"])) {
            ?>        
                    <a href="<?=$link_cart;?>"><span><i>Hello <?=$_SESSION["user"];?> ! </i></span></a>
            <?php        
                }
            ?>
        </div>
    </header>

    <section class="content">
        <div class="sidebar">
            <div class="sidebar-title">
                <h4>Filter</h4>
                <i class='bx bx-slider'></i>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li>Aksesoris<i class='bx bxs-chevron-right'></i></li>
                    <li>Kecantikan<i class='bx bxs-chevron-right'></i></li>
                    <li>Atk<i class='bx bxs-chevron-right'></i></li>
                    <li>Mainan Anak<i class='bx bxs-chevron-right'></i></li>
                </ul>
            </div>

        </div>
        <div class="main-content">
            <div class="main-content-text">
                <div class="text-left">Atk</div>
                <div class="text-right"><span class="active">New</span><span>Recommended</span></div>
            </div>
            <div class="main-content-products">
            <?php while ($produk = mysqli_fetch_assoc($result)) { ?>

                <div class="product-box">
                    <div class="img">
                        <img class="product-img" src="admin-page/produk_upload/<?=$produk['id_barang'];?>.png" alt="buku">
                    </div>
                    <div class="desc">
                        <a href="detail-product.php?id=<?=$produk['id_barang'];?>"><p class="product-name"><?=$produk['nama_barang'];?></p></a>
                        <p class="product-desc"><?=$produk['id_kategori'];?></p>
                    </div>
                    <div class="harga">
                        <span>Rp <?=$produk['harga_jual'];?></span>
                    </div>
                    <div class="like-icon">
                        <i class='bx bx-heart' ></i>
                    </div>
                </div>        

            <?php }  ?>
                
            </div>
        </div>
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
</body>
</html>