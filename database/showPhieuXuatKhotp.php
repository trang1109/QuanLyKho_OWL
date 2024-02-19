<?php
    include("connection.php");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn
    $query = "SELECT lohangtp.maLoHang, lohangtp.soLuongNhap, lohangtp.donViTinh, 
    lohangtp.ngaySanXuat, lohangtp.hanSuDung, thanhpham.tenThanhPham,
    phieuxuatkhotp.ngayLapPhieu, chitietxuatlotp.soLuong, phieuxuatkhotp.maPhieuXuatKho
              FROM lohangtp
              INNER JOIN thanhpham ON lohangtp.maThanhPham = thanhpham.maThanhPham
              INNER JOIN chitietxuatlotp ON lohangtp.maLoHang = chitietxuatlotp.maLoHang
              INNER JOIN phieuxuatkhotp ON chitietxuatlotp.maPhieuXuatKho = phieuxuatkhotp.maPhieuXuatKho";

    // Thực hiện truy vấn
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;

?>