<?php
session_start();

try {
    // Assign values to variables
    $tenKho = isset($_POST['tenKho']) ? $_POST['tenKho'] : ''; // Ensure $tenKho is not null or empty
    $sucChua = isset($_POST['sucChua']) ? $_POST['sucChua'] : '';
    $maNhanVien = isset($_POST['maNhanVien']) ? $_POST['maNhanVien'] : '';
    $trangThai = "Đang sử dụng";

    // Check if $tenKho is not null or empty
    if (empty($tenKho)) {
        throw new Exception("Tên kho không được để trống.");
    }

    // Sử dụng prepared statement để tránh SQL injection
    $sql = "INSERT INTO kho(tenKho, sucChua, maNhanVien, trangThai) VALUES (:tenKho, :sucChua, :maNhanVien, :trangThai)";

    include("connection.php");

    // Chuẩn bị và thực hiện truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tenKho', $tenKho, PDO::PARAM_STR);
    $stmt->bindParam(':sucChua', $sucChua);
    $stmt->bindParam(':maNhanVien', $maNhanVien, PDO::PARAM_STR);
    $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);

    $stmt->execute();

    $response = array(
        'success' => true,
        'message' => "Dữ liệu đã được thêm thành công!"
    );
} catch (Exception $e) {
    $response = array(
        'success' => false,
        'message' => $e->getMessage()
    );
}

// Lưu thông báo vào session và chuyển hướng trang
$_SESSION['response'] = $response;
header("refresh:0; url='../kho-add.php'");
?>
