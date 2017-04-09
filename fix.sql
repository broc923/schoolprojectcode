GRANT ALL PRIVILEGES ON *.* TO 'mgs_user'@'localhost' IDENTIFIED BY PASSWORD '*F71B0AF6B232C58021B6AC63A29FCF13A4E46E59' WITH GRANT OPTION;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `whitecustomerdatabase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `whitecustomerdatabase`;


DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `ID` int(11) unsigned NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Category` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`ID`, `FirstName`, `LastName`, `Address`, `PhoneNumber`, `Email`, `Category`) VALUES
(1, 'Broc', 'White', '302 Whispering Woods Drive', '423-773-9690', 'brocwhite923@gmail.com', 'Regular'),
(2, 'Broc2', 'White2', 'Random Address', '555-555-5555', 'email@email.com', 'VIP'),
(3, 'Broc3', 'White3', 'Random Address', '555-555-5555', 'email@email.com', 'Exclusive'),
(4, 'Broc4', 'White4', 'Random Address', '555-555-5555', 'email@email.com', 'VIP'),
(5, 'Broc5', 'White5', 'Random Address', '555-555-5555', 'email@email.com', 'VIP'),
(6, 'Broc6', 'White6', 'Random Address', '555-555-5555', 'email@email.com', 'Regular'),
(7, 'Broc7', 'White7', 'Random Address', '555-555-5555', 'email@email.com', 'Exclusive'),
(8, 'Broc8', 'White8', 'Random Address', '555-555-5555', 'email@email.com', 'VIP'),
(9, 'Broc9', 'White9', 'Random Address', '555-555-5555', 'email@email.com', 'Regular'),
(10, 'Broc10', 'White10', 'Random Address', '555-555-5555', 'email@email.com', 'Regular');


DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `ID` int(11) NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`ID`, `UserName`, `Password`) VALUES
(1, 'Admin', '16069061605');


ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `accounts`
  MODIFY `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;

ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
