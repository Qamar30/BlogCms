-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2018 at 10:02 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caturl` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `caturl`, `description`, `image`) VALUES
(10, 'Sports', '', 'A place for the latest Sports news', ''),
(11, 'Techonology', '', 'Latest Technology news', ''),
(12, 'Events', '', 'Up Coming Events', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `submittime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `cid`, `name`, `email`, `subject`, `submittime`, `status`) VALUES
(2, 17, 'qamar', 'qamarkhoza@gmail.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In convallis. Proin mattis lacinia justo. Aliquam ante. Etiam posuere lacus quis dolor. Nam quis nulla. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea comm', '2017-09-28 12:53:31', 'publish'),
(5, 20, 'James reed', 'James@gmail.com', 'This places Rocks', '2017-09-28 12:57:40', 'published'),
(6, 17, '', '', 'fdsfdsfdsfdsfdsfs', '2018-09-11 21:37:14', 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `catid` varchar(255) NOT NULL,
  `subcatid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` datetime NOT NULL,
  `publishtime` datetime NOT NULL,
  `featuredimage` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `catid`, `subcatid`, `title`, `content`, `url`, `status`, `createtime`, `updatetime`, `publishtime`, `featuredimage`, `userid`) VALUES
(17, '3', '', 'Lorem ipsum dolor sit amet', '<h4 style=\"box-sizing: border-box; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 500; line-height: 1.1; color: #333333; margin-top: 10px; margin-bottom: 10px; font-size: 18px;\"><span style=\"box-sizing: border-box;\">Duis elementum metus felis, nec pellentesque sem auctor ut.</span></h4>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam non porttitor felis. Nullam eu elit sollicitudin orci varius lacinia vitae eu diam.</span></p>', 'lorem-ipsum-dolor-sit-amet', 'published', '2017-09-28 12:19:29', '2017-09-28 08:49:29', '0000-00-00 00:00:00', 'uploads/Word Power Made Easy.jpg', 0),
(20, '3', '', 'Lifestyles of the Rich and famous', '<p>We need to get&nbsp; Rich real fast</p>', 'Lifestyles-of-the-Rich-and-famous', 'published', '2017-09-28 12:22:00', '2018-09-10 01:48:10', '0000-00-00 00:00:00', 'uploads/General Knowledge 2018.jpg', 0),
(21, '', '', 'Sports', '', 'sports', '', '2018-09-10 21:08:11', '2018-09-10 21:08:11', '0000-00-00 00:00:00', '', 0),
(22, '', '', 'Sports', '<p>Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Duis pulvinar. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Duis viverra diam non justo. Fusce consectetuer risus a nunc. Vivamus ac leo pretium faucibus. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Duis risus. Etiam dictum tincidunt diam. Vivamus luctus egestas leo. Ut tempus purus at lorem. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reici</p>', 'sports', '', '2018-09-10 21:09:41', '2018-09-10 21:09:41', '0000-00-00 00:00:00', 'uploads/austin-poon-728200-unsplash.jpg', 0),
(24, '', '', 'Sports', '<p>Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Duis pulvinar. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Duis viverra diam non justo. Fusce consectetuer risus a nunc. Vivamus ac leo pretium faucibus. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Duis risus. Etiam dictum tincidunt diam. Vivamus luctus egestas leo. Ut tempus purus at lorem. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reici</p>', 'Sports', '', '2018-09-10 21:12:08', '2018-09-10 21:12:46', '0000-00-00 00:00:00', 'uploads/27438491.jpeg', 0),
(25, '', '', 'health', '', 'health', '', '2018-09-10 22:52:15', '2018-09-10 22:52:15', '0000-00-00 00:00:00', '', 0),
(26, '', '', 'News', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Nullam faucibus mi quis velit. Nulla quis diam. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Donec vitae arcu. Aliquam ante. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Curabitur bibendum justo non orci. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Etiam posuere lacus quis dolor. Fusce tellus. Integer tempor. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Ut enim ad</p>', 'news', '', '2018-09-11 00:55:39', '2018-09-11 00:55:39', '0000-00-00 00:00:00', 'uploads/ff9b22c2cc9d02950137e064d0f72217.jpg', 0),
(27, '11', '', 'The rise of the Apple monopoly', '<p>dgfdgfdgfdgdf</p>', 'The-rise-of-the-Apple-monopoly', 'published', '2018-09-11 17:28:57', '2018-09-11 17:33:52', '0000-00-00 00:00:00', 'uploads/ff9b22c2cc9d02950137e064d0f72217.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(2, 'ad', 'your ad code here'),
(3, 'perpage', '2'),
(4, 'sitename', 'The Blog Spot'),
(10, 'site-logo.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

CREATE TABLE `subcat` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `catid`, `name`, `description`, `image`) VALUES
(1, 3, 'HTML', 'Hyper Text Markup Language', ''),
(2, 3, 'CSS', '', ''),
(3, 3, 'HTML 5', 'HTML 5', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `active`) VALUES
(1, 'Qamar', 'qamarkhoza@gmail.com', 'e6a395a1418c297f9cb47cdf5df83a68', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcat`
--
ALTER TABLE `subcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subcat`
--
ALTER TABLE `subcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
