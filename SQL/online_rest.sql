-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2020 lúc 02:29 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `online_rest`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'admin_nghi', '0192023a7bbd73250516f069df18b500', 'tuongnghi@gmail.com', 'QFE6ZM', '2020-11-02 09:35:57'),
(2, 'admin_thinh', '87ef067531ad5e77c15a8709c37953ef', 'tuthinh@gmail.com', 'QMZR92', '2020-11-02 09:42:55'),
(3, 'admin_trong', 'eadf4a44b227470564747ca9ee9bdcaa', 'viettrong@gmail.com', 'QPGIOV', '2020-11-02 09:43:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) CHARACTER SET utf8 NOT NULL,
  `slogan` varchar(222) CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(18, 1, 'Kolakem', 'KOLAKEM – COLA KEM PHỦ SOCOLA', '14', '5fce37e9440bc.jpg'),
(19, 1, 'Combo Wedges A', '01 Miếng Gà giòn cay/ giòn không cay/ truyền thống + 01 Burger Tôm + 01 Khoai Tây Múi Cau (R) + 01 Pepsi Can', '92', '5fce38c0b4a18.jpg'),
(20, 1, 'Combo Wedges B', '03 Miếng Gà giòn cay/ giòn không cay/ truyền thống + 01 Khoai Tây Múi Cau (L) + 02 Pepsi Can', '147', '5fce3dbb2ea0e.jpg'),
(21, 1, 'Wedges (Vừa)', '01 Khoai Tây Múi Cau R', '17', '5fcf7a39add8c.jpg'),
(22, 1, 'Wedges (Lớn)', '01 Khoai Tây Múi Cau L', '37', '5fcf7a8c54d78.jpg'),
(23, 1, 'Combo 86', '01 Miếng Gà Truyền Thống/ Gà Giòn Cay/ Gà Giòn Không Cay, 01 Phần Hot wings 03 miếng/ 01 Gà Popcorn (Vừa)/ 01 Bơ Gơ Tôm, 01 Khoai Tây Chiên (Vừa), 01 ly Kolakem (sản phẩm mới), 01 Phiếu Cào Trúng Thưởng', '86', '5fcf7b1ac1b37.jpg'),
(24, 1, 'Combo 158', '03 Miếng Gà Truyền Thống/ Gà Giòn Cay/ Gà Giòn Không Cay, 01 Phần Hot wings 03 miếng/ 01 Gà Popcorn (Vừa)/ 01 Bơ Gơ Tôm, 01 Khoai Tây Chiên (Vừa), 02 ly Kolakem (sản phẩm mới), 02 Phiếu Cào Trúng Thưởng', '158', '5fcf7b52e2392.jpg'),
(25, 1, 'Combo 158', '03 Miếng Gà Truyền Thống/ Gà Giòn Cay/ Gà Giòn Không Cay, 01 Phần Hot wings 03 miếng/ 01 Gà Popcorn (Vừa)/ 01 Bơ Gơ Tôm, 01 Khoai Tây Chiên (Vừa), 02 ly Kolakem (sản phẩm mới), 02 Phiếu Cào Trúng Thưởng', '158', '5fcf7c8814105.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) CHARACTER SET utf8 NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` varchar(222) CHARACTER SET utf8 NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(1, 1, 'KFC Lê Thành Phương', 'lienhe@kfcvietnam.com.vn', '1900 6886', 'https://kfcvietnam.com.vn', '8am', '10pm', '24hr-x7', 'Số 67, đường Lê Thành Phương, phường Phương Sài, thành phố Nha Trang, tỉnh Khánh Hoà.', '5f9f7f660f3c1.jpg', '2020-11-02 10:39:18'),
(2, 2, 'Pizza Hut Nha Trang', 'customerservice@pizzahut.vn', '1900 1822', 'https://pizzahut.vn', '8am', '10pm', '24hr-x7', 'Số 67, đường Lê Thành Phương, phường Lộc Thọ, thành phố Nha Trang, tỉnh Khánh Hòa.', '5f9f8587a50a7.jpg', '2020-11-02 11:05:27'),
(3, 1, 'Lotteria Thống Nhất NT', 'marketing@lotteria.vn', '0258 3828 086', 'https://www.lotteria.vn/', '8am', '10pm', '24hr-x7', ' Số 73, đường Thống Nhất, phường Vạn Thạnh, thành phố Nha Trang, tỉnh Khánh Hòa.', '5fa146a1ef114.jpg', '2020-11-03 19:01:37'),
(4, 2, 'The Pizza Company', 'cskh@qsrvietnam.com', '0258 7300 779', 'https://thepizzacompany.vn/vn/', '8am', '10pm', '24hr-x7', 'Số 44 - 46, đường Lê Thánh Tôn, phường Lộc Thọ, thành phố Nha Trang, tỉnh Khánh Hòa', '5fa147b3cf072.jpg', '2020-11-03 19:06:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(1, 'Thức ăn nhanh', '2020-11-02 10:13:21'),
(2, 'Pizza', '2020-11-02 10:13:44'),
(3, 'Cơm Việt', '2020-11-02 10:13:56'),
(4, 'Cơm Tây', '2020-11-02 10:15:23'),
(5, 'Đồ ăn Trung Quốc', '2020-11-02 10:14:40'),
(6, 'Thức uống', '2020-11-02 10:14:46'),
(7, 'Món ăn Việt', '2020-11-02 10:15:00'),
(8, 'Món ngọt', '2020-11-02 10:15:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `l_name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` varchar(222) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(1, 'nghi_ngo', 'Ngô', 'Nghi', 'nghingo@thida.com', '0935874437', 'e24ba71ca8da0b0603de9c449515f5d0', 'Diên Toàn, Diên Khánh, Khánh Hòa', 1, '2020-11-02 09:51:59'),
(2, 'thinh_diep', 'Diệp', 'Thịnh', 'thinhdiep@thida.com', '0704413390', '87ef067531ad5e77c15a8709c37953ef', 'Bình Tân, Nha Trang, Khánh Hòa', 1, '2020-11-02 09:56:41'),
(3, 'trong_nguyen', 'Nguyễn', 'Trọng', 'trongnguyen@thida.com', '0987563250', 'eadf4a44b227470564747ca9ee9bdcaa', 'Đồng Môn, thành phố Hà Tĩnh, Hà Tĩnh', 1, '2020-11-02 10:00:05'),
(4, 'huy_vo', 'Võ', 'Huy', 'huyvo@thida.com', '0773057670', 'b8dc042d8cf7deefb0ec6a264c930b02', 'Ninh Thủy, Ninh Hòa, Khánh Hòa', 1, '2020-11-02 10:01:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) CHARACTER SET utf8 NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) CHARACTER SET utf8 DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Chỉ mục cho bảng `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Chỉ mục cho bảng `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Chỉ mục cho bảng `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Chỉ mục cho bảng `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
