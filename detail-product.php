<?php

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
            <a href="#home" >Home</a>
            <a href="#kategori">Category</a>
            <a href="#about" >About</a>
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
            <button><i class='bx bx-cart'></i></button>
        </div>
    </header>

    <section class="content-detail-product">
        <div class="product-img">
            <img src="img/produk/clear-detail.png" alt="">
        </div>

        <div class="product-desc">
            <div class="product-link">
                <p>Home / Category / Kecantikan</p>
            </div>
            <div class="product-name">
                <h2>Clear Men Cool Sport Menthol</h2>
            </div>
            <div class="product-price">
                <h4>Rp 48.000</h4>
            </div>
            <div class="product-description">
                <h4>Deskripsi Produk</h4>
                <p>Inovasi formula shampo anti ketombe baru berbentuk gel cair yang segar dan cepat meresap. Clear sampo rambut anti dandruff yang diformulasikan khusus untuk pria. Perawatan rambut pria yang efektif menghilangkan, melawan, dan mencegah ketombe. Anti dandruff sampo pria yang 2x lebih lembut di kulit kepala dan rambut. Men shampo yang memberikan sensai dingin pada kulit kepala. Anti dandruff shampo yang cocok untuk jenis rambut apa saja: kering, normal, dan berminyak - BPOM NA18181003196 </p>
            </div>
            <div class="product-action">
                <div class="input">
                    <div class="box-jlh">
                        <label for="product-jlh">Banyaknya</label>
                        <div>
                            <span>-</span><input type="text" id="product-jlh" value="1">
                            <span>+</span>
                        </div>
                    </div>
                    <div class="box-subtotal">
                        <label for="subtotal">Subtotal</label>
                        <input type="text" id="subtotal" value="Rp 48.000">
                    </div>
                </div>
                <div class="action">
                    <button class="keranjang">+ Keranjang</button>
                    <button class="beli">Beli</button>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="footer-detail-product">
        <p>Copyright &copy 2023</p>
    </footer>

</body>
</html>