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


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Contact US</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#">Contact</a></li>
                    <li class="active">Contact US</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$id_kontak = $_GET['id_kontak'];
$ubah = mysqli_query($koneksi, "SELECT * FROM kontak WHERE id_kontak = '$id_kontak'");
$data = mysqli_fetch_array($ubah);
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Contact</strong> US
                    </div>
                    <div class="card-body card-block">
                        <form action="contact/proses_edit.php" method="POST" class="form-horizontal">
                            <input type="hidden" name="id_kontak" class="form-control" value="<?php echo $data['id_kontak']; ?>">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-email" class=" form-control-label"><i class="fa fa-facebook-square"></i> Facebook</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="facebook" class="form-control" value="<?php echo $data['facebook']; ?>"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label"><i class="fa fa-instagram"></i> Instagram</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="instagram" class="form-control" value="<?php echo $data['instagram']; ?>"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label"><i class="fa fa-whatsapp"></i> No.Telp</label></div>
                                <div class="col-12 col-md-9"> <input type="number" name="no_telp" class="form-control" value="<?php echo $data['no_telp']; ?>"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label"><i class="fa fa-map-signs"></i> Alamat</label></div>
                                <div class="col-12 col-md-9"> <textarea class="form-control" name="alamat" rows="5"><?php echo $data['alamat']; ?></textarea></div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Update
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>