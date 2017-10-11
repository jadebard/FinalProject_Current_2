-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 01:51 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitar_drum_db`
--
CREATE DATABASE IF NOT EXISTS `guitar_drum_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `guitar_drum_db`;

-- --------------------------------------------------------

--
-- Table structure for table `drum`
--

CREATE TABLE `drum` (
  `drum_id` int(11) NOT NULL,
  `drum_image` varchar(50) NOT NULL,
  `drum_name` varchar(50) NOT NULL,
  `drum_type` int(11) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `youtube_link` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drum`
--

INSERT INTO `drum` (`drum_id`, `drum_image`, `drum_name`, `drum_type`, `description`, `youtube_link`, `price`) VALUES
(1, 'Roland_TD_Digital_Set.jpg', 'Roland TD Digital Set', 1, 'The Roland TD-25K Electronic Drum Set offers the legendary V-Drums functionality in an intermediate kit.  Ideal for the home and studio, this kit features a module based on Roland&#39;s flagship TD-30, giving you all the realistic tone, feel and dynamics that make V-drums the top choice for drummers around the world.', 'https://www.youtube.com/watch?v=cC3u2WVnGtM', 999),
(2, 'Pearl_Roadshow_Acoustic_Set.jpg', 'Pearl Roadshow', 1, 'Made of 9mm poplar shells, the Pearl Roadshow 5-Piece Drum Set w/ Hardware & Cymbals has everything that the beginning drummer needs to get started right out of the box!', 'https://www.youtube.com/watch?v=THYhSEijEvU', 500),
(5, 'Carlsbro_9Piece_Digital_Set.jpg', 'Carlsbro 9 Piece Digital Set', 2, 'Suitable for small spaces for practice, or playing out in small venues or parties, this kit sounds and plays far better than other electronic drums at this price point.  The kick trigger can be installed directly for a real feel effect and the hi hat control offers natural voice.  The module is simple and intuitive and features compatability with and teaching or game software via USB inputs.  You can also use the module as a trigger device or audio source when connecting to a MIDI device or play along to your smart phone, mp3 player or tablet via the aux jack.', 'https://www.youtube.com/watch?v=XXe6MxWzJQc', 400),
(6, 'Tama_Superstar_Classic_Acoustic_Set.jpg', 'Tama SuperStar Classic Set', 1, 'Superstar Classic once again upholds tradition by raising the bar for discerning drummers—and remarkably—does it while also lowering the price. Drawing on Superstar of the past, its classic TAMA T-shape badge and streamlined low-mass single lugs point to the simpler state of art of the 70''s, while the ingenious Star-Mount system and new thinner gauge 100% maple shells eclipse anything in its class.', 'https://www.youtube.com/watch?v=RH8BtXXDNy0', 900),
(9, 'Pearl_Export_5Piece_Acoustic_Set.jpg', 'Pearl Export 5 Piece Set', 1, 'Get ready to welcome back the bestselling drum kit of all time. That’s right; Pearl is bringing back the Export series. This kit features many of the same design aspects that we’ve come to know and love about the exports while still making room for some modern innovations.  The first thing Pearl improved upon with these kits was the shell. Traditionally the export series consisted of Poplar shells; Pearl has revamped these drums by making the shells a mix of Poplar and Asian Mahogany. Poplar/Mahogany shells are not a new idea; many vintage drums are made up from this shell type. Mahogany is known for being warm, fat, and lush with a dark overall fundamental while poplar is known for it’s soft, mellow sound and warm spread. This gives these kits a classic sound that’s still as unique as your playing. This is all possible due to Pearl’s “Super Shell Technology”. This is Pearl’s proprietary shell making process that utilizes extreme heat and pressure help create the perfect shell. In fact, this process was so effective that Pearl offers a limited life time warranty on all of their drums.', 'https://www.youtube.com/watch?v=ZOvm1a4heG0', 700),
(12, 'PacificDW5-Piece.jpg', 'Pacific DW 5 Piece', 1, 'The PDP Mainstage 5-Piece Drum Set is made from select hardwood in a durable wrapped finish. The kit is outfitted with a hardware pack that includes a cymbal boom stand, straight cymbal stand, snare stand, hi-hat stand and a drum throne and a 4-piece Paiste 101 cymbal pack that includes 13&#34; hi-hats, a 20&#34; ride and 16&#34; crash.', 'https://www.youtube.com/watch?v=dCjSz5OEJ8A', 650);

-- --------------------------------------------------------

--
-- Table structure for table `drum_types`
--

CREATE TABLE `drum_types` (
  `type_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drum_types`
--

INSERT INTO `drum_types` (`type_id`, `type`) VALUES
(1, 'Acoustic Set'),
(2, 'Digital Set');

-- --------------------------------------------------------

--
-- Table structure for table `guitar`
--

CREATE TABLE `guitar` (
  `guitar_id` int(11) NOT NULL,
  `guitar_image` varchar(50) DEFAULT NULL,
  `guitar_name` varchar(50) DEFAULT NULL,
  `guitar_type` int(11) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `youtube_link` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guitar`
--

INSERT INTO `guitar` (`guitar_id`, `guitar_image`, `guitar_name`, `guitar_type`, `description`, `youtube_link`, `price`) VALUES
(1, '', '', 0, '', '', 0),
(2, 'fenderTele.jpg', 'Fender Telecaster Deluxe', 1, 'In the late 60s and early 70s guitarists wanted hum free tone based on the sound of an amp about to blow up. You asked so we listened and created the Telecaster Deluxe in 1973.', 'https://www.youtube.com/watch?v=n6iOyoPutzM', 899),
(3, 'lesPaulPlusTop.jpg', 'Les Paul Standard Plus Top', 2, 'Perhaps the most famous incarnation of Les'' namesake solidbody, the Les Paul Standard, has remained the most sought-after guitar in the world for over 50 years. Now, Epiphone''s Les Paul Standard Plus Top model offers the legendary Les Paul Standard sound with a stunning Flame maple top.', 'https://www.youtube.com/watch?v=aj3ByGgNLXI', 499.99),
(4, 'fenderstratacoustic.jpg', 'Fender Stratacoustic', 1, 'The electric guitar heritage of the Fender Stratacoustic Acoustic-Electric Guitar is obvious in its Stratocaster-influenced headstock and body profiles. The C-shape maple neck is instantly familiar and comfortable for electric players ready to add an acoustic to their collections.', 'https://www.youtube.com/watch?v=QoyF7Ffnneg', 299.99),
(5, 'danelectroconvert.jpg', 'Dano-electric Convertable ', 1, 'The new Convertible sports both a Lipstick and piezo pickup for exceptional versatility in a stylish package. Its hollowbody nature means you can also practice without plugging in.', 'https://www.youtube.com/watch?v=fO3eUj5Ixls', 699.99),
(7, 'fenderAcoustic.jpg', 'Fender CD60CE', 1, 'One of Fender''s best-selling acoustic-electrics is now available with the sweet mellow tone of an all-mahogany body. The CD60CE All-Mahogany Acoustic-Electric Guitar has upgraded features that include a new black pickguard, mother-of-pearl acrylic rosette design, new compensated bridge design, white', 'https://youtu.be/592mevOAqmg', 299.99),
(8, 'taylor12string.jpg', 'Taylor T5z', 1, 'The deep color and rich grain of a mahogany top give the T5z-12 Classic a vintage, earthy character. Electric-friendly features include a compact body, a 12" fretboard radius and jumbo frets, which add up to a fast, fluid playing experience.', 'https://www.youtube.com/watch?v=8sUX1Q3F-d0', 1699.99),
(11, 'GibsonHP835.jpg', 'Gibson HP 835', 1, 'Just as the HP 735 R, the HP 835 Supreme blends the tonal richness and depth of the popular Gibson square shoulder Dreadnought with an array of High Performance features for the 2017 model year for enhanced comfort and playability. Setting the HP 835 Supreme apart from the HP 735 R, this model offers several upgrades including ivoroid bindings, fretboard inlays, gold hardware, electronics, and more.', 'https://www.youtube.com/watch?v=Bs96fmJdkDI', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `guitar_types`
--

CREATE TABLE `guitar_types` (
  `type_id` int(1) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guitar_types`
--

INSERT INTO `guitar_types` (`type_id`, `type`) VALUES
(1, 'Acoustic'),
(2, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_fname`, `user_lname`, `user_email`, `user_role`) VALUES
(1, 'jadebard', 'password', 'Jacob', 'DeBard', 'jadebard32@gmail.com', 1),
(2, 'testing', 'password', 'fname', 'lname', 'testing@email.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drum`
--
ALTER TABLE `drum`
  ADD PRIMARY KEY (`drum_id`);

--
-- Indexes for table `drum_types`
--
ALTER TABLE `drum_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `guitar`
--
ALTER TABLE `guitar`
  ADD PRIMARY KEY (`guitar_id`) USING BTREE;

--
-- Indexes for table `guitar_types`
--
ALTER TABLE `guitar_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drum`
--
ALTER TABLE `drum`
  MODIFY `drum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `drum_types`
--
ALTER TABLE `drum_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guitar`
--
ALTER TABLE `guitar`
  MODIFY `guitar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `guitar_types`
--
ALTER TABLE `guitar_types`
  MODIFY `type_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
