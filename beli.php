<?php

// mendapatkan id_produk dari url 

$id_barang = $_GET['id'];

// Jika sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1

if (isset($_SESSION['keranjang'][$id_barang])) {
    $_SESSION['keranjang'][$id_barang] += 1;
}

//Selain itu (belum ada di keranjang) maka produk itu di anggap dibeli 1

else {
    $_SESSION['keranjang'][$id_barang] = 1;
}


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang

echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='?page=keranjang';</script>";
