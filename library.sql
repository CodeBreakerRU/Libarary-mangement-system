-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 09:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bname` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `copies` int(5) NOT NULL,
  `availablecopies` varchar(20) DEFAULT 'NULL',
  `description` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bname`, `author`, `isbn`, `category`, `publisher`, `copies`, `availablecopies`, `description`) VALUES
(1, 'Me Before You', 'Jojo Moyes', '911119911', 'Novel', 'Goodreads', 100, '97', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(2, 'The Perks of Being a Wallflower ', 'Stephen Chbosky', '911119911', 'Novel', 'Goodreads', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(3, 'Thirteen Reasons Why', 'Jay Asher', '911119911', 'Education', 'Goodreads', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(4, 'Gone Girl (Paperback) ', 'Gillian Flynn', '911119911', 'Novel', 'Goodreads', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(5, 'Dragon Pearl', 'Yoon Ha Lee', '911119911', 'Kids', 'Rick Riordan Presents', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(6, 'In Search of Lost Time', 'Marcel Proust', '911119911', 'Fantasy', 'thegreatestbooks', 100, '101', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(7, 'Tender is the Night', 'F. Scott Fitzgerald', '911119911', 'Novel', 'Hardback', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(8, 'Narniya', 'C.H.lewis', '911119911', 'Fantasy', 'jeoffrey Vles Bless', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(9, 'Wuthering Heights', 'Emily Bronte', '911119911', 'Novel', 'Paperback', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(10, 'The Wonderful Story of Henry Sugar and Six More', 'Roald Dahl', '911119911', 'Novel', 'Paperback', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(11, 'All Quiet on the Western Front', 'Erich Maria Remarque', '911119911', 'Fantasy', 'Paperback', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. '),
(12, 'Homage to Catalonia', 'George Orwell', '911119911', 'Novel', 'Paperback', 100, '100', 'The first great adventure story in the Western canon, The Odyssey is a poem about violence and the aftermath of war; about wealth, poverty, and power; about marriage and family; about travelers, hospitality, and the yearning for home. ');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `brid` int(11) NOT NULL,
  `memberid` varchar(40) NOT NULL,
  `bookid` varchar(40) NOT NULL,
  `borrowed_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `returned_time` varchar(30) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`brid`, `memberid`, `bookid`, `borrowed_time`, `returned_time`, `status`) VALUES
(1, 'it17', '6', '2019-05-14 12:39:59', '2019-05-18', 'BORROWED'),
(2, 'it16', '01', '2019-05-14 13:01:29', 'null', 'BORROWED'),
(3, 'it16', '01', '2019-05-14 13:01:33', 'null', 'BORROWED');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(32) NOT NULL,
  `text` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `time`, `username`, `text`) VALUES
(199, '2019-05-14 13:32:27', 'admin', 'Hello'),
(198, '2019-05-14 13:32:27', 'admin', 'Hello'),
(197, '2019-05-14 13:32:27', 'admin', 'Hello'),
(196, '2019-05-14 13:32:20', 'admin', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `message_id` int(10) NOT NULL,
  `username` varchar(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`message_id`, `username`, `title`, `email`, `message`) VALUES
(5, 'admin ', 'Test Title', 'test@mail.com', 'Test Message !! abcdefghijklmnopqrstuvwxyz'),
(6, 'IT16 ', 'I need to talk with you madm', 'vr@gmail.com', 'dear madam,\r\ni need to talk with you today evening if u free let me know.i have to say something urgent thing about library.');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `name`, `address`, `phone`) VALUES
(11, 'admin', 'Administrator', 'Colombo, Sri Lanka', '0714329761'),
(12, 'IT16', 'Rasika Liyanaarachchi', 'Colombo, Sri Lanka', '94714329761'),


-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `nid` int(10) NOT NULL,
  `topic` varchar(450) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`nid`, `topic`, `content`) VALUES
(1, 'Faculty of Engineering & Faculty of Computing  Elective Registration', '(FOE) 4th Year 1st Semester â€“ 2019\r\n\r\n(FOC) 4th Year 1st & 2nd Semester (June Intake)\r\n\r\nEXTENSION OF ELECTIVE MODULES\r\n\r\nREGISTRATION'),
(2, 'The closing date of registrations for the Elective Modules ', 'Jan-June Semester 2019 is extended to the 16th February 2019\r\n\r\nPlease use the link given below.\r\nhttp://study.sliit.lk:800/'),
(3, 'lkjesjrtsle', 'llrjtewrjewlqr'),
(4, 'Attention PLZ', 'There will be a bomb blast in the Novel section in the library at 3.00p.m.plz,be kind enough to stay inside the library Until the bomb blast.make sure u will die. '),
(5, 'Attention PLZ', 'There will be a bomb blast in the Novel section in the library at 3.00p.m.plz,be kind enough to stay inside the library Until the bomb blast.make sure u will die.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(11, 'admin', '$2y$10$AxWKsRzoCVE7aBF2XeorCeuXDvQzYSVbBLXTxvQU6zklPNBDHCahW'),
(12, 'IT16', '$2y$10$xU8Zll2k0c8X3g0btGT9w.FSsJVBheufaLHmLVbRkjwqGqRZNebhW'),
(14, 'IT17', '$2y$10$RS1X5U6n7E5mXFtrHGagy.wGeWB/z8EWsOtMPg7DJ6epOofYYgWwe'),
(15, 'IT16107960', '$2y$10$J09Lu1EMuznoP23tlQgORe8vp0BbuFuUqz1K2Da7rIqKP7jRIX.MW'),
(17, 'IT16107961', '$2y$10$aaomTLn1f5vvBimy9ChTmuK6yxCtwN8pJJ9wQ56Aa6Ft2GOglOJBe'),
(18, 'IT16081208', '$2y$10$i3zUgxS4Z.nFE8crIPn5O.DqrXQxR.dulCl7PBE4Mali18Hsu4LrG'),
(21, 'vish', '$2y$10$7UD2govbfTre39ETH1ixbOe.1wx6jA9b825mHXYmb2e9ACbQVfze2'),
(22, 'IT16018624', '$2y$10$Q/sPzmGP.J7ViiSYlIGvwOVAe/pEN/ITZYpH6qIbXD81O1.C6.3xC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`brid`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_2` (`username`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `brid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `FK_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
