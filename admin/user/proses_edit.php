<?php
session_start();
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];
$foto = $_FILES['foto']['name'];



if ($_FILES['foto']['name'] == '') {
    $namafile = $_POST['foto_lama'];
} else {
    // Jika Mengubah Gambar
    // ambil data file
    $namafile   = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];
    //pindahkan file 
    $terupload = move_uploaded_file($namaSementara, '../images/' . $namafile);
}

//Query Insert ke Database 
$ubah = mysqli_query($koneksi, "UPDATE user SET username='$username',password='$password',
nama_lengkap='$nama_lengkap',foto='$namafile' WHERE id_user='$id_user'");


// jika query berhasil
if ($ubah) {
    $_SESSION['update_success'] = 'Data Berhasil Di Update!';
    header("Location: ../?page=user/index");
    exit();
    // jika query gagal
} else {
    $_SESSION['update_success'] = 'Data Gagal Di Update!';
    header("Location: ../?page=user/index");
    exit();
}
