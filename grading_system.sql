-- YBVC • Pro Grading System
-- Admin: Mohammad Salip D.
-- Database: grading_system
-- Exported from: localhost/phpMyAdmin - based on your screenshot
-- Date: 2026

CREATE DATABASE IF NOT EXISTS `grading_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `grading_system`;

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lrn` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `q1` int(11) DEFAULT 0,
  `q2` int(11) DEFAULT 0,
  `q3` int(11) DEFAULT 0,
  `final_grade` int(11) DEFAULT 0,
  `status` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- EXACT DATA FROM YOUR SCREENSHOT (phpMyAdmin)
INSERT INTO `students` (`id`, `lrn`, `full_name`, `course`, `q1`, `q2`, `q3`, `final_grade`, `status`) VALUES
(1, '123456789012', 'MOHAMMAD, SALIP D.', 'BSIT-2A', 86, 87, 91, 89, 'PASSED'),
(2, '123456789015', 'DERK, CANON', 'BSCS-3B', 60, 65, 68, 66, 'FAILED');