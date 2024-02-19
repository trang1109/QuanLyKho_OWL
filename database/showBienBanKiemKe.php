<?php
    include("connection.php");
    // $stmt = $conn->prepare("SELECT 
    // bienbankiemke.maBienBanKiemKe, bienbankiemke.moTaKiemKe, bienbankiemke.soLuongKiemKe, bienbankiemke.trangThai
    // lohang.maLoHang, lohang.maKho, nguyenvatlieu.maNguyenVatLieu
    // FROM bienbankiemke 
    // INNER JOIN lohang ON lohang.maLoHang = bienbankiemke.maLoHang
    // INNER JOIN nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu");
    $stmt = $conn->prepare("SELECT bienbankiemke.maBienBanKiemKe, bienbankiemke.moTaKiemKe, bienbankiemke.soLuongKiemKe, 
    bienbankiemke.trangThai, lohang.maLoHang, kho.tenKho, nguyenvatlieu.tenNguyenVatLieu
    FROM bienbankiemke
    INNER JOIN lohang ON lohang.maLoHang = bienbankiemke.maLoHang
    INNER JOIN nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
    INNER JOIN kho ON lohang.maKho = kho.maKho
    LIMIT 0 , 30");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    return $data;

?>