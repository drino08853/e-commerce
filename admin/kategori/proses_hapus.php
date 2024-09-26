<?php
session_start();
// koneksi database
include '../koneksi.php';

// menangkap data nopesan yang di kirim dari url
$id_kategori = $_GET['id_kategori'];


// menghapus data dari database
$hapus = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id_kategori'");

if ($hapus) {
    $_SESSION['delete_success'] = 'Data Berhasil Dihapus!';
    header("Location: ../?page=kategori/index");
    exit();
} else {
    $_SESSION['delete_success'] = 'Data Gagal Dihapus!';
    header("Location: ../?page=kategori/index");
    exit();
}
