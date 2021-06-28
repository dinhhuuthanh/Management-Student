-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 28, 2021 lúc 11:18 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `manage_student`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '4ea87a999c60e96ab60230cb4ac34413', '2020-05-13 11:18:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(1, 'First', 1, 'A', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(2, 'First', 1, 'B', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(3, 'First', 1, 'C', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(4, 'Second', 2, 'A', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(5, 'Second', 2, 'B', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(6, 'Second', 2, 'C', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(7, 'Third', 3, 'A', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(8, 'Third', 3, 'B', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(9, 'Third', 3, 'C', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(10, 'Fourth', 4, 'A', '2020-06-06 09:52:33', '0000-00-00 00:00:00'),
(11, 'Fourth', 4, 'B', '2020-06-06 09:52:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(18, 1, 1, 2, 9, '2020-06-28 09:07:59', NULL),
(19, 1, 1, 1, 9, '2020-06-28 09:07:59', NULL),
(20, 1, 1, 5, 6, '2020-06-28 09:07:59', NULL),
(21, 1, 1, 5, 7, '2020-06-28 09:07:59', NULL),
(22, 1, 1, 4, 2, '2020-06-28 09:07:59', NULL),
(23, 1, 1, 6, 4, '2020-06-28 09:07:59', NULL),
(24, 11, 2, 2, 9, '2020-06-28 09:14:43', NULL),
(25, 11, 2, 1, 9, '2020-06-28 09:14:43', NULL),
(26, 11, 2, 4, 9, '2020-06-28 09:14:43', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(1, 'Đinh Hữu Thành', '20201', 'thanhdh@gmail.com', 'Male', '2000-03-03', 1, '2020-06-12 03:30:57', '0000-00-00 00:00:00', 1),
(2, 'Nguyễn Văn Tuán', '20202', 'tuannv@gmail.co', 'Male', '2000-02-02', 4, '2020-08-19 12:18:28', '0000-00-00 00:00:00', 0),
(3, 'Châu Nhật Cường', '20203', 'cuongnc@gmail.com', 'Male', '2000-08-06', 6, '2020-08-28 11:45:31', '0000-00-00 00:00:00', 1),
(4, 'Châu Tinh Trì', '20204', 'trict@gmail.com', 'Male', '2001-02-03', 7, '2020-08-28 11:54:58', '0000-00-00 00:00:00', 1),
(5, 'Phan Bá Cường', '20205', 'cuongpb@gmail.com', 'Female', '2002-02-03', 8, '2020-08-28 12:23:53', '0000-00-00 00:00:00', 1),
(6, 'Châu Nhật Nam', '20206', 'namcn@gmail.com', 'Male', '2000-08-06', 6, '2020-08-28 11:45:31', '0000-00-00 00:00:00', 1),
(7, 'Châu Tinh Phương', '20207', 'phuongtc@gmail.com', 'Female', '2001-02-03', 7, '2020-08-28 11:54:58', '0000-00-00 00:00:00', 1),
(8, 'Phan Bá Vành', '20208', 'vanhbv@gmail.com', 'Female', '2002-02-03', 8, '2020-08-28 12:23:53', '0000-00-00 00:00:00', 1),
(11, 'Lý Tử Thất', '20209', 'thatly@gmail.com', 'Female', '2000-06-11', 2, '2020-06-28 09:13:21', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(37, 1, 1, 1, '2020-06-28 09:05:09', NULL),
(38, 1, 2, 1, '2020-06-28 09:05:14', NULL),
(39, 1, 4, 1, '2020-06-28 09:05:18', NULL),
(40, 3, 4, 1, '2020-06-28 09:05:22', NULL),
(41, 1, 5, 1, '2020-06-28 09:05:27', NULL),
(42, 1, 6, 1, '2020-06-28 09:05:31', NULL),
(43, 1, 5, 1, '2020-06-28 09:05:27', NULL),
(44, 2, 1, 1, '2020-06-28 09:08:50', NULL),
(45, 2, 2, 1, '2021-06-28 09:08:54', NULL),
(46, 2, 4, 1, '2020-06-28 09:08:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'Maths', 'MTH01', '2020-06-07 02:23:57', '0000-00-00 00:00:00'),
(2, 'English', 'ENG11', '2020-06-07 02:24:25', '0000-00-00 00:00:00'),
(4, 'Science', 'SC1', '2020-06-07 02:36:15', '0000-00-00 00:00:00'),
(5, 'Music', 'MS', '2020-06-07 02:36:23', '0000-00-00 00:00:00'),
(6, 'Social Studies', 'SS08', '2020-08-28 11:43:29', '0000-00-00 00:00:00'),
(7, 'Physics', 'PH03', '2020-08-28 11:52:41', '0000-00-00 00:00:00'),
(8, 'Chemistry', 'CH65', '2020-08-28 12:21:46', '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`);

--
-- Chỉ mục cho bảng `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
