-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2021 at 03:47 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astonevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(500) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phoneNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `dateCreated`, `phoneNumber`) VALUES
(17, 'Qasim057', 'Qastro786', 'qasim057@aston.ac.uk', '2021-04-28 23:23:05', '123123123123'),
(18, 'tayyab7891', 'Ta123lo09', 'tayyan54@aston.ac.uk', '2021-04-28 23:45:16', '07936652981');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `eventid` int(11) NOT NULL,
  `email_eventid` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingid`, `email`, `eventid`, `email_eventid`) VALUES
(44, 'tayyan54@aston.ac.uk', 23, 'tayyan54@aston.ac.uk23'),
(45, '', 21, '21'),
(46, 'tayyan54@aston.ac.uk', 22, 'tayyan54@aston.ac.uk22'),
(53, 'tayyan54@aston.ac.uk', 26, 'tayyan54@aston.ac.uk26');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `eventPicture` text NOT NULL,
  `organiser` varchar(255) NOT NULL,
  `contactEmail` varchar(320) NOT NULL,
  `eventypeid` int(11) NOT NULL,
  `venueid` int(11) NOT NULL,
  `accountid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `name`, `description`, `time`, `eventPicture`, `organiser`, `contactEmail`, `eventypeid`, `venueid`, `accountid`) VALUES
(21, 'FOOTBALL', 'We are running a 5-a-side football tournament at Aston Universities Recreational Field. The tournament will run between 5pm-7pm on the 13th of July. BOOK NOW TO JOIN US!', '2021-07-13 00:00:00', 'https://images.unsplash.com/photo-1589487391730-58f20eb2c308?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTB8fHxlbnwwfHx8fA%3D%3D&w=1000&q=80', 'Ali Abdelaziz', 'Aliabdelaziz123@gmail.com', 1, 7, 17),
(22, 'CRICKET', 'Love cricket? Well join us & put your skill to the test. We will be running various challenges to test your skills & win prizes. The event will be held at 12pm-3pm on the 24th of July.', '2021-07-24 00:00:00', 'https://i.ytimg.com/vi/LWD2Ja9GsVI/maxresdefault.jpg', 'Jordan Lee', 'LeeJordan12@yahoo.com', 1, 6, 17),
(23, 'BASKETBALL', 'Join our womens team & have fun! Get together on the 6th of august to take part in our series of basketball games. The games will take place between 7pm-9pm at the Aston Sports Hall. ', '2021-08-06 00:00:00', 'https://www2.aston.ac.uk/migrated-assets/imagejpeg/sport/158430-Basketball-Courts.jpg', 'Lisa Smith', 'LisaSmith007@hotmail.co.uk', 1, 6, 17),
(24, 'Dance ', 'Wish you were on Strictly Come Dancing? Well you can join us on the 3rd of July at 8pm & try something new! We will offer various dance types with plenty of qualified instructors.', '2021-07-03 00:00:00', 'https://www2.aston.ac.uk/migrated-assets/imagejpeg/sport/158430-Basketball-Courts.jpg', 'Mia Cole', 'TheMiaCole1@hotmail.co.uk', 2, 6, 17),
(25, 'Singing ', 'We are starting to put together a singing event at Aston. Allowing people to stretch their vocals & improve confidence levels. The event will take place on the 19th of July at 12pm. Book Now!', '2021-07-19 00:00:00', 'https://api.time.com/wp-content/uploads/2019/09/karaoke-mic.jpg', 'Collin Moore', 'CollMoore99@gmail.com', 2, 8, 17),
(26, 'Roller Skating', 'Ever tried roller skating? Well today is your chance to book with us for the 26th of August. We will be accepting new & experienced participants at 6pm on the day. ', '2021-08-26 00:00:00', 'https://www.telegraph.co.uk/content/dam/health-fitness/2020/07/16/Photo-7-11-20-5-21-13-PM_trans_NvBQzQNjv4Bq900leoZVuq6ru6F43OqP_qmu_5TrYCayWOnMLHAQ2N0.jpg', 'Andrew Reyonalds', 'AndyRey2001@hotmail.com', 2, 6, 17),
(27, 'Debate Mate', 'We are running a debate club at the Conference Aston. Students will be able to bring up their favourite topics & get their points across. The debate will take place on the 23rd July at 2:30pm. Book now, limited places available!', '2021-07-23 00:00:00', 'https://images.theconversation.com/files/220637/original/file-20180528-80626-l37ku.jpg?ixlib=rb-1.1.0&rect=0%2C0%2C1198%2C745&q=45&auto=format&w=926&fit=clip', 'James Charles', 'Jamescharles23@yahoo.com', 3, 8, 17),
(28, 'Book Reading', 'Join us on the 9th of August at 1:30pm for some quiet time between you & your favourite novel.', '2021-08-09 00:00:00', 'https://cdn.blackpoolgrand.co.uk/app/uploads/2021/03/famous-Quotes-about-reading.jpg', 'Qasim Jahangir', 'qasim057@gmail.com', 3, 8, 17),
(29, 'Gaming Nights', 'Come & spend late nights here at the Aston Conference, where we can discuss & play new game releases. This event will run on the 24th of July at 9pm. Book Now!', '2021-07-24 00:00:00', 'https://assets.entrepreneur.com/content/3x2/2000/20171122142613-shutterstock-705666487.jpeg', 'Abdul Naeem', 'Abdulnaeem7821@yahoo.com', 3, 8, 17);

