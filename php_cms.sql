-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 12:02 AM
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
-- Database: `php_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'Abhiraj', 'abhirajdogra@gmail.com', '(647) 532-7682', 'Test Subject', 'This is test description', '2025-04-01 17:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `type` enum('Website','Graphic Design') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `content`, `url`, `type`, `date`, `photo`) VALUES
(1, 'Project One', '<p>Cras sed erat varius, ornare odio non, mattis ex. Aliquam aliquam, enim et dapibus tristique, lorem massa auctor diam, vel euismod tellus massa mollis arcu. Ut in maximus quam. Nulla nec dui nulla. Donec a efficitur quam. Morbi hendrerit ipsum quam, eu aliquet nunc gravida ut. Suspendisse posuere, mauris vel placerat eleifend, arcu dui hendrerit ex, vitae consequat ante tellus finibus lorem. Sed in interdum lectus.</p>', 'https://codeadam.ca', 'Website', '2020-11-01', NULL),
(2, 'Project Two', '<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum eget tortor dapibus, dictum ante in, mattis libero.</p>', '', 'Graphic Design', '2020-11-25', NULL),
(3, 'wefrwef Edited', '<p>wafdsfs</p>', 'fsdfsdfs', 'Website', '0000-00-00', NULL),
(5, 'New Project', '<p>This is test description</p>', 'http://testproject.com', 'Graphic Design', '2025-04-02', NULL),
(6, 'dddddddddd', '<p>dddddddddddddddddddddddd</p>', '', 'Website', '0000-00-00', NULL),
(7, 'qqqqqqqqqq', '<p>ssdsd</p>', '', 'Website', '0000-00-00', NULL),
(8, 'New with photo', '<p>Test desc</p>', 'http://testproject.com', 'Website', '2025-04-04', 'uploads/img_67ea24b5d7ee6.png'),
(9, 'dfsdfsdf', '<p>sdfdsf</p>', 'sd', 'Website', '0000-00-00', 'uploads/img_67ea24c343481.png'),
(10, 'cddad', '<p>asdasd</p>', '', 'Website', '0000-00-00', 'uploads/img_67ea24d20719f.png');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `proficiency` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `proficiency`) VALUES
(24, 'PHP', 90),
(25, 'JavaScript', 85);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `freelance` tinyint(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `title_small` varchar(255) DEFAULT NULL,
  `title_main` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `description`, `designation`, `phone`, `city`, `degree`, `freelance`, `dob`, `website`, `title_small`, `title_main`, `image`, `active`, `dateAdded`) VALUES
(1, 'Dilkhush', 'Yadav', 'dilkhushyadav@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'A results-driven Web Developer with 5+ years of experience in software engineering and web development.\r\nSpecializing in back-end development and experienced with all stages of the development cycle for dynamic web projects. Well-versed in numerous programming languages including PHP, JavaScript, HTML, CSS, ReactJS, MySQLi, etc. Strong background in project management and customer relations.\r\nAdept at collaborating with dynamic teams to build high-quality websites and identify opportunities to enhance the user experience.', 'Web Developer', '+1 3333332', 'Toronto, Canada', 'Post Graduation', 1, '1994-12-25', 'https://dilkhushyadav.com/', 'Full Stack Developer', 'I\'m a passionate Full Stack Developer', 'uploads/img_67ec60b386edd.jpg', 'Yes', '2025-04-01 17:55:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
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
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
