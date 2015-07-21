-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2014 at 02:02 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `webapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `companydetails`
--

CREATE TABLE IF NOT EXISTS `companydetails` (
  `CompanyID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Company ID',
  `CompanyName` varchar(100) NOT NULL COMMENT 'Company Name',
  `CompanyAddress` varchar(255) NOT NULL COMMENT 'Company Address',
  `CompanyCountry` int(4) NOT NULL COMMENT 'Country ID',
  `CompanyZipCode` varchar(10) NOT NULL COMMENT 'Company Country Zip',
  `CompanyContactNumber` varchar(20) NOT NULL COMMENT 'Contact Number ',
  `CompanyEmail` varchar(100) NOT NULL COMMENT 'Company Email Or User ID',
  `CompanyRegistrationDate` date NOT NULL COMMENT 'Joining date to our service ',
  `AccountType` int(1) NOT NULL DEFAULT '0' COMMENT 'Trial Or Paid (0,1)',
  `AccessService` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Active service or not ',
  PRIMARY KEY (`CompanyID`),
  UNIQUE KEY `CompanyEmail` (`CompanyEmail`),
  KEY `CompanyRegistrationDate` (`CompanyRegistrationDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `companydetails`
--

INSERT INTO `companydetails` (`CompanyID`, `CompanyName`, `CompanyAddress`, `CompanyCountry`, `CompanyZipCode`, `CompanyContactNumber`, `CompanyEmail`, `CompanyRegistrationDate`, `AccountType`, `AccessService`) VALUES
(18, 'Fuzonmedia', 'GM Lane', 0, '712222', '919831053006', 'niladridey933@gmail.com', '2014-09-23', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companylogins`
--

CREATE TABLE IF NOT EXISTS `companylogins` (
  `UserID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) NOT NULL,
  `LoginID` varchar(255) NOT NULL,
  `LoginPassword` varchar(255) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserRole` varchar(10) NOT NULL,
  `EmailValidation` tinyint(1) NOT NULL DEFAULT '0',
  `verificationCode` varchar(100) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `LoginID` (`LoginID`,`LoginPassword`,`UserRole`),
  KEY `EmailValidation` (`EmailValidation`),
  KEY `verificationCode` (`verificationCode`),
  KEY `CompanyID` (`CompanyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `companylogins`
--

INSERT INTO `companylogins` (`UserID`, `CompanyID`, `LoginID`, `LoginPassword`, `UserName`, `UserRole`, `EmailValidation`, `verificationCode`) VALUES
(9, 18, 'niladridey933@gmail.com', '$2y$10$HnXrhAbpgkRE.i8XoBOLVuwC29INqINwlTNLF7yrTz7k4kNABYFqi', 'Niladri Dey', 'ADMIN', 1, '');
