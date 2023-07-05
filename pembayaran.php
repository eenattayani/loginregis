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
            <button class="active-btn"><i class='bx bx-cart'></i></button>
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

            <div class="pembayaran-detail">                
                <h2>Detail Pembayaran</h2>       
                
                <div class="subtotal">
                    <span>Subtotal <span class="produk-item">(2 items)</span></span>
                    <span>Rp 195.000</span>
                </div>
                <div class="biaya-kirim">
                    <span>Biaya Pengiriman</span>
                    <span>Rp 25.000</span>
                </div>
                <div class="total">
                    <span>Total</span>
                    <span>Rp 220.000</span>
                </div>

                <div class="bukti-transfer">
                    <h3>Bukti Transfer</h3>
                    <button>Pilih file</button>
                    <div class="img-bukti-transfer">image</div>
                </div>

            </div>
            
            <button class="btn-kirim">Kirim</button>
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
    
</body>
</html>