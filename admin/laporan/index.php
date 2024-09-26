<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Laporan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#">Laporan</a></li>
                    <li class="active">Pembelian Per-Periode</a></li>
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
                        <strong class="card-title">Laporan Pembelian Per-Periode</strong>
                    </div>

                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required value="<?= isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '' ?>" size="10" required />
                                </div>
                                <div class="col-lg-3">
                                    <input type="date" name="tgl_sampai" id="tgl_sampai" class="form-control" required value="<?= isset($_POST['tgl_sampai']) ? $_POST['tgl_sampai'] : '' ?>" size="10" required />
                                </div>

                                <div class="col-lg-3">
                                    <button class="btn btn-outline-success" type="submit" name="filter"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-outline-info" onclick="openPrintWindow()"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script>
                        function openPrintWindow() {
                            var tglMulai = document.getElementById('tgl_mulai').value;
                            var tglSampai = document.getElementById('tgl_sampai').value;
                            var url = 'laporan/print.php?mulai=' + tglMulai + '&sampai=' + tglSampai;
                            window.open(url, '_blank');
                        }
                    </script>

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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $totalseluruh = 0;
                                //Proses Filter berdasarka tanggal
                                if (isset($_POST['filter'])) {
                                    $tgl_mulai = $_POST['tgl_mulai'];
                                    $tgl_sampai = $_POST['tgl_sampai'];

                                    if (!empty($tgl_mulai) && !empty($tgl_sampai) && $tgl_mulai <=  $tgl_sampai) {
                                        $data = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN pelanggan 
                                        ON pembayaran.id_pelanggan=pelanggan.id_pelanggan WHERE tanggal_pembelian
                                BETWEEN '$tgl_mulai' AND '$tgl_sampai' ORDER BY id_pembayaran DESC");
                                    } else {
                                        echo "<script>alert('Masukkan Rentang Tanggal Yang Valid !');</script>";
                                    }
                                } else {
                                    // Menampilkan semua data jika filter tidak digunakan 
                                    $data = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN pelanggan 
                                    ON pembayaran.id_pelanggan=pelanggan.id_pelanggan ORDER BY id_pembayaran DESC");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <th scope="col"><?= $no++; ?></th>
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
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total Seluruh :</th>
                                    <th>Rp. <?php echo number_format($totalseluruh) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->