-- --------------------------------------------------------

--
-- Table structure for table `eventtypes`
--

CREATE TABLE `eventtypes` (
  `EventTypeID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventtypes`
--

INSERT INTO `eventtypes` (`EventTypeID`, `type`) VALUES
(2, 'culture'),
(3, 'others'),
(1, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likesid` int(11) NOT NULL,
  `dateLiked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid_postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likesid`, `dateLiked`, `userid`, `postid`, `userid_postid`) VALUES
(3, '2021-04-29 00:22:10', 18, 23, 1823),
(4, '2021-04-30 01:54:41', 18, 29, 1829),
(5, '2021-04-30 02:16:37', 18, 22, 1822),
(6, '2021-04-30 02:29:52', 18, 26, 1826);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venueid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `venuelink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venueid`, `name`, `picture`, `address`, `capacity`, `venuelink`) VALUES
(6, 'Aston Sports Hall', 'https://www2.aston.ac.uk/migrated-assets/imagejpeg/sport/158429-Badminton-Courts.jpg', 'Woodcock St, Birmingham B4 7ET', 100, ''),
(7, 'Aston Recreation field', 'https://www2.aston.ac.uk/image-library/Sports/homepage-ui-cards/Rec-Centre-UI-Card-Cropped-480x320.jpg', 'University Recreation Ground, Birmingham Rd, Walsall, Birmingham B43 7AJ', 300, ''),
(8, 'Aston Conference ', 'https://mitmagazine.co.uk/wp-content/uploads/2020/01/aston.jpg', 'Aston University, Aston St, Birmingham B4 7ET', 500, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingid`),
  ADD UNIQUE KEY `email_eventid` (`email_eventid`),
  ADD KEY `eventid` (`eventid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `eventypeid` (`eventypeid`),
  ADD KEY `venueid` (`venueid`),
  ADD KEY `accountid` (`accountid`);

--
-- Indexes for table `eventtypes`
--
ALTER TABLE `eventtypes`
  ADD PRIMARY KEY (`EventTypeID`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likesid`),
  ADD UNIQUE KEY `userid_postid` (`userid_postid`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venueid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `eventtypes`
--
ALTER TABLE `eventtypes`
  MODIFY `EventTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `event` (`eventid`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`eventypeid`) REFERENCES `eventtypes` (`EventTypeID`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`venueid`) REFERENCES `venue` (`venueid`),
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
