/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 8.0.30 : Database - penggajian_2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`penggajian_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `penggajian_2`;

/*Table structure for table `data_gaji` */

DROP TABLE IF EXISTS `data_gaji`;

CREATE TABLE `data_gaji` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_gaji` varchar(255) DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji` */

insert  into `data_gaji`(`id`,`nama_gaji`,`nominal`) values 
(1,'tunjangan nongkrong',1000),
(2,'tunjangan kayang',120),
(3,'yes update',2222),
(5,'test',123),
(6,'aaaaaxxx',12345);

/*Table structure for table `data_gaji_guru` */

DROP TABLE IF EXISTS `data_gaji_guru`;

CREATE TABLE `data_gaji_guru` (
  `id_guru` int DEFAULT NULL,
  `id_gaji` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji_guru` */

insert  into `data_gaji_guru`(`id_guru`,`id_gaji`) values 
(3,1),
(3,6),
(3,3),
(4,3),
(3,2);

/*Table structure for table `data_gaji_pokok` */

DROP TABLE IF EXISTS `data_gaji_pokok`;

CREATE TABLE `data_gaji_pokok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nominal` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_gaji_pokok` */

insert  into `data_gaji_pokok`(`id`,`nominal`) values 
(1,100000);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_jadwal` */

insert  into `data_jadwal`(`id`,`id_guru`,`id_mapel`,`id_kelas`,`tanggal`,`jam`) values 
(1,3,1,3,'2023-06-15',4),
(2,3,3,3,'2023-05-01',4),
(3,3,2,3,'2023-06-21',3),
(4,4,3,3,'2023-06-16',3),
(5,4,3,4,'2023-06-15',5),
(6,4,3,3,'2023-06-22',5),
(7,3,1,4,'2023-06-15',4);

/*Table structure for table `data_kehadiran` */

DROP TABLE IF EXISTS `data_kehadiran`;

CREATE TABLE `data_kehadiran` (
  `tanggal` date DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `alfa` int DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  KEY `id_guru` (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_kehadiran` */

insert  into `data_kehadiran`(`tanggal`,`id_guru`,`alfa`,`izin`,`sakit`) values 
('2023-05-01',3,0,0,0),
('2023-06-01',3,1,0,0),
('2023-06-01',4,0,2,0);

/*Table structure for table `data_kelas` */

DROP TABLE IF EXISTS `data_kelas`;

CREATE TABLE `data_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_kelas` */

insert  into `data_kelas`(`id`,`nama_kelas`) values 
(1,'XI'),
(2,'XII'),
(3,'XIII'),
(4,'XII A');

/*Table structure for table `data_mapel` */

DROP TABLE IF EXISTS `data_mapel`;

CREATE TABLE `data_mapel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_mapel` */

insert  into `data_mapel`(`id`,`nama_mapel`) values 
(1,'lompat indah'),
(2,'ok'),
(3,'a'),
(4,'aaaaaaaaaaaaaa'),
(5,'aaaaaaaaaaaa');

/*Table structure for table `data_pegawai` */

DROP TABLE IF EXISTS `data_pegawai`;

CREATE TABLE `data_pegawai` (
  `id_pegawai` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `hak_akses` int NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_pegawai` */

insert  into `data_pegawai`(`id_pegawai`,`nik`,`nama_pegawai`,`username`,`password`,`jenis_kelamin`,`photo`,`hak_akses`) values 
(1,'666','Kepsek','Kepsek','2cc02e17c69c6cb6b89917d26d54dfe7','Perempuan','pegawai-230602-c34f545b98.jpeg',3),
(2,'123456789','Fauzi','fauzi','0bd9897bf12294ce35fdc0e21065c8a7','Laki-Laki','pegawai-210101-a7ca89f5fc.png',1),
(3,'1234567890123456','test','test','098f6bcd4621d373cade4e832627b4f6','Laki-Laki','pegawai-230618-a3e891a0a7.png',2),
(4,'3571035206010004','aaa','aaaa','594f803b380a41396ed63dca39503542','Laki-Laki','pegawai-230616-968a89d40f.png',2);

/*Table structure for table `data_potongan_gaji` */

DROP TABLE IF EXISTS `data_potongan_gaji`;

CREATE TABLE `data_potongan_gaji` (
  `id` int NOT NULL AUTO_INCREMENT,
  `potongan` varchar(255) DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_potongan_gaji` */

insert  into `data_potongan_gaji`(`id`,`potongan`,`nominal`) values 
(1,'Alfa',10000),
(2,'Izin',3000),
(3,'Sakit',7000);

/*Table structure for table `data_slip_gaji` */

DROP TABLE IF EXISTS `data_slip_gaji`;

CREATE TABLE `data_slip_gaji` (
  `id_pegawai` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('pengajuan','diterima','ditolak') DEFAULT 'pengajuan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `data_slip_gaji` */

insert  into `data_slip_gaji`(`id_pegawai`,`tanggal`,`status`) values 
(4,'2023-06-01','diterima'),
(3,'2023-05-01','diterima'),
(3,'2023-06-01','diterima');

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
