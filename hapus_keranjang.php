<?php

$id_barang = $_GET["id"];
unset($_SESSION["keranjang"][$id_barang]);

echo "<script>alert('Produk telah dihapus dari keranjang');</script>";
echo "<script>location = '?page=keranjang';</script>";
