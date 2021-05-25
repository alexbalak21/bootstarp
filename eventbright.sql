-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 07:27 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventbright`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(6) UNSIGNED NOT NULL,
  `creatorID` int(6) UNSIGNED DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `postDate` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `subscribed` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `creatorID`, `name`, `category`, `place`, `city`, `description`, `img`, `active`, `postDate`, `date`, `time`, `subscribed`) VALUES
(1, 27, 'Sortie Musé ', 'CULTURE', 'Louvre', 'Paris', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac0c63ad3997.47295166.jpg', 1, '2021-05-24', '2021-05-25', '14:00:00', 0),
(2, 26, 'Running', 'SPORT', 'Parc de la Tate d\'or.', 'Nantes', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac0cbb5a1a54.94941532.jpg', 1, '2021-05-24', '2021-05-29', '10:00:00', 1),
(3, 28, 'Sortie Cinema', 'LOISIR', 'UGC', 'Lyon', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac0d84ba1773.33811026.jpg', 1, '2021-05-24', '2021-06-18', '20:00:00', 1),
(5, 26, 'Shooting Photo', 'LOISIR', 'Rive Etoile', 'Starsbourg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac12442e74d4.38506117.jpg', 1, '2021-05-24', '2021-05-28', '18:00:00', 1),
(6, 28, 'Sortie Velo', 'SPORT', 'Virginia Sports', 'Lille', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac12bd1b5d73.02294393.jpg', 1, '2021-05-24', '2021-06-26', '08:00:00', 1),
(7, 28, 'Sortie Kayak', 'SPORT', 'Plage de l\'Huveaune', 'Marseille', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac1332ef8a27.77130338.jpg', 1, '2021-05-24', '2021-06-29', '09:00:00', 0),
(8, 27, 'Tennis', 'SPORT', 'Statde municipal', 'Grenoble', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac14b57ff9d1.70514541.jpg', 1, '2021-05-24', '2021-05-29', '14:00:00', 0),
(9, 27, 'Randonée ', 'LOISIR', 'Center Ville', 'Chamonix', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil rerum natus aliquam quasi ut unde illo laudantium sed iste esse voluptatem, labore nobis est doloribus earum quo suscipit quas? Voluptatum.', '60ac15139712c8.22042431.jpg', 1, '2021-05-24', '2021-08-24', '09:00:00', 0),
(10, 29, 'Cuisine', 'LOISIR', 'Parc du Thabor', 'Rennes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut odio nobis a assumenda quam, quisquam hic unde veniam aperiam magnam repudiandae expedita, iste totam quasi maiores quae officia quidem facere?', '60ac44b62b2153.75143204.jpg', 1, '2021-05-25', '2021-05-21', '08:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subs`
--

CREATE TABLE `subs` (
  `id` int(6) UNSIGNED NOT NULL,
  `eventID` int(6) UNSIGNED DEFAULT NULL,
  `userID` int(6) UNSIGNED DEFAULT NULL,
  `subTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subs`
--

INSERT INTO `subs` (`id`, `eventID`, `userID`, `subTime`) VALUES
(1, 2, 28, '2021-05-24 20:57:43'),
(3, 6, 27, '2021-05-24 21:02:03'),
(4, 3, 27, '2021-05-24 21:05:27'),
(5, 5, 27, '2021-05-24 21:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'profile.png',
  `reg_date` date DEFAULT NULL,
  `validated` tinyint(1) DEFAULT 0,
  `validation` varchar(255) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `token`, `img`, `reg_date`, `validated`, `validation`, `activated`) VALUES
(1, 'admin@event.com', 'Alex', 'Balak', '$2y$10$RgS5x4FBAn4VJpEhHsN8zu69J6eRqxQyh9OcSX58zd1cgx7gDgABq', '0', 'profile.png', '2021-05-24', 1, '6d0f846348a856321729a2f36734d1a7', 1),
(2, 'demo@demo.com', 'Demo', 'Demo', '$2y$10$nssecbf9X9KuxVCDUgvnMOhkSeUtpbFNnyDXMNPLfi3lChFRejrjW', '0', 'profile.png', '2021-05-24', 0, 'addfa9b7e234254d26e9c7f2af1005cb', 1),
(26, 'john.doe@email.com', 'John', 'Doe', '$2y$10$.OeU1Ul19Q4wSHnStmF9Gee6rEj47sioUmFvZzNpBvq9a5xLJvkue', '$2y$10$Ikd9JvRrhlD7fQDZ.ltOVurjXm5.UjSx/TcpapuNfwwTydVnl4ZEm', '60ac0ae811a8a0.98396550.jpg', '2021-05-24', 1, '0', 1),
(27, 'sarah.marshall@eamil.com', 'Sarah', 'Marchall', '$2y$10$SGvpbirw7q3iBL8Gi/OSAucbXX1L0fPNJab6HP8bA9dfhYF3XJB5a', '0', '60ac0b58db5bd2.14663633.jpg', '2021-05-24', 0, '0d7de1aca9299fe63f3e0041f02638a3', 1),
(28, 'max.black@email.com', 'Max', 'Black', '$2y$10$f/jyalWq055Fu9txbt/nB..kDXrRLXwHx1/zmvAujUC0oVlfw/RcG', '0', '60ac0d27bae294.18897417.jpg', '2021-05-24', 0, '766ebcd59621e305170616ba3d3dac32', 1),
(29, 'tom@white.com', 'Tom', 'White', '$2y$10$Ts.KRO2Etu1JMU9eaLc.U.2NCgV7m5/R95LCGnXB52frfgwJLNNuy', '0', '60ac428c89dc90.54962382.jpg', '2021-05-25', 0, '31fefc0e570cb3860f2a6d4b38c6490d', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subs`
--
ALTER TABLE `subs`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
