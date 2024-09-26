/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - dbecommerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `dbecommerce`;

/*Table structure for table `about` */

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `id_about` int(11) NOT NULL AUTO_INCREMENT,
  `visi` varchar(255) DEFAULT NULL,
  `misi` varchar(255) DEFAULT NULL,
  `gambar_about` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_about`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `about` */

insert  into `about`(`id_about`,`visi`,`misi`,`gambar_about`) values 
(1,'Menjadi Tempat Wisata Yang Nyaman','Memberikan Pelayanan Pada Pengunjung','pngtree-travel-tourism-logo-design-template-png-image_5476090.jpg');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `gambar_barang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`id_kategori`,`nama_barang`,`slug`,`harga`,`deskripsi`,`gambar_barang`) values 
(56,126,'Steam Deck Standard','Steam-Deck-Standard',7000000,'Rasakan experience dalam bermain game pc dalam genggaman','457-vpavic_220210_5030_0054_Edit.jpg'),
(57,126,'Asus ROG Ally','Asus-ROG-Ally',9000000,'Bermain game pc hanya dalam genggaman & di dukung cpu yang bertenaga','922-ASUS-ROG-Ally-1.jpg'),
(58,127,'Keyboard Mechanical','Keyboard-Mechanical',300000,'Nyaman digunakan saat mengetik dan merasakan xperience yang enak','781-id-11134201-7qul8-lev8pig6sy0t10.jpg'),
(59,125,'Infinix INBook X2','Infinix-INBook-X2',5500000,'Laptop bertenaga dan elegan seperti masa kini','996-e602e3020098affa4f61fb0fd86f56d2.jpg'),
(63,128,'Tp-link Tl-wr840n Router Wr840n 300mbps Wireless','Tp-link-Tl-wr840n-Router-Wr840n-300mbps-Wireless',165000,'TP-Link TL-WR840N adalah solusi kecepatan tinggi yang kompatibel dengan IEEE 802.11b / g / n. Berdasarkan teknologi 802.11n, TL-WR840N memberikan kinerja nirkabel hingga 300Mbps, yang dapat memenuhi kebutuhan jaringan rumah Anda yang paling menuntut, sepe','79-router.jpg'),
(64,127,'UGREEN 90545 Ergonomic Wireless Silent Mouse','UGREEN-90545-Ergonomic-Wireless-Silent-Mouse',125000,'6 Mute buttons. 3 million time lifespan\r\n5-level DPI : 800/1000/1600/2000/4000, The default setting is 1600','768-URGEN.JPG');

/*Table structure for table `detail_barang` */

DROP TABLE IF EXISTS `detail_barang`;

CREATE TABLE `detail_barang` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembayaran` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `detail_barang` */

insert  into `detail_barang`(`id_detail`,`id_pembayaran`,`id_barang`,`jumlah`,`subtotal`) values 
(5,3,57,1,9000000),
(6,3,58,2,600000),
(7,4,58,2,600000),
(8,5,56,1,7000000),
(9,5,58,1,300000),
(10,6,58,1,300000),
(11,6,56,1,7000000),
(12,7,64,1,125000),
(13,7,63,1,165000),
(14,8,64,1,125000),
(15,8,59,1,5500000),
(16,8,58,1,300000),
(17,9,64,1,125000),
(18,9,58,2,600000),
(19,10,63,1,165000),
(20,12,56,1,7000000),
(21,12,63,1,165000),
(22,12,64,2,250000),
(23,13,58,1,300000);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`) values 
(125,'Laptop'),
(126,'Handheld Gaming'),
(127,'Peripheral'),
(128,'Perangkat Jaringan');

/*Table structure for table `kontak` */

DROP TABLE IF EXISTS `kontak`;

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `kontak` */

insert  into `kontak`(`id_kontak`,`facebook`,`instagram`,`no_telp`,`alamat`) values 
(1,'https://www.facebook.com/profile.php?id=1000077185','https://www.instagram.com/dio_al_parino_77?igsh=MW','082384610426','Jalan Marapalam Indah A3.No.24 Kebon Sirih Siteba');

/*Table structure for table `ongkir` */

DROP TABLE IF EXISTS `ongkir`;

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `ongkir` */

insert  into `ongkir`(`id_ongkir`,`nama_kota`,`tarif`) values 
(1,'Pariaman',20000),
(2,'Bukittingi',30000),
(3,'Payakumbuh',40000),
(4,'Lubuk Sikaping',40000),
(5,'Pasaman',50000);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `telp` int(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`username`,`password`,`nama_lengkap`,`telp`,`foto`) values 
(129,'david','12345','Zasalova',454549,'809-avatars-5yIJHT8LmsSwMklH-2QfC3g-t500x500.jpg'),
(130,'daad','12345','Admiral',4545400,'224-ai1.jpg'),
(132,'dian1234','12345','Dian',458453438,'871-images.jpg'),
(133,'irfandi','12345','Dani',787875,'340-pp.jpg'),
(134,'daril1234','12345','Johnson',6759557,'174-d9bff09869ff972a13f991dc4453ae7c.jpg');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `total_pembelian` double DEFAULT NULL,
  `alamat_pengirim` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`id_pembayaran`,`id_pelanggan`,`id_ongkir`,`tanggal_pembelian`,`total_pembelian`,`alamat_pengirim`,`bukti_bayar`) values 
(3,129,1,'2024-09-19',9620000,'Korong Gadang Pariaman Selatan (43567)','bsi bukti transfer.jpg'),
(4,130,2,'2024-09-19',630000,'Komplek Air Panas Kab.Agam (2345)','bca bukti tf.jpg'),
(5,130,1,'2024-09-19',7320000,'Komplek Prima Lestari (24367)','mege bank tf.jpg'),
(6,132,4,'2024-09-20',7340000,'Jalan Parapatiah Nan Sabatang (23456)','bca ds tf.jpg'),
(7,130,2,'2024-09-20',320000,'Jln Bukittingi No.67 (23456)','mandiri tf.jpg'),
(8,129,5,'2024-09-20',5975000,'Jln Kebon Indah (23456)','mandiri tf.jpg'),
(9,133,5,'2024-09-21',775000,'Pasaman Barat Bonjol (06788)','bukti  transfer.jpg'),
(10,133,1,'2024-09-21',185000,'Gashan Kab.Pariaman (23450)','bukti  transfer.jpg'),
(12,134,2,'2024-09-22',7445000,'Jln Bukittinggi Selatan 2 Barat (23456)','link aja.jpg'),
(13,132,5,'2024-09-22',350000,'Pasaman Timur (23456)','bca ds tf.jpg');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`nama_lengkap`,`foto`) values 
(5,'markus','12345','Mas Tukang  Perkakas','ai2.jpg'),
(6,'hartono','12345','Pak Hartono','905-ai1.jpg'),
(12,'ryanfeb','12345','Ryan Feb','783-bandung-badge.png'),
(13,'asaltauaja','12345','Shanks','998-history.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
