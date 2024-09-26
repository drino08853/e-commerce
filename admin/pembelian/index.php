<!-- Modal Detail-->
<?php
// $id_kategori = $_GET['id_kategori'];
$data = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN pelanggan ON pembayaran.id_pelanggan=pelanggan.id_pelanggan JOIN ongkir ON pembayaran.id_ongkir=ongkir.id_ongkir");
while ($d = mysqli_fetch_array($data)) {
?>
    <div class="modal fade" id="detailmodal<?= $d['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 70%;" role="document">
            <div class="modal-content">
                <div class="card-header">
                    <strong>Detail</strong> Belanja
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fa fa-window-restore"></i> Sufee Shop
                                    <small class="float-right">Tgl.Transaksi: <?= date('d-m-Y', strtotime($d['tanggal_pembelian'])); ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From.Pelanggan
                                <address>
                                    <strong><?= $d['nama_lengkap']; ?></strong><br>
                                    Telp: <?= $d['telp']; ?><br>
                                    User ID: <?= $d['username']; ?><br>
                                    Alamat: <?= $d['alamat_pengirim']; ?>
                                </address>
                            </div>
                            <!-- /.col -->
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
                                        <?php
                                        $no = 1;
                                        $detail = mysqli_query($koneksi, "SELECT * FROM detail_barang JOIN barang ON 
                                        detail_barang.id_barang=barang.id_barang WHERE detail_barang.id_pembayaran='$d[id_pembayaran]'");
                                        while ($dt = mysqli_fetch_array($detail)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt['nama_barang']; ?></td>
                                                <td><?= "Rp" . number_format($dt['harga'], 0, ',', '.'); ?></td>
                                                <td><?= $dt['jumlah']; ?></td>
                                                <td><?= "Rp " . number_format($dt['harga'] * $dt['jumlah'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Ongkos Kirim:</th>
                                            <td>Rp.<?= number_format($d['tarif']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Seluruh:</th>
                                            <td>Rp.<?= number_format($d['total_pembelian']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- this row will not appear when printing -->
                    </div>
                    <!-- /.invoice -->
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-ban"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- Modal Bukti-->
<?php
// $id_kategori = $_GET['id_kategori'];
$data = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran");
while ($d = mysqli_fetch_array($data)) {
?>
    <div class="modal fade" id="buktimodal<?= $d['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header">
                    <strong>Bukti</strong> Transfer
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-12">
                            <input type="hidden" class="form-control">
                            <img src="images/<?= $d['bukti_bayar']; ?>" width="500px" height="500px" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-ban"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Pembelian</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#">Pembelian</a></li>
                    <li class="active">Data Pembelian</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">History Pembelian</strong>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">No.Telp</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Total Belanja</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN pelanggan ON pembayaran.id_pelanggan=pelanggan.id_pelanggan ORDER BY id_pembayaran DESC");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <th scope="col"><?= $no++; ?></th>
                                        <td><?= $d['username']; ?></td>
                                        <td><?= $d['nama_lengkap']; ?></td>
                                        <td><?= $d['telp']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($d['tanggal_pembelian'])); ?></td>
                                        <td><?= "Rp. " . number_format($d['total_pembelian'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a class="btn btn-outline-success btn-xs" data-toggle="modal" href="#detailmodal<?= $d['id_pembayaran']; ?>"> <i class="fa fa-eye"></i></a>
                                            <a class="btn btn-outline-primary btn-xs" data-toggle="modal" href="#buktimodal<?= $d['id_pembayaran']; ?>"> <i class="fa fa-photo"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->