-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 11:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rolsa`
--
CREATE DATABASE IF NOT EXISTS `rolsa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rolsa`;

-- --------------------------------------------------------

--
-- Table structure for table `carbonfootprint`
--

CREATE TABLE `carbonfootprint` (
  `CarbonTrackID` int(8) NOT NULL,
  `TotalEmissions` int(255) NOT NULL,
  `AllRecords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`AllRecords`)),
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `carbonfootprint`:
--   `UserID`
--       `users` -> `UserID`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `ConsultationID` int(16) NOT NULL,
  `ConsultationDate` date NOT NULL,
  `ConsultationDetails` longtext NOT NULL,
  `ConsultationAddress` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `Completed` int(2) NOT NULL DEFAULT 0,
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `consultation`:
--   `UserID`
--       `users` -> `UserID`
--

-- --------------------------------------------------------

--
-- Table structure for table `energyusage`
--

CREATE TABLE `energyusage` (
  `EnergyTrackID` int(8) NOT NULL,
  `TotalUsage` int(255) NOT NULL,
  `AllRecords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`AllRecords`)),
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `energyusage`:
--   `UserID`
--       `users` -> `UserID`
--

-- --------------------------------------------------------

--
-- Table structure for table `installation`
--

CREATE TABLE `installation` (
  `InstallationID` int(16) NOT NULL,
  `InstallationDate` date NOT NULL,
  `InstallationAddress` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `InstallationDetails` longtext NOT NULL,
  `Completed` tinyint(1) NOT NULL DEFAULT 0,
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `installation`:
--   `UserID`
--       `users` -> `UserID`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(8) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carbonfootprint`
--
ALTER TABLE `carbonfootprint`
  ADD PRIMARY KEY (`CarbonTrackID`),
  ADD KEY `carbonUser` (`UserID`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`ConsultationID`),
  ADD KEY `consultationUser` (`UserID`);

--
-- Indexes for table `energyusage`
--
ALTER TABLE `energyusage`
  ADD PRIMARY KEY (`EnergyTrackID`),
  ADD KEY `energyUser` (`UserID`);

--
-- Indexes for table `installation`
--
ALTER TABLE `installation`
  ADD PRIMARY KEY (`InstallationID`),
  ADD KEY `installationUser` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carbonfootprint`
--
ALTER TABLE `carbonfootprint`
  MODIFY `CarbonTrackID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `ConsultationID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `energyusage`
--
ALTER TABLE `energyusage`
  MODIFY `EnergyTrackID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `installation`
--
ALTER TABLE `installation`
  MODIFY `InstallationID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carbonfootprint`
--
ALTER TABLE `carbonfootprint`
  ADD CONSTRAINT `carbonUser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `consultationUser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `energyusage`
--
ALTER TABLE `energyusage`
  ADD CONSTRAINT `energyUser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `installation`
--
ALTER TABLE `installation`
  ADD CONSTRAINT `installationUser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
