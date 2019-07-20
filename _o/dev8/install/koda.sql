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


-- Dumping database structure for koda
DROP DATABASE IF EXISTS `koda`;
CREATE DATABASE IF NOT EXISTS `koda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `koda`;

-- Dumping structure for table koda.accountx
DROP TABLE IF EXISTS `accountx`;
CREATE TABLE IF NOT EXISTS `accountx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `User` varchar(70) DEFAULT NULL,
  `Bank` varchar(70) DEFAULT NULL,
  `AccountName` varchar(70) DEFAULT 'PENDING',
  `AccountNo` int(11) DEFAULT NULL,
  `AccountType` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.accountx: ~0 rows (approximately)
/*!40000 ALTER TABLE `accountx` DISABLE KEYS */;
/*!40000 ALTER TABLE `accountx` ENABLE KEYS */;

-- Dumping structure for table koda.activityx
DROP TABLE IF EXISTS `activityx`;
CREATE TABLE IF NOT EXISTS `activityx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `User` varchar(70) DEFAULT NULL,
  `ID` varchar(70) DEFAULT NULL,
  `Description` varchar(70) DEFAULT NULL,
  `Type` varchar(70) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.activityx: ~0 rows (approximately)
/*!40000 ALTER TABLE `activityx` DISABLE KEYS */;
/*!40000 ALTER TABLE `activityx` ENABLE KEYS */;

-- Dumping structure for table koda.gh
DROP TABLE IF EXISTS `gh`;
CREATE TABLE IF NOT EXISTS `gh` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `User` varchar(70) DEFAULT NULL,
  `Package` varchar(70) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  `Match` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.gh: ~0 rows (approximately)
/*!40000 ALTER TABLE `gh` DISABLE KEYS */;
/*!40000 ALTER TABLE `gh` ENABLE KEYS */;

-- Dumping structure for table koda.matchx
DROP TABLE IF EXISTS `matchx`;
CREATE TABLE IF NOT EXISTS `matchx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `Package` varchar(70) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  `GH` varchar(70) DEFAULT NULL,
  `PH` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.matchx: ~0 rows (approximately)
/*!40000 ALTER TABLE `matchx` DISABLE KEYS */;
/*!40000 ALTER TABLE `matchx` ENABLE KEYS */;

-- Dumping structure for table koda.packagex
DROP TABLE IF EXISTS `packagex`;
CREATE TABLE IF NOT EXISTS `packagex` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `Name` varchar(70) DEFAULT NULL,
  `Description` varchar(70) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Rate` int(11) DEFAULT '2',
  `Ratio` int(11) DEFAULT '3',
  `Status` varchar(70) DEFAULT 'ACTIVE',
  `Proof` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.packagex: ~0 rows (approximately)
/*!40000 ALTER TABLE `packagex` DISABLE KEYS */;
/*!40000 ALTER TABLE `packagex` ENABLE KEYS */;

-- Dumping structure for table koda.ph
DROP TABLE IF EXISTS `ph`;
CREATE TABLE IF NOT EXISTS `ph` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `User` varchar(70) DEFAULT NULL,
  `Package` varchar(70) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  `Type` varchar(70) DEFAULT 'PH',
  `Match` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.ph: ~0 rows (approximately)
/*!40000 ALTER TABLE `ph` DISABLE KEYS */;
/*!40000 ALTER TABLE `ph` ENABLE KEYS */;

-- Dumping structure for table koda.summaryx
DROP TABLE IF EXISTS `summaryx`;
CREATE TABLE IF NOT EXISTS `summaryx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `User` varchar(70) DEFAULT NULL,
  `Ledger` int(11) DEFAULT NULL,
  `Reserved` int(11) DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  `Withdrawn` int(11) DEFAULT NULL,
  `Referred` int(11) DEFAULT NULL,
  `Bonus` int(11) DEFAULT NULL,
  `HR` int(11) DEFAULT NULL,
  `HG` int(11) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.summaryx: ~0 rows (approximately)
/*!40000 ALTER TABLE `summaryx` DISABLE KEYS */;
/*!40000 ALTER TABLE `summaryx` ENABLE KEYS */;

-- Dumping structure for table koda.transactionx
DROP TABLE IF EXISTS `transactionx`;
CREATE TABLE IF NOT EXISTS `transactionx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `ID` varchar(70) DEFAULT NULL,
  `Description` varchar(70) DEFAULT NULL,
  `Type` varchar(70) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  `User` varchar(70) DEFAULT NULL,
  `Proof` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.transactionx: ~0 rows (approximately)
/*!40000 ALTER TABLE `transactionx` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactionx` ENABLE KEYS */;

-- Dumping structure for table koda.userx
DROP TABLE IF EXISTS `userx`;
CREATE TABLE IF NOT EXISTS `userx` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `Username` varchar(70) DEFAULT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `Phone` varchar(70) DEFAULT NULL,
  `Password` varchar(70) DEFAULT NULL,
  `FirstName` varchar(70) DEFAULT NULL,
  `LastName` varchar(70) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Sex` varchar(70) DEFAULT NULL,
  `Country` varchar(70) DEFAULT NULL,
  `State` varchar(70) DEFAULT NULL,
  `LGA` varchar(70) DEFAULT NULL,
  `Status` varchar(70) DEFAULT 'PENDING',
  `ReferralID` varchar(70) DEFAULT NULL,
  `ReferrerID` varchar(70) DEFAULT 'PCF',
  `Type` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda.userx: ~0 rows (approximately)
/*!40000 ALTER TABLE `userx` DISABLE KEYS */;
/*!40000 ALTER TABLE `userx` ENABLE KEYS */;

-- Dumping structure for table koda._zendtb
DROP TABLE IF EXISTS `_zendtb`;
CREATE TABLE IF NOT EXISTS `_zendtb` (
  `AUID` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(40) DEFAULT NULL,
  `RUID` varchar(50) DEFAULT NULL,
  `EUID` varchar(100) DEFAULT NULL,
  `Author` varchar(50) NOT NULL DEFAULT 'ZERN',
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Entry` tinyint(2) NOT NULL DEFAULT '1',
  `Name` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`AUID`),
  UNIQUE KEY `PUID` (`PUID`),
  UNIQUE KEY `RUID` (`RUID`),
  KEY `EUID` (`EUID`),
  KEY `Author` (`Author`),
  KEY `Created` (`Created`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table koda._zendtb: ~0 rows (approximately)
/*!40000 ALTER TABLE `_zendtb` DISABLE KEYS */;
/*!40000 ALTER TABLE `_zendtb` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
