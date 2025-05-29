-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 10:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redbus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `bus_number` varchar(255) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL,
  `passenger_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `cvv_number` varchar(4) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bus_number`, `seat_number`, `passenger_name`, `email`, `phone`, `cvv_number`, `card_number`, `expiry_date`, `total_amount`) VALUES
(6, 'B001', 4, ' prakashsinh', 'prakashsinh@gmail.com', ' 6353698467', '963 ', '96385285', '2200-02-22', 300.00),
(7, 'B001', 1, 'iuh', 'a@gmail.com', '963522510', '963', '963258741235', '2000-02-02', 963.00),
(8, 'B001', 2, 'iuh', 'a@gmail.com', '963522510', '963', '963258741235', '2000-02-02', 963.00),
(9, 'B001', 3, 'iuh', 'a@gmail.com', '632587410', '963', '741', '2000-02-22', 789.00),
(10, 'B001', 11, 'abc', 'abc@gmail.com', '87587458', '963', '789632145', '2021-02-22', 963.00),
(11, 'B001', 5, 'abc', 'abc@gmail.com', '963522510', '963', '85', '2024-02-22', 878.00),
(12, 'B001', 32, 'jaydeep', 'jd@gmail.com', '9865985685', '789', '963258741235', '0200-02-22', 9635.00),
(13, 'B001', 6, 'hiii', 'a@gmail.com', '963522510', '963', '963258741235', '2024-02-22', 963.00),
(14, 'B003', 1, 'iuh', 'a@gmail.com', '963522510', '93', '963258741235', '2000-02-22', 963.00);

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `id` int(11) NOT NULL,
  `bus_name` varchar(255) NOT NULL,
  `bus_number` varchar(20) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `arrival_time` varchar(10) NOT NULL,
  `seat_price` decimal(10,2) NOT NULL,
  `bus_type` varchar(10) NOT NULL,
  `total_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`id`, `bus_name`, `bus_number`, `from_location`, `to_location`, `arrival_time`, `seat_price`, `bus_type`, `total_seats`) VALUES
(3, 'Bus 1', 'B001', 'Ahmedabad', 'Surat', '08:00:00', 20.00, 'AC', 32),
(4, 'Bus 2', 'B002', 'Surat', 'Vadodara', '09:30:00', 18.50, 'Non-AC', 52),
(5, 'Bus 3', 'B003', 'Vadodara', 'Ahmedabad', '11:00:00', 25.00, 'AC', 32),
(6, 'Bus 4', 'B004', 'Rajkot', 'Junagadh', '12:30:00', 15.00, 'Non-AC', 52),
(7, 'Bus 5', 'B005', 'Junagadh', 'Ahmedabad', '14:00:00', 22.50, 'AC', 32),
(8, 'Bus 6', 'B006', 'Bhavnagar', 'Surat', '15:30:00', 19.50, 'Non-AC', 52),
(9, 'Bus 7', 'B007', 'Ahmedabad', 'Vadodara', '17:00:00', 23.00, 'AC', 32),
(10, 'Bus 8', 'B008', 'Surat', 'Rajkot', '18:30:00', 17.50, 'Non-AC', 52),
(11, 'Bus 9', 'B009', 'Vadodara', 'Junagadh', '20:00:00', 21.00, 'AC', 32),
(12, 'Bus 10', 'B010', 'Rajkot', 'Bhavnagar', '21:30:00', 16.00, 'Non-AC', 52),
(13, 'Bus 11', 'B011', 'Junagadh', 'Ahmedabad', '23:00:00', 24.50, 'AC', 32),
(14, 'Bus 12', 'B012', 'Bhavnagar', 'Surat', '01:00:00', 14.00, 'Non-AC', 52),
(15, 'Bus 13', 'B013', 'Ahmedabad', 'Rajkot', '03:00:00', 26.00, 'AC', 32),
(16, 'Bus 14', 'B014', 'Surat', 'Junagadh', '05:00:00', 12.50, 'Non-AC', 52);

-- --------------------------------------------------------

--
-- Table structure for table `bus_selection`
--

CREATE TABLE `bus_selection` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `start_destination` varchar(50) NOT NULL,
  `end_destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `start_destination`, `end_destination`) VALUES
(1, 'New York', 'Los Angeles'),
(2, 'London', 'Paris'),
(3, 'Tokyo', 'Osaka'),
(4, 'Sydney', 'Melbourne'),
(5, 'Toronto', 'Vancouver'),
(6, 'Berlin', 'Munich'),
(7, 'Rio de Janeiro', 'Sao Paulo'),
(8, 'Cape Town', 'Johannesburg'),
(9, 'Dubai', 'Abu Dhabi'),
(10, 'Singapore', 'Kuala Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `mobile`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '6353698467', 'admin@gmail.com', 'Aa@12345'),
(2, 'z.pprakashsinh@gmail.com', '6353698467', 'z.pprakashsinh@gmail.com', 'ZAla@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_selection`
--
ALTER TABLE `bus_selection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bus_details`
--
ALTER TABLE `bus_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bus_selection`
--
ALTER TABLE `bus_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_selection`
--
ALTER TABLE `bus_selection`
  ADD CONSTRAINT `bus_selection_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
