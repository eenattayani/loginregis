<?php
session_start();

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


// panggil tbpenjualan dengan id pelanggan
// $query = "SELECT * FROM tbpenjualan WHERE id_pelanggan ='$idPelanggan' AND status_penjualan!='tunggu bayar'";
$query = "SELECT * FROM tbpenjualan WHERE id_pelanggan ='$idPelanggan' ORDER BY id_penjualan DESC";
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
    <title>HB - My Orders</title>

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
             <a href="<?=$link_wishlist;?>"><button><i class='bx bx-heart' ></i></button></a>
            <a href="<?=$link_account;?>"><button><i class='bx bx-user' ></i></button></a>
            <a href="<?=$link_cart;?>"><button class="active-btn"><i class='bx bx-cart'></i></button></a>
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
                    <li class="active"><i class='bx bx-shopping-bag'></i><a href="myorders.php">My orders</a></li>
                    <li><i class='bx bx-heart' ></i><a href="wishlist.php">Wishlist</a></li>
                    <li><i class='bx bx-user' ></i><a href="#">My info</a></li>
                    <li><i class='bx bx-log-in-circle'></i><a href="login.php">Sign out</a></li>
                </ul>
            </div>

            <div class="wishlist-detail">                
                <h2>My Orders</h2>
                <?php                     
                    if ( $result->num_rows === 0 ) {
                        echo "<p>Belum ada order</p>";                      
                    } else {
                        while($row = mysqli_fetch_assoc($result)) {                           
                ?>               
                        <form action="pembayaran.php" method="POST">
                            <div class="list-wishlist myorders">
                                <div class="img-nama">                                    
                                    <div class="nama-qty">
                                        <label for="no order">No. Order</label>
                                        <span><?=$row["id_penjualan"];?></span>
                                    </div>
                                </div>
                                <div class="tanggal">
                                    <label for="tanggal">Tgl. Order</label>
                                    <span class="keterangan"><?=$row["tanggal"];?></span>
                                </div>
                                <div>
                                    <label for="harga">Total Bayar</label>
                                    <span class="keterangan">Rp <?=$row["harga_total"];?></span>
                                </div>
                                <div>
                                    <label for="status">Status Order</label>
                                    <span class="keterangan"><?=$row["status_penjualan"];?></span>
                                </div>                            
                                <div class="btn-bayar">
                                    
                                <?php if ( $row["status_penjualan"] === 'tunggu bayar' ) { ?>
                                    <button type="submit" name="bayar" value="<?=$row["id_penjualan"];?>"> Bayar Sekarang <i class='bx bx-credit-card' ></i></button>
                                <?php } else {?>                                        
                                    <button type="submit" name="terima" value="<?=$row["id_penjualan"];?>" <?php if($row["status_penjualan"] !== 'dikirim') {echo "class=\"gray\" disabled";}?> > Barang Diterima </button>                                    
                                <?php } ?>
                                </div>                                                
                            </div>  
                        </form>                            
                <?php            
                        } 
                    }
                ?>
                            
            </div>

            
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
    
</body>
</html>


