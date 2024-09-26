<?php
$id_barang = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori WHERE id_barang='$id_barang'");
$detail = $ambil->fetch_assoc();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Detail Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container">
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="admin/images/<?php echo $detail['gambar_barang'] ?>" style="height: 300px; width: 571px;" class="product-image" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3"><?php echo $detail['nama_barang'] ?></h3>
                            <hr>
                            <h4>Kategori :</h4>
                            <p><?php echo $detail['nama_kategori'] ?></p>
                            <hr>
                            <div class="bg-yellow py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <?php echo "Rp. " . number_format($detail['harga'], 0, ',', '.'); ?>
                                </h2>
                            </div>

                            <form method="POST">
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="number" name="jumlah" class="form-control" value="1" min="1">
                                        </div>
                                        <button class="btn btn-primary btn-sm btn-flat" name="beli">
                                            <i class="fas fa-cart-plus fa-sm mr-2"></i>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>

                    <?php
                    if (isset($_POST["beli"])) {
                        $jumlah = $_POST["jumlah"];
                        $_SESSION["keranjang"][$id_barang] = $jumlah;
                        echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                        echo "<script>location = '?page=keranjang';</script>";
                    }
                    ?>

                    <div class="row mt-4">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo $detail['deskripsi'] ?></div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
</div>
</section>
<!-- /.content -->