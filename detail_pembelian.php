<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <?php
    $ambil = $koneksi->query("SELECT * FROM pembayaran JOIN pelanggan ON pembayaran.id_pelanggan=pelanggan.id_pelanggan JOIN ongkir ON pembayaran.id_ongkir=ongkir.id_ongkir WHERE pembayaran.id_pembayaran='$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    ?>
    <div class="container">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-window-restore"></i> Sufee Shop
                        <small class="float-right">Tgl.Transaksi: <?php echo date('d-m-Y', strtotime($detail['tanggal_pembelian'])); ?></small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Yth.Pelanggan
                    <address>
                        <strong><?php echo $detail['nama_lengkap']; ?></strong><br>
                        Telp: <?php echo $detail['telp']; ?><br>
                        User ID: <?php echo $detail['username']; ?>
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
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
                            <?php $ambil = $koneksi->query("SELECT * FROM detail_barang JOIN barang ON detail_barang.id_barang=barang.id_barang WHERE detail_barang.id_pembayaran='$_GET[id]'"); ?>
                            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['nama_barang']; ?></td>
                                    <td><?php echo  "Rp" . number_format($pecah['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo $pecah['jumlah']; ?></td>
                                    <td><?php echo "Rp " . number_format($pecah['harga'] * $pecah['jumlah'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Silahkan Melakukan Pembayaran Melalui Via Transfer Dengan No.Rek Di Bawah Ini Sebesar: <span style="font-weight: bold;">Rp. <?php echo number_format($detail['total_pembelian']); ?></span>
                        Dan Sebelum Melakukan Pembayaran / Trasnfer Screenshot Dulu Bukti Detail Transaksinya Karena History Belanja Masih Dalam Maintenance !</p>

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        <strong class="alert alert-info">BANK BRI 057837823 AN. Reino</strong>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Biaya Ongkos Kirim:</th>
                                <td>Rp.<?php echo number_format($detail['tarif']); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Total Seluruh:</th>
                                <td>Rp.<?php echo number_format($detail['total_pembelian']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <form method="POST" enctype="multipart/form-data">
                <div class="row no-print">
                    <div class="col-12">
                        <input type="hidden" name="id_pembayaran" value="<?php echo $detail['id_pembayaran']; ?>">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Upload Bukti Bayar :</label>
                        <input type="file" name="bukti_bayar" required>
                        <button name="upload" class="btn btn-success float-right" onclick="return confirm('Apakah Bukti Pembayaran Yang Anda Upload Sudah Benar,Jika Sudah Benar Lanjutkan Pembayaran Agar Pesanan Di Proses !');"><i class="far fa-credit-card"></i> Submit
                            Pembayaran
                        </button>
                    </div>
                </div>
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
    </form>
    <!-- /.row -->

    <?php

    if (isset($_POST["upload"])) {
        $id_pembayaran = $_POST["id_pembayaran"];
        $bukti_bayar = $_FILES['bukti_bayar']['name'];
        // Jika Mengubah Gambar
        // ambil data file
        $namafile   = $_FILES['bukti_bayar']['name'];
        $namaSementara = $_FILES['bukti_bayar']['tmp_name'];
        //pindahkan file 
        $terupload = move_uploaded_file($namaSementara, 'admin/images/' . $namafile);


        $koneksi->query("UPDATE pembayaran SET bukti_bayar = '$bukti_bayar' WHERE id_pembayaran = '$id_pembayaran'");

        echo "<script>alert('pembayaran sukses');</script>";
        echo "<script>location = 'index.php';</script>";
    }

    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- /.content-wrapper -->