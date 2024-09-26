<?php
session_start();
// sisipkan file koneksi.php
include "../koneksi.php";

$id_kategori = $_POST['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];

// query SQL untuk insert data
$edit = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'");

// jika query berhasil
if ($edit) {
    $_SESSION['update_success'] = 'Data Berhasil Di Update!';
    header("Location: ../?page=kategori/index");
    exit();
    // jika query gagal
} else {
    $_SESSION['update_success'] = 'Data Gagal Di Update!';
    header("Location: ../?page=kategori/index");
    exit();
}
