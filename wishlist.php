<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>HB - Wishlist</title>

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
            <button><i class='bx bx-heart' ></i></button>
            <button><i class='bx bx-user' ></i></button>
            <button class="active-btn"><i class='bx bx-cart'></i></button>
        </div>
    </header>

    <section class="content-wishlist">
        <div class="content-path">
            <p>Home <i class='bx bxs-chevron-right'></i> My Account <i class='bx bxs-chevron-right'></i> <span>Wishlist</span></p>
        </div>
        
        <div class="content-main">

            <div class="sidebar-summary">
                <h2>Hello Rio</h2>
                <ul>
                    <li><i class='bx bx-shopping-bag'></i><a href="#">My orders</a></li>
                    <li class="active"><i class='bx bx-heart' ></i><a href="#">Wishlist</a></li>
                    <li><i class='bx bx-user' ></i><a href="#">My info</a></li>
                    <li><i class='bx bx-log-in-circle'></i><a href="#">Sign out</a></li>
                </ul>
            </div>

            <div class="wishlist-detail">                
                <h2>Wishlist</h2>
                <div class="list-wishlist">
                    <div class="img-nama">
                        <div class="img"><img src="admin-page/produk_upload/IB0004.png" alt=""></div>
                        <div class="nama-qty">
                            <span class="nama">Garnier Men Oil Control</span>
                            <div class="qty">
                                <span>Qty : </span>
                                <div class="box-qty">
                                    <button onclick="kurangSubtotal()">-</button>
                                    <input type="text" id="product-jlh" value="1" maxlength="4">
                                    <button onclick="tambahSubtotal()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="harga">
                        <span>Rp 29.000</span>
                    </div>
                    <div class="btn-checkout">
                        <button>Check Out</button>
                    </div>
                </div>
                
                <div class="list-wishlist">
                    <div class="img-nama">
                        <div class="img"><img src="admin-page/produk_upload/IB0004.png" alt=""></div>
                        <div class="nama-qty">
                            <span class="nama">Garnier Men Oil Control</span>
                            <div class="qty">
                                <span>Qty : </span>
                                <div class="box-qty">
                                    <button onclick="kurangSubtotal()">-</button>
                                    <input type="text" id="product-jlh" value="1" maxlength="4">
                                    <button onclick="tambahSubtotal()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="harga">
                        <span>Rp 29.000</span>
                    </div>
                    <div class="btn-checkout">
                        <button>Check Out</button>
                    </div>
                </div>

                            
            </div>

            
        </div>
        
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
    
</body>
</html>