<?php
    include("connection.php");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn
    $query = "SELECT 
        lohang.maLoHang, 
        nguyenvatlieu.tenNguyenVatLieu, 
        lohang.soLuongNhap, 
        lohang.donViTinh, 
        lohang.ngaySanXuat, 
        lohang.hanSuDung, 
        lohang.maPhieuNhapKho, 
        lohang.ngayLap, 
        kho.tenKho,
        phieudieuphoi.maPhieuDieuPhoi, 
        phieudieuphoi.ngayLapPhieu
        FROM 
            lohang
        INNER JOIN 
            nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
        INNER JOIN 
            kho ON lohang.maKho = kho.maKho
        INNER JOIN 
            phieudieuphoi ON lohang.maLoHang = phieudieuphoi.maLoHang; 
    ";

    // Thực hiện truy vấn
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;

?>