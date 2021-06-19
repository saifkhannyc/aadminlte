-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 05:34 PM
-- Server version: 5.7.22-log
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssb351`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `statuses` int(1) NOT NULL DEFAULT '0' COMMENT '0= Inactive, 1= Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `parent_id`, `statuses`) VALUES
(1, 'Business', '<p>This is the Business Category</p>\r\n', 0, 1),
(2, 'Finance', '<p>Finance Sub-Category</p>\r\n', 1, 1),
(3, 'Marketing', '<p>Marketing Sub-Category</p>\r\n', 1, 1),
(4, 'Information Technology', '<p>This is IT category</p>\r\n', 0, 1),
(5, 'Data Science', '<p>This is Data Science category</p>\r\n', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `date_posted` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1= "Active", 2="Inactive"'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `category_id`, `author_id`, `tags`, `image`, `date_posted`, `status`) VALUES
(2, 'Data is the new oil', '<p>Data Science</p>\r\n', 5, 1, 'data science, analytics', '2699798validatedlearning.png', '2021-06-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '2' COMMENT '1= Active, 2= Inactive',
  `user_role` int(1) NOT NULL DEFAULT '3' COMMENT '1= Super Admin, 2= Editor, 3= Users',
  `join_date` date NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `password`, `phone`, `address`, `status`, `user_role`, `join_date`, `image`) VALUES
(2, 'Mohammed Shihab Khan', 'shihab', 'shihab@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '346-444-4444', '3 Smith Lane, New York, NY 11045', 1, 1, '2021-06-07', '255131758443865_2242154582767826_2889959300204068864_n.jpg'),
(3, 'Mofazzal Hossain', 'mofazzal', 'mhussain@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '212-222-2222', 'csdcscsdcs', 1, 2, '2021-06-07', '2043219Shahed.png'),
(4, 'Asif Jamil', 'asif', 'asif@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '333-333-3333', 'New York', 1, 3, '2021-06-07', '8116277user6-128x128.jpg'),
(5, 'Rashed Chowdhury', 'rashed', 'rashed@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '222-111-1111', '450 W', 1, 3, '2021-06-08', NULL),
(6, 'Imtiaz Rahman', 'imtiaz', 'imtiaz@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(7, 'Jospeh Dill', 'joseph', 'joseph@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(8, 'Mary Smith', 'mary', 'mary@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(9, 'Cynthia Johnson', 'cynthia', 'cynthia@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(10, 'Karim', 'karim', 'karim@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(11, 'Hemel Bhai', 'hemel', 'hemel@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(12, 'Lablu Chowdhury', 'Lablu', 'lablu@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', NULL, NULL, 2, 3, '2021-06-08', NULL),
(13, 'Arshad Hossain', 'arshad', 'arshad@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '212-444-2222', '3 Mann Lane', 1, 2, '2021-06-09', '34564558443865_2242154582767826_2889959300204068864_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
