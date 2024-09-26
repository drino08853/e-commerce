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
                window.location.href = 'user/proses_hapus.php?id_user=' + id; // replace with your actual delete URL
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
                <form action="user/proses_tambah.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">User Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" name="username" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Password</label></div>
                        <div class="col-12 col-md-9"><input type="password" name="password" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Nama Lengkap</label></div>
                        <div class="col-12 col-md-9"><input type="text" name="nama_lengkap" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Foto</label></div>
                        <div class="col-12 col-md-9"><input type="file" name="foto" class="form-control"></div>
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
$ubah = mysqli_query($koneksi, "SELECT * FROM user");
while ($u = mysqli_fetch_array($ubah)) {
?>
    <div class="modal fade" id="editmodal<?= $u['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header">
                    <strong>From</strong> Update
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="user/proses_edit.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" value="<?= $u['id_user']; ?>">
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Username</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="username" class="form-control" value="<?= $u['username']; ?>"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" name="password" class="form-control" value="<?= $u['password']; ?>"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Nama Lengkap</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="nama_lengkap" class="form-control" value="<?= $u['nama_lengkap']; ?>"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Foto</label></div>
                            <div class="col-12 col-md-9">
                                <input type="hidden" name="foto_lama" value="<?= $u['foto']; ?>" class="form-control">
                                <img src="images/<?= $u['foto']; ?>" width="200px" height="200px" alt="Image Not Found">
                                <input type="file" name="foto" class="form-control">
                            </div>
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
                <h1>User</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#">User</a></li>
                    <li class="active">Data User</li>
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
                        <strong class="card-title">Data User</strong>
                        <button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#tambahmodal"> <i class="fa fa-plus"></i> Tambah Data</button>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM user;");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><img src="images/<?= $d['foto']; ?>" width="110px" height="90px" alt="Image Not Found"></td>
                                        <td><?= $d['nama_lengkap']; ?></td>
                                        <td><?= $d['username']; ?></td>
                                        <td>
                                            <a class="btn btn-outline-primary btn-xs" data-toggle="modal" href="#editmodal<?= $d['id_user']; ?>"> <i class="fa fa-edit"></i> Edit</a></a>
                                            <a class="btn btn-outline-danger btn-xs" href="#" onclick="confirmDelete(<?= $d['id_user']; ?>); return false;"><i class="fa fa-trash"></i> Hapus
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