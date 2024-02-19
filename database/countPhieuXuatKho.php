<?php
    include("connection.php");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn
    $query = "SELECT maPhieuXuatKho as soLuongPhieuXuatKho
    FROM phieuxuatkho
    GROUP BY maPhieuXuatKho";

    // Thực hiện truy vấn
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;
?>