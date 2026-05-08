-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2016 at 05:53 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hts`
--
CREATE DATABASE IF NOT EXISTS `hts` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hts`;

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE IF NOT EXISTS `dept` (
  `deptno` int(11) NOT NULL AUTO_INCREMENT,
  `dname` varchar(100) DEFAULT NULL,
  `loc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`deptno`),
  UNIQUE KEY `dname` (`dname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptno`, `dname`, `loc`) VALUES
(10, 'Admin', 'main building'),
(11, 'Service', 'main building'),
(12, 'Marketing', 'main building');

-- --------------------------------------------------------

--
-- Table structure for table `newuser`
--

CREATE TABLE IF NOT EXISTS `newuser` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `addr` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `qual` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `secq` varchar(100) DEFAULT NULL,
  `seca` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1005 ;

--
-- Dumping data for table `newuser`
--

INSERT INTO `newuser` (`uid`, `uname`, `gender`, `addr`, `city`, `qual`, `mobile`, `dept`, `usertype`, `username`, `password`, `secq`, `seca`) VALUES
(1000, 'Ganesh', 'male', '141,Main Street,', 'madurai', 'pg', '9877755858', 'Service', 'user', 'ganesh', 'ganesh', 'favourite color', 'blue'),
(1001, 'Balaji', 'male', '232,North Street,', 'madurai', 'ug', '9755566585', 'Service', 'user', 'balaji', 'balaji', 'favourite color', 'blue'),
(1002, 'Santhosh', 'male', '38,Chokkikulam 1 st.,', 'madurai', 'be', '9877788777', 'Service', 'techengg', 'santhosh', 'santhosh', 'favourite color', 'red'),
(1003, 'Samuel', 'male', '874,South Car st,', 'madurai', 'pg', '8899788888', 'Service', 'user', 'Samuel', 'samuel', 'favourite color', 'red'),
(1004, 'Gurunath', 'male', '334,South street,', 'madurai', 'ug', '8952544500', 'Marketing', 'user', 'guru', 'guru', 'favourite color', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE IF NOT EXISTS `pc` (
  `pcid` int(11) NOT NULL AUTO_INCREMENT,
  `pcname` varchar(50) DEFAULT NULL,
  `ipaddr` varchar(15) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `processor` varchar(20) DEFAULT NULL,
  `harddisk` varchar(20) DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `smps` varchar(20) DEFAULT NULL,
  `drive` varchar(20) DEFAULT NULL,
  `kboard` varchar(20) DEFAULT NULL,
  `monitor` varchar(20) DEFAULT NULL,
  `mouse` varchar(20) DEFAULT NULL,
  `webcam` varchar(20) DEFAULT NULL,
  `printer` varchar(50) DEFAULT NULL,
  `dop` date DEFAULT NULL,
  `warrexp` date DEFAULT NULL,
  `amccmp` varchar(100) DEFAULT NULL,
  `amcph` varchar(20) DEFAULT NULL,
  `amcfrom` date DEFAULT NULL,
  `amtto` date DEFAULT NULL,
  PRIMARY KEY (`pcid`),
  UNIQUE KEY `pcname` (`pcname`),
  UNIQUE KEY `ipaddr` (`ipaddr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`pcid`, `pcname`, `ipaddr`, `brand`, `processor`, `harddisk`, `ram`, `smps`, `drive`, `kboard`, `monitor`, `mouse`, `webcam`, `printer`, `dop`, `warrexp`, `amccmp`, `amcph`, `amcfrom`, `amtto`) VALUES
(1, 'System1', '192.9.200.100', 'HCL', 'Intel', 'Hitachi', 'Transcend', 'HCL', 'Samsung', 'HCL', 'HCL', 'HCL', 'Mercury', 'Epson', '2025-05-19', '2026-05-19', 'Verizon Tech', '9877755855', '2026-06-23', '2027-06-23'),
(2, 'System2', '192.9.200.101', 'Lenovo', 'Intel', 'Samsung', 'Lenovo', 'Lenovo', 'Lenovo', 'HCL', 'HCL', 'HCL', 'Mercury', 'Epson', '2025-09-11', '2026-09-11', 'Micro Tech', '8952655878', '2026-10-27', '2027-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `pcallot`
--

CREATE TABLE IF NOT EXISTS `pcallot` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `pcid` int(11) DEFAULT NULL,
  `allotdate` date DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `problemreport`
--

CREATE TABLE IF NOT EXISTS `problemreport` (
  `probid` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `sysid` int(11) DEFAULT NULL,
  `problem` varchar(100) NOT NULL,
  `iswarr` varchar(10) DEFAULT NULL,
  `warrdate` date DEFAULT NULL,
  `isamc` varchar(10) DEFAULT NULL,
  `amccmp` varchar(100) DEFAULT NULL,
  `amcph` varchar(20) DEFAULT NULL,
  `amcfrom` date DEFAULT NULL,
  `amcto` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'no',
  `reason` varchar(100) DEFAULT NULL,
  `compdate` date DEFAULT NULL,
  PRIMARY KEY (`probid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `support_requests`
--

CREATE TABLE support_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,    
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
	status ENUM('Pending','Resolved') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_reports`
--

CREATE TABLE stakeholder_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    summary TEXT NOT NULL,
    status ENUM('On Track','At Risk','Delayed','Completed') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
