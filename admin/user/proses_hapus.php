<?php
session_start();
// koneksi database
include '../koneksi.php';

// menangkap data nopesan yang di kirim dari url
$id_user = $_GET['id_user'];


// menghapus data dari database
$hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

if ($hapus) {
    $_SESSION['delete_success'] = 'Data Berhasil Dihapus!';
    header("Location: ../?page=user/index");
    exit();
} else {
    $_SESSION['delete_success'] = 'Data Gagal Dihapus!';
    header("Location: ../?page=user/index");
    exit();
}
