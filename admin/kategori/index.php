<?php
if (isset($_SESSION['save_success'])) :
?>

    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "<?= $_SESSION['save_success'] ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>

<?php
    unset($_SESSION['save_success']);
endif; ?>

<?php
if (isset($_SESSION['update_success'])) :
?>

    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "<?= $_SESSION['update_success'] ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>

<?php
    unset($_SESSION['update_success']);
endif; ?>

<script>
    function confirmDelete(id) {
        Swal.fire({
            position: "center",
            title: 'Apakah Anda Ingin Menghapus Data ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the delete action here, e.g., submit a form or make an AJAX request
                window.location.href = 'kategori/proses_hapus.php?id_kategori=' + id; // replace with your actual delete URL
            }
        });
    }
</script>

<?php
if (isset($_SESSION['delete_success'])) :
?>

    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "<?= $_SESSION['delete_success'] ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>

<?php
    unset($_SESSION['delete_success']);
endif; ?>




<!-- Modal Tambah-->
<div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header">
                <strong>From</strong> Tambah
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="kategori/proses_tambah.php" method="POST" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Nama Kategori</label></div>
                        <div class="col-12 col-md-9"><input type="text" name="nama_kategori" class="form-control"></div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i class="fa fa-ban"></i> Kembali
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->

<?php
// $id_kategori = $_GET['id_kategori'];
$ubah = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($u = mysqli_fetch_array($ubah)) {
?>
    <div class="modal fade" id="editmodal<?= $u['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header">
                    <strong>From</strong> Edit
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="kategori/proses_edit.php" method="POST" class="form-horizontal">
                        <input type="hidden" name="id_kategori" value="<?= $u['id_kategori']; ?>">
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Nama Kategori</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="nama_kategori" class="form-control" value="<?= $u['nama_kategori']; ?>"></div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Update
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-ban"></i> Kembali
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kategori</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#">Kategori</a></li>
                    <li class="active">Data Kategori</li>
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
                        <strong class="card-title">Data Kategori</strong>
                        <button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#tambahmodal"> <i class="fa fa-plus"></i> Tambah Data</button>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM kategori ");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <td>
                                            <a class="btn btn-outline-primary btn-xs" data-toggle="modal" href="#editmodal<?= $d['id_kategori']; ?>"> <i class="fa fa-edit"></i> Edit</a></a>
                                            <a class="btn btn-outline-danger btn-xs" href="#" onclick="confirmDelete(<?= $d['id_kategori']; ?>); return false;"><i class="fa fa-trash"></i> Hapus
                                            </a>
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