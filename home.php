<?php
session_start();

include "dbconn.php";

$link_wishlist = "login.php?ke=home.php";
$link_account = "login.php?ke=home.php";
$link_cart = "login.php?ke=home.php";

if (isset($_SESSION["login"])) {
    
    if ( $_SESSION["login"] === true ) {
        $link_wishlist = "wishlist.php";
        $link_account = "myorders.php";
        $link_cart = "myorders.php";
    }
}

/* 
    menampilkan produk paling laris:
    - ambil semua "id_barang" dan "jlh_barang" pada tabel keranjang
    - jumlahkan "jlh_barang" yang memiliki "id_barang" sama
    - tampilkan 4 data dengan urutan dari "jlh_barang" terbesar
 */

$query = "SELECT tbkeranjang.id_barang, tbbarang.nama_barang, SUM(tbkeranjang.jlh_barang) AS total_jumlah 
            FROM tbkeranjang 
            JOIN tbbarang ON tbkeranjang.id_barang = tbbarang.id_barang
            GROUP BY tbkeranjang.id_barang, tbbarang.nama_barang
            ORDER BY total_jumlah DESC LIMIT 4";
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
    <title>HB - Home</title>

    <link rel="stylesheet" href="css/style.css">

     <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="body-home">
    <header>        
        <a href="home.php" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="home.php" class="active">Home</a>
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

    <section class="banner">
        <div class="sliders">
            <div class="slide active-slide">
                <img class="img-slide" src="img/home/banner-img-3.jpg" alt="">
                <div class="banner-text">
                    <h3 class="headline">Kecantikan</h3>
                    <h1 class="tag">Special</h1>
                    <h1 class="tag">Price</h1>
                    <a href="kategori.php"><button class="banner-btn">Shop Now</button></a>
                </div>
                <div class="banner-arrow">
                    <i class='bx bx-chevron-left' ></i>
                    <i class='bx bx-chevron-right' ></i>
                </div>
                <div class="slider">
                    <div class="left active"></div>
                    <div class="right"></div>
                </div>
            </div>
            <div class="slide">
                <img class="img-slide" src="img/home/banner-img-2.jpg" alt="">
                <div class="banner-text">
                    <h3 class="headline">Kecantikan</h3>
                    <h1 class="tag">Special</h1>
                    <h1 class="tag">Price</h1>
                    <a href="kategori.php"><button class="banner-btn">Shop Now</button></a>
                </div>
                <div class="banner-arrow">
                    <i class='bx bx-chevron-left' ></i>
                    <i class='bx bx-chevron-right' ></i>
                </div>
                <div class="slider">
                    <div class="left active"></div>
                    <div class="right"></div>
                </div>
            </div>
            <div class="slide">
                <img class="img-slide" src="img/home/banner-img-1.jpg" alt="">
                <div class="banner-text">
                    <h3 class="headline">Kecantikan</h3>
                    <h1 class="tag">Special</h1>
                    <h1 class="tag">Price</h1>
                    <a href="kategori.php"><button class="banner-btn">Shop Now</button></a>
                </div>
                <div class="banner-arrow">
                    <span id="slide-left"><i class='bx bx-chevron-left' ></i></span>
                    <span id="slide-right"><i class='bx bx-chevron-right' ></i></span>
                </div>
                <div class="slider">
                    <div class="left active"></div>
                    <div class="right"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="deals">
        <div class="deal deal-1">
            <div class="col-text">
                <h2>Special Promo</h2>
                <h3> UPTO 30% OFF</h3>
                <a href="kategori.php"> Explore Items</a>
            </div>
            <div class="col-img">
                <img src="img/home/garnier.png" alt="">
            </div>
        </div>

        <div class="deal deal-2">
            <div class="col-text">
                <h4>Clear Anti Hair Fall</h4>
                <h2>2x Lebih Kuat</h2>
                <h2>Melawan Ketombe</h2>
                <h3>Promo 30%</h3>            
            </div>
            <div class="col-img">
                <img src="img/home/clear.png" alt="">
            </div>
        </div>
    </section>

    <section class="laris">
        <h1 class="laris-title">Paling Laris</h1>
        <div class="laris-contents">
            <div class="arrows">
                <i class='bx bx-left-arrow-alt'></i>
            </div>

            <?php
                $no_urut = 1;
                while ($produk = mysqli_fetch_assoc($result)) {
            ?>                
                <div class="laris-box box-<?=$no_urut;?>">
                    <div class="laris-img">
                        <a href="detail-product.php?id=<?=$produk["id_barang"];?>"><img src="admin-page/produk_upload/<?=$produk["id_barang"];?>.png" alt=""></a>
                    </div>
                    <div class="laris-desc">
                        <p><?=$produk["nama_barang"];?></p>
                        <span>terjual: <?=$produk["total_jumlah"];?></span>
                    </div>
                </div>
            <?php
                    $no_urut++;
                }
            ?>

                        

            <div class="arrows">
                <i class='bx bx-right-arrow-alt'></i>
            </div>
        </div>
    </section>

    <footer>
        <p>Copyright &copy 2023</p>        
    </footer>

    <script>
        const sliders = document.querySelectorAll('.slide');
        const slideLeft = document.querySelector("#slide-left");
        const slideRight = document.querySelector("#slide-right");

        slideLeft.addEventListener("click", () => {
            nextSlide();
        });

        slideRight.addEventListener("click", () => {
            nextSlide();            
        });

        let currentSlide = 0;

        function showSlide(slideIndex) {
            sliders.forEach((slide) => {
                slide.classList.remove('active-slide');
            });
            sliders[slideIndex].classList.add('active-slide');
        }

        function nextSlide() {
            currentSlide = ( currentSlide + 1 ) % sliders.length;
            showSlide(currentSlide);
        }


        setInterval(nextSlide, 3000);

    </script>
</body>
</html>