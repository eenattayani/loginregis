<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-hb.png" type="image/x-icon">
    <title>HB Admin - Dashboard</title>

    <!-- <link rel="stylesheet" href="../css/style-admin.css"> -->
    
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <style>
        <?php
            require "../css/style-admin.css";
        ?>
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="#">
                <img src="img/logo-hb.png" alt="HB">
            </a>
            <p>Administrator</p>
        </div>

        <div class="admin-side">
            <div class="admin">
                <h3>Richard Verdy</h3>
                <p>Admin</p>
            </div>

            <img src="img/admin-1.png" alt="">
        </div>
    </header>

    <hr>

    <section class="content">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.php"><button class="active">Dashboard</button></a></li>
                <li><a href="data-barang.php"><button>Data Barang</button></a></li>
                <li><a href="data-pembelian.php"><button>Data Pembelian</button></a></li>
                <li><a href="data-penjualan.php"><button>Data Penjualan</button></a></li>
                <li><a href="data-pelanggan.php"><button>Data Pelanggan</button></a></li>
                <li><a href="data-supplier.php"><button>Data Supplier</button></a></li>
                <li><a href="data-kategori.php"><button>Kategori</button></a></li>
                <li><a href="data-laporan.php"><button>Laporan</button></a></li>
                <li><a href="../login.php"><button class="btn-logout">Logout</button></a></li>
            </ul>
        </div>

        <div class="main">
            <h2>Profile</h2>
            <div class="modal">
                <div class="cover">
                    <img src="img/cover-1.png" alt="">
                    <span><i class='bx bx-camera'></i>Edit</span>
                </div>

                <div class="modal-content">
                    <div class="profil-img">
                        <img src="img/admin-1.png" alt="">
                        <div class="icon"><i class='bx bx-camera'></i></div>
                    </div>
                    
                    <h3>Richad Verdy</h3>
                    <p>Admin</p>

                    <h4>About Me</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt tenetur sit corporis ipsam voluptate porro at exercitationem. Unde incidunt, fuga cum expedita ipsum tempore doloribus odio, qui nobis porro minus harum, nulla repudiandae omnis laborum tenetur cupiditate delectus voluptate quam.</p>

                </div>
            </div>

        </div>
    </section>

</body>
</html>