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
  PRIMARY KEY (`coffeereq_id`),
  KEY `userID` (`userID`),
  CONSTRAINT `coffee_request_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `coffee_request` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`) values 
(1,'test','test','$2y$10$oSliI8ySIZY9v84VwcBjZO2pw/Nh157gg1ezHNpmI7DImejRb77Ey'),
(2,'admin','zidrexandag10@gmail.com','$2y$10$oSliI8ySIZY9v84VwcBjZO2pw/Nh157gg1ezHNpmI7DImejRb77Ey'),
(3,'RedTequila ','dendenbuyco@yahoo.com','$2y$10$nikeegNDJHeg92Hygt6mz.LiOZ2BcOiU62WkgHS1QAyv0DySz/rUy');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
