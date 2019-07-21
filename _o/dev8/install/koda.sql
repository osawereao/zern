/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP DATABASE IF EXISTS `koda`;
CREATE DATABASE IF NOT EXISTS `koda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `koda`;

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

/*!40000 ALTER TABLE `accountx` DISABLE KEYS */;
/*!40000 ALTER TABLE `accountx` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `activityx` DISABLE KEYS */;
/*!40000 ALTER TABLE `activityx` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `gh` DISABLE KEYS */;
/*!40000 ALTER TABLE `gh` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `matchx` DISABLE KEYS */;
/*!40000 ALTER TABLE `matchx` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `packagex` DISABLE KEYS */;
/*!40000 ALTER TABLE `packagex` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `ph` DISABLE KEYS */;
/*!40000 ALTER TABLE `ph` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `summaryx` DISABLE KEYS */;
/*!40000 ALTER TABLE `summaryx` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `transactionx` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactionx` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `userz` DISABLE KEYS */;
REPLACE INTO `userz` (`AUID`, `PUID`, `RUID`, `EUID`, `Author`, `Created`, `Entry`, `Status`, `Username`, `Email`, `Phone`, `Password`, `PIN`, `Type`, `Privilege`, `LastName`, `FirstName`, `OtherName`, `DOB`, `Sex`, `LGA`, `State`, `Country`, `ReferralID`, `ReferrerID`, `DP`) VALUES
	(1, '0328414252m62w717l4514496151203I3', '376607786rOKuL10613041183lRU2A786D54zSJ231', NULL, 'ZERN', '2019-07-21 22:00:23', 1, 1, 'ZGV2OA==', 'ZGV2OEB6ZW5xLmNh', '09026636728', '$2y$10$MwpmwfEUS95oANiS.qL0g.S/aiSQT9WfjD/Fs5Yhp2iqf16Mm5gmC', 1314, 'Er1c29mdHdhcmU=MyY82', 20, 'YNpT3Nhd2VyZQ==3Rgly', 'YW3QW50aG9ueQ==5IxWO', 'ZYRT0RBTw==ynvI7', '1987-10-31', 'M', 'Oredo', 'Edo', 'NG', 'Dev8', 'SELF', NULL);
/*!40000 ALTER TABLE `userz` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `_zendtb` DISABLE KEYS */;
/*!40000 ALTER TABLE `_zendtb` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
