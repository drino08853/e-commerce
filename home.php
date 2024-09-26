<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="assets/slider/slider01.jpg">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/slider/slider02.jpg">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/slider/slider03.jpg">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/slider/slider04.jpg">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        <?php
                        include "admin/koneksi.php";
                        //jika menu kategorinya sudah dipilih
                        if (isset($_POST['cari'])) {
                            $keyword = $_POST['keyword'];
                            $data = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori WHERE nama_barang LIKE '%$keyword%'");
                            //looping data dengan while
                        } else if (isset($_GET['nama_kategori'])) {
                            $nama_kategori = $_GET['nama_kategori'];
                            $data = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori WHERE nama_kategori='$nama_kategori' ORDER BY id_barang DESC");
                            //looping data dengan while
                            //query data tampil dengan pagination
                        } else {
                            $jumlahdataperhalaman = 6;
                            $data = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori ORDER BY id_barang DESC");
                            $jumlahdata = mysqli_num_rows($data);
                            $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
                            $halamanaktif = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
                            $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
                            $data = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori  ORDER BY id_barang DESC LIMIT $awaldata,$jumlahdataperhalaman");
                        }

                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <img src="admin/images/<?= $d['gambar_barang'] ?>" style="height: 200px; width: 350px;" class="product-image" alt="Product Image">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-14">
                                                <p></p>
                                                <h2 class="lead"><b><?= $d['nama_barang'] ?></b></h2>
                                                <p class="text-muted text-sm"><b>Kategori : </b><?= $d['nama_kategori'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a class="float-left">
                                                <h4>
                                                    <span class="badge bg-success"><?= "Rp" . number_format($d['harga'], 0, ',', '.'); ?></span>
                                                </h4>
                                            </a>
                                            <a href="?page=detail_barang&id=<?= $d['id_barang'] ?>" class="btn btn-sm bg-teal">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?page=beli&id=<?= $d['id_barang']; ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-shopping-cart"></i> Add Chart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <?php if (isset($halamanaktif) && $halamanaktif > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $halamanaktif - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (isset($jumlahhalaman)) : ?>
                                <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
                                    <?php if (isset($halamanaktif) && $i == $halamanaktif) : ?>
                                        <li class="page-item active"><a class="page-link" href="?halaman=<?= $i;
                                                                                                            -1 ?>"><?= $i;
                                                                                                                    -1 ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?= $i;
                                                                                                    -1 ?>"><?= $i;
                                                                                                            -1 ?></a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            <?php endif; ?>


                            <?php if (isset($halamanaktif, $jumlahhalaman) && $halamanaktif < $jumlahhalaman): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $halamanaktif + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->