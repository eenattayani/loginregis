<?php
session_start();

if (!isset($_SESSION["iduser"])) {
    
    echo '
        <script>
            alert("Silahkan Login dahulu!");
            location.replace("login.php");
        </script>
    ';
}


$link_wishlist = "wishlist.php";
$link_account = "myorders.php";
$link_cart = "myorders.php";

$idPelanggan = $_SESSION["iduser"];
$namaPelanggan = $_SESSION["user"];
$emailPelanggan = $_SESSION["emailuser"];
$alamatPelanggan = $_SESSION["alamatuser"];
$hpPelanggan = $_SESSION["nohp"];

include "dbconn.php";

if ( isset($_POST["checkout"]) ) {

    $idBarang = "IB0001";
    $jlhProduct = 3;
    $hargaBarang = 15000;    
    
    $subtotal = 0;
    $ongkir = 15000;
    $total = $subtotal + $ongkir;    

    // ambil data ongkir
    $query = "SELECT * FROM tbongkir";
    $result = mysqli_query($connection, $query);

    // panggil tabel keranjang dengan id pelanggan
    $queryCart = "SELECT * FROM tbkeranjang WHERE id_pelanggan ='$idPelanggan' AND status_beli='keranjang'";
    $resultCart = mysqli_query($connection, $queryCart);

    mysqli_close($connection);


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

    <section class="content-checkout">
        <div class="content-path">
            <p>Home <i class='bx bxs-chevron-right'></i> My Account <i class='bx bxs-chevron-right'></i> <span>Check Out</span></p>
        </div>
        <form action="pembayaran.php" method="POST">
            <div class="content-main">
                <div class="checkout-detail">
                    <h1>Check Out</h1>
                    <h2>Details</h2>

                    <div class="data-pelanggan">
                        <div class="nama">
                            <div class="nama-depan">
                                <label for="">Nama</label>
                                <input type="text" placeholder="nama" value="<?=$namaPelanggan;?>">
                            </div>
                            <div class="email">
                                <label for="">Email</label>
                                <input type="text" placeholder="email" value="<?=$emailPelanggan;?>">
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="alamat">
                                <label for="">Alamat</label>
                                <input type="text" placeholder="alamat" value="<?=$alamatPelanggan;?>">
                            </div>
                            <div class="no-hp">
                                <label for="">No HP</label>
                                <input type="number" placeholder="no hp" value="<?=$hpPelanggan;?>">
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="alamat-lengkap">
                                <label for="">Alamat Tujuan Pengiriman</label>
                                <input name="tujuan-kirim" type="text" placeholder="alamat tujuan pengiriman" value="<?=$alamatPelanggan;?>">
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="kota">
                                <label for="">Kota</label><br>
                                <!-- <input type="text" placeholder="kota"> -->
                                <select name="ongkos-kirim" id="ongkos-kirim">
                                    <?php
                                        while($row = mysqli_fetch_assoc($result)) {
                                    ?>                                                                                                              
                                            <option value="<?=$row["ongkos"];?>"><?=$row["nama_wilayah"];?></option>
                                    <?php       
                                        }                                
                                    ?>  
                                </select>
                            </div>
                            <div class="kode-pos">
                                <label for="">Kode Pos</label><br>
                                <input name="kode-pos" type="text" placeholder="kode pos">
                                <input type="hidden" name="hid-wilayah" id="hid-wilayah" value="">
                            </div>
                        </div>

                        
                    </div>

                    <h4>Metode Pengiriman</h4>
                    <div class="info-pengiriman">
                        <p class="est-tanggal">Estimasi pengiriman 2-3 hari</p>
                        <div class="est-biaya">
                            <div>
                                <p class="label-est-biaya">Biaya Pengiriman</p>
                                <p>Regular</p>
                            </div>
                            <div>
                                <p id="est-ongkir" class="nilai-est-biaya">Pilih Kota Tujuan</p>
                            </div>
                        </div>
                    </div>
                    <h4></h4>
                </div>

                <div class="sidebar-summary">                
                    <h2>Order Summary</h2>
                    <div class="products">
                        <?php 
                            while ($rowBarang = mysqli_fetch_assoc($resultCart)) {
                                $idBarang = $rowBarang["id_barang"];
                                $jlhProduct = $rowBarang["jlh_barang"];
                                $hargaBarang = $rowBarang["harga_satuan"]; 

                                $subtotal += $hargaBarang * (int)$jlhProduct;                                                                
                        ?>

                        <div class="produk">
                            <img src="admin-page/produk_upload/<?=$idBarang;?>.png" alt="">
                            <p><?="$idBarang x $jlhProduct";?> </p>
                            <p>Rp <?=$hargaBarang;?></p>
                        </div>                    

                        <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="subtotal">
                        <span>Subtotal</span>
                        <span>Rp <?=$subtotal?></span>
                    </div>
                    <div class="biaya-kirim">
                        <span>Biaya Pengiriman</span>
                        <span id="span-ongkir">Rp <?=$ongkir;?></span>
                    </div>
                    <div class="total">
                        <span>Total</span>
                        <span id="total-bayar">Rp <?=$total;?></span>
                    </div>
                    <div class="btn-checkout">
                        <input type="hidden" name="product-jlh" value="<?=$jlhProduct;?>">
                        <input type="hidden" id="hid-ongkir" name="ongkir" value="<?=$ongkir;?>">
                        <input type="hidden" id="hid-subtotal" name="subtotal" value="<?=$subtotal;?>">
                        <input type="hidden" id="hid-total" name="total" value="<?=$total;?>">
                        <button type="submit" name="beli" id="beli">Pembayaran</button>
                    </div>
                </div>
            </div>
        </form>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
    
    <script>
        const ongkir = document.querySelector("#ongkos-kirim");
        const estOngkir = document.querySelector("p#est-ongkir");
        const spanOngkir = document.querySelector("span#span-ongkir");
        const spanTotal = document.querySelector("#total-bayar");
        const hidOngkir = document.querySelector("#hid-ongkir");
        const subtotal = document.querySelector("#hid-subtotal");
        const hidTotal = document.querySelector("#hid-total");
        const hidWilayah = document.querySelector("#hid-wilayah");

        let wilayah = ongkir.options[ongkir.selectedIndex].textContent;        
        let totalHarga = Number(subtotal.value) + Number(ongkir.value);

        hidWilayah.value = wilayah;


        spanTotal.innerHTML = "Rp " + totalHarga;
        hidTotal.value = totalHarga;

        estOngkir.innerHTML = "Rp " + ongkir.value;
        spanOngkir.innerHTML = "Rp " + ongkir.value;
        hidOngkir.value = ongkir.value;   
        

        ongkir.addEventListener("change", ()=>{
            wilayah = ongkir.options[ongkir.selectedIndex].textContent;
            
            hidWilayah.value = wilayah;        

            totalHarga = Number(subtotal.value) + Number(ongkir.value);
            spanTotal.innerHTML = "Rp " + totalHarga;
            hidTotal.value = totalHarga;

            estOngkir.innerHTML = "Rp " + ongkir.value;
            spanOngkir.innerHTML = "Rp " + ongkir.value;
            hidOngkir.value = ongkir.value;
        });
    </script>
</body>
</html>

<?php
} else {
    header("location:kategori.php");
}
?>