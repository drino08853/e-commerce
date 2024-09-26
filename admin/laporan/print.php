<?php
include "../koneksi.php";
session_start();

// Ambil data tanggal mulai dan sampai dari URL (GET parameter)
$mulai = isset($_GET['mulai']) ? $_GET['mulai'] : '';
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';

// Validasi input tanggal
if (!empty($mulai) && !empty($sampai)) {
    $laporan = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN pelanggan ON pembayaran.id_pelanggan=pelanggan.id_pelanggan 
    WHERE tanggal_pembelian BETWEEN '$mulai' AND '$sampai' ORDER BY id_pembayaran DESC");
} else {
    echo "Tanggal tidak valid.";
    exit;
}
?>

<script>
    window.print()
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
</head>


<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fa fa-window-restore"></i> Sufee Shop
                    <small class="float-right">Periode Tanggal : <?= date('d-m-Y', strtotime($mulai)) ?> s.d <?= date('d-m-Y', strtotime($sampai)) ?></small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM kontak ;");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Laporan Penjualan Per-Periode / Harian</strong><br>
                        <?= $d['alamat']; ?><br>
                        <i class="fab fa-whatsapp"></i></i> Telp : <?= $d['no_telp']; ?>
                    </address>
                <?php
            }
                ?>
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
                                <th scope="col">No.</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">No.Telp</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Total Belanja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $totalseluruh = 0;
                            while ($d = mysqli_fetch_array($laporan)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['username']; ?></td>
                                    <td><?= $d['nama_lengkap']; ?></td>
                                    <td><?= $d['telp']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($d['tanggal_pembelian'])); ?></td>
                                    <td><?= "Rp. " . number_format($d['total_pembelian'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php
                                $totalseluruh += $d['total_pembelian'];
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
                    <p class="lead">Mengetahui :</p>

                    <p>Padang, <?php echo date('d-m-Y'); ?></p>
                    <div style=""></div>
                    <br><br><br>
                    <p><?= $_SESSION['nama_lengkap'] ?></p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:63%">Grand Total:</th>
                                <th>Rp. <?php echo number_format($totalseluruh) ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.invoice -->
</div>
<!-- /.invoice -->`