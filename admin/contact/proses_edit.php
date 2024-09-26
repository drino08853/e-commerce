<?php
session_start();
// sisipkan file koneksi.php
include "../koneksi.php";

$id_kontak = $_POST['id_kontak'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$no_telp = $_POST['no_telp'];
$alamat = $_POST['alamat'];

// query SQL untuk insert data
$edit = mysqli_query($koneksi, "UPDATE kontak SET facebook = '$facebook',instagram ='$instagram',no_telp='$no_telp',alamat='$alamat' WHERE id_kontak = '$id_kontak'");


// jika query berhasil
if ($edit) {
    $_SESSION['update_success'] = 'Data Berhasil Di Update!';
    header("Location: ../?page=contact/edit&id_kontak=$id_kontak");
    exit();
    // jika query gagal
} else {
    $_SESSION['update_success'] = 'Data Gagal Di Update!';
    header("Location: ../?page=contact/edit&id_kontak=$id_kontak");
    exit();
}
