<?php


session_start();
// koneksi database
include "../koneksi.php";
// menangkap data nopesan yang di kirim dari url
$nama_kategori = $_POST['nama_kategori'];

// Memperbaiki query dengan menambahkan kurung tutup yang hilang
$tambah = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");

if ($tambah) {
    $_SESSION['save_success'] = 'Data Berhasil Ditambahkan!';
    header("Location: ../?page=kategori/index");
    exit();
} else {
    $_SESSION['save_success'] = 'Data Gagal Ditambahkan!';
    header("Location: ../?page=kategori/index");
    exit();
}
