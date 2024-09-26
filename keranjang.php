<?php
if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, Silahkan belanja');</script>";
    echo "<script>location = 'index.php';</script>";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Keranjang Belanja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Keranjang Belanja</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Keranjang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $totalbelanja = 0; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah): ?>
                            <!-- Menampilkan yang sedang di perulangkan berdasarkan id produk -->
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
                            $pecah = $ambil->fetch_assoc();
                            $subharga = $pecah["harga"] * $jumlah;
                            ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah["nama_barang"]; ?></td>
                                <td><?php echo "Rp" . number_format($pecah['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo "Rp" . number_format($subharga, 0, ',', '.'); ?></td>
                                <td><a href="?page=hapus_keranjang&id=<?php echo $id_barang ?>" onclick="return confirm('Apakah anda yakin keranjang belanjaan akan dihapus!');" class="btn btn-outline-danger"><i class="fa fa-trash"></a></td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php $totalbelanja += $subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total belanja</th>
                            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                        </tr>
                    </tfoot>
                </table>


                <div class="card-header">
                    <a href="?page=home" class="btn btn-primary btn-flat"><i class="fa fa-cart-plus"></i> Lanjutkan Belanja</a>
                    <a href="?page=checkout" class="btn btn-success btn-flat"><i class="fa fa-check-square"></i> Check Out</a>
                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
    </div>

    <!-- /.row -->

</div>
<!-- /.row -->