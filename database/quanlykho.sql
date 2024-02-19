-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2023 at 01:37 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quanlykho`
--

-- --------------------------------------------------------

--
-- Table structure for table `bienbankiemke`
--

CREATE TABLE `bienbankiemke` (
  `maBienBanKiemKe` varchar(11) NOT NULL,
  `maKho` int(11) NOT NULL,
  `maLoHang` varchar(20) NOT NULL,
  `maTaiKhoan` varchar(10) NOT NULL,
  `ngayLap` date NOT NULL,
  `moTaKiemKe` varchar(100) NOT NULL,
  `soLuongKiemKe` double NOT NULL,
  `trangThai` varchar(20) NOT NULL,
  PRIMARY KEY  (`maBienBanKiemKe`),
  KEY `maTaiKhoan` (`maTaiKhoan`),
  KEY `maKho` (`maKho`),
  KEY `maLoHang` (`maLoHang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bienbankiemke`
--

INSERT INTO `bienbankiemke` (`maBienBanKiemKe`, `maKho`, `maLoHang`, `maTaiKhoan`, `ngayLap`, `moTaKiemKe`, `soLuongKiemKe`, `trangThai`) VALUES
('BBKK10109', 2, 'LH7314693', 'admin', '2023-12-14', 'Số lượng lớn hơn số lượng thực tế trong kho', 190, 'Không duyệt'),
('BBKK56426', 2, 'LH1976776', 'admin', '2023-12-14', 'Số lượng nhỏ hơn số lượng thực tế trong kho', 70, 'Chờ duyệt');

-- --------------------------------------------------------

--
-- Table structure for table `chitietxuatlo`
--

CREATE TABLE `chitietxuatlo` (
  `maChiTietXuatLo` varchar(20) NOT NULL,
  `maLoHang` varchar(20) default NULL,
  `maPhieuXuatKho` int(11) default NULL,
  `soLuong` double default NULL,
  PRIMARY KEY  (`maChiTietXuatLo`),
  KEY `maLoHang` (`maLoHang`),
  KEY `maPhieuXuatKho` (`maPhieuXuatKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietxuatlo`
--

INSERT INTO `chitietxuatlo` (`maChiTietXuatLo`, `maLoHang`, `maPhieuXuatKho`, `soLuong`) VALUES
('CTXL1020204', 'LH1666034', 1702578969, 250),
('CTXL1311487', 'LH1538144', 1702466190, 50),
('CTXL1743614', 'LH7314693', 1702528055, 50),
('CTXL1744413', 'LH1908538', 1702468032, 44),
('CTXL2110142', 'LH1976776', 1702466558, 10),
('CTXL6029978', 'LH1538144', 1702466680, 10);

-- --------------------------------------------------------

--
-- Table structure for table `chitietxuatlotp`
--

CREATE TABLE `chitietxuatlotp` (
  `maChiTietXuatLo` varchar(20) NOT NULL,
  `maLoHang` varchar(20) default NULL,
  `maPhieuXuatKho` int(11) default NULL,
  `soLuong` double default NULL,
  PRIMARY KEY  (`maChiTietXuatLo`),
  KEY `maLoHang` (`maLoHang`),
  KEY `maPhieuXuatKho` (`maPhieuXuatKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietxuatlotp`
--

INSERT INTO `chitietxuatlotp` (`maChiTietXuatLo`, `maLoHang`, `maPhieuXuatKho`, `soLuong`) VALUES
('CTXL1187191', 'LH4830724', 1702471625, 400),
('CTXL6841056', 'LH1316105', 1702471603, 50);

-- --------------------------------------------------------

--
-- Table structure for table `kho`
--

CREATE TABLE `kho` (
  `maKho` int(11) NOT NULL auto_increment,
  `tenKho` varchar(50) NOT NULL,
  `sucChua` double NOT NULL,
  `maNhanVien` varchar(10) NOT NULL,
  `trangThai` varchar(30) NOT NULL,
  PRIMARY KEY  (`maKho`),
  KEY `maNhanVien` (`maNhanVien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `kho`
