<?php
if (isset($_POST["beli"])) {
    
    $idBarang = $_POST["id-barang"];
    $jlhProduct = $_POST["product-jlh"];
    $hargaBarang = $_POST["harga-barang"];
    
    $subtotal = $hargaBarang * (int)$jlhProduct;
    $ongkir = 15000;
    $total = $subtotal + $ongkir;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Checkout</title>

    <link rel="stylesheet" href="css/style.css">

    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-checkout">
     <header>        
        <a href="#" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="home.php">Home</a>
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
            <button><i class='bx bx-heart' ></i></button>
            <button><i class='bx bx-user' ></i></button>
            <button class="active-btn"><i class='bx bx-cart'></i></button>
        </div>
    </header>

    <section class="content-checkout">
        <div class="content-path">
            <p>Home <i class='bx bxs-chevron-right'></i> My Account <i class='bx bxs-chevron-right'></i> <span>Check Out</span></p>
        </div>
        <div class="content-main">
            <div class="checkout-detail">
                <h1>Check Out</h1>
                <h2>Details</h2>

                <div class="data-pelanggan">
                    <div class="nama">
                        <div class="nama-depan">
                            <label for="">Nama Depan</label>
                            <input type="text" placeholder="nama depan">
                        </div>
                        <div class="nama-belakang">
                            <label for="">Nama Belakang</label>
                            <input type="text" placeholder="nama belakang">
                        </div>
                    </div>

                    <div class="tujuan">
                        <div class="alamat">
                            <label for="">Alamat</label>
                            <input type="text" placeholder="alamat">
                        </div>
                        <div class="no-rumah">
                            <label for="">No Rumah</label>
                            <input type="text" placeholder="no rumah">
                        </div>
                    </div>

                    <div class="tujuan">
                        <div class="kota">
                            <label for="">Kota</label><br>
                            <input type="text" placeholder="kota">
                        </div>
                        <div class="kode-pos">
                            <label for="">Kode Pos</label><br>
                            <input type="text" placeholder="kode pos">
                        </div>
                    </div>

                    <div class="Phone">
                        <div class="no-hp">
                            <label for="">Phone*</label>
                            <input type="text" placeholder="phone">
                        </div>
                    </div>
                </div>

                <h4>Metode Pengiriman</h4>
                <div class="info-pengiriman">
                    <p class="est-tanggal">Akan diterima pada tanggal 12-14 Juli 2023</p>
                    <div class="est-biaya">
                        <div>
                            <p class="label-est-biaya">Biaya Pengiriman</p>
                            <p>Regular</p>
                        </div>
                        <div>
                            <p class="nilai-est-biaya">Rp <?=$ongkir;?></p>
                        </div>
                    </div>
                </div>
                <h4></h4>
            </div>

            <div class="sidebar-summary">
                <form action="pembayaran.php" method="POST">
                    <h2>Order Summary</h2>
                    <div class="products">
                        <div class="produk-1">
                            <img src="admin-page/produk_upload/<?=$idBarang;?>.png" alt="">
                            <p><?="$idBarang x $jlhProduct";?> </p>
                            <p>Rp <?=$hargaBarang;?></p>
                        </div>                    
                    </div>
    
                    <div class="subtotal">
                        <span>Subtotal <span class="produk-item">(<?=$jlhProduct;?> items)</span></span>
                        <span>Rp <?=$subtotal?></span>
                    </div>
                    <div class="biaya-kirim">
                        <span>Biaya Pengiriman</span>
                        <span>Rp <?=$ongkir;?></span>
                    </div>
                    <div class="total">
                        <span>Total</span>
                        <span>Rp <?=$total;?></span>
                    </div>
                    <div class="btn-checkout">
                        <input type="hidden" name="product-jlh" value="<?=$jlhProduct;?>">
                        <input type="hidden" name="ongkir" value="<?=$ongkir;?>">
                        <input type="hidden" name="subtotal" value="<?=$subtotal;?>">
                        <input type="hidden" name="total" value="<?=$total;?>">
                        <button type="submit" name="bayar" id="bayar">Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
    
</body>
</html>

<?php
} else {
    header("location:kategori.php");
}
?>