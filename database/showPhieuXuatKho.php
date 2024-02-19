<?php
    include("connection.php");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn
    $query = "SELECT lohang.maLoHang, nguyenvatlieu.tenNguyenVatLieu, lohang.soLuongNhap, lohang.donViTinh, 
    lohang.ngaySanXuat, lohang.hanSuDung, 
    phieuxuatkho.ngayLapPhieu, chitietxuatlo.soLuong, phieuxuatkho.maPhieuXuatKho
              FROM lohang
              INNER JOIN nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
              INNER JOIN chitietxuatlo ON lohang.maLoHang = chitietxuatlo.maLoHang
              INNER JOIN phieuxuatkho ON chitietxuatlo.maPhieuXuatKho = phieuxuatkho.maPhieuXuatKho";

    // Thực hiện truy vấn
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;

?>