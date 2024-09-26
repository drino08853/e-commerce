<?php
session_start();
// koneksi database
include '../koneksi.php';

// menangkap data nopesan yang di kirim dari url
$id_barang = $_GET['id_barang'];


// menghapus data dari database
$hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");

if ($hapus) {
    $_SESSION['delete_success'] = 'Data Berhasil Dihapus!';
    header("Location: ../?page=barang/index");
    exit();
} else {
    $_SESSION['delete_success'] = 'Data Gagal Dihapus!';
    header("Location: ../?page=barang/index");
    exit();
}
