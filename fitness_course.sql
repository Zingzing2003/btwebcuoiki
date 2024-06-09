-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 03:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_course`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Nguyễn Văn ABC', 'admin', '1234567'),
(2, 'Phạm Thị B', 'admin2', 'password2'),
(3, 'Hoàng Văn C', 'admin3', 'password3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `featured` enum('Yes','No') DEFAULT 'No',
  `active` enum('Yes','No') DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `description`, `image_name`, `featured`, `active`) VALUES
(1, 'Yoga', 'Bộ môn này là sự kết hợp các kỹ thuật thở, tư thế yoga và ngồi thiền.', 'yoga.jpg', 'Yes', 'Yes'),
(2, 'Gym', 'Bộ môn luyện tập để sở hữu sức khỏe dẻo dai, thân hình vạm vỡ ', 'gym.jpg', 'Yes', 'Yes'),
(3, 'Pilates', 'Bài tập kết hợp những động tác giữ thăng bằng, linh hoạt cùng điều chỉnh hơi thở', 'pilates.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `course_fee` decimal(10,2) DEFAULT NULL,
  `lesson_number` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `featured` enum('Yes','No') DEFAULT 'Yes',
  `active` enum('Yes','No') DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `title`, `description`, `image_name`, `course_fee`, `lesson_number`, `category_id`, `featured`, `active`) VALUES
(2, 'Yoga giảm căng thẳng', 'Khóa học yoga giúp giảm căng thẳng và lo âu', 'yoga_giam_cang_thang.jpg', 90000077.00, 8, 1, 'Yes', 'Yes'),
(3, 'Yoga bầu', 'Khóa học yoga dành cho phụ nữ mang thai', 'yoga_bau.jpg', 1500000.00, 12, 1, 'Yes', 'Yes'),
(4, 'Yoga giảm mỡ bụng', 'Khóa học yoga tập trung vào giảm mỡ bụng', 'yoga_giam_mo_bung.jpg', 950000.00, 10, 1, 'Yes', 'Yes'),
(5, 'Thể hình nữ', 'Chương trình tập luyện thể hình dành cho phụ nữ', 'the_hinh_nu.jpg', 1200000.00, 12, 2, 'Yes', 'Yes'),
(6, 'Gym tăng cân', 'Chương trình tập luyện gym để tăng cân', 'gym_tang_can.jpg', 1100000.00, 8, 2, 'Yes', 'Yes'),
(7, 'Gym giảm mỡ toàn thân', 'Chương trình tập luyện gym tập trung vào giảm mỡ toàn thân', 'gym_giam_mo_toan_than.jpg', 1000000.00, 10, 2, 'Yes', 'Yes'),
(8, 'Gym săn chắc cơ', 'Khóa học gym giúp săn chắc cơ bắp', 'gym_san_chac_co.jpg', 850000.00, 8, 2, 'No', 'Yes'),
(9, 'Pilates duy trì vóc dáng', 'Khóa học pilates giúp duy trì vóc dáng thon gọn', 'pilates_duy_tri_voc_dang.jpg', 950000.00, 8, 3, 'Yes', 'Yes'),
(10, 'Pilates giảm cân', 'Khóa học pilates tập trung vào giảm cân', 'pilates_giam_can.jpg', 2000000.00, 10, 3, 'Yes', 'Yes'),
(11, 'Yoga trị liệu', 'Khóa học yoga giúp điều trị các vấn đề về sức khỏe', 'yoga_tri_lieu.jpg', 1000000.00, 10, 1, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_fee` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `learner_name` varchar(255) NOT NULL,
  `learner_email` varchar(255) NOT NULL,
  `learner_address` varchar(255) NOT NULL,
  `status` enum('Registered','Completed','Cancelled') DEFAULT 'Registered',
  `learner_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`id`, `course_name`, `course_fee`, `qty`, `total`, `register_date`, `learner_name`, `learner_email`, `learner_address`, `status`, `learner_contact`) VALUES
(1, 'Yoga giảm căng thẳng', 900000.00, 1, 900000.00, '2024-05-24 21:27:34', 'Bùi Thị Kun', 'buithihoaidung95@gmail.com', 'qưertyu', 'Registered', '123456789'),
(2, 'Gym giảm mỡ toàn thân', 1000000.00, 1, 1000000.00, '2024-05-25 00:03:24', 'Bùi Thị Kun', 'dinh@gmail.com', 'Thanh Hóa', 'Registered', '01233978622'),
(3, 'Yoga giảm căng thẳng', 90000077.00, 1, 90000077.00, '2024-05-25 02:42:21', 'Bùi Thị Dinh', 'dinh@gmail.com', 'Thanh Hóa', 'Registered', '01233978622');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `tbl_course_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
