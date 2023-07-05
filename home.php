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
        <a href="#" class="logo"><img src="img/logo.png" alt="HB"></a>

        <nav class="navbar">
            <a href="#home" class="active">Home</a>
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

    <section class="banner">
        <img class="img-slide" src="img/home/banner-img-1.jpg" alt="">
        <div class="banner-text">
            <h3 class="headline">Kecantikan</h3>
            <h1 class="tag">Special</h1>
            <h1 class="tag">Price</h1>
            <button class="banner-btn">Shop Now</button>
        </div>
        <div class="banner-arrow">
            <i class='bx bx-chevron-left' ></i>
            <i class='bx bx-chevron-right' ></i>
        </div>
        <div class="slider">
            <div class="left active"></div>
            <div class="right"></div>
        </div>
    </section>

    <section class="deals">
        <div class="deal deal-1">
            <div class="col-text">
                <h2>Special Promo</h2>
                <h3> UPTO 30% OFF</h3>
                <a href="#"> Explore Items</a>
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

            <div class="laris-box box-1">
                <div class="laris-img">
                    <img src="img/home/truk.png" alt="">
                </div>
                <div class="laris-desc">
                    <p>The Little Truk</p>
                </div>
            </div>

            <div class="laris-box box-2">
                <div class="laris-img">
                    <img src="img/home/push-pop.png" alt="">
                </div>
                <div class="laris-desc">
                    <p>Push pop - Love</p>
                </div>
            </div>

            <div class="laris-box box-3">
                <div class="laris-img">
                    <img src="img/home/garnier.png" alt="">
                </div>
                <div class="laris-desc">
                    <p>Garnier Men TurboLight</p>
                </div>
            </div>

            <div class="laris-box box-4">
                <div class="laris-img">
                    <img src="img/home/kotak-pensil.png" alt="">
                </div>
                <div class="laris-desc">
                    <p>Kotak Pensil</p>
                </div>
            </div>

            <div class="arrows">
                <i class='bx bx-right-arrow-alt'></i>
            </div>
        </div>
    </section>

    <footer>
        <p>Copyright &copy 2023</p>
    </footer>
</body>
</html>