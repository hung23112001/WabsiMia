-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 10:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wabsi_mia`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloguser`
--

CREATE TABLE `bloguser` (
  `ID_blog` int(11) NOT NULL,
  `noiDung` varchar(200) NOT NULL,
  `hinhAnh` varchar(50) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tuongTac` int(11) NOT NULL,
  `ID_taiKhoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bloguser`
--

INSERT INTO `bloguser` (`ID_blog`, `noiDung`, `hinhAnh`, `ngayTao`, `tuongTac`, `ID_taiKhoan`) VALUES
(1, 'Xin chào 2022', 'stone-1.jpg', '2022-09-18 03:56:50', 3, 2),
(2, 'Bạn đã biết bản thân mình thuộc mệnh gì chưa? \r\n🌿Theo triết học Trung Hoa cổ đại thì tất cả vạn vật đều được sinh ra từ năm nguyên tố cơ bản và trải qua năm trạng thái là Kim - Mộc - Thủy - Hỏa - Thổ,', 'stone-2.jpg', '2022-09-18 03:52:37', 2, 11),
(8, 'Muộn rồi mà sao còn chưa ngủ', 'meo_coder.jpg', '2022-07-10 16:36:55', 2, 2),
(20, 'Các bạn thuộc mệnh gì nhỉ...', 'select_destiny.jpg', '2022-07-10 16:37:02', 2, 31);

-- --------------------------------------------------------

--
-- Table structure for table `blogweb`
--

CREATE TABLE `blogweb` (
  `ID_blog` int(11) NOT NULL,
  `tieuDe` varchar(100) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `linkAnh` varchar(50) NOT NULL,
  `linkBlog` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogweb`
--

INSERT INTO `blogweb` (`ID_blog`, `tieuDe`, `ngayTao`, `linkAnh`, `linkBlog`) VALUES
(3, 'Tử vi tháng 12/2021', '2021-12-21 08:06:32', 'Tu-vi-thang-12-2021.jpg', 'blog2'),
(4, 'Tử vi tháng 10/2021', '2021-12-21 04:36:59', 'Tu-vi-thang-10-2021.jpg', 'blog3'),
(5, 'Tử vi tháng 11/2021', '2021-12-21 05:01:45', 'Tu-vi-thang-11-2021-1.jpg', 'blog2'),
(11, 'Vòng đá hỗ trợ công việc', '2021-12-21 08:04:20', 'vong-da-ho-tro-cong-viec-web.jpg', 'blog2');

-- --------------------------------------------------------

--
-- Table structure for table `bosuutap`
--

CREATE TABLE `bosuutap` (
  `tenBST` varchar(100) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_TaiKhoan` int(11) NOT NULL,
  `ID_SanPham` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bosuutap`
--

INSERT INTO `bosuutap` (`tenBST`, `ngayTao`, `ID_TaiKhoan`, `ID_SanPham`) VALUES
('BST 6', '2021-12-24 14:27:13', 3, 8),
('BST 6', '2021-12-24 14:27:13', 3, 12),
('BST 3', '2021-12-24 14:27:13', 3, 15),
('BST 3', '2021-12-24 14:27:13', 3, 16),
('BST 2', '2021-12-24 14:27:13', 3, 18),
('BST Thời trang', '2021-12-30 10:20:47', 2, 27),
('BST Thời trang', '2021-12-30 12:53:03', 2, 24),
('BST Thời trang', '2022-01-03 02:53:35', 2, 42),
('BST Thời trang', '2022-01-03 02:57:54', 2, 49);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID_comment` int(11) NOT NULL,
  `ID_taikhoan` int(11) NOT NULL,
  `noiDung` varchar(150) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID_comment`, `ID_taikhoan`, `noiDung`, `ngayTao`, `ID_blog`) VALUES
(6, 2, 'okay', '2022-01-02 03:08:17', 8),
(12, 2, 'oke', '2022-01-03 16:08:36', 2),
(13, 2, 'nha', '2022-01-04 01:32:18', 2),
(14, 31, 'Mình mệnh Kim nè', '2022-01-04 03:38:18', 20),
(15, 31, 'Avatar cùng nè', '2022-01-04 03:38:32', 2),
(16, 31, 'chấm', '2022-01-04 03:48:58', 2),
(17, 2, 'Hi chào cậu', '2022-07-10 16:37:13', 1),
(18, 1, 'hello bro', '2022-08-20 15:16:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `giaohang`
--

CREATE TABLE `giaohang` (
  `ID_dvi` int(11) NOT NULL,
  `tenDvi` varchar(50) NOT NULL,
  `phiGH` int(11) NOT NULL,
  `thoigianGH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giaohang`
--

INSERT INTO `giaohang` (`ID_dvi`, `tenDvi`, `phiGH`, `thoigianGH`) VALUES
(2, 'Giao hàng tiết kiệm', 15000, '3 đến 6 ngày'),
(3, 'Giao hàng nhanh', 30000, '2 đến 4 ngày'),
(6, 'ITH Express', 10000, '2 đến 5 ngày');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `ID_gioHang` int(11) NOT NULL,
  `donGia` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `thanhTien` int(11) NOT NULL,
  `ID_TaiKhoan` int(11) NOT NULL,
  `ID_SanPham` int(11) NOT NULL,
  `trangThai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`ID_gioHang`, `donGia`, `soLuong`, `thanhTien`, `ID_TaiKhoan`, `ID_SanPham`, `trangThai`) VALUES
(57, 80000, 1, 80000, 2, 49, 'Đã thanh toán'),
(60, 90000, 5, 450000, 2, 41, 'Chưa thanh toán'),
(61, 125000, 7, 875000, 2, 34, 'Chưa thanh toán'),
(62, 150000, 1, 150000, 2, 43, 'Chưa thanh toán'),
(70, 80000, 5, 400000, 2, 49, 'Đã thanh toán'),
(71, 80000, 5, 400000, 2, 49, 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `maHD` int(11) NOT NULL,
  `thanhTien` int(11) NOT NULL,
  `ID_TaiKhoan` int(11) NOT NULL,
  `ID_gioHang` int(11) NOT NULL,
  `diaChi` varchar(100) NOT NULL,
  `tenKH` varchar(100) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `ID_SanPham` int(11) NOT NULL,
  `ID_dvGiaoHang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`maHD`, `thanhTien`, `ID_TaiKhoan`, `ID_gioHang`, `diaChi`, `tenKH`, `SDT`, `ID_SanPham`, `ID_dvGiaoHang`) VALUES
(43, 415000, 2, 70, 'Xuân Trường, Nam Định', 'Trần Hữu Hùng', '0964985882', 49, 2);

-- --------------------------------------------------------

--
-- Table structure for table `phanhoi`
--

CREATE TABLE `phanhoi` (
  `ID_FB` int(11) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `noiDung` varchar(150) NOT NULL,
  `ID_TaiKhoan` int(11) NOT NULL,
  `ID_SanPham` int(11) NOT NULL,
  `danhGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phanhoi`
--

INSERT INTO `phanhoi` (`ID_FB`, `ngayTao`, `noiDung`, `ID_TaiKhoan`, `ID_SanPham`, `danhGia`) VALUES
(17, '2022-09-21 16:36:32', 'Thời gian giao hàng nhanh. Chất lượng sản phẩm tuyệt vời. ', 2, 49, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `maSP` int(11) NOT NULL,
  `tenSP` varchar(100) NOT NULL,
  `gia` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `loaiDa` varchar(100) NOT NULL,
  `menh` varchar(50) NOT NULL,
  `anhSP` varchar(100) NOT NULL,
  `loaiSP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`maSP`, `tenSP`, `gia`, `soLuong`, `loaiDa`, `menh`, `anhSP`, `loaiSP`) VALUES
(8, 'Vòng đá Lavender', 125000, 2, 'Lavender', 'Hỏa', 'is_3.jpg', 'Phong thủy'),
(12, 'Vòng đá Ametrine', 59000, 15, 'Ametrine', 'Hỏa', 'tt-sp15.jpg', 'Thời trang'),
(15, 'Vòng đá Opal', 65000, 10, 'Đá Opal', 'Mộc', 'sp-8.jpg', 'Phong thủy'),
(16, 'Vòng đá XSMax', 85000, 8, 'Đá XSMax', 'Thổ', 'sp-9.jpg', 'Phong thủy'),
(18, 'Vòng Ưu linh Cẩm thạch', 85000, 12, 'Đá ưu linh tím', 'Kim', 'tt-sp13.jpg', 'Thời trang'),
(19, 'Vòng đá Mặt trăng', 45000, 9, 'Đá thạch anh', 'Hỏa', 'tt-sp19.jpg', 'Thời trang'),
(21, 'Vòng đá Opal', 50000, 12, 'Đá Opal', 'Kim', 'sp-10.jpg', 'Phong thủy'),
(22, 'Vòng tay Ưu linh ', 50000, 8, 'Đá ưu linh', 'Kim', 'tt-sp15.jpg', 'Thời trang'),
(23, 'Vòng tay Thạch anh Tím', 95000, 12, 'Đá ưu linh', 'Thủy', 'tt-sp9.jpg', 'Thời trang'),
(24, 'Thạch anh Tóc xanh', 120000, 15, 'Thạch anh', 'Mộc', 'sp-13.jpg', 'Phong thủy'),
(25, 'Ametrine xanh lá', 115000, 15, 'Đá Ametrine', 'Thổ', 'sp-13.jpg', 'Phong thủy'),
(26, 'Vòng Lu thống Hổ phách', 160000, 16, 'Đá Hổ Phách', 'Hỏa', 'sp-14.jpg', 'Phong thủy'),
(27, 'Vòng đá mặt trăng huyết phách', 99000, 15, 'Đá Thạch anh hồng', 'Mộc', 'sp-15.jpg', 'Phong thủy'),
(28, 'Ưu linh ngũ sắc', 85000, 15, 'Đá ngũ sắc', 'Kim', 'sp-16.jpg', 'Phong thủy'),
(29, 'Vòng tay đá mặt trăng trắng', 145000, 15, 'Đá mặt trăng trắng', 'Thủy', 'sp-17.jpg', 'Phong thủy'),
(30, 'Vòng đá Beryl x Ngọc Hòa Điền ', 160000, 0, 'Đá Berly', 'Thủy', 'sp-18.jpg', 'Phong thủy'),
(31, 'Apatite phối ngọc trai', 90000, 15, 'Đá Apatite', 'Thổ', 'sp-19.jpg', 'Phong thủy'),
(32, 'Thạch Anh Hồng Phối Pha Lê', 99000, 15, 'Thạch anh hồng', 'Thổ', 'sp-3.jpg', 'Phong thủy'),
(33, 'Hổ Phách Mật Lạp x Hồ Lô', 150000, 0, 'Đá hổ phách', 'Thổ', 'sp-20.jpg', 'Phong thủy'),
(34, 'Apatite phối ngọc trai', 125000, 15, 'Đá Apatite', 'Thổ', 'tt-sp4.jpg', 'Thời trang'),
(35, 'Thạch anh Tóc xanh', 120000, 15, 'Thạch anh', 'Mộc', 'tt-sp1.jpg', 'Thời trang'),
(36, 'Vòng Lu thống Hổ phách', 160000, 16, 'Đá Hổ Phách', 'Hỏa', 'tt-sp2.jpg', 'Thời trang'),
(37, 'Vòng đá mặt trăng huyết phách', 99000, 15, 'Đá Thạch anh hồng', 'Mộc', 'tt-sp3.jpg', 'Thời trang'),
(38, 'Ưu linh ngũ sắc', 85000, 15, 'Đá ngũ sắc', 'Kim', 'tt-sp4.jpg', 'Thời trang'),
(39, 'Vòng tay đá mặt trăng trắng', 145000, 15, 'Đá mặt trăng trắng', 'Thủy', 'tt-sp6.jpg', 'Thời trang'),
(40, 'Vòng đá Beryl x Ngọc Hòa Điền x Pha lê', 160000, 15, 'Đá Berly', 'Thủy', 'tt-sp10.jpg', 'Thời trang'),
(41, 'Apatite phối ngọc trai', 90000, 15, 'Đá Apatite', 'Thổ', 'tt-sp12.jpg', 'Thời trang'),
(42, 'Thạch Anh Xanh Phối Pha Lê', 99000, 15, 'Thạch anh hồng', 'Thổ', 'tt-sp17.jpg', 'Thời trang'),
(43, 'Hổ Phách Mật Lạp x Hồ Lô', 150000, 15, 'Đá hổ phách', 'Thổ', 'tt-sp19.jpg', 'Thời trang'),
(49, 'Vòng đá XSMax', 80000, 8, 'Đá ưu linh tím', 'Mộc', 'is_1.jpg', 'Thời trang');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ID` int(11) NOT NULL,
  `tenTK` varchar(50) NOT NULL,
  `matKhau` varchar(20) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `ngayTao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diaChi` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL,
  `gioiTinh` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`ID`, `tenTK`, `matKhau`, `SDT`, `ngayTao`, `diaChi`, `avatar`, `gioiTinh`) VALUES
(1, 'Admin', '1', '0123456789', '2022-09-18 03:55:32', 'Trường Đại học Mỏ - Địa chất', '4f9c069ffd1808465109.jpg', 'Nam'),
(2, 'Trần Hữu Hùng', '2', '0964985882', '2022-05-30 04:04:29', 'Xuân Trường, Nam Định', 'meo_coder.jpg', 'Nam'),
(3, 'WabsiMia', '1234Humg@', '0666688888', '2022-01-03 14:37:54', 'Humg HaNoi', 'avt3.jpg', 'Nữ'),
(11, 'Trần Hùng', 'Hello1234', '0943945644', '2021-12-30 17:48:39', 'Xuân Trường, Nam Định', 'avt4.jpg', 'Nam'),
(31, 'Mia Trần', 'Mia1234%', '01234567891', '2022-01-04 03:35:58', 'Phố Viên, Bắc Từ Liêm, Hà Nội', 'z2592174887906_b3ab159f5f33dc4e45670e781a72fc93.jpg', 'Nam'),
(33, 'Trần Minh A', 'H123$$u', '0948374731', '2022-08-20 16:48:25', 'Xuân Tiến, Xuân Trường, Nam Định ', 'Ảnh chân dung.jpg', 'Nam');

-- --------------------------------------------------------

--
-- Table structure for table `tuongtac`
--

CREATE TABLE `tuongtac` (
  `ID_tuongtac` int(11) NOT NULL,
  `trangThai` varchar(5) DEFAULT NULL,
  `ID_TaiKhoan` int(11) NOT NULL,
  `ID_BLog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuongtac`
--

INSERT INTO `tuongtac` (`ID_tuongtac`, `trangThai`, `ID_TaiKhoan`, `ID_BLog`) VALUES
(65, 'yes', 2, 1),
(66, 'yes', 2, 2),
(68, 'yes', 31, 20),
(69, 'yes', 31, 1),
(70, 'yes', 31, 8),
(71, 'yes', 2, 8),
(72, 'yes', 2, 20),
(73, 'yes', 1, 1),
(74, 'yes', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloguser`
--
ALTER TABLE `bloguser`
  ADD PRIMARY KEY (`ID_blog`),
  ADD KEY `ID_taiKhoan` (`ID_taiKhoan`);

--
-- Indexes for table `blogweb`
--
ALTER TABLE `blogweb`
  ADD PRIMARY KEY (`ID_blog`);

--
-- Indexes for table `bosuutap`
--
ALTER TABLE `bosuutap`
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`),
  ADD KEY `ID_SanPham` (`ID_SanPham`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_comment`),
  ADD KEY `ID_blog` (`ID_blog`),
  ADD KEY `ID_taikhoan` (`ID_taikhoan`);

--
-- Indexes for table `giaohang`
--
ALTER TABLE `giaohang`
  ADD PRIMARY KEY (`ID_dvi`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ID_gioHang`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`),
  ADD KEY `ID_SanPham` (`ID_SanPham`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`maHD`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`),
  ADD KEY `ID_gioHang` (`ID_gioHang`),
  ADD KEY `ID_SanPham` (`ID_SanPham`),
  ADD KEY `ID_dvGiaoHang` (`ID_dvGiaoHang`);

--
-- Indexes for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`ID_FB`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`),
  ADD KEY `ID_SanPham` (`ID_SanPham`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`maSP`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tuongtac`
--
ALTER TABLE `tuongtac`
  ADD PRIMARY KEY (`ID_tuongtac`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`),
  ADD KEY `ID_BLog` (`ID_BLog`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloguser`
--
ALTER TABLE `bloguser`
  MODIFY `ID_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `blogweb`
--
ALTER TABLE `blogweb`
  MODIFY `ID_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `giaohang`
--
ALTER TABLE `giaohang`
  MODIFY `ID_dvi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ID_gioHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `maHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `ID_FB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `maSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tuongtac`
--
ALTER TABLE `tuongtac`
  MODIFY `ID_tuongtac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloguser`
--
ALTER TABLE `bloguser`
  ADD CONSTRAINT `bloguser_ibfk_1` FOREIGN KEY (`ID_taiKhoan`) REFERENCES `taikhoan` (`ID`);

--
-- Constraints for table `bosuutap`
--
ALTER TABLE `bosuutap`
  ADD CONSTRAINT `bosuutap_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `bosuutap_ibfk_2` FOREIGN KEY (`ID_SanPham`) REFERENCES `sanpham` (`maSP`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `ID_taikhoan` FOREIGN KEY (`ID_taikhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ID_blog`) REFERENCES `bloguser` (`ID_blog`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`ID_SanPham`) REFERENCES `sanpham` (`maSP`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`ID_gioHang`) REFERENCES `giohang` (`ID_gioHang`),
  ADD CONSTRAINT `hoadon_ibfk_4` FOREIGN KEY (`ID_SanPham`) REFERENCES `sanpham` (`maSP`),
  ADD CONSTRAINT `hoadon_ibfk_5` FOREIGN KEY (`id_dvGiaoHang`) REFERENCES `giaohang` (`ID_dvi`),
  ADD CONSTRAINT `hoadon_ibfk_6` FOREIGN KEY (`ID_dvGiaoHang`) REFERENCES `giaohang` (`ID_dvi`);

--
-- Constraints for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD CONSTRAINT `phanhoi_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `phanhoi_ibfk_2` FOREIGN KEY (`ID_SanPham`) REFERENCES `sanpham` (`maSP`);

--
-- Constraints for table `tuongtac`
--
ALTER TABLE `tuongtac`
  ADD CONSTRAINT `tuongtac_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID`),
  ADD CONSTRAINT `tuongtac_ibfk_2` FOREIGN KEY (`ID_BLog`) REFERENCES `bloguser` (`ID_blog`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
