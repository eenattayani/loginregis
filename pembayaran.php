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

$idPelanggan = $_SESSION["iduser"];

$link_wishlist = "wishlist.php";
$link_account = "myorders.php";
$link_cart = "myorders.php";

include "dbconn.php";

if( isset($_POST["terima"]) ){ // konfirmasi barang diterima
    $id = $_POST["terima"];

     // update tbkeranjang
    $queryCart = "UPDATE tbkeranjang SET status_beli='selesai' WHERE id_penjualan ='$id'";
    $resultCart = mysqli_query($connection,$queryCart);

    // update tbpenjualan
    $updatePenjualan = "UPDATE tbpenjualan SET status_penjualan='selesai' WHERE id_penjualan ='$id'";
    $resultupdateJual = mysqli_query($connection,$updatePenjualan);

    echo '
        <script>
            alert("Barang Sudah Diterima!");
            location.replace("myorders.php");
        </script>
    ';

    exit;
    
    // header("location:myorders.php");


} elseif (isset($_POST["konfirmasi-plg"])) { // konfirmasi sudah transfer

    $id = $_POST["konfirmasi-plg"];

    // proses upload gambar
    $error = $_FILES["upload"]["error"];

    if ($error === 0) {
        // pindahkan file folder produk_upload
        $namaFolder = "admin-page/bukti_transfer";
        $tmp = $_FILES["upload"]["tmp_name"];
        // $namaFile = $_FILES["upload"]["name"];
        $namaFile = $id . ".png";
        
        if (move_uploaded_file($tmp, "$namaFolder/$namaFile")) {
            $pesanError = "File sukses diupload";
        } else {
            $pesanError = "File gagal diupload";
        }
    } else {
        $pesanError = "File gagal diupload";
    }

    // update tbkeranjang
    $queryCart = "UPDATE tbkeranjang SET status_beli='dikemas' WHERE id_penjualan ='$id'";
    $resultCart = mysqli_query($connection,$queryCart);

    // update tbpenjualan
    $updatePenjualan = "UPDATE tbpenjualan SET status_penjualan='dikemas' WHERE id_penjualan ='$id'";
    $resultupdateJual = mysqli_query($connection,$updatePenjualan);

    header("location:myorders.php");
    exit;
    
} elseif ( isset($_POST["beli"]) || isset($_POST["bayar"]) ) {    
    if (isset($_POST["beli"])) {        
        $jlhProduct = $_POST["product-jlh"];
        $subtotal = $_POST["subtotal"];
        $ongkir = $_POST["ongkir"];    
        $total = $_POST["total"];  
    
        //alamat tujuan kirim
        $alamat = $_POST["tujuan-kirim"];
        $wilayah = $_POST["hid-wilayah"];
        $kodepos= $_POST["kode-pos"];
    
        $alamatKirim = $alamat . ", " . $wilayah . ", " . $kodepos;
    
        $t=time();
        // echo($t . "<br>");
        // echo(date("Y-m-d",$t));
        $tanggal = date("Y-m-d",$t);
        $idPenjualan = $t;

        // ambil id_barang dan jlh_barang berdasarkan id_pelanggan, status_beli, check_status
        $queryIdJumlah = "SELECT id_barang, jlh_barang FROM tbkeranjang WHERE id_pelanggan='$idPelanggan' AND status_beli='keranjang' AND check_status='1'";
        $resultIdJumlah = mysqli_query($connection, $queryIdJumlah);

        if ( $resultIdJumlah->num_rows !== 0) {
            while ( $rowidjumlah = mysqli_fetch_assoc($resultIdJumlah)) {
                $rIdBarang = $rowidjumlah["id_barang"];
                $rJumlah = $rowidjumlah["jlh_barang"];
            
                // update pengurangan jumlah stok barang
                mysqli_query($connection, "UPDATE tbbarang SET stok=stok - $rJumlah WHERE id_barang='$rIdBarang'");
            }   
        }
    
        // insert ke tabel penjualan
        $queryPenjualan = "INSERT INTO tbpenjualan(id_penjualan,id_pelanggan,tanggal,harga_subtotal,harga_ongkir,harga_total,status_penjualan) VALUES ('$idPenjualan','$idPelanggan','$tanggal','$subtotal','$ongkir','$total','tunggu bayar')";
        $resultPenjualan = mysqli_query($connection,$queryPenjualan);            

        // update tbkeranjang
        $query = "UPDATE tbkeranjang SET status_beli='tunggu bayar', alamat_tujuan='$alamatKirim', id_penjualan='$idPenjualan' WHERE id_pelanggan ='$idPelanggan' AND status_beli='keranjang' AND check_status='1'";
        $result = mysqli_query($connection,$query);

    } elseif (isset($_POST["bayar"])) {
        $idPenjualan = $_POST["bayar"];

        $query = "SELECT * FROM tbpenjualan WHERE id_penjualan ='$idPenjualan'";
        $result = mysqli_query($connection,$query);

        $row = mysqli_fetch_assoc($result);
    
        $subtotal = $row["harga_subtotal"];
        $ongkir = $row["harga_ongkir"];    
        $total = $row["harga_total"];

    }

    mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Pembayaran</title>

    <link rel="stylesheet" href="css/style.css">

    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-pembayaran">
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

    <section class="content-pembayaran">
        <div class="content-path">
            <p>
                Home <i class='bx bxs-chevron-right'></i> 
                My Account <i class='bx bxs-chevron-right'></i> 
                Check Out <i class='bx bxs-chevron-right'></i> 
                <span>Pembayaran</span>
            </p>
        </div>
        <div class="content-main">
            <h1>Pembayaran</h1>   
            <form action="pembayaran.php" method="POST" enctype="multipart/form-data">          
                <div class="pembayaran-detail">                
                    <h2>Detail Pembayaran</h2>       
                    
                    <div class="subtotal">
                        <span>Subtotal</span>
                        <span>Rp <?=$subtotal;?></span>
                    </div>
                    <div class="biaya-kirim">
                        <span>Biaya Pengiriman</span>
                        <span>Rp <?=$ongkir;?></span>
                    </div>
                    <div class="total">
                        <span>Total</span>
                        <span>Rp <?=$total;?></span>
                    </div>
                    <div><span>Pembayaran transfer ke Rekening BCA 192837465 an. Hoki Beauty</span></div>
                    
                    
                        <div class="bukti-transfer">
                            <h3>Bukti Transfer</h3>                    
                            <input type="file" class="input-img" name="upload" id="upload" accept="image/png" required>
                            <!-- <button>Pilih file</button> -->
                            <div class="img-bukti-transfer">
                                <img id="img" width="50%" height="165px" alt="bukti transfer">
                            </div>
                        </div>
                    
                        <button name="konfirmasi-plg" value="<?=$idPenjualan;?>" class="btn-kirim">Konfirmasi Sudah Transfer</button>

                </div>
            </form> 
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>

    <script>
        const inputUpload = document.querySelector("#upload");
        const img = document.querySelector("#img");

        inputUpload.addEventListener( "change" , ()=> {
            if (inputUpload.files && inputUpload.files[0]) {
                var reader = new FileReader();   
                
                reader.readAsDataURL(inputUpload.files[0]);

                reader.onload = function (readerEvent) {
                    img.src = readerEvent.target.result;
                }
            }
        });        
    </script>
</body>
</html>

<?php
} else {
    header("location:kategori.php");
    exit;
}
?>
