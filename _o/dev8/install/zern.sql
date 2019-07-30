-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5603
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for zern
DROP DATABASE IF EXISTS `zern`;
CREATE DATABASE IF NOT EXISTS `zern` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `zern`;

-- Dumping structure for table zern.userz
DROP TABLE IF EXISTS `userz`;
CREATE TABLE IF NOT EXISTS `userz` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `Status` tinyint(2) DEFAULT '1',
  `Username` varchar(70) DEFAULT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `Phone` varchar(70) DEFAULT NULL,
  `Password` varchar(70) DEFAULT NULL,
  `PIN` mediumint(9) DEFAULT NULL,
  `Type` varchar(70) DEFAULT NULL,
  `Privilege` tinyint(3) DEFAULT NULL,
  `LastName` varchar(70) DEFAULT NULL,
  `FirstName` varchar(70) DEFAULT NULL,
  `OtherName` varchar(70) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Sex` varchar(70) DEFAULT NULL,
  `LGA` varchar(70) DEFAULT NULL,
  `State` varchar(70) DEFAULT NULL,
  `Country` varchar(70) DEFAULT 'NG',
  `ReferralID` varchar(70) DEFAULT NULL,
  `ReferrerID` varchar(70) DEFAULT 'SELF',
  `DP` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Phone` (`Phone`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`),
  KEY `Status` (`Status`),
  KEY `PIN` (`PIN`),
  KEY `Type` (`Type`),
  KEY `Privilege` (`Privilege`),
  KEY `LastName` (`LastName`),
  KEY `FirstName` (`FirstName`),
  KEY `OtherName` (`OtherName`),
  KEY `DOB` (`DOB`),
  KEY `Sex` (`Sex`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zern.userz: ~1 rows (approximately)
/*!40000 ALTER TABLE `userz` DISABLE KEYS */;
REPLACE INTO `userz` (`AUID`, `PUID`, `RUID`, `EUID`, `Author`, `Created`, `Entry`, `Status`, `Username`, `Email`, `Phone`, `Password`, `PIN`, `Type`, `Privilege`, `LastName`, `FirstName`, `OtherName`, `DOB`, `Sex`, `LGA`, `State`, `Country`, `ReferralID`, `ReferrerID`, `DP`) VALUES
	(1, '6S8545672008F32043N06201683g5124', '582299713d1TPV9727387890531jLY06U556ikZ4g', NULL, 'ZERN', '2019-07-30 17:53:23', 1, 1, 'ZGV2OA==', 'ZGV2OEB6ZW5xLmNh', '09026636728', '$2y$10$Gycd2VGOv5jZwFHAU.2Sf.MrMn2oUArsB/C.Oawppa/jCkDA3DhRu', 1314, '8jic29mdHdhcmU=ugj8P', 20, 'YwgT3Nhd2VyZQ==Ixy6e', '0yHQW50aG9ueQ==2dhuW', 'oRMT0RBTw==lNVO0', '1987-10-31', 'M', 'Oredo', 'Edo', 'NG', 'Dev8', 'SELF', NULL);
/*!40000 ALTER TABLE `userz` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
