<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation + Sidebar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

</head>


<div class="modal fade" id="modal-info">
    <div class="modal-dialog" style="max-width: 37%;" role="document">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h4 class="modal-title">Contact US</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive p-3">

                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM kontak ;");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>

                        <table class="table align-items-center table-flush">
                            <tbody>
                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fab fa-facebook-square"></i> Facebook</th>
                                        <td><a href="<?= $d['facebook']; ?>"><span style="color:#ffffff;">Follow Us To <i class="fab fa-facebook-square"></i></span></a></td>
                                    </tr>
                                </thead>

                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fab fa-instagram"></i> Instagram</th>
                                        <td><a href="<?= $d['instagram']; ?>"><span style="color:#ffffff;">Follow Us To <i class="fab fa-instagram"></i></span></a></td>
                                    </tr>
                                </thead>

                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fab fa-whatsapp"></i> No.Telp</th>
                                        <td><?= $d['no_telp']; ?></td>
                                    </tr>
                                </thead>

                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fa fa-map-signs"></i> Alamat</th>
                                        <td><?= $d['alamat']; ?></td>
                                    </tr>
                                </thead>

                            <?php
                        }
                            ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white ">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Sufee Shop</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <?php
                                $data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori DESC");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <li><a href="index.php?nama_kategori=<?= $d['nama_kategori'] ?>" class="dropdown-item"><?= $d['nama_kategori'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#modal-info" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3" action="index.php" method="POST">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" name="keyword" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" name="cari" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->

                    <?php if (!isset($_SESSION['pelanggan'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=login">
                                <span class="brand-text font-weight-light text-dark"> <i class="fas fa-sign-out-alt"></i> Login/Register</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown user-menu">
                        <?php if (isset($_SESSION['pelanggan'])) : ?>
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img src="admin/images/<?php echo $_SESSION["pelanggan"]['foto'] ?>" class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline"><?php echo $_SESSION["pelanggan"]['username'] ?></span>
                            </a>
                        <?php endif; ?>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="admin/images/<?php echo $_SESSION["pelanggan"]['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                                <p>
                                    <?php echo $_SESSION["pelanggan"]['nama_lengkap'] ?></p>
                            </li>


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="logout.php" class="btn btn-default btn-flat float-right">Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Messages Dropdown Menu -->
                    <?php
                    $totaljumlah = 0;

                    // Cek apakah sesi dan variabel 'keranjang' ada dan merupakan array
                    if (isset($_SESSION["keranjang"]) && is_array($_SESSION["keranjang"])) {
                        foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) {
                            // Ambil data barang dari database
                            $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
                            $pecah = $ambil->fetch_assoc();

                            // Tambahkan jumlah barang ke totaljumlah
                            $totaljumlah += $jumlah;
                        }
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-danger navbar-badge"><?php echo $totaljumlah; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="?page=keranjang" class="dropdown-item dropdown-footer">View Keranjang</a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->