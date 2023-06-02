/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 8.0.30 : Database - penggajian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`penggajian` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `penggajian`;

/*Table structure for table `data_gaji` */

DROP TABLE IF EXISTS `data_gaji`;

CREATE TABLE `data_gaji` (
  `id_pegawai` int NOT NULL,
  `cetak` date DEFAULT NULL,
  `status` enum('pengajuan','diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pengajuan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji` */

insert  into `data_gaji`(`id_pegawai`,`cetak`,`status`) values 
(1,'2023-05-01','diterima'),
(1,'2023-06-01','diterima'),
(3,'2023-06-01','diterima');

/*Table structure for table `data_gaji_tunjangan` */

DROP TABLE IF EXISTS `data_gaji_tunjangan`;

CREATE TABLE `data_gaji_tunjangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_gaji` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji_tunjangan` */

insert  into `data_gaji_tunjangan`(`id`,`nama_gaji`) values 
(1,'tunjangan nongkrong'),
(2,'tunjangan kayang'),
(3,'tunjangan salto');

/*Table structure for table `data_gaji_tunjangan_guru` */

DROP TABLE IF EXISTS `data_gaji_tunjangan_guru`;

CREATE TABLE `data_gaji_tunjangan_guru` (
  `id_guru` int DEFAULT NULL,
  `id_tunjangan` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji_tunjangan_guru` */

insert  into `data_gaji_tunjangan_guru`(`id_guru`,`id_tunjangan`,`jumlah`) values 
(1,1,10000),
(1,3,1),
(3,1,6000),
(2,2,100000);

/*Table structure for table `data_jabatan` */

DROP TABLE IF EXISTS `data_jabatan`;

CREATE TABLE `data_jabatan` (
  `id_jabatan` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(120) NOT NULL,
  `gaji_pokok` varchar(50) NOT NULL,
  `tj_transport` varchar(50) NOT NULL,
  `uang_makan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_jabatan` */

insert  into `data_jabatan`(`id_jabatan`,`nama_jabatan`,`gaji_pokok`,`tj_transport`,`uang_makan`) values 
(1,'HRD','4000000','600000','400000'),
(2,'Staff Marketing','2500000','300000','200000'),
(3,'Admin','2200000','300000','200000'),
(4,'Sales','2500000','300000','200000');

/*Table structure for table `data_jadwal` */

DROP TABLE IF EXISTS `data_jadwal`;

CREATE TABLE `data_jadwal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_guru` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_jadwal` */

insert  into `data_jadwal`(`id`,`id_guru`,`id_mapel`,`id_kelas`,`tanggal`,`jam`) values 
(2,1,1,1,'2023-05-31',1),
(3,1,1,1,'2023-06-01',1),
(4,1,1,1,'2023-06-30',1),
(5,1,1,1,'2023-06-01',5),
(6,1,1,1,'2023-06-14',9),
(7,3,2,3,'2023-06-30',1),
(8,2,2,2,'2023-06-01',1),
(9,3,2,3,'2023-06-01',1),
(10,2,1,2,'2023-06-01',9),
(11,1,1,1,'2023-06-01',9),
(12,2,2,2,'2023-06-01',5),
(13,4,2,3,'2023-05-31',5),
(14,1,1,1,'2023-06-07',1),
(15,1,1,1,'2023-06-02',1),
(16,1,1,1,'2023-06-16',1),
(17,1,1,1,'2023-06-02',2),
(18,2,1,1,'2023-06-02',6);

/*Table structure for table `data_kehadiran` */

DROP TABLE IF EXISTS `data_kehadiran`;

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int NOT NULL AUTO_INCREMENT,
  `bulan` varchar(15) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `hadir` int NOT NULL,
  `sakit` int NOT NULL,
  `alpha` int NOT NULL,
  PRIMARY KEY (`id_kehadiran`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_kehadiran` */

insert  into `data_kehadiran`(`id_kehadiran`,`bulan`,`nik`,`nama_pegawai`,`jenis_kelamin`,`nama_jabatan`,`hadir`,`sakit`,`alpha`) values 
(1,'012021','0987654321','Dodi','Laki-Laki','Staff Marketing',24,0,0),
(2,'012021','123456789','Fauzi','Laki-Laki','Admin',22,0,1);

/*Table structure for table `data_kelas` */

DROP TABLE IF EXISTS `data_kelas`;

CREATE TABLE `data_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_kelas` */

insert  into `data_kelas`(`id`,`nama_kelas`) values 
(1,'XI'),
(2,'XII'),
(3,'XIII');

/*Table structure for table `data_mapel` */

DROP TABLE IF EXISTS `data_mapel`;

CREATE TABLE `data_mapel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_mapel` */

insert  into `data_mapel`(`id`,`nama_mapel`) values 
(1,'lompat indah'),
(2,'ok');

/*Table structure for table `data_pegawai` */

DROP TABLE IF EXISTS `data_pegawai`;

CREATE TABLE `data_pegawai` (
  `id_pegawai` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `hak_akses` int NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_pegawai` */

insert  into `data_pegawai`(`id_pegawai`,`nik`,`nama_pegawai`,`username`,`password`,`jenis_kelamin`,`jabatan`,`tanggal_masuk`,`status`,`photo`,`hak_akses`) values 
(1,'123456789','Fauzi','fauzi','0bd9897bf12294ce35fdc0e21065c8a7','Laki-Laki','Admin','2020-12-26','Karyawan Tetap','pegawai-210101-a7ca89f5fc.png',1),
(2,'0987654321','Dodi','dodi','dc82a0e0107a31ba5d137a47ab09a26b','Laki-Laki','Staff Marketing','2021-01-02','Karyawan Tidak Tetap','pegawai-210101-9847084dc8.png',2),
(3,'35720727080001','rosa','rosa','84109ae4b4178430b8174b1dfef9162b','Perempuan','Admin','2023-05-18','Karyawan Tetap','pegawai-230523-fc9c3741e8.jpg',1),
(4,'666','Kepsek','Kepsek','2cc02e17c69c6cb6b89917d26d54dfe7','Perempuan','HRD','2023-06-01','Karyawan Tetap','pegawai-230602-c34f545b98.jpeg',3);

/*Table structure for table `data_presensi` */

DROP TABLE IF EXISTS `data_presensi`;

CREATE TABLE `data_presensi` (
  `id_jadwal` int NOT NULL,
  `hadir` enum('Hadir','Lainnya') NOT NULL,
  `id_potongan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_presensi` */

insert  into `data_presensi`(`id_jadwal`,`hadir`,`id_potongan`) values 
(5,'Hadir',0),
(2,'Lainnya',1),
(8,'Hadir',0),
(11,'Hadir',0),
(3,'Lainnya',2);

/*Table structure for table `hak_akses` */

DROP TABLE IF EXISTS `hak_akses`;

CREATE TABLE `hak_akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `hak_akses` */

insert  into `hak_akses`(`id`,`keterangan`,`hak_akses`) values 
(1,'admin',1),
(2,'pegawai',2);

/*Table structure for table `potongan_gaji` */

DROP TABLE IF EXISTS `potongan_gaji`;

CREATE TABLE `potongan_gaji` (
  `id` int NOT NULL AUTO_INCREMENT,
  `potongan` varchar(120) NOT NULL,
  `jml_potongan` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `potongan_gaji` */

insert  into `potongan_gaji`(`id`,`potongan`,`jml_potongan`) values 
(1,'Alfa',100000),
(2,'Izin',1),
(3,'Sakit',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
