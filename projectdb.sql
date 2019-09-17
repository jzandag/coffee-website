/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 5.5.60-log : Database - projectdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`projectdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `projectdb`;

/*Table structure for table `coffee_request` */

DROP TABLE IF EXISTS `coffee_request`;

CREATE TABLE `coffee_request` (
  `coffeereq_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_date` datetime NOT NULL,
  `brew_date` datetime NOT NULL,
  `coffee_level` int(11) NOT NULL,
  `creamer_level` int(11) NOT NULL,
  `sugar_level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `queue` tinyint(1) DEFAULT NULL,
  `config_fk` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`coffeereq_id`),
  KEY `userID` (`userID`),
  KEY `config_fk` (`config_fk`),
  CONSTRAINT `coffee_request_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  CONSTRAINT `config_fk` FOREIGN KEY (`config_fk`) REFERENCES `config` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `coffee_request` */

insert  into `coffee_request`(`coffeereq_id`,`app_date`,`brew_date`,`coffee_level`,`creamer_level`,`sugar_level`,`status`,`userID`,`queue`,`config_fk`) values 
(7,'2019-09-17 17:51:13','2019-09-17 17:51:13',1,2,2,1,2,0,1),
(8,'2019-09-17 17:52:40','2019-09-17 17:52:40',1,1,1,1,2,0,1),
(9,'2019-09-17 17:54:41','2019-09-17 17:54:41',1,3,3,1,2,0,1),
(10,'2019-09-17 17:54:53','2019-09-17 17:54:53',1,4,4,1,2,0,1),
(11,'2019-09-17 17:55:32','2019-09-18 17:56:00',1,1,1,1,2,0,1),
(12,'2019-09-17 17:58:19','2019-09-17 17:58:19',1,3,3,1,2,0,1),
(13,'2019-09-17 18:01:55','2019-09-17 18:01:55',1,3,3,1,2,0,1),
(14,'2019-09-17 18:02:08','2019-09-17 18:02:08',1,3,3,1,2,0,1),
(15,'2019-09-17 18:02:18','2019-09-17 18:02:18',1,4,4,1,2,0,1);

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `config_key` varchar(255) DEFAULT NULL,
  `config_value` varchar(255) DEFAULT NULL,
  `config_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `config` */

insert  into `config`(`id`,`config_key`,`config_value`,`config_status`) values 
(1,'SYSTEM_MAINTENANCE','System Maintenance','1');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`role`) values 
(1,'test','test','$2y$10$oSliI8ySIZY9v84VwcBjZO2pw/Nh157gg1ezHNpmI7DImejRb77Ey','user'),
(2,'admin','zidrexandag10@gmail.com','$2y$10$xNdGa1RybCaxZQrtJxgIS.qI8/dyHgxXB/QV0MDIjBYgsttrD1sq.','admin'),
(3,'RedTequila ','dendenbuyco@yahoo.com','$2y$10$nikeegNDJHeg92Hygt6mz.LiOZ2BcOiU62WkgHS1QAyv0DySz/rUy','user'),
(4,'raspi','raspi@gmail.com\r\n','$2y$10$oSliI8ySIZY9v84VwcBjZO2pw/Nh157gg1ezHNpmI7DImejRb77Ey','machine'),
(5,'helloww','hellow@gmail.com','$2y$10$CBKKzL1yFWGVSk0ty5Y0rO5X6j1sJC18yGyXQ70.VnMe1c.AMrlG6','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
