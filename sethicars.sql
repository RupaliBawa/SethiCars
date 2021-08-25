-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 06:49 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sethicars`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestId` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `date` date NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestId`, `days`, `date`, `vehicle_id`, `user_id`, `isApproved`) VALUES
(10, 2, '2021-09-01', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `customer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `username`, `email`, `password`, `customer`) VALUES
(1, 'John Doe', 'JohnDoe12', 'JohnDoe12@email.com', 'Johnny12', 1),
(2, 'Abe Smith', 'AbeSmith98', 'AbeSmith98@email.com', 'AbeSmith99', 1),
(3, 'Anna Black', 'AnnaIsBack', 'AnnaBlack789@email.com', 'AnnaIsCool', 1),
(4, 'Bedi Car Agency', 'BediCars', 'bedi.car.agency@email.com', 'bedicars55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleId` int(11) NOT NULL,
  `model` varchar(60) NOT NULL,
  `number` varchar(30) NOT NULL,
  `capacity` int(11) NOT NULL,
  `rent` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `booked` tinyint(1) NOT NULL DEFAULT 0,
  `booker_id` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicleId`, `model`, `number`, `capacity`, `rent`, `owner_id`, `image`, `booked`, `booker_id`, `startDate`, `endDate`) VALUES
(1, 'Mahindra XUV700', 'PB11AV4226', 7, 2400, 4, 'https://imgd.aeplcdn.com/0x0/n/cw/ec/42355/xuv700-exterior-right-front-three-quarter.jpeg?isig=0', 0, NULL, NULL, NULL),
(2, 'Maruti Suzuki Dzire', 'TN66W4455', 5, 540, 4, 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/45691/marutisuzuki-dzire-right-front-three-quarter8.jpeg?q=85', 0, NULL, NULL, NULL),
(3, 'Toyota Fortuner', 'PB10AS2312', 7, 1200, 4, 'https://imgd.aeplcdn.com/0x0/n/cw/ec/44709/fortuner-exterior-right-front-three-quarter-19.jpeg', 0, NULL, NULL, NULL),
(4, 'Volkswagen Polo', 'WB23XC3234', 5, 450, 4, 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/29628/polo-exterior-right-front-three-quarter-2.jpeg?q=85', 0, NULL, NULL, NULL),
(5, 'Ford Endeavour', 'PB31AS0001', 7, 2300, 4, 'https://imgd.aeplcdn.com/664x374/n/55reasa_1459072.jpg?q=85', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `vehicle_fkey` (`vehicle_id`),
  ADD KEY `user_fkey` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleId`),
  ADD KEY `owner_fkey` (`owner_id`),
  ADD KEY `booker_fkey` (`booker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `user_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `vehicle_fkey` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicleId`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `booker_fkey` FOREIGN KEY (`booker_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `owner_fkey` FOREIGN KEY (`owner_id`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
