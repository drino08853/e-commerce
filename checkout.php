<?php
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location = '?page=login';</script>";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Check Out</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Check Out</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Keranjang</h3>
                <h3 class="card-title float-right">Tanggal : <?= date('d-m-Y') ?></h3>
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
                                <td>Rp.<?php echo number_format($pecah["harga"]); ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp.<?php echo number_format($subharga); ?></td>

                            </tr>
                            <?php $nomor++; ?>
                            <?php $totalbelanja += $subharga; ?>

                        <?php endforeach ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total belanja</th>
                            <th>Rp. <?php echo number_format($totalbelanja) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>


                <form method="POST">
                    <div class="card-header">
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-sm-12 invoice-col">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                            <input name="nama_lengkap" type="text" class="form-control" readonly value="<?php echo $_SESSION["pelanggan"]['nama_lengkap'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No.Telp</label>
                                            <input name="telp" type="number" class="form-control" readonly value="<?php echo $_SESSION["pelanggan"]['telp'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pilih Ongkos Kirim</label>
                                            <select class="form-control select2" name="id_ongkir" required>
                                                <option selected="selected">==Silahkan Pilih==</option>
                                                <?php
                                                $ambil = $koneksi->query("SELECT * FROM ongkir");
                                                while ($perongkir = $ambil->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $perongkir["id_ongkir"] ?>"><?php echo $perongkir['nama_kota'] ?>
                                                        Rp. <?php echo number_format($perongkir['tarif']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat_pengirim" placeholder="masukan alamat lengkap(Kode pos)" rows="7" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <div class="card-header">
                        <a href="?page=keranjang" class="btn btn-warning btn-flat"><i class="fa fa-backward"></i> Kembali Halaman Keranjang</a>
                        <button name="checkout" class="btn btn-primary btn-flat" onclick="return confirm('Apakah Data Anda Sudah Benar Di Input Atau Belum Lengkap,Kalau Merasa Belum Benar Silahkan Kembali Ke Halaman Keranjang Sebelum Melakukan Check Out,Karena Setelah Melakukan Proses Check Out Data Tidak Bisa Di Update Atau Di Ubah !');"><i class="fa fa-cart-plus"></i> Proses Checkout</button>
                    </div>


                    <!-- /.card-body -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.row -->
    </form>
    <!-- /.row -->


    <?php

    if (isset($_POST["checkout"])) {
        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
        $id_ongkir = $_POST["id_ongkir"];
        $tanggal_pembelian = date("Y-m-d");
        $alamat_pengirim = $_POST['alamat_pengirim'];


        $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir ='$id_ongkir'");
        $arrayongkir = $ambil->fetch_assoc();
        $nama_kota = $arrayongkir['nama_kota'];
        $tarif = $arrayongkir['tarif'];

        $total_pembelian = $totalbelanja + $tarif;
        $koneksi->query("INSERT INTO pembayaran (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,alamat_pengirim)VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$alamat_pengirim')");

        $id_pembelian_barusan = $koneksi->insert_id;
        foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) {

            $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
            $perbarang = $ambil->fetch_assoc();
            $nama_barang = $perbarang['nama_barang'];
            $harga = $perbarang['harga'];
            $subtotal = $perbarang['harga'] * $jumlah;

            $koneksi->query("INSERT INTO detail_barang(id_pembayaran,id_barang,jumlah,subtotal) VALUES ('$id_pembelian_barusan','$id_barang','$jumlah','$subtotal')");
        }
        unset($_SESSION["keranjang"]);


        echo "<script>alert('pembelian sukses');</script>";
        echo "<script>location = '?page=detail_pembelian&id=$id_pembelian_barusan';</script>";
    }

    ?>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>