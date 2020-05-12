-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 02:37 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbslopac`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `accession_num` varchar(20) NOT NULL,
  `isbn_num` varchar(13) NOT NULL,
  `title` text NOT NULL,
  `edition` smallint(6) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `publish_year` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`accession_num`, `isbn_num`, `title`, `edition`, `author`, `publisher`, `country`, `publish_year`) VALUES
('2019:1', '9780240809748', 'Game Design Workshop', 2, 'Tracy Fullerton', 'Morgan Kaufmann Publishers', 'USA', 2008),
('2019:2', '9781435458109', 'Visual Basic Game Programming', 3, 'Jonathan S. Harbour', 'Cengage Learning', 'USA', 2011),
('2019:3', '159200086X', 'Learn JavaScript in a Weekend', 2, 'Jerry Lee Ford, Jr.', 'Premier Press', 'USA', 2004),
('2019:4', '1584504269', 'Simply Java : An Introduction to Java Programming', 1, 'James R. Levenick', 'Charles River Media', 'USA', 2006),
('2019:5', '9780071805148', 'How to Do Everything : Windows 8', 1, 'Mary Branscombe', 'McGraw-Hill', 'USA', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `member_id` varchar(20) NOT NULL,
  `accession_num` varchar(20) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`member_id`, `accession_num`, `borrow_date`, `return_date`) VALUES
('0004', '2019:4', '2019-12-11', '2019-12-18'),
('0001', '2019:3', '2019-12-11', '2019-12-18'),
('0001', '2019:2', '2019-12-12', '2019-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `ic_num` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `admin_sign` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `password`, `name`, `phone_num`, `ic_num`, `email`, `dob`, `status`, `admin_sign`) VALUES
('0001', 'dummy1', 'Slopac Dummy1', '0111111111', '111111111111', 'dummy001@gmail.com', '1999-11-26', 'Student', 'No'),
('0002', 'dummy2', 'Slopac Dummy2', '0122222222', '222222222222', 'dummy2@gmail.com', '1975-11-04', 'Teacher', 'Yes'),
('0003', 'dummy3', 'Slopac Dummy3', '0133333333', '333333333333', 'dummy3@gmail.com', '1983-10-01', 'Teacher', 'No'),
('0004', 'dummy4', 'Slopac Dummy4', '0144444444', '444444444444', 'dummy4@gmail.com', '1999-11-20', 'Student', 'No'),
('0005', 'dummy5', 'Slopac Dummy5', '0155555555', '555555555555', 'dummy5@gmail.com', '1999-12-01', 'Student', 'No'),
('0006', 'dummy6', 'Slopac Dummy6', '0166666666', '666666666666', 'dummy6@gmail.com', '1998-11-01', 'Student', 'No'),
('0007', 'dummy7', 'Slopac Dummy7', '0177777777', '777777777777', 'dummy7@gmail.com', '1999-12-07', 'Student', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `returner`
--

CREATE TABLE `returner` (
  `member_id` varchar(20) NOT NULL,
  `accession_num` varchar(20) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `total_fine` decimal(4,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returner`
--

INSERT INTO `returner` (`member_id`, `accession_num`, `borrow_date`, `return_date`, `total_fine`, `timestamp`) VALUES
('0001', '2019:1', '2019-11-26', '2019-12-03', '1.80', '2019-12-11 15:38:33'),
('0002', '2019:2', '2019-12-07', '2019-12-14', '0.00', '2019-12-11 15:39:28'),
('0003', '2019:5', '2019-12-10', '2019-12-17', '0.00', '2019-12-12 01:17:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`accession_num`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD KEY `member_id` (`member_id`),
  ADD KEY `accession_num` (`accession_num`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `returner`
--
ALTER TABLE `returner`
  ADD KEY `member_id` (`member_id`),
  ADD KEY `accession_num` (`accession_num`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrower`
--
ALTER TABLE `borrower`
  ADD CONSTRAINT `borrower_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `borrower_ibfk_2` FOREIGN KEY (`accession_num`) REFERENCES `book` (`accession_num`);

--
-- Constraints for table `returner`
--
ALTER TABLE `returner`
  ADD CONSTRAINT `returner_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `returner_ibfk_2` FOREIGN KEY (`accession_num`) REFERENCES `book` (`accession_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
