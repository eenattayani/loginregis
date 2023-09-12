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

$idPelanggan = $_SESSION["iduser"];
$namaPelanggan = $_SESSION["user"];
$emailPelanggan = $_SESSION["emailuser"];
$alamatPelanggan = $_SESSION["alamatuser"];
$hpPelanggan = $_SESSION["nohp"];

include "dbconn.php";

if ( isset($_POST["checkout"]) ) {

    $idBarang = "";
    $jlhProduct = 0;
    $hargaBarang = 0;    
    
    $subtotal = 0;
    $ongkir = 0;
    $total = $subtotal + $ongkir;    


     // ambil id_barang dan jlh_barang berdasarkan id_pelanggan, status_beli, check_status
    $queryIdJumlah = "SELECT id_barang, jlh_barang FROM tbkeranjang WHERE id_pelanggan='$idPelanggan' AND status_beli='keranjang' AND check_status='1'";
    $resultIdJumlah = mysqli_query($connection, $queryIdJumlah);

    if ( $resultIdJumlah->num_rows !== 0) {
        while ( $rowidjumlah = mysqli_fetch_assoc($resultIdJumlah)) {
            $rIdBarang = $rowidjumlah["id_barang"];
            $rJumlah = $rowidjumlah["jlh_barang"];

            $rJlhTbbarang = mysqli_query($connection,"SELECT stok FROM tbbarang WHERE id_barang='$rIdBarang'");
            if ( $rJlhTbbarang->num_rows !== 0) {
                $jlhTbbarang = mysqli_fetch_assoc($rJlhTbbarang);

                $stok = $jlhTbbarang["stok"];

                if ( $rJumlah > $stok ) {
                    header("location:wishlist.php?errorstok=$rIdBarang");
                    exit;
                }
            }

            // update pengurangan jumlah stok barang
            // mysqli_query($connection, "UPDATE tbbarang SET stok=stok - $rJumlah WHERE id_barang='$rIdBarang'");
        }   
    }





    // ambil data ongkir
    $query = "SELECT * FROM tbongkir";
    $result = mysqli_query($connection, $query);

    // panggil tabel keranjang dengan id pelanggan
    $queryCart = "SELECT * FROM tbkeranjang WHERE id_pelanggan ='$idPelanggan' AND status_beli='keranjang' AND check_status='1'";
    $resultCart = mysqli_query($connection, $queryCart);

    mysqli_close($connection);

    if ( $resultCart->num_rows === 0 ) {
        echo '
        <script>
            alert("pilih barang yang akan dibeli!");   
            location.replace("wishlist.php");             
        </script>
        ';
        exit;
    }


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
        <form name="myform" action="pembayaran.php" method="POST">
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
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="provinsi">
                                <label for="nama_provinsi">Provinsi</label>
                                <select name="nama_provinsi" id="nama_provinsi"></select>
                            </div>
                            <div class="kota">
                                <label for="nama_kota">Kota</label>
                                <select name="nama_kota" id="nama_kota">
                                    <option>--Pilih Kota--</option>
                                </select>
                            </div>                            
                        </div>

                        <div class="tujuan">
                            <div class="kodepos">
                                <label for="kode-pos">Kode Pos</label>
                                <input name="kode-pos" type="text" placeholder="kode pos">
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="ekspedisi">
                                <label for="ekspedisi">Ekspedisi</label>
                                <select name="nama_ekspedisi" id="nama_ekspedisi"></select>
                            </div>
                            <div class="paket">
                                <label for="paket">Paket</label>
                                <select name="nama_paket" id="nama_paket">
                                    <option value="">--Pilih Paket--</option>
                                </select>
                            </div>
                        </div>

                        <div class="tujuan">
                            <div class="kota">                                                           

                                <input type="hidden" name="total_berat" value="1200">
                                <input type="hidden" name="provinsi">
                                <input type="hidden" name="distrik" id="distrik">
                                <input type="hidden" name="tipe">
                                <input type="hidden" name="kodepos">
                            </div>
                            <div class="kode-pos">                                                                
                                <input type="hidden" name="ekspedisi">
                                <input type="hidden" name="paket" id="paket">
                                <input type="hidden" name="ongkir" id="ongkir">
                                <input type="hidden" name="estimasi" id="estimasi">

                                <input type="hidden" name="hid-wilayah" id="hid-wilayah" value="">
                            </div>
                        </div>

                        
                    </div>

                    <h4>Metode Pengiriman</h4>
                    <div class="info-pengiriman">
                        <p class="est-tanggal">Estimasi pengiriman <span id="span-etd">2-3</span> hari</p>
                        <div class="est-biaya">
                            <div>
                                <p class="label-est-biaya">Biaya Pengiriman</p>
                                <p><span id="span-paket">Regular</span></p>
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


    <script src="js/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("select[name=nama_kota]").prop("disabled", true);
            $("select[name=nama_ekspedisi]").prop("disabled", true);
            $("select[name=nama_paket]").prop("disabled", true);
            $("input[name=kode-pos]").prop("disabled", true);

            $("form[name=myform]").submit(function(event){
                var ongkirInp = $("input[name=ongkir]").val();

                if ( ongkirInp === "" ) {
                    event.preventDefault();
                    alert("Mohon pilih pengiriman!");                    
                }
            });
           
            $.ajax({
                type:'post',
                url:'dataprovinsi.php',
                success:function(hasil_provinsi)
                {
                    $("select[name=nama_provinsi]").html(hasil_provinsi);
                }
            });

            $("select[name=nama_provinsi]").on("change",function(){
                var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
                $.ajax({
                    type:'post',
                    url:'datadistrik.php',
                    data:'id_provinsi='+id_provinsi_terpilih,
                    success:function(hasil_distrik)
                    {
                        $("select[name=nama_kota]").html(hasil_distrik);

                        $("select[name=nama_kota]").prop("disabled", false);
                    }
                })
            });

            $.ajax({
                type:'post',
                url:'dataekspedisi.php',
                success:function(hasil_ekspedisi)
                {
                    $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
                   
                }
            });

            $("select[name=nama_ekspedisi]").on("change", function(){
                var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
                var distrik_terpilih = $("option:selected","select[name=nama_kota]").attr("id_distrik");
                var total_berat = $("input[name=total_berat]").val();

                $.ajax({
                    type:'post',
                    url:'datapaket.php',
                    data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
                    success:function(hasil_paket)
                    {
                        $("select[name=nama_paket]").html(hasil_paket);                        

                        $("input[name=ekspedisi]").val(ekspedisi_terpilih);

                        $("select[name=nama_paket]").prop("disabled", false);
                    }
                });
            });

            $("select[name=nama_kota]").on("change",function(){
                $("select[name=nama_ekspedisi]").prop("disabled", false);            

                var prov = $("option:selected", this).attr("nama_provinsi");
                var dist = $("option:selected", this).attr("nama_distrik");
                var tipe = $("option:selected", this).attr("tipe_distrik");
                var kodepos = $("option:selected", this).attr("kodepos");

                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);
                $("input[name=kode-pos]").val(kodepos);
            });

            $("select[name=nama_paket]").on("change",function(){
                var paket = $("option:selected", this).attr("paket");
                var ongkir = $("option:selected", this).attr("ongkir");
                var etd = $("option:selected", this).attr("etd");

                $("input[name=paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd);
            });


        });

        const ongkir = document.querySelector("#ongkir");

        const estOngkir = document.querySelector("p#est-ongkir");
        const spanOngkir = document.querySelector("span#span-ongkir");
        const spanEtd = document.querySelector("span#span-etd");
        const spanPaket = document.querySelector("span#span-paket");

        const spanTotal = document.querySelector("#total-bayar");
        const hidOngkir = document.querySelector("#hid-ongkir");
        const subtotal = document.querySelector("#hid-subtotal");
        const hidTotal = document.querySelector("#hid-total");
        const hidWilayah = document.querySelector("#hid-wilayah");

        const selectPaket = document.querySelector("select[name=nama_paket]");
        const estimasi = document.querySelector("#estimasi");
        const paket = document.querySelector("#paket");

        let totalHarga = Number(subtotal.value) + Number(ongkir.value);


        spanTotal.innerHTML = "Rp " + totalHarga;
        hidTotal.value = totalHarga;

        estOngkir.innerHTML = "Rp " + ongkir.value;
        spanOngkir.innerHTML = "Rp " + ongkir.value;
        hidOngkir.value = ongkir.value;   
        
        selectPaket.addEventListener("change", ()=>{
            setTimeout(() => {                
                console.log("paket dipilih");
                console.log("ongkir", ongkir.value);
    
                totalHarga = Number(subtotal.value) + Number(ongkir.value);
                spanTotal.innerHTML = "Rp " + totalHarga;
                hidTotal.value = totalHarga;
    
                estOngkir.innerHTML = "Rp " + ongkir.value;
                spanOngkir.innerHTML = "Rp " + ongkir.value;
                hidOngkir.value = ongkir.value;

                spanEtd.innerHTML = estimasi.value;
                spanPaket.innerHTML = paket.value;
            }, 1000);
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