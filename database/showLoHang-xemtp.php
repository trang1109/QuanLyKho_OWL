<?php
    include("connection.php");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn
    $query = "SELECT lohangtp.maLoHang, thanhpham.tenThanhPham, lohangtp.soLuongNhap, lohangtp.donViTinh, 
    lohangtp.ngaySanXuat, lohangtp.hanSuDung, lohangtp.maPhieuNhapKho, lohangtp.ngayLap
              FROM lohangtp
              INNER JOIN thanhpham ON lohangtp.maThanhPham = thanhpham.maThanhPham
              ORDER BY lohangtp.maPhieuNhapKho DESC";

    // Thực hiện truy vấn
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;

?>