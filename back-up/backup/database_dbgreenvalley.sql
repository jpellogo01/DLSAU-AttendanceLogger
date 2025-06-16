
-- phpMyAdmin SQL Dump (Modified)
-- New Clean Schema for Attendance System (DLSAU Context)

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendnce-system-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumber`
--

CREATE TABLE IF NOT EXISTS `tblautonumber` (
  `AutoID` int(11) NOT NULL AUTO_INCREMENT,
  `AutoStart` varchar(30) NOT NULL,
  `AutoEnd` int(11) NOT NULL,
  `AutoInc` int(11) NOT NULL,
  `AutoType` varchar(30) NOT NULL,
  PRIMARY KEY (`AutoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tblautonumber` (`AutoID`, `AutoStart`, `AutoEnd`, `AutoInc`, `AutoType`) VALUES
(1, '2025', 1, 1, 'AuthPrint');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE IF NOT EXISTS `tbldepartment` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(30) NOT NULL,
  `Description` varchar(99) NOT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbldepartment` (`DepartmentID`, `Department`, `Description`) VALUES
(1, 'CAST', 'COLLEGE OF ARTS, SCIENCE AND TECHNOLOGY'),
(2, 'CAFT', 'COLLEGE OF AGRICULTURE AND FOOD TECHNOLOGY'),
(3, 'DVM', 'DEPARTMENT OF VETERINARY MEDICINE'),
(4, 'CBMA', 'COLLEGE OF BUSINESS MANAGEMENT AND ACCOUNTANCY');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE IF NOT EXISTS `tblcourse` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseCode` varchar(30) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  PRIMARY KEY (`CourseID`),
  KEY `DepartmentID` (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tblcourse` (`CourseID`, `CourseCode`, `Description`, `DepartmentID`) VALUES
(1, 'BSCS', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 1),
(2, 'BSPsy', 'BACHELOR OF SCIENCE IN PSYCHOLOGY', 1),
(3, 'BSFT', 'BACHELOR OF SCIENCE IN FOOD TECHNOLOGY', 2),
(4, 'BSAgri', 'BACHELOR OF SCIENCE IN AGRICULTURE', 2),
(5, 'DVM', 'DOCTOR OF VETERINARY MEDICINE', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE IF NOT EXISTS `tblstudent` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(30) NOT NULL,
  `Firstname` varchar(99) NOT NULL,
  `Lastname` varchar(99) NOT NULL,
  `Middlename` varchar(99) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `BirthDate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `ContactNo` varchar(30) NOT NULL,
  `YearLevel` varchar(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `StudPhoto` varchar(255) NOT NULL,
  `Cand_Status` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `StudentID` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable`
--

CREATE TABLE IF NOT EXISTS `tbltimetable` (
  `TimeTableID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(90) NOT NULL,
  `TimeInAM` varchar(30) NOT NULL,
  `TimeOutAM` varchar(30) NOT NULL,
  `TimeInPM` varchar(30) NOT NULL,
  `TimeOutPM` varchar(30) NOT NULL,
  `AttendDate` date NOT NULL,
  PRIMARY KEY (`TimeTableID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- No inserted data to keep it clean

-- --------------------------------------------------------

--
-- Table structure for table `tblverifytimeintimeout`
--

CREATE TABLE IF NOT EXISTS `tblverifytimeintimeout` (
  `VerifyID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(90) NOT NULL,
  `TimeIn` varchar(30) NOT NULL,
  `TimeOut` varchar(30) NOT NULL,
  `Verification` varchar(90) NOT NULL,
  `DateValidation` date NOT NULL,
  PRIMARY KEY (`VerifyID`),
  UNIQUE KEY `StudentID` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- No inserted data to keep it clean

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE IF NOT EXISTS `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) NOT NULL,
  `ACCOUNT_PASSWORD` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL,
  PRIMARY KEY (`ACCOUNT_ID`),
  UNIQUE KEY `ACCOUNT_USERNAME` (`ACCOUNT_USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'Admin User', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1234, 'photos/default.png');
