<?php
session_start();
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_barang = $_POST['id_barang'];
$id_kategori = $_POST['id_kategori'];
$nama_barang = $_POST['nama_barang'];
$slug =  str_replace('+', '-', urlencode($nama_barang));
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$gambar_barang = $_FILES['gambar_barang']['name'];


if ($_FILES['gambar_barang']['name'] == '') {
    $namafile = $_POST['foto_lama'];
} else {
    // Jika Mengubah Gambar
    // ambil data file
    $namafile   = $_FILES['gambar_barang']['name'];
    $namaSementara = $_FILES['gambar_barang']['tmp_name'];
    //pindahkan file 
    $terupload = move_uploaded_file($namaSementara, '../images/' . $namafile);
}

//Query Insert ke Database 
$ubah = mysqli_query($koneksi, "UPDATE barang SET id_kategori='$id_kategori',nama_barang='$nama_barang',slug='$slug',
harga='$harga',deskripsi='$deskripsi',gambar_barang='$namafile' WHERE id_barang='$id_barang'");


// jika query berhasil
if ($ubah) {
    $_SESSION['update_success'] = 'Data Berhasil Di Update!';
    header("Location: ../?page=barang/index");
    exit();
    // jika query gagal
} else {
    $_SESSION['update_success'] = 'Data Gagal Di Update!';
    header("Location: ../?page=barang/index");
    exit();
}
