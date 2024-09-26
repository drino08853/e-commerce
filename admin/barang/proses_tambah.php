<?php

session_start();
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_kategori = $_POST['id_kategori'];
$nama_barang = $_POST['nama_barang'];
$slug =  str_replace('+', '-', urlencode($nama_barang));
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$gambar_barang = $_FILES['gambar_barang']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if ($gambar_barang  != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_barang); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_barang']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_barang; //menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../images/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
        $query = "INSERT INTO barang (id_kategori,nama_barang,slug,harga,deskripsi,gambar_barang) VALUES ('$id_kategori','$nama_barang','$slug','$harga','$deskripsi','$nama_gambar_baru')";
        $result = mysqli_query($koneksi, $query);
        // periska query apakah ada error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju

            $_SESSION['save_success'] = 'Data Berhasil Ditambahkan!';
            header("Location: ../?page=barang/index");
            exit();
        }
    } else {
        //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        $_SESSION['save_success'] = 'Ekstensi Gambar Yang Boleh Hanya jpg atau png.';
        header("Location: ../?page=barang/index");
        exit();
    }
} else {
    $query = "INSERT INTO barang (id_kategori,nama_barang,slug,harga,deskripsi,gambar_barang) VALUES ('$id_kategori','$nama_barang','$slug','$harga','$deskripsi', null)";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju

        $_SESSION['save_success'] = 'Data Berhasil Ditambahkan!';
        header("Location: ../?page=barang/index");
        exit();
    }
}