--

INSERT INTO `kho` (`maKho`, `tenKho`, `sucChua`, `maNhanVien`, `trangThai`) VALUES
(1, 'Kho NVL  - 1', 5000, 'NV01', 'Đã xóa'),
(2, 'Kho NVL  - 2', 5000, 'NV02', 'Đang sử dụng'),
(3, 'Kho NVL  - 3', 5000, 'NV03', 'Đang sử dụng'),
(4, 'Kho TP  - 1', 7000, 'NV04', 'Đang sử dụng'),
(5, 'Kho TP  - 2', 7000, 'NV05', 'Đang sử dụng'),
(6, 'Kho TP  - 3', 4500, 'NV06', 'Đang sử dụng'),
(7, 'Kho NVL  - 4', 5000, 'NV01', 'Đang sử dụng'),
(8, 'Kho TP - 4', 70000, 'NV01', 'Đang sử dụng'),
(10, 'Kho TP - 5', 6000, 'NV03', 'Đã xóa');

-- --------------------------------------------------------

--
-- Table structure for table `lohang`
--

CREATE TABLE `lohang` (
  `maLoHang` varchar(20) NOT NULL,
  `maNguyenVatLieu` int(11) NOT NULL,
  `maKho` int(11) default NULL,
  `soLuongNhap` double NOT NULL,
  `soLuongChinh` double NOT NULL,
  `donViTinh` varchar(10) NOT NULL,
  `ngaySanXuat` date NOT NULL,
  `hanSuDung` date NOT NULL,
  `maPhieuNhapKho` int(20) default NULL,
  `ngayLap` date NOT NULL,
  `ngayCapNhat` date NOT NULL,
  PRIMARY KEY  (`maLoHang`),
  KEY `maPhieuNhapKho` (`maPhieuNhapKho`),
  KEY `tenNguyenVatLieu` (`maNguyenVatLieu`),
  KEY `maKho` (`maKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lohang`
--

INSERT INTO `lohang` (`maLoHang`, `maNguyenVatLieu`, `maKho`, `soLuongNhap`, `soLuongChinh`, `donViTinh`, `ngaySanXuat`, `hanSuDung`, `maPhieuNhapKho`, `ngayLap`, `ngayCapNhat`) VALUES
('LH1538144', 6, 2, 200, 140, 'kg', '2023-12-06', '2024-01-06', 1702465895, '2023-12-13', '2023-12-13'),
('LH1666034', 2, 3, 400, 150, 'kg', '2023-11-30', '2023-12-22', 1702578152, '2023-12-15', '2023-12-15'),
('LH1889165', 11, NULL, 300, 300, 'kg', '2023-11-30', '2024-05-02', 1702578253, '2023-12-15', '0000-00-00'),
('LH1908538', 9, 7, 444, 400, 'kg', '2023-12-01', '2024-01-01', 1702465949, '2023-12-13', '2023-12-13'),
('LH1976776', 6, 2, 50, 40, 'kg', '2023-11-28', '2024-01-06', 1702465949, '2023-12-13', '2023-12-13'),
('LH1986779', 13, NULL, 200, 200, 'kg', '2023-12-14', '2024-01-25', 1702578253, '2023-12-15', '0000-00-00'),
('LH2019621', 19, 7, 333, 333, 'kg', '2023-12-10', '2023-12-30', 1702471050, '2023-12-13', '2023-12-13'),
('LH3147155', 25, NULL, 100, 100, 'kg', '2023-12-07', '2023-12-30', 1702578253, '2023-12-15', '0000-00-00'),
('LH3714074', 3, NULL, 250, 250, 'kg', '2023-11-15', '2024-02-29', 1702578152, '2023-12-15', '0000-00-00'),
('LH5678550', 5, NULL, 150, 150, 'kg', '2023-11-30', '2024-02-02', 1702578204, '2023-12-15', '0000-00-00'),
('LH6026387', 23, NULL, 425, 425, 'kg', '2023-11-30', '2023-12-27', 1702578204, '2023-12-15', '0000-00-00'),
('LH7314693', 16, 2, 200, 150, 'kg', '2023-12-01', '2024-01-05', 1702527915, '2023-12-14', '2023-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `lohangtp`
--

CREATE TABLE `lohangtp` (
  `maLoHang` varchar(20) NOT NULL,
  `maThanhPham` int(11) NOT NULL,
  `maKho` int(11) default NULL,
  `soLuongNhap` double NOT NULL,
  `soLuongChinh` double NOT NULL,
  `donViTinh` varchar(10) NOT NULL,
  `ngaySanXuat` date NOT NULL,
  `hanSuDung` date NOT NULL,
  `maPhieuNhapKho` int(20) default NULL,
  `ngayLap` date NOT NULL,
  `ngayCapNhat` date NOT NULL,
  PRIMARY KEY  (`maLoHang`),
  KEY `maPhieuNhapKho` (`maPhieuNhapKho`),
  KEY `maThanhPham` (`maThanhPham`),
  KEY `maKho` (`maKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lohangtp`
--

INSERT INTO `lohangtp` (`maLoHang`, `maThanhPham`, `maKho`, `soLuongNhap`, `soLuongChinh`, `donViTinh`, `ngaySanXuat`, `hanSuDung`, `maPhieuNhapKho`, `ngayLap`, `ngayCapNhat`) VALUES
('LH1316105', 7, 4, 150, 100, 'hộp', '2023-12-05', '2025-05-27', 1702471209, '2023-12-13', '2023-12-13'),
('LH1324174', 10, NULL, 500, 500, 'hộp', '2023-12-01', '2024-10-10', 1702527958, '2023-12-14', '0000-00-00'),
('LH1463425', 4, NULL, 200, 200, 'hộp', '2023-12-15', '2026-05-14', 1702578557, '2023-12-15', '0000-00-00'),
('LH1674033', 6, NULL, 200, 200, 'hộp', '2023-12-15', '2025-12-01', 1702578557, '2023-12-15', '0000-00-00'),
('LH1692355', 20, NULL, 222, 222, 'hộp', '2023-11-30', '2024-01-06', 1702578624, '2023-12-15', '0000-00-00'),
('LH1794303', 3, NULL, 90, 90, 'hộp', '2023-12-09', '2024-11-15', 1702578624, '2023-12-15', '0000-00-00'),
('LH1831260', 7, 4, 300, 300, 'hộp', '2023-11-27', '2024-03-27', 1702471309, '2023-12-13', '2023-12-13'),
('LH1959647', 2, NULL, 100, 100, 'hộp', '2023-11-29', '2025-03-15', 1702578557, '2023-12-15', '0000-00-00'),
('LH4830724', 17, 8, 444, 44, 'hộp', '2023-12-04', '2025-10-10', 1702471254, '2023-12-13', '2023-12-13'),
('LH7018541', 15, NULL, 600, 600, 'hộp', '2023-12-05', '2024-02-21', 1702471254, '2023-12-13', '0000-00-00'),
('LH8153911', 13, NULL, 350, 350, 'hộp', '2023-12-14', '2025-10-22', 1702578481, '2023-12-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `nguyenvatlieu`
--

CREATE TABLE `nguyenvatlieu` (
  `maNguyenVatLieu` int(11) NOT NULL auto_increment,
  `tenNguyenVatLieu` varchar(50) NOT NULL,
  `soLuong` double default NULL,
  `donViTinh` varchar(10) NOT NULL,
  `trangThai` varchar(30) NOT NULL,
  PRIMARY KEY  (`maNguyenVatLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `nguyenvatlieu`
--

INSERT INTO `nguyenvatlieu` (`maNguyenVatLieu`, `tenNguyenVatLieu`, `soLuong`, `donViTinh`, `trangThai`) VALUES
(1, 'Cà chua', 0, 'kg', 'Đang sử dụng'),
(2, 'Thịt heo', 150, 'kg', 'Đang sử dụng'),
(3, 'Đường', 250, 'kg', 'Đang sử dụng'),
(4, 'Hạt nêm', 0, 'kg', 'Đang sử dụng'),
(5, 'Muối   ', 150, 'kg', 'Đang sử dụng'),
(6, 'Cá thu ', 180, 'kg', 'Đang sử dụng'),
(7, 'Thịt dê', 0, 'kg', 'Đang sử dụng'),
(8, 'Thịt bò', 0, 'kg', 'Đang sử dụng'),
(9, 'Ớt', 400, 'kg', 'Đang sử dụng'),
(10, 'Cá ngừ đại dương', 0, 'kg', 'Đang sử dụng'),
(11, 'Đậu nành', 300, 'kg', 'Đang sử dụng'),
(12, 'Gà đông lạnh', 0, 'kg', 'Đang sử dụng'),
(13, 'Gan ngỗng', 200, 'kg', 'Đang sử dụng'),
(14, 'Bắp', 0, 'kg', 'Đang sử dụng'),
(15, 'Dầu ăn', 0, 'kg', 'Đang sử dụng'),
(16, 'Tôm', 150, 'kg', 'Đang sử dụng'),
(17, 'Mắc khén', 0, 'kg', 'Đang sử dụng'),
(18, 'Hạt tiêu', 0, 'kg', 'Đang sử dụng'),
(19, 'Sả', 333, 'kg', 'Đang sử dụng'),
(20, 'Gừng', 0, 'kg', 'Đang sử dụng'),
(21, 'Cá  nục', 0, 'kg', 'Đang sử dụng'),
(22, 'Bào ngư', 0, 'kg', 'Đang sử dụng'),
(23, 'Cá  mòi', 425, 'kg', 'Đang sử dụng'),
(24, 'Thịt mèo', 0, 'tấn', 'Đang sử dụng'),
(25, 'Cá hồi', 100, 'kg', 'Đang sử dụng'),
(26, 'Thịt thỏ', 0, 'kg', 'Đang sử dụng');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `tenNhanVien` varchar(100) NOT NULL,
  `maNhanVien` varchar(10) NOT NULL,
  PRIMARY KEY  (`maNhanVien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`tenNhanVien`, `maNhanVien`) VALUES
('Phùng Nguyễn Như Thùy', 'NV01'),
('Nguyễn Đình Đức', 'NV02'),
('Huỳnh Đình Chiểu ', 'NV03'),
('Bùi Thị Huyền Trang', 'NV04'),
('Vũ Công Danh', 'NV05'),
('Meo Meo', 'NV06');

-- --------------------------------------------------------

--
-- Table structure for table `phieudieuphoi`
--

CREATE TABLE `phieudieuphoi` (
  `maPhieuDieuPhoi` int(11) NOT NULL auto_increment,
  `ngayLapPhieu` date NOT NULL,
  `maKho` int(11) NOT NULL,
  `maLoHang` varchar(20) NOT NULL,
  PRIMARY KEY  (`maPhieuDieuPhoi`),
  KEY `maKho` (`maKho`),
  KEY `maLoHang` (`maLoHang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1702578938 ;

--
-- Dumping data for table `phieudieuphoi`
--

INSERT INTO `phieudieuphoi` (`maPhieuDieuPhoi`, `ngayLapPhieu`, `maKho`, `maLoHang`) VALUES
(1702466176, '2023-12-13', 2, 'LH1538144'),
(1702466543, '2023-12-13', 2, 'LH1976776'),
(1702467974, '2023-12-13', 7, 'LH1908538'),
(1702471057, '2023-12-13', 7, 'LH2019621'),
(1702528032, '2023-12-14', 2, 'LH7314693'),
(1702578937, '2023-12-15', 3, 'LH1666034');

-- --------------------------------------------------------

--
-- Table structure for table `phieudieuphoitp`
--

CREATE TABLE `phieudieuphoitp` (
  `maPhieuDieuPhoi` int(11) NOT NULL auto_increment,
  `ngayLapPhieu` date NOT NULL,
  `maKho` int(11) NOT NULL,
  `maLoHang` varchar(20) NOT NULL,
  PRIMARY KEY  (`maPhieuDieuPhoi`),
  KEY `maKho` (`maKho`),
  KEY `maLoHang` (`maLoHang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1702471325 ;

--
-- Dumping data for table `phieudieuphoitp`
--

INSERT INTO `phieudieuphoitp` (`maPhieuDieuPhoi`, `ngayLapPhieu`, `maKho`, `maLoHang`) VALUES
(1702471278, '2023-12-13', 4, 'LH1316105'),
(1702471285, '2023-12-13', 8, 'LH4830724'),
(1702471324, '2023-12-13', 4, 'LH1831260');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhapkho`
--

CREATE TABLE `phieunhapkho` (
  `maPhieuNhapKho` int(20) NOT NULL,
  `ngayLapPhieu` date NOT NULL,
  PRIMARY KEY  (`maPhieuNhapKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieunhapkho`
--

INSERT INTO `phieunhapkho` (`maPhieuNhapKho`, `ngayLapPhieu`) VALUES
(1702465895, '2023-12-13'),
(1702465949, '2023-12-13'),
(1702471050, '2023-12-13'),
(1702527434, '2023-12-14'),
(1702527915, '2023-12-14'),
(1702578152, '2023-12-15'),
(1702578204, '2023-12-15'),
(1702578253, '2023-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhapkhotp`
--

CREATE TABLE `phieunhapkhotp` (
  `maPhieuNhapKho` int(20) NOT NULL,
  `ngayLapPhieu` date NOT NULL,
  PRIMARY KEY  (`maPhieuNhapKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieunhapkhotp`
--

INSERT INTO `phieunhapkhotp` (`maPhieuNhapKho`, `ngayLapPhieu`) VALUES
(1702471209, '2023-12-13'),
(1702471254, '2023-12-13'),
(1702471309, '2023-12-13'),
(1702527958, '2023-12-14'),
(1702578481, '2023-12-15'),
(1702578557, '2023-12-15'),
(1702578624, '2023-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `phieuxuatkho`
--

CREATE TABLE `phieuxuatkho` (
  `maPhieuXuatKho` int(20) NOT NULL,
  `ngayLapPhieu` date default NULL,
  PRIMARY KEY  (`maPhieuXuatKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieuxuatkho`
--

INSERT INTO `phieuxuatkho` (`maPhieuXuatKho`, `ngayLapPhieu`) VALUES
(1702466190, '2023-12-13'),
(1702466558, '2023-12-13'),
(1702466680, '2023-12-13'),
(1702468032, '2023-12-13'),
(1702528055, '2023-12-14'),
(1702578969, '2023-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `phieuxuatkhotp`
--

CREATE TABLE `phieuxuatkhotp` (
  `maPhieuXuatKho` int(20) NOT NULL,
  `ngayLapPhieu` date default NULL,
  PRIMARY KEY  (`maPhieuXuatKho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieuxuatkhotp`
--

INSERT INTO `phieuxuatkhotp` (`maPhieuXuatKho`, `ngayLapPhieu`) VALUES
(1702471603, '2023-12-13'),
(1702471625, '2023-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `matKhau` int(11) NOT NULL,
  `maTaiKhoan` varchar(10) NOT NULL,
  `tenTaiKhoan` varchar(30) NOT NULL,
  `trangThai` varchar(30) NOT NULL,
  PRIMARY KEY  (`maTaiKhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`matKhau`, `maTaiKhoan`, `tenTaiKhoan`, `trangThai`) VALUES
(999000, 'admin', 'admin', 'Đang hoạt động'),
(12345, 'GD001', 'Giám Đốc ', 'Đã xóa'),
(1111, 'NV01', 'Nhân Viên Kho', 'Đã xóa'),
(1111, 'NV02', 'Nhân Viên Kho', 'Đang hoạt động'),
(1111, 'NV03', 'Nhân Viên Kho', 'Tạm khóa'),
(1111, 'NV04', 'Nhân Viên Kho', 'Đang hoạt động'),
(1111, 'NV05', 'Nhân Viên Kho', 'Đang hoạt động'),
(3333, 'NV06', 'Nhân Viên Kho', 'Đang hoạt động'),
(90909, 'QLK002', 'Quản Lý Kho', 'Đang hoạt động'),
(666777, 'SXKD003', 'Bộ Phận SXKD', 'Đang hoạt động');

-- --------------------------------------------------------

--
-- Table structure for table `thanhpham`
--

CREATE TABLE `thanhpham` (
  `maThanhPham` int(11) NOT NULL auto_increment,
  `tenThanhPham` varchar(50) NOT NULL,
  `soLuong` double default NULL,
  `donViTinh` varchar(5) NOT NULL,
  `trangThai` varchar(30) NOT NULL,
  PRIMARY KEY  (`maThanhPham`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `thanhpham`
--

INSERT INTO `thanhpham` (`maThanhPham`, `tenThanhPham`, `soLuong`, `donViTinh`, `trangThai`) VALUES
(1, 'Cá nục sốt cà', 0, 'Hộp', 'Đang sử dụng'),
(2, 'Pate cột đèn HP', 100, 'Hộp', 'Đang sử dụng'),
(3, 'Thịt bò sốt vang đóng hộp', 90, 'Hộp', 'Đang sử dụng'),
(4, 'Gan ngỗng Pháp đóng hộp ', 200, 'Hộp', 'Đang sử dụng'),
(6, 'Bò Hầm', 200, 'Hộp', 'Đang sử dụng'),
(7, 'Cá ngừ ngâm đậu', 400, 'Hộp', 'Đang sử dụng'),
(8, 'Mắm chưng trứng vịt muối', 0, 'Hộp', 'Đang sử dụng'),
(9, 'Mắm chưng trứng vịt muối', 0, 'Hộp', 'Đang sử dụng'),
(10, 'Bò bít tết sốt tiêu đen', 500, 'Hộp', 'Đang sử dụng'),
(11, 'Cá ngừ ngâm dầu', 0, 'Hộp', 'Đang sử dụng'),
(12, 'Cá ngừ vị ớt cay', 0, 'Hộp', 'Đang sử dụng'),
(13, 'Cá SaBa Sriacha', 350, 'Hộp', 'Đang sử dụng'),
(14, 'Cá mòi sốt cà chua', 0, 'Hộp', 'Đang sử dụng'),
(15, 'Cà ri Gà', 600, 'Hộp', 'Đang sử dụng'),
(16, 'Cá Sapa Sốt cà chua', 0, 'Hộp', 'Đang sử dụng'),
(17, 'Heo hầm chay', 44, 'Hộp', 'Đang sử dụng'),
(18, 'Mắm chưng trứng vịt muối', 0, 'Hộp', 'Đang sử dụng'),
(19, 'Pate cá hồi phô mai', 0, 'Hộp', 'Đang sử dụng'),
(20, 'Pate Gan', 222, 'Hộp', 'Đang sử dụng'),
(21, 'Pate Gan Bò', 0, 'Hộp', 'Đang sử dụng'),
(22, 'Bò Chay', 0, 'Hộp', 'Đang sử dụng'),
(23, 'Ragu bò chay', 0, 'Hộp', 'Đang sử dụng'),
(24, 'Thịt bò xay', 0, 'Hộp', 'Đang sử dụng'),
(25, 'Meo', 0, 'Hộp', 'Đang sử dụng'),
(26, 'Bắp USA  ', 0, 'Hộp', 'Đang sử dụng'),
(27, 'Trứng cá chuồn UK', 0, 'Hộp', 'Đang sử dụng');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bienbankiemke`
--
ALTER TABLE `bienbankiemke`
  ADD CONSTRAINT `bienbankiemke_ibfk_18` FOREIGN KEY (`maKho`) REFERENCES `lohang` (`maKho`),
  ADD CONSTRAINT `bienbankiemke_ibfk_19` FOREIGN KEY (`maTaiKhoan`) REFERENCES `taikhoan` (`maTaiKhoan`);

--
-- Constraints for table `chitietxuatlo`
--
ALTER TABLE `chitietxuatlo`
  ADD CONSTRAINT `chitietxuatlo_ibfk_2` FOREIGN KEY (`maLoHang`) REFERENCES `lohang` (`maLoHang`),
  ADD CONSTRAINT `chitietxuatlo_ibfk_3` FOREIGN KEY (`maPhieuXuatKho`) REFERENCES `phieuxuatkho` (`maPhieuXuatKho`);

--
-- Constraints for table `chitietxuatlotp`
--
ALTER TABLE `chitietxuatlotp`
  ADD CONSTRAINT `chitietxuatlotp_ibfk_1` FOREIGN KEY (`maLoHang`) REFERENCES `lohangtp` (`maLoHang`),
  ADD CONSTRAINT `chitietxuatlotp_ibfk_2` FOREIGN KEY (`maPhieuXuatKho`) REFERENCES `phieuxuatkhotp` (`maPhieuXuatKho`);

--
-- Constraints for table `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `kho_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`);

--
-- Constraints for table `lohang`
--
ALTER TABLE `lohang`
  ADD CONSTRAINT `lohang_ibfk_3` FOREIGN KEY (`maNguyenVatLieu`) REFERENCES `nguyenvatlieu` (`maNguyenVatLieu`),
  ADD CONSTRAINT `lohang_ibfk_4` FOREIGN KEY (`maKho`) REFERENCES `kho` (`maKho`),
  ADD CONSTRAINT `lohang_ibfk_5` FOREIGN KEY (`maPhieuNhapKho`) REFERENCES `phieunhapkho` (`maPhieuNhapKho`);

--
-- Constraints for table `lohangtp`
--
ALTER TABLE `lohangtp`
  ADD CONSTRAINT `lohangtp_ibfk_1` FOREIGN KEY (`maThanhPham`) REFERENCES `thanhpham` (`maThanhPham`),
  ADD CONSTRAINT `lohangtp_ibfk_2` FOREIGN KEY (`maKho`) REFERENCES `kho` (`maKho`),
  ADD CONSTRAINT `lohangtp_ibfk_3` FOREIGN KEY (`maPhieuNhapKho`) REFERENCES `phieunhapkhotp` (`maPhieuNhapKho`);

--
-- Constraints for table `phieudieuphoi`
--
ALTER TABLE `phieudieuphoi`
  ADD CONSTRAINT `phieudieuphoi_ibfk_1` FOREIGN KEY (`maKho`) REFERENCES `kho` (`maKho`),
  ADD CONSTRAINT `phieudieuphoi_ibfk_2` FOREIGN KEY (`maLoHang`) REFERENCES `lohang` (`maLoHang`);

--
-- Constraints for table `phieudieuphoitp`
--
ALTER TABLE `phieudieuphoitp`
  ADD CONSTRAINT `phieudieuphoitp_ibfk_1` FOREIGN KEY (`maKho`) REFERENCES `kho` (`maKho`),
  ADD CONSTRAINT `phieudieuphoitp_ibfk_2` FOREIGN KEY (`maLoHang`) REFERENCES `lohangtp` (`maLoHang`);
