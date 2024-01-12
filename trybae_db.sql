-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 07:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trybae_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

CREATE TABLE `age` (
  `id` int(11) NOT NULL,
  `age` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `age`
--

INSERT INTO `age` (`id`, `age`) VALUES
(1, '12+'),
(2, '18+'),
(3, '21+');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Lusaka'),
(2, 'Kitwe');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `attendance_limit` int(11) NOT NULL,
  `published` text NOT NULL,
  `address` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  `vip` int(11) NOT NULL,
  `ordinary` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `add_info` text NOT NULL,
  `age_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `attendance_limit`, `published`, `address`, `start_time`, `end_time`, `vip`, `ordinary`, `images`, `add_info`, `age_id`, `city_id`, `user_id`) VALUES
(1, 'Too High to Riot\r\n2016', 500, '1', '18142 liable south', '', '2022-06-01 17:15:39', 150, 150, '1652859501_jcole.jpg', 'Abbas Hamad, better known by his stage name Bas, is an American rapper. He is signed to J. Cole\'s Dreamville Records via Interscope Records.', 2, 1, 1),
(2, 'Chocolate Fest', 500, '2', '214353245', '', '2022-06-01 17:15:39', 150, 150, '1652968874_hydraulic.png', 'grwrhrhgrghywtrheyfbhaergar', 2, 2, 1),
(3, 'Booty Spot Chillz', 200, '1', 'first time using the app, can\'t say', '2022-06-16 14:08', '2022-06-16 16:10', 200, 100, '1654085713_2-4.png', 'yytdrytfuyguihojikpl', 2, 1, 1),
(4, 'Oasis Fest june show', 500, '1', 'first time using the app, can\'t say', '2022-06-10 19:24', '2022-06-11 05:30', 250, 100, '1654086041_00160123.png', 'ewtrtcyvubinomp,opoiutyxter', 2, 1, 1),
(5, 'Booty Spot Chillz Part 2', 500, '1', 'Bwijimfumu Lounge plot 1200', '2022-06-02 17:30', '2022-06-03 17:31', 200, 100, '1654093996_2-4.png', 'asfgerhtfygukyiu', 2, 2, 1),
(6, 'Chocolate Experience Part 2', 500, '1', 'Elunda Spaces, 2nd Floor, Plot 4648 ADDIS ABABA ROUNDABOUT RHODES PARK,LUSAKA', '2022-06-03 16:52', '2022-06-13 16:52', 250, 100, '1654095020_2-4.png', 'sdffghjgrewaresrfjgh,bn', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `tx_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `event_id`, `amount`, `email`, `name`, `tx_time`) VALUES
(3441392, 5, 200, 'mcwayzj@gmail.com', 'Niza Tembo', '2022-06-02 19:26:19'),
(3441408, 4, 250, 'chiyembekezop11@gmail.com', 'Chiyembekezo', '2022-06-02 19:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(10) NOT NULL,
  `activation_status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `password`, `code`, `activation_status`, `created_at`) VALUES
(1, 'Chiyembekezo', 'Admin', 'chiyembekezop11@gmail.com', '12345678', 0, 'verified', '2022-05-31 20:02:01'),
(3, 'lotus_zm', 'eventOrg', 'lotuszm.io@gmail.com', '12345678', 860406, 'notverified', '2022-05-31 21:06:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `age_id` (`age_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `age`
--
ALTER TABLE `age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`age_id`) REFERENCES `age` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
